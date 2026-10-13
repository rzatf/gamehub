import sys, json, os
from rapidocr_onnxruntime import RapidOCR

ocr = RapidOCR()

def ocr_page(path):
    res, _ = ocr(path)
    if not res:
        return []
    items = []
    for box, text, score in res:
        ys = [p[1] for p in box]; xs = [p[0] for p in box]
        items.append({"y": sum(ys)/4.0, "x": min(xs), "text": text, "score": score})
    items.sort(key=lambda d: (round(d["y"]/12), d["x"]))
    return items

def main(folder, out):
    files = sorted(f for f in os.listdir(folder) if f.lower().endswith(".png"))
    with open(out, "w", encoding="utf-8") as fh:
        for fn in files:
            fh.write(f"\n\n===== {fn} =====\n")
            for it in ocr_page(os.path.join(folder, fn)):
                fh.write(f"[{int(it['y']):>4},{int(it['x']):>4}] {it['text']}\n")
            print("done", fn, flush=True)

if __name__ == "__main__":
    main(sys.argv[1], sys.argv[2])
