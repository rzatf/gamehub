"""Fetch per-game screenshots from the Steam Store API and download them.

Steam's appdetails response carries a `screenshots` array (path_thumbnail /
path_full). Grab up to 3 per game into frontend/public/screenshots/ so the
detail page can show the "screenshot" the PRD's acceptance criteria ask for,
and dump a slug -> [paths] map for the seeder.
"""
import json
import os
import time
import urllib.request
from pathlib import Path

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

OUT = Path(r"E:\GAMEHUB\frontend\public\screenshots")
OUT.mkdir(parents=True, exist_ok=True)
UA = {"User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) GameHub/1.0"}
PER_GAME = 3

result = {}
skipped = []

for slug, appid in APPIDS.items():
    if all((OUT / f"{slug}-{i}.jpg").exists() for i in range(1, PER_GAME + 1)):
        result[slug] = [f"/screenshots/{slug}-{i}.jpg" for i in range(1, PER_GAME + 1)]
        continue

    url = f"https://store.steampowered.com/api/appdetails?appids={appid}&cc=id&l=indonesian&filters=screenshots"
    try:
        with urllib.request.urlopen(urllib.request.Request(url, headers=UA), timeout=25) as resp:
            payload = json.loads(resp.read().decode("utf-8"))
        entry = (payload or {}).get(str(appid)) or {}
        shots = ((entry.get("data") or {}).get("screenshots") or []) if entry.get("success") else []
    except Exception as exc:  # noqa: BLE001 - report and continue
        print(f"  ! {slug}: {exc}")
        skipped.append(slug)
        continue

    if not shots:
        print(f"  - {slug}: no screenshots returned")
        skipped.append(slug)
        continue

    saved = []
    for index, shot in enumerate(shots[:PER_GAME], start=1):
        src = shot.get("path_full") or shot.get("path_thumbnail")
        if not src:
            continue
        dest = OUT / f"{slug}-{index}.jpg"
        try:
            with urllib.request.urlopen(urllib.request.Request(src, headers=UA), timeout=30) as img:
                data = img.read()
            if len(data) < 5000:
                print(f"  ! {slug}-{index}: only {len(data)} bytes")
                continue
            dest.write_bytes(data)
            saved.append(f"/screenshots/{slug}-{index}.jpg")
        except Exception as exc:  # noqa: BLE001
            print(f"  ! {slug}-{index}: {exc}")
    if saved:
        result[slug] = saved
        print(f"  + {slug}: {len(saved)} screenshots")
    else:
        skipped.append(slug)
    time.sleep(0.4)

Path(r"E:\GAMEHUB\.work\screenshots.json").write_text(json.dumps(result, indent=2), encoding="utf-8")
print(f"\ngames with screenshots: {len(result)}/{len(APPIDS)}")
print("missing:", sorted(set(APPIDS) - set(result)))
