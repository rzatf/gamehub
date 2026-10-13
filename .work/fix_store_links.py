"""Point the Epic/GOG offers at store search pages for their own title.

The seeded Epic/GOG offers only carried a bare storefront URL, so "Buka di X"
dropped the user on the store home page. Rewrite them to title-scoped search
URLs so every outbound link is useful.
"""
import re
from pathlib import Path
from urllib.parse import quote_plus

PATH = Path(r"E:\GAMEHUB\backend\database\seeders\data\catalog.php")
text = PATH.read_text(encoding="utf-8")

TITLE_RE = re.compile(r"'title' => '([^']*)',")
EPIC_RE = re.compile(r"('platform' => 'epic',.*?'url' => ')https://store\.epicgames\.com/('([^']*)'\))", re.S)
GOG_RE = re.compile(r"('platform' => 'gog',.*?'url' => ')https://www\.gog\.com/('([^']*)'\))", re.S)


def clean(title: str) -> str:
    for mark in ("™", "®", "©"):
        title = title.replace(mark, "")
    return re.sub(r"\s+", " ", title).strip()


def rewrite(match: re.Match) -> str:
    title = match.group(3)
    if not title:
        return match.group(0)
    query = quote_plus(clean(title))
    is_epic = "epicgames" in match.group(1) or "'platform' => 'epic'" in match.group(1)
    base = "https://store.epicgames.com/en-US/browse?q=" if is_epic else "https://www.gog.com/en/games?query="
    return match.group(1) + base + query + "'"


# Walk the file once, remembering the most recent game title.
out = []
pos = 0
title = ""
for m in re.finditer(r"'title' => '[^']*',|'url' => '(?:https://store\.epicgames\.com/|https://www\.gog\.com/)',", text):
    chunk = text[pos:m.start()]
    out.append(chunk)
    token = m.group(0)
    if token.startswith("'title'"):
        title = clean(token[len("'title' => '"):-2])
        out.append(token)
    elif "'epicgames" in chunk[-400:] or "'platform' => 'epic'" in chunk[-600:]:
        out.append(f"'url' => 'https://store.epicgames.com/en-US/browse?q={quote_plus(title)}',")
    else:
        out.append(f"'url' => 'https://www.gog.com/en/games?query={quote_plus(title)}',")
    pos = m.end()
out.append(text[pos:])
new = "".join(out)

epic_count = new.count("store.epicgames.com/en-US/browse?q=")
gog_count = new.count("www.gog.com/en/games?query=")
bare_epic = new.count("'url' => 'https://store.epicgames.com/'")
bare_gog = new.count("'url' => 'https://www.gog.com/'")
print(f"epic search urls: {epic_count} (bare left: {bare_epic})")
print(f"gog  search urls: {gog_count} (bare left: {bare_gog})")

if bare_epic or bare_gog:
    raise SystemExit("some bare store urls remain — aborting")

PATH.write_text(new, encoding="utf-8")
print("written")
