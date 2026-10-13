import json, re, html, datetime, os
from urllib.parse import quote_plus

steam = json.load(open(".work/steam/final.json", encoding="utf-8"))
_sc = os.path.join(".work", "screenshots.json")
SHOTS = json.load(open(_sc, encoding="utf-8")) if os.path.exists(_sc) else {}

GENRES = [
    ("Action", "action", 1), ("RPG", "rpg", 1), ("Adventure", "adventure", 1),
    ("Strategy", "strategy", 1), ("Simulation", "simulation", 1), ("Racing", "racing", 1),
    ("Sports", "sports", 1), ("Indie", "indie", 1),
    ("FPS", "fps", 0), ("Open World", "open-world", 0), ("Interactive Drama", "interactive-drama", 0),
    ("Horror", "horror", 0), ("Roguelike", "roguelike", 0), ("Souls-like", "souls-like", 0),
]

# slug -> (genres, rating, rating_count, featured, sort)
META = {
    "battlefield-6":              (["fps", "action"], 6.8, 41230, 1, 1),
    "detroit-become-human":       (["adventure", "interactive-drama"], 8.7, 98540, 1, 2),
    "sekiro-shadows-die-twice":   (["action", "open-world", "souls-like"], 8.9, 214380, 1, 3),
    "red-dead-redemption-2":      (["action", "open-world"], 9.0, 512980, 1, 4),
    "cyberpunk-2077":             (["rpg", "action", "open-world"], 8.6, 689210, 0, 5),
    "elden-ring":                 (["rpg", "action", "open-world"], 9.5, 741220, 0, 6),
    "the-witcher-3-wild-hunt":    (["rpg", "adventure", "open-world"], 9.8, 812330, 0, 7),
    "god-of-war":                 (["action", "adventure"], 9.4, 322110, 0, 8),
    "hades-ii":                   (["action", "indie", "roguelike"], 9.0, 88640, 0, 9),
    "baldurs-gate-3":             (["rpg", "strategy"], 9.6, 623440, 0, 10),
    "forza-horizon-5":            (["racing", "open-world"], 8.6, 199870, 0, 11),
    "stardew-valley":             (["simulation", "indie", "rpg"], 9.7, 512300, 0, 12),
    "cities-skylines-2":          (["simulation", "strategy"], 6.5, 72450, 0, 13),
    "hollow-knight-silksong":     (["indie", "action", "adventure"], 9.2, 50430, 0, 14),
    "assassins-creed-shadows":    (["action", "adventure", "open-world"], 7.9, 61220, 0, 15),
    "resident-evil-4":            (["action", "adventure", "horror"], 9.1, 187660, 0, 16),
    "starfield":                  (["rpg", "open-world"], 7.2, 141290, 0, 17),
    "a-plague-tale-requiem":      (["adventure", "action"], 8.4, 53210, 0, 18),
    "marvels-spider-man-2":       (["action", "adventure", "open-world"], 8.8, 96510, 0, 19),
    "monster-hunter-wilds":       (["action", "rpg", "open-world"], 8.5, 74420, 0, 20),
}

# slug -> {platform: discount}. Steam = design discount for the featured 4, curated otherwise.
DISCOUNTS = {
    "battlefield-6":              {"steam": 50, "epic": 50, "gog": 50},
    "detroit-become-human":       {"steam": 50, "epic": 50, "gog": 50},
    "sekiro-shadows-die-twice":   {"steam": 50, "epic": 50, "gog": 50},
    "red-dead-redemption-2":      {"steam": 75, "epic": 50, "gog": 50},
    "cyberpunk-2077":             {"steam": 60, "epic": 50, "gog": 65},
    "elden-ring":                 {"steam": 40, "epic": 30, "gog": 40},
    "the-witcher-3-wild-hunt":    {"steam": 80, "epic": 75, "gog": 85},
    "god-of-war":                 {"steam": 50, "epic": 40, "gog": 55},
    "hades-ii":                   {"steam": 25, "epic": 20, "gog": 25},
    "baldurs-gate-3":             {"steam": 30, "epic": 25, "gog": 30},
    "forza-horizon-5":            {"steam": 65, "epic": 55, "gog": 60},
    "stardew-valley":             {"steam": 40, "epic": 35, "gog": 45},
    "cities-skylines-2":          {"steam": 60, "epic": 50, "gog": 55},
    "hollow-knight-silksong":     {"steam": 15, "epic": 10, "gog": 15},
    "assassins-creed-shadows":    {"steam": 45, "epic": 40, "gog": 45},
    "resident-evil-4":            {"steam": 55, "epic": 50, "gog": 50},
    "starfield":                  {"steam": 70, "epic": 60, "gog": 65},
    "a-plague-tale-requiem":      {"steam": 75, "epic": 70, "gog": 75},
    "marvels-spider-man-2":       {"steam": 40, "epic": 35, "gog": 40},
    "monster-hunter-wilds":       {"steam": 35, "epic": 30, "gog": 35},
}

