from PIL import Image
import numpy as np

def hexc(c): return '#%02X%02X%02X' % tuple(int(x) for x in c)

def top(im, y0, y1, x0, x1, n=5):
    r = im[y0:y1, x0:x1].reshape(-1, 3)
    cols, counts = np.unique(r, axis=0, return_counts=True)
    order = np.argsort(-counts)[:n]
    tot = r.shape[0]
    return [(hexc(cols[i]), round(100*counts[i]/tot, 1)) for i in order]

home = np.asarray(Image.open(".work/des_hi/des_p01.png").convert("RGB"))
det  = np.asarray(Image.open(".work/des_hi/des_p07.png").convert("RGB"))
print("home shape", home.shape, "detail shape", det.shape)

regions_home = {
  "navbar strip":      (50, 70, 0, 1438),
  "far-left margin":   (1200, 1300, 0, 30),
  "hero heading text": (235, 265, 30, 500),
  "btn1 JelajahiGame": (540, 585, 40, 270),
  "btn2 LihatPromo":   (540, 585, 350, 560),
  "SaleEvents bg":     (660, 720, 20, 200),
  "section title Steam":(1160, 1205, 30, 200),
  "card1 whole":       (1370, 1910, 30, 370),
  "card1 top image":   (1380, 1600, 40, 360),
  "card1 body area":   (1680, 1900, 40, 360),
  "badge 50%":         (1615, 1660, 200, 320),
  "price line1":       (1730, 1755, 30, 200),
  "rating row":        (1810, 1835, 30, 120),
  "genre row":         (1850, 1875, 30, 160),
  "More text":         (1940, 1970, 1250, 1400),
  "footer bg":         (2960, 3060, 0, 1438),
}
for k, (y0, y1, x0, x1) in regions_home.items():
    print(f"HOME {k:22s}", top(home, y0, y1, x0, x1, 4))

regions_det = {
  "page bg":            (1000, 1100, 0, 40),
  "Back button":        (110, 150, 140, 220),
  "title text":         (200, 240, 70, 700),
  "cover art":          (300, 800, 80, 700),
  "price panel bg":     (300, 700, 1250, 1780),
  "Harga per platform": (315, 345, 1350, 1650),
  "Steam row":          (420, 470, 1290, 1780),
  "price normal":       (425, 455, 1550, 1790),
  "discount 75%":       (355, 395, 1630, 1730),
  "about text":         (1430, 1510, 80, 1700),
  "chart area":         (2180, 2600, 200, 1700),
}
for k, (y0, y1, x0, x1) in regions_det.items():
    print(f"DETAIL {k:22s}", top(det, y0, y1, x0, x1, 4))
