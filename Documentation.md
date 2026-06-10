# Dokumentasi Project LiquidPedia

**Web E-Commerce Liquid & Vape berbasis Laravel**

---

## Daftar Isi

1. [Gambaran Umum Project](#1-gambaran-umum-project)
2. [Fitur-Fitur Utama Aplikasi](#2-fitur-fitur-utama-aplikasi)
3. [Fitur Location Picker (Peta Interaktif)](#3-fitur-location-picker-peta-interaktif)
4. [Bagian Frontend](#4-bagian-frontend)
5. [Bagian Backend](#5-bagian-backend)
6. [REST API (Web Service)](#6-rest-api-web-service)
7. [Alur Sistem (Flow Aplikasi)](#7-alur-sistem-flow-aplikasi)
8. [Keamanan Aplikasi](#8-keamanan-aplikasi)

---

## 1. Gambaran Umum Project

**LiquidPedia** adalah aplikasi web e-commerce yang dikhususkan untuk penjualan liquid (cairan vape) dan device vape. Aplikasi ini dibangun menggunakan framework **Laravel 13** dengan bahasa **PHP 8.3+**, database **MySQL**, dan template engine **Blade** yang dikombinasikan dengan **Tailwind CSS v4** serta **Vite** sebagai asset bundler.

### Tujuan Pembuatan

Project ini dibuat sebagai tugas mata kuliah **Analisis dan Perancangan Perangkat Lunak (ABP)** untuk mensimulasikan pengembangan aplikasi web e-commerce fungsional dengan dua peran pengguna: **Customer (pembeli)** dan **Admin (pengelola toko)**. Aplikasi ini juga dilengkapi dengan **REST API** menggunakan Laravel Sanctum untuk mendukung pengembangan aplikasi mobile (Flutter) di masa mendatang.

### Teknologi Utama

| Teknologi | Versi | Kegunaan |
|-----------|-------|----------|
| PHP | ^8.3 | Bahasa pemrograman backend |
| Laravel | ^13.8 | Framework MVC |
| MySQL | 5.7+ / 10.4+ | Database relasional |
| Blade | - | Template engine |
| Tailwind CSS | v4 | Styling frontend |
| Vite | ^8.0 | Asset bundler |
| Leaflet.js | 1.x | Peta interaktif (OpenStreetMap) |
| Laravel Sanctum | v4 | API token authentication |
| Flutter (rencana) | - | Aplikasi mobile konsumen |

---

## 2. Fitur-Fitur Utama Aplikasi

### A. Fitur untuk Customer (Pengguna Umum)

#### Halaman Beranda (Home)
- Hero section dengan headline promosi
- 4 produk **Best Seller** (grid dengan gambar, kategori, harga)
- 2 kartu kategori (Vape & Liquid) dengan link filter
- Banner promosi
- 4 produk **New Arrival** dengan badge "BARU"

#### Halaman Produk
- Grid produk 1-4 kolom (responsive)
- Filter kategori berbentuk **pill buttons** (klik untuk filter)
- Filter berdasarkan slug kategori via query parameter
- Tombol "Tambah ke Cart" langsung dari grid
- Empty state jika produk tidak ditemukan

#### Halaman Detail Produk
- Breadcrumb navigasi
- Gambar produk (hover zoom)
- Badge kategori, Best Seller, New Arrival
- Quantity selector (+/-) dengan validasi min 1
- Tombol "Tambah ke Cart"
- Tabel informasi produk (kategori, status stok, garansi)

#### Keranjang Belanja (Cart)
- Cart berbasis **session** (tanpa perlu login untuk menambahkan)
- Tampilkan item: gambar, nama, kategori, harga, quantity
- Tombol **+/-** untuk mengubah jumlah
- Tombol **X** untuk menghapus item
- Ringkasan pesanan sidebar: subtotal per item, grand total
- Tombol "Checkout" (redirect ke form checkout)

#### Checkout & Pemesanan
- **Wajib login** untuk akses halaman checkout
- Form data pengiriman: nama, negara, provinsi, kota, kecamatan, kode pos, alamat lengkap, nomor telepon, email
- **Location Picker interaktif** berbasis Leaflet.js + OpenStreetMap (pilih titik koordinat)
- Ringkasan pesanan + grand total
- Pilihan metode pembayaran (radio button):

| Metode | Keterangan |
|--------|------------|
| **Transfer Bank** | BCA, Mandiri, BRI, BNI |
| **E-Wallet** | GoPay, OVO, Dana |
| **QR Code (QRIS)** | Scan QR code |
| **COD** | Bayar di tempat |

#### Konfirmasi Pembayaran
Setelah order berhasil dibuat, customer diarahkan ke halaman konfirmasi yang menampilkan:
- Nomor pesanan (format: `INV/YYYYMMDD/RANDOM6`)
- Status pembayaran (Menunggu Pembayaran)
- Daftar item yang dipesan
- Total pembayaran
- Alamat pengiriman lengkap (dengan link Google Maps jika ada koordinat)
- **Instruksi pembayaran** sesuai metode yang dipilih:
  - Transfer Bank: daftar 4 rekening dengan tombol "Salin" (copy to clipboard)
  - E-Wallet: daftar 3 provider dengan nomor tujuan
  - QRIS: gambar QR Code
  - COD: informasi bayar di tempat
- Tombol WhatsApp untuk konfirmasi (pre-filled dengan nomor pesanan)

#### Riwayat Pesanan
- Daftar semua pesanan milik customer (terbaru di atas)
- Setiap pesanan menampilkan: nomor pesanan, badge status pembayaran (color-coded: amber = pending, green = paid, red = cancelled), tanggal
- Item per pesanan: nama produk x quantity, subtotal
- Total dan metode pembayaran
- Link "Lihat Petunjuk Pembayaran" untuk pesanan pending

#### Profil Pengguna
- Avatar inisial
- Nama, email, role (Pelanggan)
- Member Since date
- Link ke riwayat pesanan

#### Autentikasi Customer
- **Registrasi**: nama, email, password, konfirmasi password (min 8 karakter)
- **Login**: email, password, "Ingat saya"
- **Logout**: destroy session
- Proteksi route checkout, profil, dan orders dengan middleware `auth`

### B. Fitur untuk Admin (Pengelola Toko)

#### Login Admin Terpisah
- Halaman login khusus di `/admin/login`
- Pengecekan flag `is_admin = true` pada tabel users
- Session terpisah dari login customer

#### Dashboard Admin
- Kartu statistik: Total Produk, Total Kategori, Best Seller, New Arrival
- Chart "Produk per Kategori": bar chart dengan lebar proporsional

#### Manajemen Produk (CRUD)
| Operasi | Keterangan |
|---------|------------|
| **Create** | Form: nama, deskripsi, harga, kategori (dropdown), gambar (upload file jpeg/png/jpg/gif/webp max 2MB), checkbox Best Seller & New Arrival |
| **Read** | Tabel daftar produk (image thumbnail + nama, kategori badge, harga, status badge, tombol aksi) |
| **Update** | Form pre-filled sama seperti create (gambar opsional saat edit, bisa hapus gambar lama) |
| **Delete** | Hapus produk + file gambar (dengan konfirmasi) |

#### Manajemen Kategori (CRUD)
| Operasi | Keterangan |
|---------|------------|
| **Create** | Input nama → slug otomatis dari nama |
| **Read** | Grid kartu kategori (icon, nama, jumlah produk, tombol aksi) |
| **Update** | Form pre-filled, slug otomatis diperbarui |
| **Delete** | **Dicegah** jika kategori masih memiliki produk (validasi server) |

---

## 3. Fitur Location Picker (Peta Interaktif)

Salah satu fitur unggulan LiquidPedia adalah **Location Picker** berbasis peta interaktif yang digunakan pada halaman checkout untuk memilih lokasi pengiriman.

### Teknologi yang Digunakan

| Komponen | Kegunaan |
|----------|----------|
| **Leaflet.js** | Library JavaScript untuk menampilkan peta interaktif (gratis, open-source) |
| **OpenStreetMap** | Sumber data peta (gratis, tanpa API key) |
| **Nominatim API** | Layanan geocoding (cari alamat) dan reverse geocoding (alamat dari koordinat) |
| **Geolocation API** | Deteksi lokasi otomatis via browser |

### Implementasi

Fitur ini diimplementasikan dalam file `resources/views/components/location-picker.blade.php` sebagai **Blade Component** reusable.

#### Struktur Tampilan

1. **Preview Lokasi** (sebelum memilih)
   - Jika belum ada lokasi: ikon pin + teks "Belum memilih lokasi"
   - Jika sudah dipilih: alamat, koordinat lat/lng, link "Buka Maps" (Google Maps)

2. **Tombol Aksi**
   - **"Pilih Lokasi"** — membuka modal peta interaktif
   - **"Lokasi Saya"** — deteksi otomatis via browser geolocation

#### Modal Peta Interaktif

Modal berisi 4 area utama:

| Area | Fungsi |
|------|--------|
| **Search Bar** | Input pencarian alamat, terhubung ke Nominatim API dengan debounce 300ms, menampilkan 5 hasil teratas |
| **Peta Interaktif** | Map Leaflet.js dengan tile dari OpenStreetMap, marker yang bisa di-drag, klik pada peta untuk memindahkan marker |
| **Info Terpilih** | Menampilkan alamat hasil reverse geocoding dan koordinat lat/lng |
| **Tombol** | "Gunakan Lokasi Saya" (deteksi browser) dan "Simpan Lokasi" (menyimpan ke form) |

#### Alur Kerja Location Picker

```
Customer klik "Pilih Lokasi"
        │
        ▼
Modal terbuka → Map diinisialisasi (center di lokasi sebelumnya atau default Indonesia)
        │
        ├── Customer cari alamat → input → debounce 300ms → Nominatim API → tampilkan hasil
        │       └── Klik hasil → map pindah ke lokasi + marker + reverse geocode
        │
        ├── Customer klik peta → marker pindah → reverse geocode → tampilkan alamat
        │
        ├── Customer drag marker → marker pindah → reverse geocode → tampilkan alamat
        │
        └── Customer klik "Gunakan Lokasi Saya" → browser geolocation → map pindah → reverse geocode
                │
                ▼
        Customer klik "Simpan Lokasi"
                │
                ▼
        Value latitude & longitude tersimpan di hidden input form checkout
        Preview lokasi diperbarui dengan alamat dan koordinat
```

#### Keunggulan

- **Gratis** — semua layanan open-source, tanpa API key, tanpa biaya
- **Akurat** — menggunakan data OpenStreetMap yang komprehensif
- **User-friendly** — drag marker, klik peta, atau cari alamat
- **Responsive** — modal menyesuaikan ukuran layar

---

## 4. Bagian Frontend

### Struktur View (resources/views/)

Frontend menggunakan **Blade Templating Engine** milik Laravel dengan **Tailwind CSS v4** untuk styling. Aset dikelola menggunakan **Vite**.

```
resources/views/
├── layouts/
│   └── app.blade.php              → Layout utama customer (navbar, footer, cart badge, WhatsApp float)
├── admin/
│   └── layouts/
│       └── app.blade.php          → Layout admin (sidebar, top bar, toast notifikasi)
├── home.blade.php                  → Halaman beranda (hero, best seller, kategori, new arrival)
├── products.blade.php              → Daftar produk dengan filter kategori
├── product-detail.blade.php        → Detail produk dengan quantity selector
├── cart.blade.php                  → Keranjang belanja (session-based)
├── checkout.blade.php              → Form checkout dengan location picker
├── checkout/
│   └── payment-confirmation.blade.php → Halaman konfirmasi pembayaran
├── orders.blade.php                → Riwayat pesanan customer
├── profile.blade.php               → Profil customer
├── auth/
│   ├── login.blade.php             → Login customer
│   └── register.blade.php          → Registrasi customer
├── admin/
│   ├── login.blade.php             → Login admin (standalone layout)
│   ├── dashboard.blade.php         → Dashboard admin dengan statistik
│   ├── products/
│   │   ├── index.blade.php         → Daftar produk (admin)
│   │   ├── create.blade.php        → Form tambah produk
│   │   └── edit.blade.php          → Form edit produk
│   └── categories/
│       ├── index.blade.php         → Daftar kategori (admin)
│       ├── create.blade.php        → Form tambah kategori
│       └── edit.blade.php          → Form edit kategori
├── components/
│   └── location-picker.blade.php   → Komponen peta interaktif Leaflet.js
└── 404.blade.php                   → Halaman error 404 kustom
```

### Tema dan Styling

| Aspek | Detail |
|-------|--------|
| Warna primer | `#D84040` (merah) |
| Warna sekunder | `#8E1616` (merah gelap) |
| Warna aksen | `#1D1616` (hampir hitam) |
| Background | `#EEEEEE` (abu-abu terang) |
| Font | Inter (CDN Bunny Fonts) |
| Icon | Heroicons (inline SVG) |
| Animasi | Custom (fade-in, slide-in, float) |

### Layout Utama Customer

Berisi:
- **Top navbar**: logo "Liquid" (merah) + "Pedia" (gelap), navigasi (Beranda, Produk), icon cart dengan badge jumlah item, dropdown user (Profil, Pesanan, Logout) atau link Login/Register
- **Flash messages**: notifikasi sukses/error otomatis hilang
- **Footer**: 3 kolom (brand, navigasi, kontak: WhatsApp 0821-9148-8380, email hello@liquidpedia.id, jam operasional 09:00-21:00 WIB)
- **Tombol WhatsApp floating**: fixed bottom-right, link wa.me/6282191488380

### Layout Admin

Berisi:
- **Sidebar fixed** kiri: brand + badge "Admin", navigasi (Dashboard, Produk, Kategori), user info + logout
- **Top bar**: mobile hamburger toggle, link "Lihat Toko"
- **Toast notifications**: auto-dismiss 4 detik
- **Data-confirm**: konfirmasi sebelum delete

---

## 5. Bagian Backend

### A. Models (app/Models/)

| Model | Tabel | Relasi | Catatan Khusus |
|-------|-------|--------|----------------|
| **User** | `users` | `hasMany` Orders | Trait `HasApiTokens` (Sanctum) |
| **Category** | `categories` | `hasMany` Products | Auto-generate `slug` dari `name` saat `creating` |
| **Product** | `products` | `belongsTo` Category | Accessor `getImageUrlAttribute` (URL lokal/eksternal) |
| **Order** | `orders` | `belongsTo` User, `hasMany` OrderItems | Accessor label metode & status bayar (Bahasa Indonesia) |
| **OrderItem** | `order_items` | `belongsTo` Order, `belongsTo` Product | Snapshot nama & harga saat order |
| **CartItem** | `cart_items` | `belongsTo` User, `belongsTo` Product | Cart untuk API (database-based) |

### B. Controllers (app/Http/Controllers/)

#### Customer Controllers

| Controller | Method | Fungsi |
|------------|--------|--------|
| **HomeController** | `index()` | Ambil best seller (4), new arrival (4), semua kategori |
| **ProductController** | `index()` | Daftar produk dengan filter kategori via slug |
| **ProductController** | `show()` | Detail produk dengan relasi kategori |
| **CartController** | `index()` | Baca session cart, hitung subtotal |
| **CartController** | `add()` | Tambah/update quantity di session cart |
| **CartController** | `update()` | Update quantity (hapus jika < 1) |
| **CartController** | `remove()` | Hapus produk dari session cart |
| **CartController** | `showCheckoutForm()` | Validasi cart tidak kosong, tampilkan form |
| **CartController** | `processOrder()` | Validasi input, create Order + OrderItems, clear cart |
| **CartController** | `showPaymentConfirmation()` | Validasi kepemilikan order, tampilkan instruksi bayar |
| **AuthController** | `showLoginForm()` | Tampilkan form login |
| **AuthController** | `login()` | Validasi kredensial, regenerate session, redirect |
| **AuthController** | `showRegisterForm()` | Tampilkan form register |
| **AuthController** | `register()` | Validasi, create user, auto-login, redirect |
| **AuthController** | `logout()` | Logout, invalidate session, regenerate token |
| **AuthController** | `profile()` | Tampilkan profil |
| **AuthController** | `orders()` | Ambil order user + items, tampilkan riwayat |

#### Admin Controllers

| Controller | Fungsi |
|------------|--------|
| **Admin\AuthController** | Login/logout khusus admin (cek `is_admin = true`) |
| **Admin\DashboardController** | Statistik: total produk, kategori, best seller, new arrival, per kategori |
| **Admin\ProductController** | CRUD lengkap produk + upload/delete gambar |
| **Admin\CategoryController** | CRUD kategori + auto-slug + proteksi delete jika masih ada produk |

#### API Controllers (app/Http/Controllers/Api/)

| Controller | Endpoints | Auth |
|------------|-----------|------|
| **AuthController** | register, login, logout, user | Sanctum: logout, user |
| **ProductController** | index (pagination + filter), home, show | Public |
| **CategoryController** | index | Public |
| **CartController** | index, add, update, remove | Sanctum (semua) |
| **OrderController** | index, show, store, paymentConfirmation | Sanctum (semua) |

### C. Middleware

| Middleware | Fungsi |
|------------|--------|
| **AdminMiddleware** | Cek `Auth::check()` DAN `Auth::user()->is_admin` — redirect ke `/admin/login` jika gagal |

### D. Routes

#### Web Routes (routes/web.php)

| Grup | Middleware | Route |
|------|-----------|-------|
| **Publik** | - | `/` (home), `/products`, `/products/{product}`, `/cart` (+ add/update/remove), `/login`, `/register`, `/logout` |
| **Customer** | `auth` | `/checkout` (+ process), `/orders/{order}/payment-confirmation`, `/profile`, `/orders` |
| **Admin** | `admin` | `/admin/` (dashboard), `/admin/products/*` (CRUD), `/admin/categories/*` (CRUD) |
| **Fallback** | - | 404 custom |

#### API Routes (routes/api.php)

| Grup | Middleware | Route |
|------|-----------|-------|
| **Publik** | - | `GET /api/products` (+ home, show), `GET /api/categories`, `POST /api/auth/register`, `POST /api/auth/login` |
| **Protected** | `auth:sanctum` | `POST /api/auth/logout`, `GET /api/auth/user`, `/api/cart/*`, `/api/orders/*` |

### E. Database

#### Struktur Tabel

| Tabel | Isi |
|-------|-----|
| **users** | Data pengguna: name, email, password, is_admin |
| **categories** | Kategori: name, slug (unique, auto-generated) |
| **products** | Produk: name, description, price, category_id (FK), image, is_best_seller, is_new_arrival |
| **orders** | Pesanan: user_id (FK), order_number (unique), data pengiriman (name, country, province, city, district, postal code, address, phone, email), shipping_latitude, shipping_longitude, payment_method, payment_status, total |
| **order_items** | Detail item: order_id (FK), product_id (FK), product_name (snapshot), quantity, price, subtotal |
| **cart_items** | Cart API: user_id (FK), product_id (FK), quantity — unique(user_id, product_id) |
| **personal_access_tokens** | Token Sanctum: tokenable_id (user_id), name, token, abilities, last_used_at |

#### Relasi Database

```
users ──hasMany──> orders ──hasMany──> order_items ──belongsTo──> products
  │                                                │
  └──hasMany──> cart_items ──belongsTo─────────────┘
                    │
                    └──belongsTo──> products

categories ──hasMany──> products
```

### F. Seeders

| Seeder | Data |
|--------|------|
| **AdminSeeder** | 1 admin: `admin@liquidpedia.id` / `admin123` |
| **ProductSeeder** | 2 kategori (Vape, Liquid) + 16 produk (8 Vape, 8 Liquid) dengan gambar Unsplash |

---

## 6. REST API (Web Service)

### Deskripsi

LiquidPedia menyediakan REST API berbasis **JSON** yang menggunakan **Laravel Sanctum** untuk autentikasi token. API ini dirancang khusus untuk dikonsumsi oleh **aplikasi mobile (Flutter)** untuk customer.

### Autentikasi

API menggunakan **token-based authentication**:

1. Customer register/login → server mengembalikan **token** (format: `1|abc123...`)
2. Token disimpan di `SharedPreferences` Flutter
3. Setiap request protected menyertakan header: `Authorization: Bearer {token}`

### Endpoints

#### Public Endpoints (tanpa token)

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| `GET` | `/api/products` | Daftar produk dengan pagination & filter kategori (`?category=vape&page=1&per_page=10`) |
| `GET` | `/api/products/home` | Data beranda: best seller, new arrival, kategori |
| `GET` | `/api/products/{id}` | Detail produk |
| `GET` | `/api/categories` | Semua kategori dengan jumlah produk |
| `POST` | `/api/auth/register` | Registrasi akun baru → return token |
| `POST` | `/api/auth/login` | Login → return token |

#### Protected Endpoints (perlu token)

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| `POST` | `/api/auth/logout` | Hapus token |
| `GET` | `/api/auth/user` | Data profil user |
| `GET` | `/api/cart` | Lihat isi cart |
| `POST` | `/api/cart/{product}` | Tambah produk ke cart (body: `{"quantity":2}`) |
| `PUT` | `/api/cart/{product}` | Update quantity (body: `{"quantity":1}`) |
| `DELETE` | `/api/cart/{product}` | Hapus produk dari cart |
| `POST` | `/api/orders` | Buat pesanan (checkout) |
| `GET` | `/api/orders` | Riwayat pesanan |
| `GET` | `/api/orders/{id}` | Detail pesanan |
| `GET` | `/api/orders/{id}/payment` | Instruksi pembayaran |

### Format Response

Semua response memiliki format standar:

```json
{
  "success": true,
  "message": "Pesan (opsional)",
  "data": { ... },
  "meta": {
    "current_page": 1,
    "last_page": 2,
    "per_page": 10,
    "total": 16
  }
}
```

Contoh response error:

```json
{
  "success": false,
  "message": "Email atau password salah",
  "errors": null
}
```

### Mapping ke Flutter

| Halaman Flutter | API Endpoint |
|----------------|--------------|
| Splash Screen | `GET /api/auth/user` (cek token) |
| Login | `POST /api/auth/login` |
| Register | `POST /api/auth/register` |
| Beranda | `GET /api/products/home` |
| Daftar Produk | `GET /api/products?category=...` |
| Detail Produk | `GET /api/products/{id}` |
| Cart | `GET /api/cart` |
| Checkout | `POST /api/orders` |
| Riwayat Pesanan | `GET /api/orders` |
| Konfirmasi Bayar | `GET /api/orders/{id}/payment` |
| Profil | `GET /api/auth/user` |

---

## 7. Alur Sistem (Flow Aplikasi)

### Alur Customer (Web)

```
1. Buka Beranda ──> Lihat best seller & new arrival
       │
2. Klik "Produk" ──> Browse produk, filter kategori
       │
3. Klik produk ──> Lihat detail ──> Pilih quantity ──> Tambah ke Cart
       │
4. Buka Cart ──> Review item, ubah jumlah, hapus
       │
5. Klik Checkout
       │
       ├── Belum login? ──> Redirect ke Login ──> Login/Register
       │
       └── Sudah login ──> Form checkout:
              │  - Isi data pengiriman
              │  - Pilih lokasi di peta interaktif
              │  - Pilih metode bayar
              │  - Klik "Buat Pesanan"
              │
              ▼
      6. Order tersimpan di database
         Cart dikosongkan
         Redirect ke halaman konfirmasi pembayaran
              │
              ▼
      7. Lihat instruksi bayar sesuai metode:
         - Transfer: salin nomor rekening
         - E-Wallet: transfer ke nomor tujuan
         - QRIS: scan QR code
         - COD: siapkan uang tunai
              │
              ▼
      8. Konfirmasi via WhatsApp (tombol otomatis terisi nomor pesanan)
              │
              ▼
      9. Buka "Pesanan Saya" ──> Lihat riwayat pesanan
         - Status pending (Menunggu Pembayaran)
         - Status paid (Lunas) setelah admin konfirmasi
```

### Alur Admin

```
1. Buka /admin/login ──> Login dengan email & password admin
       │
2. Dashboard ──> Lihat statistik:
   - Total produk, kategori
   - Best seller, new arrival
   - Jumlah produk per kategori
       │
3. Kelola Produk:
   - Lihat daftar produk
   - Tambah produk baru (nama, harga, kategori, gambar, flag best/new)
   - Edit produk yang sudah ada
   - Hapus produk
       │
4. Kelola Kategori:
   - Lihat daftar kategori
   - Tambah kategori baru (slug otomatis)
   - Edit kategori
   - Hapus kategori (dicegah jika masih ada produk)
```

---

## 8. Keamanan Aplikasi

| Fitur Keamanan | Implementasi |
|----------------|--------------|
| **CSRF Protection** | Semua form menggunakan `@csrf` (Laravel built-in) |
| **Authentication Guard** | Route checkout, profil, orders dilindungi middleware `auth` |
| **Admin Middleware** | Semua route admin dilindungi middleware `admin` (cek `is_admin = true`) |
| **API Token Auth** | Semua endpoint API protected menggunakan Sanctum `auth:sanctum` |
| **Validasi Input** | Semua input divalidasi server-side menggunakan Laravel Validation (required, min, max, unique, email, in, dll) |
| **Password Hashing** | Password di-hash menggunakan bcrypt (Laravel default `Hash::make()`) |
| **Authorization Check** | Halaman konfirmasi pembayaran & API endpoint memvalidasi kepemilikan order (`$order->user_id === auth()->id()`) |
| **File Upload Validation** | Upload gambar divalidasi: tipe file (jpeg/png/jpg/gif/webp), ukuran max 2MB |
| **Sanctum Token Scoping** | Token API dibatasi untuk akses mobile-app |
| **Session Security** | Regenerasi session ID setelah login, invalidasi session setelah logout |
| **Error Handling** | Halaman 404 kustom untuk route tidak ditemukan |
| **SQL Injection Protection** | Menggunakan Eloquent ORM (parameter binding otomatis) |

---

> **Catatan:** Project ini merupakan tugas mata kuliah Analisis dan Perancangan Perangkat Lunak (ABP). Integrasi pembayaran dilakukan secara manual (belum terintegrasi dengan payment gateway). Konfirmasi pembayaran dilakukan melalui WhatsApp admin.
