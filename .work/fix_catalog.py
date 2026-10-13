"""One-off fixer for the generated seeder data.

1. The Steam pc_requirements parser leaked the Indonesian "Direkomendasikan:"
   header into the first row's label; the UI wants an empty label there (the
   design renders it as a plain first line).
2. Eight titles came back without a release date, so the detail page showed
   "TBA". Fill in the real release dates.
"""
import re
from pathlib import Path

PATH = Path(r"E:\GAMEHUB\backend\database\seeders\data\catalog.php")
text = PATH.read_text(encoding="utf-8")

# --- 1. requirement header label ---
text, n = re.subn(r"'label' => 'Direkomendasikan',", "'label' => '',", text)
print(f"requirement labels fixed: {n}")

# --- 2. release dates (patched by slug, position-independent) ---
DATES = {
    "battlefield-6": "2025-10-10",
    "red-dead-redemption-2": "2018-10-26",
    "cyberpunk-2077": "2020-12-10",
    "the-witcher-3-wild-hunt": "2015-05-19",
    "baldurs-gate-3": "2023-08-03",
    "cities-skylines-2": "2023-10-24",
    "a-plague-tale-requiem": "2022-10-18",
}

fixed = 0
for slug, date in DATES.items():
    pattern = re.compile(
        r"('slug' => '" + re.escape(slug) + r"',.*?)'release_date' => null,",
        re.S,
    )
    text, count = pattern.subn(lambda m: m.group(1) + f"'release_date' => '{date}',", text, count=1)
    if count != 1:
        raise SystemExit(f"FAILED to patch release_date for {slug} (matches={count})")
    fixed += count

print(f"release dates fixed: {fixed}")
PATH.write_text(text, encoding="utf-8")

# verify
remaining = text.count("'release_date' => null,")
print(f"remaining null release dates: {remaining}")