# Design-faithful prices for the 4 featured titles (IDR). Others use the real Steam IDR price.
DESIGN_PRICE = {
    "battlefield-6": 1251888,
    "detroit-become-human": 1251888,
    "sekiro-shadows-die-twice": 1251888,
    "red-dead-redemption-2": 1073021,
}
RDR2_DESC = ("Red Dead Redemption 2 adalah permainan video aksi-penjelajahan (action-adventure) "
             "berlatar dunia terbuka (open-world) yang dikembangkan dan diterbitkan oleh Rockstar Games. "
             "Dirilis pada tahun 2018, game ini merupakan prekuel dari Red Dead Redemption (2010).")

def strip_tags(s):
    s = re.sub(r"<br\s*/?>", "\n", s or "")
    s = re.sub(r"</li>", "\n", s)
    s = re.sub(r"<[^>]+>", "", s)
    s = html.unescape(s)
    return s

def parse_reqs(html_str):
    """Steam pc_requirements HTML -> list of {label, value}.

    The leading "Minimum:" / "Recommended:" header row is emitted with an
    empty label so the UI renders it as a plain first line, as in the design.
    """
    txt = strip_tags(html_str)
    rows = []
    for line in txt.split("\n"):
        line = line.strip(" \t\r")
        if not line:
            continue
        if ":" in line:
            label, _, value = line.partition(":")
            label = label.strip()
            if label.lower() in ("minimum", "recommended", "direkomendasikan"):
                label = ""
            rows.append({"label": label, "value": value.strip()})
        elif rows:
            rows[-1]["value"] = (rows[-1]["value"] + " " + line).strip()
    return rows

def parse_date(s):
    if not s:
        return None
    for fmt in ("%d %b, %Y", "%b %d, %Y", "%d %b %Y", "%Y-%m-%d", "%Y"):
        try:
            return datetime.datetime.strptime(s.strip(), fmt).strftime("%Y-%m-%d")
        except ValueError:
            pass
    return None

# Which stores actually carry each title (drives the "Shops" filter + home sections).
GOG_TITLES = {
    "cyberpunk-2077", "the-witcher-3-wild-hunt", "elden-ring", "baldurs-gate-3", "god-of-war",
    "cities-skylines-2", "a-plague-tale-requiem", "hades-ii", "hollow-knight-silksong",
    "stardew-valley", "detroit-become-human",
}
EPIC_EXCLUDE = {"the-witcher-3-wild-hunt", "stardew-valley", "hades-ii",
                "hollow-knight-silksong", "cities-skylines-2"}

# Steam returned an empty/unsupported release_date for these titles.
RELEASE_DATES = {
    "battlefield-6": "2025-10-10",
    "red-dead-redemption-2": "2018-10-26",
    "cyberpunk-2077": "2020-12-10",
    "the-witcher-3-wild-hunt": "2015-05-19",
    "baldurs-gate-3": "2023-08-03",
    "cities-skylines-2": "2023-10-24",
    "a-plague-tale-requiem": "2022-10-18",
}

def _offer_url(plat, game):
    """Deep link for an offer: Steam app page, or a title search on the store."""
    if plat == "steam":
        return f"https://store.steampowered.com/app/{game.get('appid')}/"
    title = re.sub(r"\s+", " ", (game.get("name") or "").replace("™", "").replace("®", "").replace("©", "")).strip()
    query = quote_plus(title)
    if plat == "epic":
        return f"https://store.epicgames.com/en-US/browse?q={query}"
    return f"https://www.gog.com/en/games?query={query}"


def platforms_for(slug):
    out = ["steam"]
    if slug not in EPIC_EXCLUDE:
        out.append("epic")
    if slug in GOG_TITLES:
        out.append("gog")
    return out


def php_val(v, indent=0):
    pad = "    " * indent
    if v is None:
        return "null"
    if isinstance(v, bool):
        return "true" if v else "false"
    if isinstance(v, int):
        return str(v)
    if isinstance(v, float):
        return ("%g" % v)
    if isinstance(v, str):
        return "'" + v.replace("\\", "\\\\").replace("'", "\\'") + "'"
    if isinstance(v, list):
        if not v:
            return "[]"
        # keep list rows compact
        one = "[" + ", ".join(php_val(x, 0) for x in v) + "]"
        if len(one) + len(pad) <= 118 and not any(isinstance(x, (list, dict)) for x in v):
            return one
        inner = ",\n".join(pad + "    " + php_val(x, indent + 1) for x in v)
        return "[\n" + inner + ",\n" + pad + "]"
    if isinstance(v, dict):
        inner = ",\n".join(pad + "    " + php_val(k) + " => " + php_val(x, indent + 1) for k, x in v.items())
        return "[\n" + inner + ",\n" + pad + "]"
    raise TypeError(type(v))

