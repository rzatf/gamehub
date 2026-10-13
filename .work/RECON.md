# GAMEHUB — Recon notes

## Task
Build the GameHub web app (Next.js frontend + Laravel backend, both already scaffolded)
matching `design/` and the requirements in `PRD/`.

## Provided
- `design/GameHub (2).pdf` — 9 pages of UI screens (text layer partially extractable)
- `design/GameHub.png` — 9093x3220 Figma export (all screens)
- `PRD/Gamehubprd.pdf` — 6 pages (NO usable text layer → needed OCR/vision)
- `frontend/` — Next.js **16.4.0**, React 19.3.0, Tailwind **v4** (`@tailwindcss/turbopack`), TS
  - `next.config.ts`: `experimental.agentFeedback`, `cacheComponents: true`, `partialPrefetching: true`, turbopack css loader
  - app/{layout.tsx,page.tsx,globals.css} = default create-next-app boilerplate
- `backend/` — Laravel **12.69.3** bare skeleton, sqlite default in .env.example but
  actual `.env` = **mysql** db `gamehub_db` @127.0.0.1, user root, empty password
  - routes/web.php only has `/` -> welcome
  - only User model + default migrations/seeders

## Environment
- `php` = C:\xampp\php\php (8.2.34, has pdo_mysql, no pdo_sqlite)
- MariaDB 10.4.32 available via /c/xampp/mysql/bin/mysql.exe ; `gamehub_db` exists and is EMPTY
- `node` v26.7.0, `npm` 11.19.0
- `composer` binary is BROKEN (path issue) — vendor/ already installed, use `php artisan` directly
- Correct CLI tools available: pdftotext, pypdfium2 (python), pillow
- No tesseract, no pymupdf. Vision done via child `vision_analyze` tool.

## Data extracted so far (from design PDF text layer)
Pages/screens: Home (hero + Sale Events/Steam carousel + Epic Games Store carousel + footer disclaimers),
Catalog (filters: Shops Steam/Epic/GOG, Genre list; sort: Terlaris / Diskon Tertinggi / Harga Terendah / Terbaru;
grid + pagination 1 2 3 4 5 ...), Search results, Game detail (per-platform prices w/ discount %,
About paragraph, Min/Recommended system reqs, price history chart with Harga Normal/Harga Akhir/Diskon %),
Favorites (Favorit Saya).
Nav: `GameHub | Cari... | Katalog | Favorite`
Home hero: "Cari Game yang Kamu Mau. / Cek Harganya. / Temukan Deal Terbaik."
 + "Lagi cari game? Cek harga dan diskonnya dari berbagai platform di sini" + buttons "Jelajahi Game" "Lihat Promo"
Footer: non-commercial disclaimer (bukan reseller), no affiliation with Steam/Valve, Epic Games, GOG.
Sample data: Battlefield 6 (Rp1.251.888 -> Rp625.854, 50%, 6.8, FPS Action),
 Detroit: Become Human (Rp1.251.888 -> Rp625.854, 50%, 8.7, Adventure Interactive Drama),
 Sekiro (Rp1.251.888 -> Rp625.854, 50%, 8.9, Action Open World),
 Red Dead Redemption II (Rp1.073.021 -> Rp268.121, 50-75%, 9.0, Action Open World).

## Decisions
- Backend: MySQL `gamehub_db`. Laravel REST API under /api/*.
- Frontend: fetch from Laravel API via NEXT_PUBLIC_API_URL (default http://127.0.0.1:8000/api).
- Seed DB with the games/platforms/prices seen in the design.
