import json, time, urllib.request, os, sys

APPIDS = {
    "battlefield-6": 2807960,
    "detroit-become-human": 1222140,
    "sekiro-shadows-die-twice": 814380,
    "red-dead-redemption-2": 1174180,
    "cyberpunk-2077": 1091500,
    "elden-ring": 1245620,
    "the-witcher-3-wild-hunt": 292030,
    "god-of-war": 1593500,
    "hades-ii": 1145350,
    "baldurs-gate-3": 1086940,
    "forza-horizon-5": 1551360,
    "stardew-valley": 413150,
    "cities-skylines-2": 949230,
    "hollow-knight-silksong": 1030300,
    "assassins-creed-shadows": 3159330,
    "resident-evil-4": 2050650,
    "starfield": 1716740,
    "a-plague-tale-requiem": 1182900,
    "marvels-spider-man-2": 2651280,
    "monster-hunter-wilds": 2246340,
}
IMGDIR = "frontend/public/covers"
os.makedirs(IMGDIR, exist_ok=True)

def get(url, timeout=30):
    req = urllib.request.Request(url, headers={"User-Agent": "Mozilla/5.0"})
    with urllib.request.urlopen(req, timeout=timeout) as r:
        return r.read()

def getj(url):
    return json.loads(get(url).decode("utf-8", "replace"))

out = {}
for slug, appid in APPIDS.items():
    rec = None
    try:
        d = getj(f"https://store.steampowered.com/api/appdetails?appids={appid}&cc=id&l=indonesian")
        node = d.get(str(appid), {})
        if node.get("success"):
            data = node["data"]
            po = data.get("price_overview") or {}
            rec = {
                "appid": appid,
                "name": data.get("name"),
                "release_date": (data.get("release_date") or {}).get("date"),
                "developers": data.get("developers") or [],
                "publishers": data.get("publishers") or [],
                "genres": [g["description"] for g in data.get("genres", [])],
                "short_description": data.get("short_description"),
                "pc_requirements": data.get("pc_requirements") or {},
                "price_initial": po.get("initial"),
                "price_final": po.get("final"),
                "discount": po.get("discount_percent"),
                "currency": po.get("currency"),
                "is_free": data.get("is_free"),
            }
    except Exception as e:
        print("DETAIL ERR", slug, e)
    out[slug] = rec or {"appid": appid, "name": None}

    # download images: capsule (card), header (wide), library_600x900 (portrait), library_hero (banner)
    for kind, fn in [("capsule_616x353", "card"), ("library_600x900", "portrait"),
                     ("library_hero", "hero"), ("header", "header")]:
        url = f"https://cdn.cloudflare.steamstatic.com/steam/apps/{appid}/{kind}.jpg"
        dest = f"{IMGDIR}/{slug}-{fn}.jpg"
        try:
            blob = get(url)
            if len(blob) > 1500:
                open(dest, "wb").write(blob)
        except Exception as e:
            print("IMG ERR", slug, kind, e)
    print("OK", slug, (rec or {}).get("name"), (rec or {}).get("price_initial"), (rec or {}).get("discount"))
    time.sleep(1.0)

json.dump(out, open(".work/steam/final.json", "w", encoding="utf-8"), ensure_ascii=False, indent=1)
print("games:", len(out))
print("images:", len([f for f in os.listdir(IMGDIR) if f.endswith('.jpg')]))
