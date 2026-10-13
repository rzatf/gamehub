# Game Hub — Tracker Diskon Game Multi-Platform

Web app non-komersial untuk menjelajahi katalog game dan membandingkan harga serta
diskon dari beberapa platform (Steam, Epic Games Store, GOG) dalam Rupiah.

- **Frontend** — Next.js 16 (App Router, React 19, Tailwind CSS v4, TypeScript)
- **Backend** — Laravel 12 + MySQL (`gamehub_db`), REST API read-only
- **Arsitektur** — *backend-mediated*: hanya backend yang berbicara dengan Steam
  Store API (`gamehub:sync-steam`). Frontend **tidak pernah** memanggil provider
  secara langsung; semua harga dilayani dari katalog lokal.

---

## Menjalankan aplikasi

### 1. Backend (Laravel)

```bash
cd backend
cp .env.example .env        # isi kredensial MySQL lokal
php artisan key:generate
php artisan migrate:fresh --seed --force
php artisan serve --host=127.0.0.1 --port=8000
```

API tersedia di `http://127.0.0.1:8000/api/*`.

Menyegarkan harga dari Steam (satu-satunya pihak yang memanggil provider):

```bash
php artisan gamehub:sync-steam --dry-run     # pratinjau, tanpa menulis
php artisan gamehub:sync-steam               # terapkan
php artisan gamehub:sync-steam --slug=elden-ring
```

### 2. Frontend (Next.js)

```bash
cd frontend
npm install
npm run dev                  # http://localhost:3000
# atau
npm run build && npm start
```

Frontend mem-proxy `/api/*` ke backend (lihat `next.config.ts`), sehingga browser
selalu *same-origin*: tanpa CORS dan host API tidak bocor ke bundle client.

| Variabel | Default | Keterangan |
| --- | --- | --- |
| `API_URL` | `http://127.0.0.1:8000` | Alamat backend untuk rewrite `/api/*` |
| `PORT` | `3004` | Port dev/start Next.js |

> Port 3000 pada mesin ini dipakai aplikasi lain; jalankan dengan `npm run dev -- -p 4321`
> (atau `PORT=4321`) bila bentrok.

---

## Halaman

| Route | Isi |
| --- | --- |
| `/` | Hero, banner Sale Events, carousel per platform (Steam, Epic Games Store) |
| `/katalog` | Katalog: filter Shops & Genre, rentang harga, pencarian, sort, paginasi |
| `/search?q=` | Hasil pencarian (`Ditemukan N hasil untuk "..."`) |
| `/game/[slug]` | Detail: harga per platform, tentang game, persyaratan sistem, riwayat harga 6 bulan |
| `/favorite` | Favorit Saya (disimpan di `localStorage`, tanpa akun) |

## API

| Endpoint | Keterangan |
| --- | --- |
| `GET /api/home` | Banner sale event + section carousel beranda |
| `GET /api/games` | Katalog. Query: `search`, `genre`, `platform`, `slugs`, `min_price`, `max_price`, `sort`, `page`, `per_page` |
| `GET /api/games/{slug}` | Detail game: `prices`, `history`, requirements |
| `GET /api/genres` | Genre yang dapat difilter |
| `GET /api/platforms` | Daftar platform/toko |
| `GET /api/sale-events` | Sale event aktif |

`sort` = `terbaru` \| `terlaris` \| `diskon` \| `harga` \| `rating`.

## Pengujian

```bash
cd backend && php -d extension=pdo_sqlite vendor/bin/phpunit --testsuite Feature
```

12 feature test menutup: home, katalog + filter/sort/paginasi, detail (harga,
history, requirements), 404 game tidak dikenal, dan meta endpoint.

## Disclaimer

Game Hub hanya menampilkan informasi harga referensi dan mengarahkan pengguna ke
platform resmi. Kami bukan reseller, tidak menjual game, dan tidak berafiliasi
dengan Steam/Valve, Epic Games, GOG, atau publisher terkait.
