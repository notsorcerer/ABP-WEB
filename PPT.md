# RENCANA PRESENTASI FINAL PROJECT — LIQUIDPEDIA

**Copy konten di bawah ke Canva slide-by-slide. Tambahkan screenshot sesuai petunjuk.**

---

## SLIDE 1 — COVER

| Elemen | Isi |
|--------|-----|
| **Judul Utama** | LIQUIDPEDIA |
| **Subtitle** | E-Commerce Liquid & Vape |
| **Platform** | Web (Laravel) + Mobile (Flutter) |
| **Mata Kuliah** | Analisis dan Perancangan Perangkat Lunak |
| **Nama / NIM** | [ISI NAMA DAN NIM] |

**Desain:** Background merah marun (#8E1616) atau hitam (#1D1616), teks putih.

---

## SLIDE 2 — DAFTAR ISI

1. Latar Belakang
2. Rumusan Masalah & Tujuan
3. Landasan Teori
4. Arsitektur Sistem
5. Struktur Database
6. Fitur Customer
7. Fitur Admin
8. Perbandingan Platform
9. REST API
10. Fitur Unggulan
11. Hasil Implementasi — Web
12. Hasil Implementasi — Mobile
13. Hasil Pengujian
14. Kesimpulan & Saran

**Desain:** Dua kolom, background gradien merah.

---

## SLIDE 3 — LATAR BELAKANG

**Judul:** Latar Belakang

- Meningkatnya pengguna vape di Indonesia kebutuhan platform e-commerce khusus liquid & vape
- Platform e-commerce umum tidak menyediakan kategorisasi spesifik untuk produk liquid & vape
- Kebutuhan aplikasi mobile + web yang terintegrasi via REST API

**Ilustrasi:** Icon grafik naik, icon shopping cart, icon smartphone + laptop.

---

## SLIDE 4 — RUMUSAN MASALAH & TUJUAN

**Rumusan Masalah:**
1. Bagaimana merancang platform e-commerce khusus liquid & vape untuk web dan mobile?
2. Bagaimana mengintegrasikan mobile dengan backend Laravel via REST API?
3. Bagaimana mengimplementasikan fitur location picker berbasis OpenStreetMap di web & mobile?
4. Bagaimana menyediakan panel admin yang dapat diakses dari web dan mobile?

**Tujuan:**
1. Menghasilkan platform e-commerce web + mobile yang fungsional
2. Mengimplementasikan REST API dengan Laravel Sanctum
3. Menyediakan location picker (Leaflet.js + flutter_map)
4. Menyediakan panel administrasi untuk web dan mobile

**Desain:** Dua kolom (kiri: masalah, kanan: tujuan), icon panah.

---

## SLIDE 5 — LANDASAN TEORI

**Grid 3x3:**

| Kolom 1 | Kolom 2 | Kolom 3 |
|---------|---------|---------|
| **Laravel** (MVC, Blade, Eloquent, Sanctum) | **Flutter** (Widget, Provider, Dio) | **MySQL** (Database Relasional) |
| **REST API** (JSON, HTTP Methods) | **Leaflet.js** (Peta interaktif Web) | **flutter_map** (Peta interaktif Mobile) |
| **OpenStreetMap** (Tile peta gratis) | **Tailwind CSS** (Utility-first CSS) | **Nominatim** (Geocoding gratis) |

**Desain:** Kartu-kartu kecil dengan icon, merah untuk kartu yang dipilih.

---

## SLIDE 6 — ARSITEKTUR SISTEM

Buat diagram layer:

```
       CLIENT LAYER
  Web Browser (Blade+JS)     Flutter App (Android)
           |                         |
           +-------- HTTP/JSON ------+
                        |
                   LARAVEL SERVER
              - Controllers (Web + API)
              - Eloquent ORM
              - Sanctum Auth
              - Blade Views
                        |
                  MySQL Database
            users, categories, products,
            orders, order_items, cart_items
```

**Catatan:** Gambar ulang di Canva pakai shape kotak + panah, warna berbeda per layer.

---

## SLIDE 7 — STRUKTUR DATABASE

| Tabel | Kolom Penting | Relasi |
|-------|--------------|--------|
| **users** | id, name, email, password, is_admin | hasMany orders, hasMany cart_items |
| **categories** | id, name, slug (unique) | hasMany products |
| **products** | id, name, description, price, category_id, image, is_best_seller, is_new_arrival | belongsTo category |
| **orders** | id, user_id, order_number (unique), payment_method, payment_status, total | belongsTo user, hasMany order_items |
| **order_items** | id, order_id, product_id, product_name, quantity, price, subtotal | belongsTo order, belongsTo product |
| **cart_items** | id, user_id, product_id, quantity (unique) | belongsTo user, belongsTo product |

**Format Order Number:** `INV/YYYYMMDD/RANDOM6`

---

## SLIDE 8 — FITUR CUSTOMER

| Fitur | Deskripsi |
|-------|-----------|
| **Registrasi & Login** | Session-based (web) atau token-based Sanctum (mobile) |
| **Beranda** | Hero banner, Best Seller, kategori, New Arrival, cart badge |
| **Katalog Produk** | Grid + filter kategori + search debounce + infinite scroll |
| **Detail Produk** | Gambar, info tabel, quantity selector, Add to Cart |
| **Keranjang Belanja** | Tambah/ubah/hapus item, subtotal, grand total |
| **Checkout + Location Picker** | Form pengiriman + peta OpenStreetMap interaktif |
| **Konfirmasi Pembayaran** | Invoice, instruksi bayar, tombol WA, copy-to-clipboard |
| **Riwayat Pesanan** | Daftar pesanan, status badge, cancel order |
| **Profil** | Info akun, tautan pesanan & logout |

**Desain:** Tabel atau list dengan icon per fitur.

---

## SLIDE 9 — FITUR ADMIN

| Fitur | Deskripsi |
|-------|-----------|
| **Dashboard** | Statistik toko (total produk/kategori, best seller, new arrival) |
| **Manajemen Produk** | CRUD + upload gambar + toggle best seller/new arrival |
| **Manajemen Kategori** | CRUD + proteksi hapus jika masih punya produk |
| **Manajemen Pesanan** | Lihat/filter/update status pembayaran |

**Desain:** Grid 2x2 dengan icon.

---

## SLIDE 10 — PERBANDINGAN PLATFORM

| Fitur | Web | Mobile |
|-------|-----|--------|
| Autentikasi | Session-based | Token-based (Sanctum) |
| Cart | Session (tanpa login) | Database (harus login) |
| Search | Filter kategori | Debounce 500ms |
| Location Picker | Leaflet.js | flutter_map |
| Cart Badge | Badge navbar | Badge real-time dari API |
| Admin Panel | Blade views | Flutter screens |
| Animasi | Hover CSS | Fade-in + SlideTransition |
| Payment Copy | Manual select + copy | Tap to copy (clipboard) |
| Pagination | Page load | Infinite scroll |
| Cancel Order | URL konfirmasi | Dialog + API call |

---

## SLIDE 11 — REST API ENDPOINTS

**27 endpoint dalam 3 kategori:**

**Public (tanpa token):**
| Method | Endpoint |
|--------|----------|
| POST | /api/auth/register |
| POST | /api/auth/login |
| GET | /api/products, /products/home, /products/{id} |
| GET | /api/categories |

**Protected (Sanctum):**
| Method | Endpoint |
|--------|----------|
| POST | /api/auth/logout |
| GET | /api/auth/user |
| GET/POST/PUT/DELETE | /api/cart |
| GET/POST | /api/orders |
| PUT | /api/orders/{id}/cancel |
| GET | /api/orders/{id}/payment |

**Admin (Sanctum + is_admin):**
| Method | Endpoint |
|--------|----------|
| GET | /api/admin/dashboard |
| GET/POST/PUT/DELETE | /api/admin/products |
| GET/POST/PUT/DELETE | /api/admin/categories |
| GET/PUT | /api/admin/orders |

**Desain:** Tabel striped, 3 section dengan header warna merah.

---

## SLIDE 12 — FITUR UNGGULAN

**4 fitur:**

| No | Fitur | Deskripsi |
|----|-------|-----------|
| 1 | **Location Picker Interaktif** | Leaflet.js (web) + flutter_map (mobile) — OpenStreetMap gratis, search, drag marker, reverse geocode |
| 2 | **Admin Panel di Mobile** | Dashboard, CRUD produk + kategori, manajemen pesanan dari HP |
| 3 | **Cancel Order** | Batalkan pesanan selama status masih pending (web + mobile) |
| 4 | **Search Debounce** | Pencarian real-time dengan delay 500ms, filter nama + deskripsi |

**Desain:** Layout grid 2x2, setiap kartu icon + judul + deskripsi.

---

## SLIDE 13 — HASIL IMPLEMENTASI WEB (BAGIAN 1)

**4 screenshot grid 2x2:**

| Kiri Atas | Kanan Atas |
|-----------|------------|
| **Beranda** — Hero banner merah, best seller grid, kategori cards, new arrival | **Katalog Produk** — Grid 4 kolom, pill filter kategori (Vape/Liquid) |

| Kiri Bawah | Kanan Bawah |
|-----------|------------|
| **Detail Produk** — Gambar, badge, info table, quantity, add to cart | **Checkout + Location Picker** — Form data, Leaflet map, metode bayar |

---

## SLIDE 14 — HASIL IMPLEMENTASI WEB (BAGIAN 2)

**4 screenshot grid 2x2:**

| Kiri Atas | Kanan Atas |
|-----------|------------|
| **Admin Dashboard** — 4 kartu statistik + chart per kategori | **Admin Produk** — Form tambah/edit, upload gambar, switch best seller/new arrival |

| Kiri Bawah | Kanan Bawah |
|-----------|------------|
| **Admin Kategori** — Grid dengan jumlah produk + edit/hapus | **Konfirmasi Pembayaran** — Instruksi bayar sesuai metode + tombol WA |

---

## SLIDE 15 — HASIL IMPLEMENTASI MOBILE (BAGIAN 1)

**6 screenshot grid 3x2:**

| Kiri | Tengah | Kanan |
|------|--------|-------|
| **Home** — Hero gradien, kategori, best seller, new arrival, cart badge | **Katalog** — Grid 2 kolom, search bar debounce | **Detail** — Info table, quantity, add to cart |
| **Cart** — Item list, quantity +/-, total | **Checkout** — Form + flutter_map location picker | **Order Detail** — Status, payment instructions, copy-to-clipboard |

---

## SLIDE 16 — HASIL IMPLEMENTASI MOBILE (BAGIAN 2)

**6 screenshot grid 3x2:**

| Kiri | Tengah | Kanan |
|------|--------|-------|
| **Admin Dashboard** — Stats grid, menu CRUD | **Admin Produk** — List + search + FAB add | **Admin Product Form** — Image picker, form fields, switches |
| **Admin Kategori** — List + FAB add | **Admin Order List** — Filter chips | **Admin Order Detail** — Info customer, items, update status |

---

## SLIDE 17 — HASIL PENGUJIAN

| Platform | Jumlah Test | Berhasil | Gagal |
|----------|-------------|----------|-------|
| Web (Customer) | 12 | 12 | 0 |
| Web (Admin) | 4 | 4 | 0 |
| Mobile (Customer) | 14 | 14 | 0 |
| Mobile (Admin) | 6 | 6 | 0 |
| API Endpoints | 27 | 27 | 0 |

**Temuan:**
- Gambar produk mobile — fix: `Storage::disk('public')->url()` bukan `Storage::url()`
- Overflow OrderDetailScreen — fix: `Expanded` + `TextOverflow.ellipsis`
- Gesture conflict flutter_map — fix: `GestureDetector` + `InteractionOptions`

---

## SLIDE 18 — KESIMPULAN & SARAN

**Kesimpulan:**
1. LiquidPedia berhasil diimplementasikan di **Web (Laravel)** dan **Mobile (Flutter)**
2. Integrasi mobile via **REST API + Sanctum** berjalan baik (27 endpoint)
3. Fitur **Location Picker** berhasil di kedua platform (Leaflet.js + flutter_map)
4. Panel **Admin** dapat diakses dari Web dan Mobile

**Saran:**
1. Integrasi **Payment Gateway** (Midtrans, Xendit)
2. **Notifikasi Push** (Firebase) untuk update status pesanan
3. **Fitur Review & Rating** produk
4. **Versi iOS** dari aplikasi mobile

**Desain:** Dua kolom (kiri: kesimpulan, kanan: saran).

---

## SLIDE 19 — TERIMA KASIH

| Elemen | Isi |
|--------|-----|
| Judul | TERIMA KASIH |
| Subtitle | LiquidPedia — E-Commerce Liquid & Vape |
| Teks | "Questions?" |
| Kontak | [ISI EMAIL / WHATSAPP] |

**Desain:** Background merah (#D84040), teks putih besar. Sederhana dan elegan.

---

# PETUNJUK SCREENSHOT

## Web (14 screenshot)

| No | Halaman | Catatan |
|----|---------|---------|
| 1 | Halaman Login | Form login web |
| 2 | Halaman Beranda | Hero banner, Best Seller, kategori, New Arrival |
| 3 | Katalog Produk | Grid dengan filter kategori aktif |
| 4 | Detail Produk | Gambar, badge, info table, add to cart |
| 5 | Keranjang Belanja | Item list + total |
| 6 | Checkout | Form + Leaflet map terbuka |
| 7 | Location Picker | Leaflet map dengan marker |
| 8 | Konfirmasi Pembayaran | Instruksi bayar + tombol WA |
| 9 | Riwayat Pesanan | Daftar pesanan + status badge |
| 10 | Admin Dashboard | 4 kartu statistik |
| 11 | Admin Produk List | Tabel daftar produk |
| 12 | Admin Produk Form | Form tambah/edit produk |
| 13 | Admin Kategori | Grid kategori + jumlah produk |
| 14 | Admin Pesanan | Daftar pesanan + filter status |

## Mobile (16 screenshot)

| No | Screen | Catatan |
|----|--------|---------|
| 1 | Login | Form login mobile |
| 2 | Beranda | Hero, kategori, best seller, new arrival, cart badge |
| 3 | Katalog Produk | Grid 2 kolom + search bar |
| 4 | Detail Produk | Info table, quantity, badges |
| 5 | Keranjang | Items + quantity +/- + total |
| 6 | Checkout | Form + flutter_map |
| 7 | Location Picker | flutter_map dengan marker |
| 8 | Konfirmasi Pembayaran | Payment instructions + copy |
| 9 | Riwayat Pesanan | Riwayat + status badge |
| 10 | Detail Pesanan | Payment instructions + copy |
| 11 | Profil | User info + admin panel link |
| 12 | Admin Dashboard | Stats grid + menu |
| 13 | Admin Produk List | List + search + FAB |
| 14 | Admin Produk Form | Image picker + fields |
| 15 | Admin Kategori | Grid + FAB |
| 16 | Admin Pesanan | Filter chips + list |

## Tips

- **Web:** Resize browser ke 1280x720, pakai ekstensi "Full Page Screen Capture"
- **Mobile:** Screenshot bawaan HP, atau Ctrl+S di emulator Android Studio
- **Format:** PNG, resolusi cukup tinggi, bersihkan bookmark bar
