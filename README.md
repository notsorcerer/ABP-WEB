# LiquidPedia - E-Commerce Liquid & Vape

Aplikasi e-commerce untuk liquid dan vape berbasis Laravel 13 dengan fitur location picker menggunakan Leaflet.js + OpenStreetMap.

## Persyaratan Sistem

| Komponen | Versi Minimal | Keterangan |
|---|---|---|
| PHP | 8.3+ | Extension: `gd`, `fileinfo`, `pdo_mysql`, `mbstring`, `bcmath` |
| MySQL / MariaDB | 5.7+ / 10.4+ | XAMPP 8.2+ recommendation |
| Composer | 2.x | Dependency Manager PHP |
| Node.js | 18+ | Build Vite asset |
| NPM | 9+ | |

## Langkah Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/notsorcerer/ABP-WEB.git
cd ABP-WEB
```

### 2. Install Dependency

```bash
composer install
npm install
```

### 3. Konfigurasi Environment

```bash
cp .env.example .env
```

Sesuaikan isi `.env` terutama bagian database:

```env
APP_NAME=LiquidPedia
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=liquidpedia
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate App Key

```bash
php artisan key:generate
```

### 5. Setup Database

Buat database MySQL terlebih dahulu, misal melalui phpMyAdmin atau command line:

```bash
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS liquidpedia"
```

**Migrate + Seed:**

```bash
php artisan migrate:fresh --seed
```

Perintah ini akan:
- Membuat semua tabel (termasuk `orders`, `order_items`)
- Mengisi 2 kategori (Vape, Liquid)
- Mengisi 16 produk
- Membuat 1 akun admin

### 6. Storage Link

```bash
php artisan storage:link
```

Command ini membuat symlink `public/storage` → `storage/app/public` agar file gambar produk bisa diakses publik.

### 7. Build Asset

```bash
npm run build
```

### 8. Jalankan Server

```bash
php artisan serve
```

Akses aplikasi di: **http://localhost:8000**

---


## Struktur Database

Tabel utama dari migration:

| Tabel | Deskripsi |
|--------|-----------|
| `users` | Customer + Admin (`is_admin` flag) |
| `categories` | Kategori produk (Vape / Liquid) |
| `products` | Produk dengan relasi ke categories |
| `orders` | Pesanan dengan data pengiriman + koordinat |
| `order_items` | Item detail per pesanan |
| `cart_items` | Cart untuk REST API (`user_id`, `product_id`, `quantity`) |
| `personal_access_tokens` | Token autentikasi untuk REST API (Sanctum) |
| `sessions` | Session cart pengguna web |
| `cache` / `cache_locks` | Cache Laravel |

Kolom koordinat: `shipping_latitude` & `shipping_longitude` (string, nullable) di tabel `orders`.

---

## Akun Login

### Admin
- **URL:** http://localhost:8000/admin/login
- **Email:** `admin@liquidpedia.id`
- **Password:** `admin123`
- **Role:** CRUD produk & kategori, kelola pesanan

### Customer
- **URL:** http://localhost:8000/register
- **Registrasi:** Manual melalui halaman register
- **Role:** Belanja, checkout, lihat riwayat pesanan

---

## Fitur Utama

### Storefront (Public)
- Halaman utama dengan produk best seller & new arrival
- Katalog produk per kategori
- Detail produk
- Keranjang belanja (session-based)
- Filter & pencarian produk

### Checkout
- Form data pengiriman (nama, alamat, provinsi, kota, kecamatan, kode pos, no telepon, email)
- **Location Picker** — modal interaktif menggunakan Leaflet.js + OpenStreetMap:
  - Pencarian alamat via Nominatim API (gratis, tanpa API key)
  - Map interaktif dengan draggable marker
  - Deteksi lokasi otomatis via browser geolocation
  - Reverse geocoding (otomatis menampilkan nama alamat)
- Metode pembayaran: Transfer Bank, E-Wallet, QRIS, COD
- Konfirmasi pesanan via WhatsApp

### Admin Panel (`/admin/login`)
- Dashboard (statistik penjualan)
- CRUD Produk (termasuk upload gambar lokal)
- CRUD Kategori
- Manajemen Pesanan (update status pembayaran)

### Auth
- Register / Login customer
- Profil customer
- Admin login terpisah (cek `is_admin`)

