import pymupdf, json, sys

d = pymupdf.open("PRD/Gamehubprd.pdf")
out = []
for pno in range(d.page_count):
    pg = d[pno]
    raw = pg.get_text("rawdict")
    page_spans = []
    for b in raw["blocks"]:
        if b.get("type") != 0:
            continue
        for l in b["lines"]:
            for s in l["spans"]:
                chars = "".join(c["c"] for c in s["chars"])
                page_spans.append({
                    "font": s["font"],
                    "size": round(s["size"], 1),
                    "bbox": [round(v, 1) for v in s["bbox"]],
                    "codes": [ord(c) for c in chars],
                    "text": chars,
                })
    out.append(page_spans)

with open(".work/spans.json", "w", encoding="utf-8") as f:
    json.dump(out, f, ensure_ascii=False)
for i, sp in enumerate(out):
    print(f"== page {i+1}: {len(sp)} spans ==")
    fonts = {}
    for s in sp:
        fonts.setdefault((s["font"], s["size"]), 0)
        fonts[(s["font"], s["size"])] += len(s["codes"])
    for k, v in sorted(fonts.items(), key=lambda x: -x[1]):
        print("   ", k, "chars", v)