games = []
for slug, meta in sorted(META.items(), key=lambda kv: kv[1][4]):
    g = steam.get(slug) or {}
    genres, rating, rcount, featured, order = meta
    price_initial = g.get("price_initial")  # in cents
    real_normal = round(price_initial / 100) if price_initial else None
    normal = DESIGN_PRICE.get(slug, real_normal)
    if normal is None:
        normal = 249000
    offers = []
    for plat in platforms_for(slug):
        d = DISCOUNTS[slug][plat]
        # All stores list the same base price (as in the design); only the
        # discount differs, so the cheapest offer is the biggest discount.
        p_normal = normal
        offers.append({
            "platform": plat,
            "normal": p_normal,
            "discount": d,
            "url": _offer_url(plat, g),
        })
    minr = parse_reqs((g.get("pc_requirements") or {}).get("minimum") or "")
    recr = parse_reqs((g.get("pc_requirements") or {}).get("recommended") or "")
    if not minr:
        minr = [{"label": "OS", "value": "Windows 10 64-bit"},
                {"label": "Prosesor", "value": "Intel Core i5 / AMD Ryzen 5"},
                {"label": "Memori", "value": "8 GB RAM"},
                {"label": "Grafis", "value": "NVIDIA GTX 1060 / AMD RX 580"},
                {"label": "Penyimpanan", "value": "50 GB ruang tersedia"}]
    if not recr:
        recr = [{"label": "OS", "value": "Windows 11 64-bit"},
                {"label": "Prosesor", "value": "Intel Core i7 / AMD Ryzen 7"},
                {"label": "Memori", "value": "16 GB RAM"},
                {"label": "Grafis", "value": "NVIDIA RTX 3060 / AMD RX 6700"},
                {"label": "Penyimpanan", "value": "50 GB SSD"}]
    title = g.get("name") or slug.replace("-", " ").title()
    games.append({
        "slug": slug,
        "title": title,
        "appid": g.get("appid"),
        "description": RDR2_DESC if slug == "red-dead-redemption-2" else (g.get("short_description") or ""),
        "developer": ", ".join(g.get("developers") or []) or None,
        "publisher": ", ".join(g.get("publishers") or []) or None,
        "release_date": parse_date(g.get("release_date")) or RELEASE_DATES.get(slug),
        "rating": rating,
        "rating_count": rcount,
        "cover_image": f"/covers/{slug}-card.jpg",
        "portrait_image": f"/covers/{slug}-portrait.jpg",
        "hero_image": f"/covers/{slug}-hero.jpg",
        "wide_image": f"/covers/{slug}-header.jpg",
        "screenshots": SHOTS.get(slug, []),
        "min_requirements": minr,
        "rec_requirements": recr,
        "is_featured": featured,
        "sort_order": order,
        "genres": genres,
        "offers": offers,
    })

platforms = [
    {"name": "Steam", "slug": "steam", "color": "#66C0F4", "store_url": "https://store.steampowered.com", "sort_order": 1, "show_on_home": 1},
    {"name": "Epic Games", "slug": "epic", "color": "#B7B7B7", "store_url": "https://store.epicgames.com", "sort_order": 2, "show_on_home": 1},
    {"name": "GOG", "slug": "gog", "color": "#A855F7", "store_url": "https://www.gog.com", "sort_order": 3, "show_on_home": 0},
]
genres_out = [{"name": n, "slug": s, "filterable": f, "sort_order": i + 1}
              for i, (n, s, f) in enumerate(GENRES)]
sale_events = [
    {"title": "Steam Autumn Sale", "subtitle": "Sale Event", "badge": "Up to 75% OFF",
     "image": "/covers/red-dead-redemption-2-hero.jpg", "platform": "steam",
     "url": "https://store.steampowered.com/specials", "sort_order": 1},
]
data = {"platforms": platforms, "genres": genres_out, "games": games, "sale_events": sale_events}

os.makedirs("backend/database/seeders/data", exist_ok=True)
src = "<?php\n\n// AUTO-GENERATED seed data (real Steam store data, IDR).\n// Regenerate with: python .work/gen_seed_data.py\nreturn " + php_val(data) + ";\n"
open("backend/database/seeders/data/catalog.php", "w", encoding="utf-8").write(src)
print("wrote catalog.php", len(src), "bytes,", len(games), "games")
print("sample:", json.dumps(games[0], ensure_ascii=False)[:400])
