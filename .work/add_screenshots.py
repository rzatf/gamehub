"""Add a `screenshots` list to every game in the generated seeder data."""
import json
import re
from pathlib import Path

shots = json.loads(Path(r"E:\GAMEHUB\.work\screenshots.json").read_text(encoding="utf-8"))
PATH = Path(r"E:\GAMEHUB\backend\database\seeders\data\catalog.php")
text = PATH.read_text(encoding="utf-8")

if "'screenshots' =>" in text:
    raise SystemExit("catalog.php already carries screenshots — aborting")

lines = text.splitlines(keepends=True)
out = []
current = None
inserted = 0

for line in lines:
    m = re.match(r"\s*'slug' => '([^']+)',", line)
    if m:
        current = m.group(1)
    out.append(line)
    if current and re.match(r"\s*'wide_image' => '[^']*',\s*$", line):
        paths = shots.get(current, [])
        if paths:
            joined = ", ".join(f"'{p}'" for p in paths)
            out.append(f"            'screenshots' => [{joined}],\n")
            inserted += 1
        current = None

new = "".join(out)
PATH.write_text(new, encoding="utf-8")
print(f"screenshot lists inserted: {inserted}")
print(f"games in map: {len(shots)}")
