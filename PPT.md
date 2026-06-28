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
| **Kelas** | [ISI KELAS] |
| **Logo** | Logo LiquidPedia (lingkaran merah dengan "L") / icon cart + vape |

**Desain:** Background merah marun (#8E1616) atau hitam (#1D1616), teks putih.

---

## SLIDE 2 — DAFTAR ISI

1. Latar Belakang
2. Rumusan Masalah & Tujuan
3. Landasan Teori
4. Analisis & Perancangan
5. Hasil Implementasi — Web
6. Hasil Implementasi — Mobile
7. Fitur Unggulan
8. REST API
9. Hasil Pengujian
10. Kesimpulan & Saran

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
3. Bagaimana menyediakan panel admin yang dapat diakses dari web dan mobile?

**Tujuan:**
1. Menghasilkan platform e-commerce web + mobile yang fungsional
2. Mengimplementasikan REST API dengan Laravel Sanctum
3. Menyediakan panel administrasi untuk web dan mobile

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

## SLIDE 6 — USE CASE DIAGRAM

**Aktor 1:** **Customer** (kiri)  **10 use case:** Registrasi, Login, Lihat Produk, Detail Produk, Search Produk, Kelola Cart, Checkout + Location Picker, Konfirmasi Bayar, Cancel Order, Riwayat Pesanan

**Aktor 2:** **Admin** (kanan)  **4 use case:** Login & Dashboard, Kelola Produk, Kelola Kategori, Kelola Pesanan

**System boundary:** LiquidPedia

**Catatan Gambar:** Buat diagram di Canva (ellipse = use case, stick figure = aktor, rectangle = system boundary).

---

## SLIDE 7 — ARSITEKTUR SISTEM

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

## SLIDE 8 — ENTITY RELATIONSHIP DIAGRAM (ERD)

| Tabel | Primary Key | Foreign Key |
|-------|-------------|-------------|
| **users** | id | - |
| **categories** | id | - |
| **products** | id | category_id |
| **orders** | id | user_id |
| **order_items** | id | order_id, product_id |
| **cart_items** | id | user_id, product_id |

**Relasi:** users 1:N orders, orders 1:N order_items, products 1:N order_items, users 1:N cart_items, products 1:N cart_items, categories 1:N products

---

## SLIDE 9 — FITUR UNGGULAN

**4 fitur:**

| No | Fitur | Icon | Deskripsi |
|----|-------|------|-----------|
| 1 | **Location Picker Interaktif** | Pin | Leaflet.js (web) + flutter_map (mobile)  OpenStreetMap gratis, search, drag marker, reverse geocode |
| 2 | **Admin Panel di Mobile** | HP | Dashboard, CRUD produk + kategori, manajemen pesanan dari HP |
| 3 | **Cancel Order** | Panah | Batalkan pesanan selama status masih pending (web + mobile) |
| 4 | **Search Debounce** | Kaca | Pencarian real-time dengan delay 500ms, filter nama + deskripsi |

**Desain:** Layout grid 2x2, setiap kartu icon + judul + deskripsi.

---

## SLIDE 10 — HASIL IMPLEMENTASI WEB (BAGIAN 1)

**4 screenshot grid 2x2:**

| Kiri Atas | Kanan Atas |
|-----------|------------|
| **Beranda**  Hero banner merah, best seller grid, kategori cards, new arrival | **Katalog Produk**  Grid 4 kolom, pill filter kategori (Vape/Liquid) |

| Kiri Bawah | Kanan Bawah |
|-----------|------------|
| **Detail Produk**  Gambar, badge, info table, quantity, add to cart | **Checkout + Location Picker**  Form data, Leaflet map, metode bayar |

---

## SLIDE 11 — HASIL IMPLEMENTASI WEB (BAGIAN 2)

**4 screenshot grid 2x2:**

| Kiri Atas | Kanan Atas |
|-----------|------------|
| **Dashboard Admin**  4 kartu statistik + chart per kategori | **CRUD Produk**  Form tambah/edit, upload gambar, switch best seller/new arrival |

| Kiri Bawah | Kanan Bawah |
|-----------|------------|
| **CRUD Kategori**  Grid dengan jumlah produk + edit/hapus | **Konfirmasi Pembayaran**  Instruksi bayar sesuai metode + tombol WA |

---

## SLIDE 12 — HASIL IMPLEMENTASI MOBILE (BAGIAN 1)

**6 screenshot grid 3x2:**

| Kiri | Tengah | Kanan |
|------|--------|-------|
| **Home**  Hero gradien, kategori, best seller, new arrival, cart badge | **Produk**  Grid 2 kolom, search bar debounce | **Detail**  Info table, quantity, add to cart |
| **Cart**  Item list, quantity +/- , total | **Checkout**  Form + flutter_map location picker | **Order Detail**  Status, payment instructions, copy-to-clipboard |

---

## SLIDE 13 — HASIL IMPLEMENTASI MOBILE (BAGIAN 2)

**6 screenshot grid 3x2:**

| Kiri | Tengah | Kanan |
|------|--------|-------|
| **Admin Dashboard**  Stats grid, menu CRUD | **Admin Produk**  List + search + FAB add | **Admin Product Form**  Image picker, form fields, switches |
| **Admin Kategori**  List + FAB add | **Admin Order List**  Filter chips | **Admin Order Detail**  Info customer, items, update status |

---

## SLIDE 14 — REST API ENDPOINTS

| Method | Endpoint | Auth |
|--------|----------|------|
| POST | /api/auth/register | - |
| POST | /api/auth/login | - |
| POST/GET | /api/auth/logout, /user | Sanctum |
| GET | /api/products, /products/home | - |
| GET/POST/PUT/DELETE | /api/cart | Sanctum |
| GET/POST | /api/orders | Sanctum |
| PUT | /api/orders/{id}/cancel | Sanctum |
| GET/POST/PUT/DELETE | /api/admin/products | Admin |
| GET/POST/PUT/DELETE | /api/admin/categories | Admin |
| GET/PUT | /api/admin/orders | Admin |

**Desain:** Tabel striped.

---

## SLIDE 15 — HASIL PENGUJIAN

| Platform | Fitur | Berhasil | Gagal |
|----------|-------|----------|-------|
| Web (Customer) | 15 | 15 | 0 |
| Web (Admin) | 5 | 5 | 0 |
| Mobile (Customer) | 14 | 14 | 0 |
| Mobile (Admin) | 7 | 7 | 0 |
| API Endpoints | 20 | 20 | 0 |

**Temuan:** Gambar produk mobile (fix: Storage::disk('public')->url), Overflow OrderDetailScreen (fix: Expanded + ellipsis), Gesture conflict flutter_map (fix: GestureDetector)

---

## SLIDE 16 — KESIMPULAN

1. LiquidPedia berhasil diimplementasikan sebagai e-commerce khusus liquid & vape di **Web (Laravel)** dan **Mobile (Flutter)**
2. Integrasi mobile dengan backend via **REST API + Sanctum** berjalan baik (20 endpoint)
3. Fitur **Location Picker** berhasil di kedua platform (Leaflet.js + flutter_map)
4. Panel **Admin** dapat diakses dari Web dan Mobile

---

## SLIDE 17 — SARAN

1. Integrasi **Payment Gateway** (Midtrans, Xendit) untuk pembayaran otomatis
2. **Notifikasi Push** (Firebase) untuk update status pesanan
3. **Fitur Review & Rating** produk
4. **Versi iOS** dari aplikasi mobile

---

## SLIDE 18 — TERIMA KASIH

| Elemen | Isi |
|--------|-----|
| Judul | TERIMA KASIH |
| Subtitle | LiquidPedia  E-Commerce Liquid & Vape |
| Teks | "Questions?" |
| Kontak | [ISI EMAIL / WHATSAPP] |

**Desain:** Background merah (#D84040), teks putih besar. Sederhana dan elegan.

---

# PETUNJUK SCREENSHOT

## Web (8 screenshot)
| No | Halaman | Catatan |
|----|---------|---------|
| 1 | Beranda (/) | Full page  hero, best seller, kategori, new arrival |
| 2 | Katalog Produk (/products) | Grid dengan filter kategori aktif |
| 3 | Detail Produk (/products/{id}) | Gambar, badge, info table, add to cart |
| 4 | Cart (/cart) | Item list + total |
| 5 | Checkout (/checkout) | Form + Leaflet map terbuka |
| 6 | Konfirmasi Bayar (/orders/{id}/...) | Instruksi bayar + tombol WA |
| 7 | Admin Dashboard (/admin) | 4 kartu statistik + chart |
| 8 | Admin Produk (/admin/products) | Tabel produk + form create/edit |

## Mobile (12 screenshot)
| No | Screen | Catatan |
|----|--------|---------|
| 1 | Home | Hero, kategori, best seller, new arrival |
| 2 | Product List | Grid 2 kolom + search bar |
| 3 | Product Detail | Info table, quantity, badges |
| 4 | Cart | Items + quantity +/- + total |
| 5 | Checkout + Map | Form + flutter_map |
| 6 | Order List | Riwayat + status badge + cancel |
| 7 | Order Detail | Payment instructions + copy |
| 8 | Profile | User info + admin panel link |
| 9 | Admin Dashboard | Stats grid + menu |
| 10 | Admin Product Form | Image picker + fields |
| 11 | Admin Order List | Filter chips + list |
| 12 | Admin Category List | Grid + FAB |

## Tips
- **Web:** Resize browser ke 1280x720, pakai ekstensi "Full Page Screen Capture"
- **Mobile:** Screenshot bawaan HP, atau Ctrl+S di emulator Android Studio
- **Format:** PNG, resolusi cukup tinggi, bersihkan bookmark bar
