import json, time, urllib.request, urllib.error, os

APPIDS = {
    "battlefield-2042": 1517290,
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
    "ea-sports-fc-25": 2669320,
    "cities-skylines-2": 949230,
    "hollow-knight-silksong": 1030300,
    "assassins-creed-shadows": 3159330,
    "resident-evil-4": 2050650,
    "starfield": 1716740,
    "alan-wake-2": 1087100,
    "marvels-spider-man-2": 2651280,
    "monster-hunter-wilds": 2246340,
}

def get(url, timeout=25):
    req = urllib.request.Request(url, headers={"User-Agent": "Mozilla/5.0"})
    with urllib.request.urlopen(req, timeout=timeout) as r:
        return json.loads(r.read().decode("utf-8", "replace"))

out = {}
for slug, appid in APPIDS.items():
    try:
        d = get(f"https://store.steampowered.com/api/appdetails?appids={appid}&cc=id&l=indonesian")
        node = d.get(str(appid), {})
        if not node.get("success"):
            print("FAIL", slug, appid, "not success"); continue
        data = node["data"]
        po = data.get("price_overview") or {}
        rec = {
            "appid": appid,
            "name": data.get("name"),
            "type": data.get("type"),
            "release_date": (data.get("release_date") or {}).get("date"),
            "developers": data.get("developers"),
            "publishers": data.get("publishers"),
            "genres": [g["description"] for g in data.get("genres", [])],
            "categories": [c["description"] for c in data.get("categories", [])][:12],
            "short_description": data.get("short_description"),
            "header_image": data.get("header_image"),
            "capsule_image": data.get("capsule_image"),
            "screenshots": [s["path_full"] for s in (data.get("screenshots") or [])][:6],
            "pc_requirements": data.get("pc_requirements"),
            "price": {
                "currency": po.get("currency"),
                "initial": po.get("initial"),
                "final": po.get("final"),
                "discount_percent": po.get("discount_percent"),
                "initial_formatted": po.get("initial_formatted"),
                "final_formatted": po.get("final_formatted"),
            } if po else None,
            "is_free": data.get("is_free"),
        }
        out[slug] = rec
        print(f"OK   {slug:28s} {appid:8d} {rec['name'][:38]:38s} price={rec['price']}")
    except Exception as e:
        print("ERR ", slug, appid, type(e).__name__, e)
    time.sleep(1.2)

os.makedirs(".work/steam", exist_ok=True)
json.dump(out, open(".work/steam/appdetails.json", "w", encoding="utf-8"), ensure_ascii=False, indent=1)
print("saved", len(out), "games")
