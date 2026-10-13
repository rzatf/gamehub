from PIL import Image
import numpy as np, sys

def hexc(c): return '#%02X%02X%02X' % tuple(int(x) for x in c)

def top_colors(im, n=6):
    flat = im.reshape(-1, 3)
    cols, counts = np.unique(flat, axis=0, return_counts=True)
    order = np.argsort(-counts)[:n]
    tot = flat.shape[0]
    return [(hexc(cols[i]), round(100*counts[i]/tot, 2)) for i in order]

def band(im, y0f, y1f, x0f=0.0, x1f=1.0):
    H, W = im.shape[:2]
    return im[int(y0f*H):int(y1f*H), int(x0f*W):int(x1f*W)]

files = [
    ("home",   ".work/des_hi/des_p01.png"),
    ("detail", ".work/des_hi/des_p07.png"),
    ("catalog",".work/des_hi/des_p03.png"),
    ("sort",   ".work/des_hi/des_p04.png"),
    ("fav",    ".work/des_hi/des_p09.png"),
    ("banner", ".work/des_hi/des_p05.png"),
    ("shops",  ".work/des_hi/des_p08.png"),
    ("search", ".work/des_hi/des_p06.png"),
]
for name, f in files:
    im = np.asarray(Image.open(f).convert("RGB"))
    H, W = im.shape[:2]
    print(f"===== {name} {f} {W}x{H} =====")
    print(" corner(2,2):", hexc(im[2, 2]), " corner(h-3,w-3):", hexc(im[H-3, W-3]))
    print(" full top6:", top_colors(im))
    for label, y0, y1 in [("top3%", 0.0, 0.03), ("top6%", 0.0, 0.06),
                          ("mid", 0.45, 0.55), ("bot6%", 0.94, 1.0)]:
        print(f"  band {label:6s}:", top_colors(band(im, y0, y1), 4))