### REST API (`/api/`)
- **Autentikasi token** menggunakan Laravel Sanctum
- **20 endpoint** RESTful: produk, kategori, cart, orders, auth, admin
- Cart berbasis database (bukan session) — siap untuk mobile app
- Format response JSON konsisten (`success`, `message`, `data`, `meta`)
- Admin API endpoints untuk mendukung Flutter Admin Panel

| Method | Endpoint | Auth | Fungsi |
|--------|----------|------|--------|
| `POST` | `/api/auth/register` | ❌ | Registrasi → dapat token |
| `POST` | `/api/auth/login` | ❌ | Login → dapat token |
| `POST` | `/api/auth/logout` | ✅ | Hapus token |
| `GET` | `/api/auth/user` | ✅ | Profil user |
| `GET` | `/api/products` | ❌ | List produk + filter + pagination |
| `GET` | `/api/products/home` | ❌ | Data beranda (best seller, new arrival) |
| `GET` | `/api/products/{id}` | ❌ | Detail produk |
| `GET` | `/api/categories` | ❌ | List kategori |
| `GET` | `/api/cart` | ✅ | Lihat cart |
| `POST` | `/api/cart/{product}` | ✅ | Tambah ke cart |
| `PUT` | `/api/cart/{product}` | ✅ | Update quantity |
| `DELETE` | `/api/cart/{product}` | ✅ | Hapus dari cart |
| `POST` | `/api/orders` | ✅ | Checkout / buat pesanan |
| `GET` | `/api/orders` | ✅ | Riwayat pesanan |
| `GET` | `/api/orders/{id}` | ✅ | Detail pesanan |
| `GET` | `/api/orders/{id}/payment` | ✅ | Instruksi pembayaran |
| `PUT` | `/api/orders/{order}/cancel` | ✅ | Batalkan pesanan (status pending) |
| | | | |
| **Admin Endpoints** | | | |
| `GET` | `/api/admin/dashboard` | ✅ | Statistik dashboard |
| `GET` | `/api/admin/products` | ✅ | List produk (admin) |
| `POST` | `/api/admin/products` | ✅ | Tambah produk + gambar |
| `PUT` | `/api/admin/products/{id}` | ✅ | Edit produk + gambar |
| `DELETE` | `/api/admin/products/{id}` | ✅ | Hapus produk |
| `GET` | `/api/admin/categories` | ✅ | List kategori (admin) |
| `POST` | `/api/admin/categories` | ✅ | Tambah kategori |
| `PUT` | `/api/admin/categories/{id}` | ✅ | Edit kategori |
| `DELETE` | `/api/admin/categories/{id}` | ✅ | Hapus kategori |
| `GET` | `/api/admin/orders` | ✅ | List semua pesanan |
| `GET` | `/api/admin/orders/{id}` | ✅ | Detail pesanan (admin) |
| `PUT` | `/api/admin/orders/{id}/payment` | ✅ | Update status pembayaran |

---

## Troubleshooting

| Masalah | Solusi |
|---|---|
| `Target class [xxx] does not exist` | Jalankan `composer dump-autoload` |
| Gambar tidak muncul | Jalankan `php artisan storage:link` |
| Vite error build | Jalankan `npm install && npm run build` |
| `[1045] Access denied for user` | Cek user/password database di `.env` |
| Halaman kosong / 500 | Cek `storage/logs/laravel.log` |
| Leaflet map tidak muncul | Pastikan koneksi internet aktif (CDN) |

---

## Catatan Teknis

- Warna tema: `bg #EEEEEE`, `Primary #D84040`, `Secondary #8E1616`, `Accent #1D1616`
- Font: Inter (CDN Bunny Fonts)
- Icon: Heroicons (inline SVG)
- Map: Leaflet.js + OpenStreetMap + Nominatim (gratis, tanpa API key)
- Cart Web: Laravel Session (database session)
- Cart API: Database table `cart_items` (user-based, bukan session)
- Produk image: support URL eksternal dan upload lokal ke `storage/app/public/products/`
- WhatsApp: nomor admin `082191488380` (floating button di semua halaman)
- API Auth: Laravel Sanctum (token-based, pakai `auth:sanctum` middleware)
- CORS: dikonfigurasi manual via `bootstrap/app.php` (Laravel 11+)
- File Postman: `LiquidPedia-API.postman_collection.json` (import ke Postman untuk testing API)
- Dokumentasi lengkap: lihat `Documentation.md`
- **APP_URL** di `.env` harus diset sesuai IP laptop agar gambar bisa diakses dari HP fisik
