"""Second look at PRD page 4, whose body the first OCR pass skipped."""
from PIL import Image
from rapidocr_onnxruntime import RapidOCR

img = Image.open(r"E:\GAMEHUB\.work\prd_hi\prd_p04.png")
w, h = img.size
# body only, upscaled a little for the recogniser
crop = img.crop((0, int(h * 0.09), w, int(h * 0.92)))
crop = crop.resize((crop.width, crop.height), Image.LANCZOS)
tmp = r"E:\GAMEHUB\.work\prd_p04_body.png"
crop.save(tmp)

engine = RapidOCR()
result, _ = engine(tmp)
if not result:
    print("no text recognised")
else:
    for box, text, score in result:
        y = int(box[0][1])
        x = int(box[0][0])
        print(f"[{y:5d},{x:5d}] {text}  ({score:.2f})")
