# LAPORAN FINAL PROJECT — LIQUIDPEDIA

**Web E-Commerce Liquid & Vape (Laravel) + Aplikasi Mobile (Flutter)**

---

**Mata Kuliah:** Analisis dan Perancangan Perangkat Lunak (ABP)

**Program Studi:** Informatika — Telkom University

---

## DAFTAR ISI

1. [BAB 1 — PENDAHULUAN](#bab-1--pendahuluan)
   - 1.1 Latar Belakang
   - 1.2 Rumusan Masalah
   - 1.3 Batasan Masalah
   - 1.4 Tujuan
   - 1.5 Manfaat

2. [BAB 2 — TINJAUAN PUSTAKA](#bab-2--tinjauan-pustaka)
   - 2.1 Laravel Framework
   - 2.2 Flutter Framework
   - 2.3 MySQL
   - 2.4 Laravel Sanctum
   - 2.5 Provider (State Management)
   - 2.6 REST API
   - 2.7 Leaflet.js & OpenStreetMap
   - 2.8 Flutter Map (flutter_map)
   - 2.9 Tailwind CSS

3. [BAB 3 — ANALISIS & PERANCANGAN](#bab-3--analisis--perancangan)
   - 3.1 Analisis Sistem
   - 3.2 Perancangan Sistem
   - 3.3 Perancangan Data
   - 3.4 Perancangan Antarmuka
   - 3.5 Perancangan Algoritma

4. [BAB 4 — IMPLEMENTASI](#bab-4--implementasi)
   - 4.1 Lingkungan Implementasi
   - 4.2 Implementasi Backend (Laravel)
   - 4.3 Implementasi Frontend Web (Blade)
   - 4.4 Implementasi Aplikasi Mobile (Flutter)
   - 4.5 Integrasi Web & Mobile

5. [BAB 5 — PENGUJIAN](#bab-5--pengujian)
   - 5.1 Skenario Pengujian
   - 5.2 Hasil Pengujian Web
   - 5.3 Hasil Pengujian Mobile
   - 5.4 Hasil Pengujian API
   - 5.5 Analisis Hasil Pengujian

6. [BAB 6 — PENUTUP](#bab-6--penutup)
   - 6.1 Kesimpulan
   - 6.2 Saran

---

## DAFTAR GAMBAR

| No | Nama Gambar | Halaman |
|----|------------|---------|
| 3.1 | Use Case Diagram | - |
| 3.2 | Arsitektur Sistem | - |
| 3.3 | ERD | - |
| 3.4 | Class Diagram | - |
| 4.1 | Struktur Navigasi Web | - |
| 4.2 | Struktur Navigasi Mobile | - |
| 4.3 | Screenshot Web - Beranda | - |
| 4.4 | Screenshot Web - Detail Produk | - |
| 4.5 | Screenshot Web - Checkout & Map | - |
| 4.6 | Screenshot Web - Admin Dashboard | - |
| 4.7 | Screenshot Mobile - Home | - |
| 4.8 | Screenshot Mobile - Produk | - |
| 4.9 | Screenshot Mobile - Checkout & Map | - |
| 4.10 | Screenshot Mobile - Admin Panel | - |

## DAFTAR TABEL

| No | Nama Tabel | Halaman |
|----|-----------|---------|
| 3.1 | Kebutuhan Fungsional | - |
| 3.2 | Kebutuhan Non-Fungsional | - |
| 3.3 | Struktur Tabel Database | - |
| 3.4 | Daftar API Endpoint | - |
| 5.1 | Hasil Pengujian Web | - |
| 5.2 | Hasil Pengujian Mobile | - |
| 5.3 | Hasil Pengujian API | - |

---

# BAB 1 — PENDAHULUAN

## 1.1 Latar Belakang

Perkembangan industri vaping di Indonesia menunjukkan peningkatan yang signifikan dalam beberapa tahun terakhir. Meningkatnya jumlah pengguna liquid dan perangkat vape menciptakan kebutuhan akan platform e-commerce yang dikhususkan untuk produk-produk tersebut. Sayangnya, sebagian besar platform e-commerce umum tidak menyediakan kategorisasi yang spesifik untuk produk liquid dan vape, sehingga menyulitkan pengguna dalam mencari dan membandingkan produk.

Selain itu, dengan semakin meluasnya penggunaan smartphone, konsumen modern cenderung beralih dari belanja melalui desktop ke perangkat mobile. Oleh karena itu, diperlukan solusi yang mencakup platform web dan mobile yang terintegrasi untuk memenuhi kebutuhan pengguna di kedua platform.

LiquidPedia hadir sebagai solusi e-commerce khusus untuk liquid dan vape yang dikembangkan dalam dua platform sekaligus: aplikasi web berbasis Laravel dan aplikasi mobile berbasis Flutter. Kedua platform terhubung ke backend yang sama melalui REST API, memastikan konsistensi data dan pengalaman pengguna yang seamless.

## 1.2 Rumusan Masalah

Berdasarkan latar belakang di atas, rumusan masalah dalam proyek ini adalah:

1. Bagaimana merancang dan membangun platform e-commerce khusus liquid dan vape yang mencakup web dan mobile?
2. Bagaimana mengintegrasikan aplikasi mobile dengan backend Laravel melalui REST API?
3. Bagaimana mengimplementasikan fitur location picker berbasis peta interaktif (OpenStreetMap) pada proses checkout di web dan mobile?
4. Bagaimana menyediakan panel administrasi yang dapat diakses dari web dan mobile untuk mengelola produk, kategori, dan pesanan?

## 1.3 Batasan Masalah

Untuk menjaga fokus pengembangan, proyek ini memiliki batasan sebagai berikut:

1. Pembayaran dilakukan secara manual (belum terintegrasi dengan payment gateway)
2. Konfirmasi pembayaran melalui WhatsApp admin
3. Tidak ada fitur pengiriman/resi otomatis
4. Tidak ada fitur review atau rating produk
5. Tidak ada fitur wishlist
6. Tidak ada sistem diskon atau kupon
7. Aplikasi mobile hanya tersedia untuk platform Android
8. Admin tidak bisa registrasi mandiri (hanya via database seeder)

## 1.4 Tujuan

Tujuan dari pembuatan proyek LiquidPedia adalah:

1. Menghasilkan platform e-commerce khusus liquid dan vape yang fungsional dalam bentuk aplikasi web (Laravel) dan mobile (Flutter)
2. Mengimplementasikan REST API dengan Laravel Sanctum untuk melayani aplikasi mobile
3. Menyediakan fitur location picker berbasis OpenStreetMap pada web (Leaflet.js) dan mobile (flutter_map)
4. Menyediakan panel administrasi yang dapat diakses dari web dan mobile
5. Menerapkan arsitektur MVC pada backend dan arsitektur Provider pada mobile

## 1.5 Manfaat

Manfaat dari proyek LiquidPedia adalah:

1. **Bagi pengguna**: Memudahkan pencarian dan pembelian produk liquid dan vape melalui web maupun mobile
2. **Bagi admin**: Memudahkan pengelolaan toko melalui panel administrasi yang dapat diakses dari web dan mobile
3. **Bagi pengembang**: Menjadi referensi implementasi integrasi Laravel + Flutter dengan REST API dan Sanctum authentication

---

# BAB 2 — TINJAUAN PUSTAKA

## 2.1 Laravel Framework

Laravel adalah framework aplikasi web berbasis PHP dengan arsitektur MVC (Model-View-Controller). Laravel menyediakan berbagai fitur seperti routing, middleware, Eloquent ORM, Blade templating engine, dan berbagai fitur keamanan built-in. Laravel versi 13.x yang digunakan dalam proyek ini mendukung PHP 8.3+.

Keunggulan utama Laravel yang digunakan dalam proyek ini:
- **Eloquent ORM**: Active-record implementation untuk interaksi database yang ekspresif
- **Blade Templating**: Template engine dengan komponen dan layout
- **Sanctum**: Lightweight authentication system untuk API token dan SPA
- **Migration**: Version control untuk skema database
- **Seeder**: Pengisian data awal untuk development dan testing

## 2.2 Flutter Framework

Flutter adalah framework open-source dari Google untuk membangun aplikasi mobile, web, dan desktop dari satu codebase. Flutter menggunakan bahasa pemrograman Dart dan menyediakan widget library yang kaya untuk membangun antarmuka pengguna yang responsif dan menarik.

Komponen utama Flutter yang digunakan:
- **Widget**: Semua elemen UI adalah widget (StatelessWidget, StatefulWidget)
- **Provider**: State management pattern berbasis ChangeNotifier
- **Dio**: HTTP client untuk komunikasi dengan REST API
- **CachedNetworkImage**: Widget untuk menampilkan dan caching gambar dari network
- **flutter_map**: Widget map terintegrasi dengan OpenStreetMap

## 2.3 MySQL

MySQL adalah sistem manajemen database relasional (RDBMS) open-source yang banyak digunakan. Dalam proyek LiquidPedia, MySQL digunakan untuk menyimpan data pengguna, produk, kategori, pesanan, dan cart items. Penggunaan InnoDB engine memastikan integritas referensial melalui foreign key constraints.

## 2.4 Laravel Sanctum

Laravel Sanctum adalah package autentikasi ringan untuk Laravel yang mendukung API token-based authentication. Sanctum cocok untuk aplikasi mobile dan SPA (Single Page Application). Setiap pengguna dapat memiliki banyak token yang dapat diberikan abilities tertentu.

Alur autentikasi Sanctum di LiquidPedia:
1. Pengguna login/register → server membuat token baru
2. Token dikembalikan ke Flutter dan disimpan di encrypted storage
3. Setiap request API menyertakan token di header `Authorization: Bearer <token>`
4. Server memvalidasi token melalui middleware `auth:sanctum`

## 2.5 Provider (State Management)

Provider adalah state management pattern untuk Flutter yang direkomendasikan oleh tim Flutter. Provider menggunakan konsep ChangeNotifier dan Consumer untuk memisahkan logika bisnis dari tampilan UI.

Dalam LiquidPedia, terdapat 5 provider:
- AuthProvider: manajemen autentikasi pengguna
- ProductProvider: data produk dan kategori
- CartProvider: data keranjang belanja
- OrderProvider: data pesanan
- AdminProvider: data panel administrasi

## 2.6 REST API

REST (Representational State Transfer) API adalah arsitektur komunikasi antar sistem berbasis HTTP. Dalam LiquidPedia, REST API digunakan untuk komunikasi antara aplikasi Flutter dan backend Laravel. Format data yang digunakan adalah JSON.

Prinsip REST yang diterapkan:
- **Stateless**: Setiap request berdiri sendiri, tidak ada session di server
- **Resource-based**: Setiap endpoint merepresentasikan resource (products, orders, dll)
- **HTTP Methods**: GET (membaca), POST (membuat), PUT (memperbarui), DELETE (menghapus)
- **JSON Response**: Format response standar dengan field `success`, `message`, `data`, `meta`

## 2.7 Leaflet.js & OpenStreetMap

Leaflet.js adalah library JavaScript open-source untuk peta interaktif. OpenStreetMap (OSM) adalah sumber data peta gratis dan terbuka. Kombinasi Leaflet.js + OSM menyediakan alternatif gratis untuk Google Maps.

Dalam LiquidPedia, Leaflet.js digunakan pada halaman checkout web dengan fitur:
- Pencarian alamat via Nominatim API (forward geocoding)
- Drag marker untuk memilih lokasi
- Reverse geocoding (menampilkan alamat dari koordinat)
- Deteksi lokasi otomatis via browser geolocation API

## 2.8 Flutter Map (flutter_map)

flutter_map adalah library Flutter yang menyediakan widget map terintegrasi dengan berbagai tile provider termasuk OpenStreetMap. flutter_map digunakan pada aplikasi mobile LiquidPedia untuk fitur location picker di halaman checkout dengan fitur:
- Tap pada peta untuk memindahkan marker
- Drag marker untuk menyesuaikan posisi
- Tombol pusatkan ke lokasi terpilih
- Input koordinat manual

## 2.9 Tailwind CSS

Tailwind CSS adalah utility-first CSS framework yang menyediakan class-class siap pakai untuk membangun antarmuka web tanpa menulis CSS kustom. Tailwind digunakan bersama Blade template engine untuk styling aplikasi web LiquidPedia dengan warna tema merah (#D84040) dan font Inter.

---

# BAB 3 — ANALISIS & PERANCANGAN

## 3.1 Analisis Sistem

### 3.1.1 Kebutuhan Fungsional

**Tabel 3.1 — Kebutuhan Fungsional**

| Kode FR | Nama Kebutuhan | Aktor | Platform |
|---------|---------------|-------|----------|
| FR-01 | Registrasi Akun | Customer | Web, Mobile |
| FR-02 | Login Akun | Customer | Web, Mobile |
| FR-03 | Melihat & Menyaring Produk | Customer | Web, Mobile |
| FR-04 | Melihat Detail Produk | Customer | Web, Mobile |
| FR-05 | Mencari Produk (Search) | Customer | Mobile |
| FR-06 | Mengelola Keranjang Belanja | Customer | Web, Mobile |
| FR-07 | Melakukan Checkout | Customer | Web, Mobile |
| FR-08 | Memilih Lokasi via Peta | Customer | Web, Mobile |
| FR-09 | Melihat Konfirmasi Pembayaran | Customer | Web, Mobile |
| FR-10 | Membatalkan Pesanan | Customer | Web, Mobile |
| FR-11 | Melihat Riwayat Pesanan | Customer | Web, Mobile |
| FR-12 | Login & Dashboard Admin | Admin | Web, Mobile |
| FR-13 | Mengelola Produk (CRUD) | Admin | Web, Mobile |
| FR-14 | Mengelola Kategori (CRUD) | Admin | Web, Mobile |
| FR-15 | Mengelola Pesanan (Update Status) | Admin | Web, Mobile |
| FR-16 | Melihat Statistik Dashboard | Admin | Web, Mobile |

### 3.1.2 Kebutuhan Non-Fungsional

**Tabel 3.2 — Kebutuhan Non-Fungsional**

| No | Kode NF | Kebutuhan | Kriteria |
|----|---------|-----------|----------|
| 1 | NFR-US-01 | Antarmuka responsif (desktop & mobile) | Usability |
| 2 | NFR-US-02 | Notifikasi sukses/error otomatis hilang | Usability |
| 3 | NFR-US-03 | Entry animations di mobile | Usability |
| 4 | NFR-SC-01 | Password di-hash bcrypt | Security |
| 5 | NFR-SC-02 | CSRF protection (web) | Security |
| 6 | NFR-SC-03 | Route checkout & profil protected | Security |
| 7 | NFR-SC-04 | Admin middleware (is_admin=true) | Security |
| 8 | NFR-SC-05 | API token authentication (Sanctum) | Security |
| 9 | NFR-SC-06 | Kepemilikan order diverifikasi | Security |
| 10 | NFR-SC-07 | Upload gambar tervalidasi (format & ukuran) | Security |
| 11 | NFR-PF-01 | Query dengan eager loading | Performance |
| 12 | NFR-PF-02 | Debounce pada search & geocoding | Performance |
| 13 | NFR-RL-01 | Foreign key constraints | Reliability |
| 14 | NFR-MT-01 | MVC architecture | Maintainability |
| 15 | NFR-MT-02 | Database migration versioning | Maintainability |
| 16 | NFR-PT-01 | Aplikasi dapat dijalankan di Windows/Linux | Portability |

### 3.1.3 Kebutuhan Perangkat Keras dan Lunak

**Server:**
| Komponen | Spesifikasi |
|----------|-------------|
| Sistem Operasi | Windows 10/11, Linux, macOS |
| PHP | ^8.3 |
| Database | MySQL 5.7+ / MariaDB 10.4+ |
| Web Server | Apache / Nginx / Built-in (`php artisan serve`) |
| RAM Minimal | 4 GB |
| Storage | 1 GB (tanpa gambar produk) |

**Client Web:**
| Komponen | Spesifikasi |
|----------|-------------|
| Browser | Chrome, Firefox, Edge, Safari (2 versi terbaru) |
| Internet | Diperlukan untuk OSM tiles & font CDN |

**Client Mobile:**
| Komponen | Spesifikasi |
|----------|-------------|
| Sistem Operasi | Android 8.0+ (API 26+) |
| RAM Minimal | 3 GB |
| Internet | Diperlukan untuk koneksi ke backend |

## 3.2 Perancangan Sistem

### 3.2.1 Arsitektur Sistem

LiquidPedia menggunakan arsitektur **Client-Server** dengan pola **MVC** (Model-View-Controller) pada backend dan **Provider pattern** pada mobile.

```
                          ┌──────────────────────┐
                          │     DATABASE          │
                          │    (MySQL)            │
                          └──────────┬───────────┘
                                     │
                          ┌──────────▼───────────┐
                          │     LARAVEL SERVER   │
                          │  ┌────────────────┐  │
                          │  │  Controllers   │  │
                          │  │ (Web + API)    │  │
                          │  ├────────────────┤  │
                          │  │  Eloquent ORM  │  │
                          │  ├────────────────┤  │
                          │  │  Blade Views   │  │
                          │  ├────────────────┤  │
                          │  │  REST API JSON │  │
                          │  └────────────────┘  │
                          └──────┬──────────┬───┘
                                 │          │
          ┌──────────────────┐   │          │   ┌──────────────────┐
          │   WEB BROWSER    │◄──┘          └──►│  FLUTTER APP     │
          │  (Blade + JS)    │                   │  (Mobile)        │
          │  - Tailwind CSS  │                   │  - Provider      │
          │  - Leaflet.js    │                   │  - flutter_map   │
          │  - Session Auth  │                   │  - Sanctum Token │
          └──────────────────┘                   └──────────────────┘
```

**Lapisan Arsitektur:**
| Lapisan | Teknologi | Fungsi |
|---------|-----------|--------|
| Presentation (Web) | Blade, Tailwind CSS, Leaflet.js | Tampilan antarmuka web |
| Presentation (Mobile) | Flutter Widgets, flutter_map | Tampilan antarmuka mobile |
| Application (API) | Laravel Controllers (Api/) | Logika bisnis untuk mobile |
| Application (Web) | Laravel Controllers (Web/) | Logika bisnis untuk web |
| Data | Eloquent ORM, MySQL | Penyimpanan & akses data |

### 3.2.2 Use Case Diagram

**Aktor:** Terdapat 2 aktor — **Customer** (Pelanggan) dan **Admin** (Pengelola Toko).

**Use Case Customer (FR-01 sampai FR-11):**
1. Registrasi Akun
2. Login Akun
3. Melihat & Menyaring Produk
4. Melihat Detail Produk
5. Mencari Produk (Mobile)
6. Mengelola Keranjang Belanja
7. Melakukan Checkout → include Login
8. Memilih Lokasi via Peta
9. Melihat Konfirmasi Pembayaran
10. Membatalkan Pesanan
11. Melihat Riwayat Pesanan

**Use Case Admin (FR-12 sampai FR-16):**
12. Login & Dashboard Admin
13. Mengelola Produk → include Login Admin
14. Mengelola Kategori → include Login Admin
15. Mengelola Pesanan → include Login Admin

### 3.2.3 Use Case Scenario

**UC-01: Registrasi Akun**

| Field | Isi |
|-------|-----|
| Nama | Registrasi Akun |
| Deskripsi | Customer mendaftarkan akun baru |
| Pre-Kondisi | Customer belum memiliki akun |
| Post-Kondisi | Akun baru terdaftar, customer login otomatis |
| Skenario Utama | 1. Buka halaman register<br>2. Isi nama, email, password, konfirmasi<br>3. Submit → validasi → create user → auto-login → redirect ke beranda |
| Skenario Alternatif | Validasi gagal (email sudah terdaftar, password < 8) → tampilkan error |

**UC-02: Login Akun**

| Field | Isi |
|-------|-----|
| Nama | Login Akun |
| Deskripsi | Customer yang sudah memiliki akun masuk ke sistem |
| Pre-Kondisi | Customer belum login |
| Post-Kondisi | Customer login, session/token dibuat |
| Skenario Utama | 1. Buka halaman login<br>2. Isi email & password<br>3. Submit → validasi → login → redirect |
| Skenario Alternatif | Email/password salah → tampilkan error |

**UC-03: Melihat & Menyaring Produk**

| Field | Isi |
|-------|-----|
| Nama | Melihat & Menyaring Produk |
| Deskripsi | Customer melihat katalog produk dengan filter kategori |
| Pre-Kondisi | Data produk tersedia |
| Post-Kondisi | Grid produk ditampilkan |
| Skenario Utama | 1. Buka halaman produk<br>2. Filter kategori (Vape/Liquid)<br>3. Grid produk diperbarui |
| Skenario Alternatif | Tidak ada produk → empty state |

**UC-04: Melihat Detail Produk**

| Field | Isi |
|-------|-----|
| Nama | Melihat Detail Produk |
| Deskripsi | Customer melihat informasi lengkap produk |
| Pre-Kondisi | Buka salah satu produk |
| Post-Kondisi | Halaman detail ditampilkan |
| Skenario Utama | Tampilkan: gambar, harga, deskripsi, badge status, info tabel, quantity selector, add to cart |

**UC-05: Mengelola Keranjang Belanja**

| Field | Isi |
|-------|-----|
| Nama | Mengelola Keranjang Belanja |
| Deskripsi | Customer menambah/mengubah/menghapus item di keranjang |
| Pre-Kondisi | Berada di halaman produk/keranjang |
| Post-Kondisi | Isi keranjang berubah |
| Skenario Utama | Tambah: pilih produk → set quantity → klik "Tambah ke Cart" |
| Skenario Alternatif | Quantity < 1 → hapus item |

**UC-06: Melakukan Checkout**

| Field | Isi |
|-------|-----|
| Nama | Melakukan Checkout |
| Deskripsi | Customer membuat pesanan dengan data pengiriman dan location picker |
| Pre-Kondisi | Customer login, keranjang tidak kosong |
| Post-Kondisi | Pesanan baru terbuat, keranjang dikosongkan |
| Skenario Utama | 1. Klik "Checkout"<br>2. Isi form data pengiriman<br>3. Pilih lokasi via peta (Leaflet / flutter_map)<br>4. Pilih metode bayar<br>5. Klik "Buat Pesanan"<br>6. Order + OrderItems dibuat<br>7. Cart dikosongkan<br>8. Redirect ke konfirmasi bayar |

**UC-07: Melihat Konfirmasi Pembayaran**

| Field | Isi |
|-------|-----|
| Nama | Melihat Konfirmasi Pembayaran |
| Deskripsi | Customer melihat instruksi pembayaran |
| Pre-Kondisi | Pesanan sudah dibuat |
| Post-Kondisi | Halaman instruksi bayar ditampilkan |
| Skenario Utama | Tampilkan nomor pesanan, status, item, total, alamat, instruksi bayar sesuai metode, tombol WA konfirmasi |

**UC-08: Login & Dashboard Admin**

| Field | Isi |
|-------|-----|
| Nama | Login & Dashboard Admin |
| Deskripsi | Admin login dan melihat dashboard statistik |
| Pre-Kondisi | Belum login, punya akun admin |
| Post-Kondisi | Admin di dashboard |
| Skenario Utama | 1. Buka login admin<br>2. Login → cek is_admin<br>3. Dashboard: total produk, kategori, best seller, new arrival |

**UC-09: Mengelola Produk (CRUD)**

| Field | Isi |
|-------|-----|
| Nama | Mengelola Produk |
| Deskripsi | Admin melakukan CRUD produk |
| Pre-Kondisi | Admin sudah login |
| Post-Kondisi | Data produk berubah |
| Skenario Utama | Create: form → upload gambar → store<br>Read: tabel daftar produk<br>Update: edit → simpan perubahan<br>Delete: konfirmasi → hapus produk + gambar |

**UC-10: Mengelola Kategori (CRUD)**

| Field | Isi |
|-------|-----|
| Nama | Mengelola Kategori |
| Deskripsi | Admin melakukan CRUD kategori |
| Pre-Kondisi | Admin sudah login |
| Post-Kondisi | Data kategori berubah |
| Skenario Utama | Create: input nama → auto-slug → store<br>Read: grid kategori + jumlah produk<br>Update: edit nama<br>Delete: cegah jika kategori memiliki produk |

### 3.2.4 Sequence Diagram

**Sequence Diagram — Registrasi Akun (UC-01)**

```
Customer → HalamanRegister : buka halaman register
HalamanRegister → AuthController : POST /register (data)
AuthController → AuthController : validasi input
alt validasi gagal
    AuthController → HalamanRegister : kembali dengan error
else validasi sukses
    AuthController → User : create (name, email, password)
    User → Database : INSERT INTO users
    AuthController → Auth : login(user)
    AuthController → HalamanBeranda : redirect ke beranda
end
```

**Sequence Diagram — Checkout & Location Picker (UC-06)**

```
Customer → HalamanCheckout : klik "Checkout"
HalamanCheckout → CartController : showCheckoutForm()
CartController → Session/Database : ambil cart
CartController → HalamanCheckout : tampilkan form + location picker
Customer → LeafletMap/flutter_map : pilih lokasi (click/drag/search)
LeafletMap → Nominatim API : reverse geocode (jika perlu)
LeafletMap → HalamanCheckout : return lat, lng, alamat
Customer → HalamanCheckout : pilih metode bayar
Customer → HalamanCheckout : klik "Buat Pesanan"
HalamanCheckout → CartController : POST /orders (data)
CartController → Order : create (order baru)
CartController → OrderItem : create untuk setiap item
CartController → Cart : hapus semua item
CartController → HalamanKonfirmasi : redirect ke konfirmasi bayar
```

**Sequence Diagram — Login & Dashboard Admin (UC-08)**

```
Admin → HalamanLoginAdmin : buka /admin/login
HalamanLoginAdmin → AdminAuthController : POST /admin/login (email, password)
AdminAuthController → Auth : attempt(credentials)
alt attempt gagal
    AdminAuthController → HalamanLoginAdmin : error "Email atau password salah"
else attempt sukses
    AdminAuthController → User : cek is_admin
    alt bukan admin
        AdminAuthController → Auth : logout()
        AdminAuthController → HalamanLoginAdmin : error "Tidak memiliki akses"
    else is_admin = true
        AdminAuthController → DashboardController : index()
        DashboardController → Product : count(), best_seller, new_arrival
        DashboardController → Category : withCount(products)
        DashboardController → HalamanDashboard : tampilkan statistik
    end
end
```

### 3.2.5 Class Diagram

**Entity Classes (Model):**

| Kelas | Atribut | Method |
|-------|---------|--------|
| **User** | -id, -name, -email, -password, -is_admin, -timestamps | +orders(): HasMany, +cartItems(): HasMany |
| **Category** | -id, -name, -slug, -timestamps | +products(): HasMany |
| **Product** | -id, -name, -description, -price, -category_id, -image, -is_best_seller, -is_new_arrival, -timestamps | +category(): BelongsTo, +getImageUrlAttribute(): string |
| **Order** | -id, -user_id, -order_number, -shipping_*, -payment_method, -payment_status, -total, -timestamps | +user(): BelongsTo, +items(): HasMany |
| **OrderItem** | -id, -order_id, -product_id, -product_name, -quantity, -price, -subtotal, -timestamps | +order(): BelongsTo, +product(): BelongsTo |
| **CartItem** | -id, -user_id, -product_id, -quantity, -timestamps | +user(): BelongsTo, +product(): BelongsTo |

**Controller Classes (Web):**
- HomeController: +index()
- ProductController: +index(), +show()
- CartController: +index(), +add(), +update(), +remove(), +showCheckoutForm(), +processOrder(), +showPaymentConfirmation()
- AuthController: +showLoginForm(), +login(), +showRegisterForm(), +register(), +logout(), +profile(), +orders()
- Admin\AuthController: +showLoginForm(), +login(), +logout()
- Admin\DashboardController: +index()
- Admin\ProductController: +index(), +create(), +store(), +edit(), +update(), +destroy()
- Admin\CategoryController: +index(), +create(), +store(), +edit(), +update(), +destroy()

**API Controller Classes (Mobile):**
- Api\AuthController: +register(), +login(), +logout(), +user()
- Api\ProductController: +index(), +home(), +show()
- Api\CategoryController: +index()
- Api\CartController: +index(), +add(), +update(), +remove()
- Api\OrderController: +index(), +show(), +store(), +cancel(), +paymentConfirmation()
- Api\Admin\DashboardController: +index()
- Api\Admin\ProductController: +index(), +store(), +update(), +destroy()
- Api\Admin\CategoryController: +index(), +store(), +update(), +destroy()
- Api\Admin\OrderController: +index(), +show(), +updatePaymentStatus()

**Flutter Classes (Mobile):**
- ApiConfig: +baseUrl, +apiPrefix, +timeout
- ApiService: +get(), +post(), +put(), +delete(), +postMultipart(), +putMultipart()
- AuthProvider: +user, +isLoggedIn, +isLoading, +login(), +register(), +logout(), +checkAuth()
- ProductProvider: +bestSellers, +newArrivals, +categories, +products, +loadHomeData(), +loadProducts(), +loadProductDetail()
- CartProvider: +items, +total, +totalItems, +loadCart(), +addToCart(), +updateQuantity(), +removeFromCart()
- OrderProvider: +orders, +selectedOrder, +loadOrders(), +createOrder(), +cancelOrder()
- AdminProvider: +dashboardStats, +loadDashboard(), +createProduct(), +updateProduct(), +deleteProduct(), +createCategory(), +updateCategory(), +deleteCategory(), +loadOrders(), +updatePaymentStatus()

## 3.3 Perancangan Data

### 3.3.1 Struktur Tabel Database

**Tabel 3.3 — Struktur Database**

| Tabel | Primary Key | Foreign Key | Kolom Penting |
|-------|-------------|-------------|---------------|
| users | id | - | name, email, password, is_admin |
| categories | id | - | name, slug (unique) |
| products | id | category_id → categories.id | name, price, image, is_best_seller, is_new_arrival |
| orders | id | user_id → users.id | order_number (unique), shipping_*, payment_method, payment_status, total |
| order_items | id | order_id → orders.id, product_id → products.id | product_name, quantity, price, subtotal |
| cart_items | id | user_id → users.id, product_id → products.id | quantity, unique(user_id, product_id) |

**Relasi Antar Tabel:**
- User → Order: one-to-many (satu user memiliki banyak order)
- Order → OrderItem: one-to-many (satu order memiliki banyak item)
- Product → OrderItem: one-to-many (satu produk muncul di banyak order item)
- User → CartItem: one-to-many (satu user memiliki banyak cart item)
- Product → CartItem: one-to-many (satu produk ada di banyak cart)
- Category → Product: one-to-many (satu kategori memiliki banyak produk)

**Order Number Format:** `INV/YYYYMMDD/RANDOM6` (contoh: `INV/20260628/A3B7C9`)

### 3.3.2 API Endpoint Design

**Tabel 3.4 — Daftar API Endpoint**

**Public Endpoints (tanpa token):**

| Method | Endpoint | Controller | Fungsi |
|--------|----------|------------|--------|
| GET | /api/products | Api\ProductController@index | List produk (pagination, filter kategori, search) |
| GET | /api/products/home | Api\ProductController@home | Data beranda (best seller, new arrival, kategori) |
| GET | /api/products/{id} | Api\ProductController@show | Detail produk |
| GET | /api/categories | Api\CategoryController@index | Semua kategori |
| POST | /api/auth/register | Api\AuthController@register | Registrasi |
| POST | /api/auth/login | Api\AuthController@login | Login |

**Protected Endpoints (Sanctum):**

| Method | Endpoint | Controller | Fungsi |
|--------|----------|------------|--------|
| POST | /api/auth/logout | Api\AuthController@logout | Hapus token |
| GET | /api/auth/user | Api\AuthController@user | Profil user |
| GET | /api/cart | Api\CartController@index | Lihat cart |
| POST | /api/cart/{product} | Api\CartController@add | Tambah ke cart |
| PUT | /api/cart/{product} | Api\CartController@update | Update quantity |
| DELETE | /api/cart/{product} | Api\CartController@remove | Hapus dari cart |
| GET | /api/orders | Api\OrderController@index | Riwayat pesanan |
| GET | /api/orders/{id} | Api\OrderController@show | Detail pesanan |
| POST | /api/orders | Api\OrderController@store | Buat pesanan |
| PUT | /api/orders/{id}/cancel | Api\OrderController@cancel | Batalkan pesanan |
| GET | /api/orders/{id}/payment | Api\OrderController@paymentConfirmation | Instruksi bayar |

**Admin Endpoints (Sanctum + is_admin check):**

| Method | Endpoint | Controller | Fungsi |
|--------|----------|------------|--------|
| GET | /api/admin/dashboard | Api\Admin\DashboardController@index | Statistik dashboard |
| GET | /api/admin/products | Api\Admin\ProductController@index | List produk (admin) |
| POST | /api/admin/products | Api\Admin\ProductController@store | Tambah produk |
| PUT | /api/admin/products/{id} | Api\Admin\ProductController@update | Edit produk |
| DELETE | /api/admin/products/{id} | Api\Admin\ProductController@destroy | Hapus produk |
| GET | /api/admin/categories | Api\Admin\CategoryController@index | List kategori |
| POST | /api/admin/categories | Api\Admin\CategoryController@store | Tambah kategori |
| PUT | /api/admin/categories/{id} | Api\Admin\CategoryController@update | Edit kategori |
| DELETE | /api/admin/categories/{id} | Api\Admin\CategoryController@destroy | Hapus kategori |
| GET | /api/admin/orders | Api\Admin\OrderController@index | List semua pesanan |
| GET | /api/admin/orders/{id} | Api\Admin\OrderController@show | Detail pesanan |
| PUT | /api/admin/orders/{id}/payment-status | Api\Admin\OrderController@updatePaymentStatus | Update status bayar |

**Format Response JSON:**
```json
{
    "success": true,
    "message": "Pesan (opsional)",
    "data": { ... },
    "meta": {
        "current_page": 1,
        "last_page": 5,
        "per_page": 10,
        "total": 50
    }
}
```

## 3.4 Perancangan Antarmuka

### 3.4.1 Struktur Navigasi Web

```
Web (Laravel Blade)
│
├── Guest
│   ├── / (Beranda)
│   ├── /products (Katalog Produk)
│   ├── /products/{id} (Detail Produk)
│   ├── /cart (Keranjang)
│   ├── /login
│   └── /register
│
├── Customer (login)
│   ├── /checkout
│   ├── /orders/{id}/payment-confirmation
│   ├── /profile
│   └── /orders (Riwayat Pesanan)
│
└── Admin (is_admin=true)
    ├── /admin/login
    ├── /admin (Dashboard)
    ├── /admin/products (CRUD)
    └── /admin/categories (CRUD)
```

### 3.4.2 Struktur Navigasi Mobile

```
Mobile (Flutter)
│
├── SplashScreen → checkAuth()
│   ├── Token valid → HomeScreen
│   └── Token tidak valid → LoginScreen
│
├── LoginScreen / RegisterScreen
│
├── HomeScreen (BottomNavigationBar)
│   ├── Beranda
│   │   ├── Hero Banner
│   │   ├── Category Cards
│   │   ├── Best Seller (horizontal)
│   │   └── New Arrivals (horizontal)
│   ├── Pesanan → OrderListScreen
│   └── Profil → ProfileScreen
│       └── (jika admin) → Admin Panel
│
├── ProductListScreen (search + grid)
├── ProductDetailScreen
├── CartScreen
├── CheckoutScreen (form + map + payment)
├── OrderListScreen (pagination + cancel)
├── OrderDetailScreen (payment info + copy)
│
└── Admin Section
    ├── AdminDashboardScreen
    ├── AdminProductListScreen
    ├── AdminProductFormScreen
    ├── AdminCategoryListScreen
    ├── AdminCategoryFormScreen
    ├── AdminOrderListScreen
    └── AdminOrderDetailScreen
```

### 3.4.3 Halaman Utama

**Web:**
| Halaman | URL | Deskripsi |
|---------|-----|-----------|
| Beranda | / | Hero, best seller (4), kategori, new arrival (4) |
| Katalog | /products | Grid produk + pill filter kategori |
| Detail | /products/{id} | Gambar, harga, info, quantity, add to cart |
| Cart | /cart | Item list, quantity +/- , total, checkout |
| Checkout | /checkout | Form + Leaflet map + metode bayar |
| Admin Login | /admin/login | Form login khusus admin |
| Admin Dashboard | /admin | Statistik, chart per kategori |
| Admin Produk | /admin/products | Tabel CRUD produk |
| Admin Kategori | /admin/categories | Grid CRUD kategori |

**Mobile:**
| Screen | Route | Deskripsi |
|--------|-------|-----------|
| Splash | / | Auto-login check |
| Login | /auth/login | Email, password |
| Register | /auth/register | Nama, email, password |
| Home | / | Hero, kategori, best seller, new arrival |
| Product List | /products | Grid 2 kolom + search bar |
| Product Detail | /products/{id} | Gambar, info table, quantity, add to cart |
| Cart | /cart | Item list, quantity, total, checkout |
| Checkout | /checkout | Form + flutter_map + metode bayar |
| Order List | /orders | Riwayat + cancel + petunjuk bayar |
| Order Detail | /orders/{id} | Informasi lengkap + payment instructions |
| Profile | /profile | User info, admin panel link, logout |
| Admin Dashboard | /admin | Stats grid, menu CRUD |
| Admin Products | /admin/products | List + search + FAB add |
| Admin Product Form | /admin/products/form | Create/edit dengan image picker |
| Admin Categories | /admin/categories | List + FAB add |
| Admin Category Form | /admin/categories/form | Create/edit |
| Admin Orders | /admin/orders | Filter status, list |
| Admin Order Detail | /admin/orders/{id} | Detail + update payment status |

## 3.5 Perancangan Algoritma

### Algoritma 1: Autentikasi (Login API)
```
Input: email, password
Output: token + user data

1. Validasi input (email required + email format, password required)
2. Attempt login dengan kredensial
3. Jika gagal:
   - Return 401 Unauthorized dengan pesan error
4. Jika sukses:
   a. Hapus token lama (jika ada)
   b. Buat token baru: user->createToken('mobile-app')->plainTextToken
   c. Return token + data user dalam format JSON
```

### Algoritma 2: Checkout (Web & Mobile)
```
Input: Data pengiriman, koordinat lokasi, metode bayar
Output: Order baru

1. Validasi input (semua field required, format valid)
2. Ambil data cart dari session (web) / database (mobile)
3. Jika cart kosong → return error "Cart masih kosong"
4. Generate order_number: INV/YYYYMMDD/STR_RANDOM(6)
5. Hitung total dari cart items
6. Buat Order baru dengan data + payment_status = 'pending'
7. Untuk setiap item di cart:
   - Buat OrderItem (snapshot nama, quantity, price, subtotal)
8. Hapus semua item dari cart
9. Return Order yang sudah dibuat
```

### Algoritma 3: Upload & Serving Gambar Produk
```
Upload:
1. Validasi file: image, max 2MB, format jpeg/png/jpg/gif/webp
2. Simpan file: file->store('products', 'public')
3. Simpan path (contoh: 'products/abc123.webp') ke kolom image di database

Serving:
1. Accessor getImageUrlAttribute():
   a. Jika image startsWith('http') → return image (URL eksternal)
   b. Jika tidak → Storage::disk('public')->url(image)
   c. Hasil: http://IP:8000/storage/products/abc123.webp
```

### Algoritma 4: Cancel Order
```
Input: Order ID
Output: Order dibatalkan

1. Cari Order berdasarkan ID
2. Validasi: order->user_id === current user (kepemilikan)
3. Validasi: order->payment_status === 'pending' (hanya pending bisa dicancel)
4. Update: order->payment_status = 'cancelled'
5. Simpan perubahan
6. Return sukses
```

### Algoritma 5: Search Produk dengan Debounce (Mobile)
```
Input: Query pencarian (string)
Output: Produk yang cocok

1. User mengetik di search bar
2. Debounce 500ms (tunggu user berhenti mengetik)
3. Jika query kosong → load semua produk
4. Jika query tidak kosong:
   a. Panggil API: GET /api/products?search={query}
   b. Server melakukan: Product::where('name', 'like', '%{query}%')->orWhere('description', 'like', '%{query}%')
   c. Return hasil pencarian
5. Update UI dengan hasil
```

---

# BAB 4 — IMPLEMENTASI

## 4.1 Lingkungan Implementasi

### 4.1.1 Spesifikasi Perangkat Pengembangan

| Perangkat | Spesifikasi |
|-----------|-------------|
| Sistem Operasi | Windows 11 |
| Prosesor | Intel Core i5 |
| RAM | 8 GB |
| Storage | SSD 256 GB |

### 4.1.2 Tools dan Framework

**Backend (Laravel):**
| Tools | Versi |
|-------|-------|
| PHP | 8.3+ |
| Laravel | ^13.8 |
| MySQL | 5.7+ |
| Composer | 2.x |
| Node.js | 18+ |
| NPM | 9+ |

**Frontend Web:**
| Tools | Deskripsi |
|-------|-----------|
| Blade | Template engine Laravel |
| Tailwind CSS v4 | Utility-first CSS |
| Vite | Asset bundler |
| Leaflet.js 1.x | Peta interaktif |
| Nominatim API | Geocoding |

**Mobile (Flutter):**
| Tools | Versi |
|-------|-------|
| Flutter | 3.41+ |
| Dart | 3.11+ |
| Provider | State management |
| Dio | HTTP Client |
| flutter_map | OpenStreetMap integration |
| cached_network_image | Image caching |
| flutter_secure_storage | Encrypted token storage |
| image_picker | Gallery image selection |

## 4.2 Implementasi Backend (Laravel)

### 4.2.1 Struktur Proyek

```
liquid/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Web admin controllers
│   │   │   ├── Api/
│   │   │   │   └── Admin/      # API admin controllers
│   │   │   ├── AuthController.php
│   │   │   ├── CartController.php
│   │   │   ├── HomeController.php
│   │   │   └── ProductController.php
│   │   ├── Middleware/
│   │   │   └── AdminMiddleware.php
│   │   └── Resources/
│   │       └── ProductResource.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Category.php
│   │   ├── Product.php
│   │   ├── Order.php
│   │   ├── OrderItem.php
│   │   └── CartItem.php
│   └── ...
├── bootstrap/app.php           # CORS + middleware config
├── config/
│   ├── cors.php                # CORS configuration
│   └── filesystems.php         # Storage disk config
├── database/
│   └── migrations/             # 6 migration files
├── resources/views/            # Blade templates
├── routes/
│   ├── web.php                 # Web routes
│   └── api.php                 # API routes (20 endpoint)
└── storage/app/public/products/ # Product images
```

### 4.2.2 Database & Migration

Terdapat 6 migration files yang mendefinisikan struktur tabel:

1. `create_users_table.php` — id, name, email, password, is_admin, timestamps
2. `create_categories_table.php` — id, name, slug (unique), timestamps
3. `create_products_table.php` — id, name, description, price (decimal 12,2), category_id (FK), image, is_best_seller, is_new_arrival, timestamps
4. `create_orders_table.php` — id, user_id (FK), order_number (unique), shipping_*, payment_method, payment_status, total (decimal 12,2), timestamps
5. `create_order_items_table.php` — id, order_id (FK), product_id (FK), product_name (snapshot), quantity, price, subtotal, timestamps
6. `create_cart_items_table.php` — id, user_id (FK), product_id (FK), quantity, unique(user_id, product_id), timestamps

### 4.2.3 Model & Relasi

**Product.php** — Menampilkan accessor untuk image URL:
```php
public function getImageUrlAttribute(): string
{
    if (Str::startsWith($this->image, 'http')) {
        return $this->image;
    }
    return Storage::disk('public')->url($this->image);
}
```

**Order.php** — Menampilkan accessor untuk label status dan metode bayar:
```php
public function getPaymentStatusLabelAttribute(): string
{
    return match($this->payment_status) {
        'pending' => 'Menunggu Pembayaran',
        'paid' => 'Lunas',
        'cancelled' => 'Dibatalkan',
        default => $this->payment_status,
    };
}
```

### 4.2.4 Controller (Web + API)

**Kategori Controller:**
- **Web**: HomeController (beranda), ProductController (katalog & detail), CartController (keranjang + checkout), AuthController (auth + profil + orders)
- **Admin Web**: AdminAuthController, AdminDashboardController, AdminProductController, AdminCategoryController
- **API**: Api\AuthController, Api\ProductController, Api\CategoryController, Api\CartController, Api\OrderController
- **API Admin**: Api\Admin\DashboardController, Api\Admin\ProductController, Api\Admin\CategoryController, Api\Admin\OrderController

### 4.2.5 API Resource

**ProductResource.php** — Menformat response produk:
```php
return [
    'id' => $this->id,
    'name' => $this->name,
    'price' => (float) $this->price,
    'price_formatted' => 'Rp' . number_format($this->price, 0, ',', '.'),
    'image_url' => $this->image_url,  // via accessor
    'category' => [
        'id' => $this->category->id,
        'name' => $this->category->name,
    ],
    'is_best_seller' => (bool) $this->is_best_seller,
    'is_new_arrival' => (bool) $this->is_new_arrival,
    // ...
];
```

**OrderResource.php** — Menformat response pesanan, dengan cast shipping_latitude/longitude ke string.

### 4.2.6 Middleware & CORS

**AdminMiddleware:**
```php
public function handle(Request $request, Closure $next): mixed
{
    if (Auth::check() && Auth::user()->is_admin) {
        return $next($request);
    }
    return redirect('/admin/login');
}
```

**CORS Configuration** (`bootstrap/app.php`):
```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->api(prepend: [
        \Illuminate\Http\Middleware\HandleCors::class,
    ]);
})
```

**config/cors.php:**
```php
return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['*'],
    'allowed_headers' => ['*'],
    'supports_credentials' => true,
];
```

### 4.2.7 Routes

**routes/web.php** — 18 route (publik, customer, admin)
**routes/api.php** — 20 route (publik, sanctum, admin)

## 4.3 Implementasi Frontend Web (Blade)

### 4.3.1 Struktur View

```
resources/views/
├── layouts/app.blade.php           # Layout utama customer
├── home.blade.php                  # Beranda
├── products.blade.php              # Katalog produk
├── product-detail.blade.php        # Detail produk
├── cart.blade.php                  # Keranjang
├── checkout.blade.php              # Checkout + Leaflet map
├── checkout/payment-confirmation.blade.php
├── orders.blade.php                # Riwayat pesanan
├── profile.blade.php               # Profil
├── auth/login.blade.php
├── auth/register.blade.php
├── 404.blade.php
├── components/location-picker.blade.php  # Leaflet component
└── admin/
    ├── layouts/app.blade.php       # Layout admin
    ├── login.blade.php
    ├── dashboard.blade.php
    ├── products/index.blade.php
    ├── products/create.blade.php
    ├── products/edit.blade.php
    └── categories/index.blade.php
    └── categories/create.blade.php
    └── categories/edit.blade.php
```

### 4.3.2 Halaman Customer

**Beranda (`home.blade.php`):**
- Hero section dengan background gradien merah dan tagline promosi
- 4 produk Best Seller dalam grid (gambar, kategori badge, harga, nama)
- 2 kartu kategori (Vape & Liquid) dengan link filter
- Banner promosi
- 4 produk New Arrival dengan badge "BARU"
- Animasi hover dan transisi CSS

**Katalog Produk (`products.blade.php`):**
- Grid produk responsif (1-4 kolom tergantung layar)
- Pill filter kategori (Semua, Vape, Liquid)
- Search produk
- Tombol "Tambah ke Cart" langsung dari grid
- Empty state jika produk tidak ditemukan

**Detail Produk (`product-detail.blade.php`):**
- Breadcrumb navigasi
- Gambar produk dengan efek hover zoom
- Badge kategori, Best Seller, New Arrival
- Harga dengan format Rp
- Quantity selector (+/-)
- Tombol "Tambah ke Cart"
- Tabel info produk (Kategori, Status Stok, Garansi)

**Keranjang (`cart.blade.php`):**
- Cart berbasis session
- Item list: gambar, nama, kategori, harga, quantity +/- , subtotal
- Tombol hapus (X)
- Ringkasan pesanan (subtotal per item, grand total)
- Tombol "Checkout"

**Checkout (`checkout.blade.php`):**
- Form data pengiriman (9 field)
- Location Picker interaktif (Leaflet.js + OpenStreetMap)
- Radio button metode bayar (Transfer Bank, E-Wallet, QRIS, COD)
- Ringkasan pesanan + grand total
- Tombol "Buat Pesanan"

**Location Picker Component (`components/location-picker.blade.php`):**
- Preview lokasi (alamat, koordinat, link Google Maps)
- Tombol "Pilih Lokasi" → modal peta interaktif
- Modal: search bar (Nominatim API, debounce 300ms)
- Peta Leaflet dengan marker draggable
- Reverse geocoding (klik/drag map → tampilkan alamat)
- Tombol "Gunakan Lokasi Saya" (browser geolocation)
- Tombol "Simpan Lokasi"

**Konfirmasi Pembayaran (`checkout/payment-confirmation.blade.php`):**
- Nomor pesanan (format INV/YYYYMMDD/RANDOM6)
- Status badge (pending/paid/cancelled)
- Daftar item dipesan
- Total pembayaran
- Instruksi bayar sesuai metode:
  - Transfer Bank: 4 rekening (BCA, Mandiri, BRI, BNI) + tombol copy
  - E-Wallet: 3 provider (GoPay, OVO, Dana) + nomor tujuan
  - QRIS: gambar QR Code
  - COD: informasi bayar di tempat
- Tombol WhatsApp konfirmasi (pre-filled nomor pesanan)

### 4.3.3 Halaman Admin

**Dashboard (`admin/dashboard.blade.php`):**
- 4 kartu statistik: Total Produk, Total Kategori, Best Seller, New Arrival
- Bar chart "Produk per Kategori" (lebar proporsional)

**Manajemen Produk (`admin/products/`):**
- `index.blade.php`: Tabel daftar produk (thumbnail, nama, kategori badge, harga, status badge, edit/hapus)
- `create.blade.php`: Form (nama, deskripsi, harga, kategori dropdown, upload gambar, is_best_seller switch, is_new_arrival switch)
- `edit.blade.php`: Form pre-filled + preview gambar

**Manajemen Kategori (`admin/categories/`):**
- `index.blade.php`: Grid kategori (icon, nama, jumlah produk, edit/hapus)
- `create.blade.php`: Form nama kategori
- `edit.blade.php`: Form edit nama kategori

## 4.4 Implementasi Aplikasi Mobile (Flutter)

### 4.4.1 Struktur Proyek

```
Mobile_liquid/lib/
├── main.dart                              # Entry point + MultiProvider
├── config/
│   ├── api_config.dart                    # Base URL API
│   ├── theme.dart                         # Tema LiquidPedia
│   └── routes.dart                        # Route constants
├── services/
│   └── api_service.dart                   # Dio HTTP + Token Interceptor
├── models/
│   ├── user.dart                          # User model
│   ├── product.dart                       # Product model
│   ├── category.dart                      # Category model (import hide)
│   ├── cart_item.dart                     # CartItem model
│   ├── order.dart                         # Order model
│   ├── order_item.dart                    # OrderItem model
│   └── dashboard_stats.dart               # DashboardStats model
├── repositories/
│   ├── auth_repository.dart               # Auth API calls
│   ├── product_repository.dart            # Product API calls
│   ├── cart_repository.dart               # Cart API calls
│   ├── order_repository.dart              # Order API calls
│   └── admin_repository.dart              # Admin API calls
├── providers/
│   ├── auth_provider.dart                 # Auth state management
│   ├── product_provider.dart              # Product state management
│   ├── cart_provider.dart                 # Cart state management
│   ├── order_provider.dart                # Order state management
│   └── admin_provider.dart                # Admin state management
├── views/
│   ├── splash_screen.dart                 # Splash + auto-login
│   ├── auth/
│   │   ├── login_screen.dart              # Login form
│   │   └── register_screen.dart           # Register form
│   ├── home/
│   │   └── home_screen.dart               # Beranda + bottom nav
│   ├── products/
│   │   ├── product_list_screen.dart       # Grid + search
│   │   └── product_detail_screen.dart     # Detail + add to cart
│   ├── cart/
│   │   └── cart_screen.dart               # Cart management
│   ├── checkout/
│   │   └── checkout_screen.dart           # Checkout form + map
│   ├── orders/
│   │   ├── order_list_screen.dart         # Riwayat pesanan
│   │   └── order_detail_screen.dart       # Detail pesanan
│   ├── profile/
│   │   └── profile_screen.dart            # Profil + admin link
│   └── admin/
│       ├── dashboard_screen.dart          # Admin dashboard
│       ├── product_list_screen.dart       # Admin product list
│       ├── product_form_screen.dart       # Admin product form
│       ├── category_list_screen.dart      # Admin category list
│       ├── category_form_screen.dart      # Admin category form
│       ├── order_list_screen.dart         # Admin order list
│       └── order_detail_screen.dart       # Admin order detail
└── widgets/
    ├── product_card.dart                  # Product card with badges
    ├── loading_widget.dart                # Loading indicator
    ├── location_picker.dart               # flutter_map widget
    └── payment_method_picker.dart         # Payment method selector
```

### 4.4.2 Konfigurasi API & Dio Service

**ApiConfig:**
```dart
class ApiConfig {
  static const String baseUrl = 'http://192.168.0.110:8000';
  static const String apiPrefix = '/api/';
  static const Duration timeout = Duration(seconds: 30);
}
```

**ApiService (Dio + Interceptor):**
```dart
class ApiService {
  late final Dio _dio;
  final FlutterSecureStorage _storage = const FlutterSecureStorage();

  ApiService() {
    _dio = Dio(BaseOptions(
      baseUrl: '${ApiConfig.baseUrl}${ApiConfig.apiPrefix}',
      connectTimeout: ApiConfig.timeout,
      receiveTimeout: ApiConfig.timeout,
      headers: {'Accept': 'application/json'},
    ));

    _dio.interceptors.add(InterceptorsWrapper(
      onRequest: (options, handler) async {
        final token = await _storage.read(key: 'auth_token');
        if (token != null) {
          options.headers['Authorization'] = 'Bearer $token';
        }
        handler.next(options);
      },
      onError: (error, handler) {
        if (error.response?.statusCode == 401) {
          // Token expired → force logout
        }
        handler.next(error);
      },
    ));
  }

  // GET, POST, PUT, DELETE, postMultipart, putMultipart
  Future<Response> get(String path, {Map<String, dynamic>? params});
  Future<Response> post(String path, {dynamic data});
  Future<Response> postMultipart(String path, {required FormData formData});
  // ...
}
```

### 4.4.3 Model

**Product Model:**
```dart
class Product {
  final int id;
  final String name;
  final String description;
  final double price;
  final String priceFormatted;
  final String imageUrl;
  final Category category;
  final bool isBestSeller;
  final bool isNewArrival;

  Product.fromJson(Map<String, dynamic> json)
      : id = json['id'] as int,
        name = json['name'] as String,
        imageUrl = json['image_url'] as String,
        price = (json['price'] as num).toDouble(),
        // ...
}
```

### 4.4.4 State Management (Provider)

**MultiProvider Setup (main.dart):**
```dart
void main() {
  runApp(
    MultiProvider(
      providers: [
        ChangeNotifierProvider(create: (_) => AuthProvider(AuthRepository(apiService))),
        ChangeNotifierProvider(create: (_) => ProductProvider(ProductRepository(apiService))),
        ChangeNotifierProvider(create: (_) => CartProvider(CartRepository(apiService))),
        ChangeNotifierProvider(create: (_) => OrderProvider(OrderRepository(apiService))),
        ChangeNotifierProvider(create: (_) => AdminProvider(AdminRepository(apiService))),
      ],
      child: const LiquidApp(),
    ),
  );
}
```

### 4.4.5 Halaman Customer Mobile

**HomeScreen:**
- BottomNavigationBar (Beranda, Pesanan, Profil)
- AppBar dengan logo + cart badge (real-time dari CartProvider.totalItems)
- Hero banner gradien merah
- Category cards horizontal
- Best Seller horizontal row (ProductCard)
- Promo banner
- New Arrivals horizontal row (ProductCard)
- Entry animations (AnimatedOpacity + SlideTransition)

**ProductListScreen:**
- Search bar dengan debounce 500ms
- GridView 2 kolom dengan ProductCard
- Infinite scroll pagination
- Pull-to-refresh

**ProductDetailScreen:**
- Gambar produk full-width
- Nama, harga, badge kategori/best seller/new arrival
- Info table (Kategori, Status, Garansi) dengan icon
- Deskripsi
- Quantity selector (+/-)
- Tombol "Add to Cart" dengan snackbar

**CartScreen:**
- Item list: gambar, nama, price, quantity +/- , subtotal
- Delete button per item
- "Lanjut Belanja" link
- Bottom bar: total harga + checkout button

**CheckoutScreen:**
- Form data pengiriman (9 field)
- LocationPicker (flutter_map + OpenStreetMap)
- PaymentMethodPicker (Transfer Bank, E-Wallet, QRIS, COD)
- Order summary
- Create Order button
- Error handling pesan asli dari API

**OrderListScreen:**
- Order cards (nomor, tanggal, total, status badge)
- Button "Petunjuk" untuk pending orders
- Button "Batalkan" dengan konfirmasi dialog
- Infinite scroll pagination

**OrderDetailScreen:**
- Sukses banner (jika dari checkout)
- Order number, status badge
- Informasi pengiriman
- Item list
- Total pembayaran
- Payment instructions dengan copy-to-clipboard
- Tombol WhatsApp konfirmasi

### 4.4.6 Halaman Admin Mobile

**AdminDashboardScreen:**
- Grid statistik (Total Produk, Kategori, Pesanan Menunggu, Pesanan Lunas)
- List produk per kategori
- Menu: Manage Products, Manage Categories, Manage Orders

**AdminProductListScreen:**
- Search bar
- Product list (image, name, price, category, badges)
- Tap to edit
- Delete with confirmation
- FAB untuk add product

**AdminProductFormScreen:**
- Image picker (gallery)
- Name, description, price, category dropdown
- Best seller switch, new arrival switch
- Create / Edit mode

**AdminCategoryListScreen:**
- Category list with product count
- Delete with confirmation (dicegah jika kategori memiliki produk)
- FAB untuk add category

**AdminCategoryFormScreen:**
- Name field
- Create / Edit mode

**AdminOrderListScreen:**
- Filter chips (Semua, Menunggu, Lunas, Dibatalkan)
- Order list (nomor, customer, tanggal, total, status)

**AdminOrderDetailScreen:**
- Order number, status, customer info
- Shipping address + coordinates
- Items list
- Payment info
- Actions: "Tandai Lunas" / "Batalkan Pesanan"

## 4.5 Integrasi Web & Mobile

### 4.5.1 Alur Autentikasi (Sanctum Token)

1. **Register/Login (Mobile):**
   - POST /api/auth/register atau /api/auth/login
   - Server membuat token baru via `$user->createToken('mobile-app')`
   - Response: `{ user: {...}, token: "1|abc123..." }`
   - Flutter menyimpan token di `FlutterSecureStorage`

2. **Setiap Request:**
   - Dio interceptor membaca token dari secure storage
   - Menambahkan header `Authorization: Bearer <token>`
   - Server memvalidasi via middleware `auth:sanctum`

3. **Auto-Login (Splash Screen):**
   - Cek token di storage
   - Panggil GET /api/auth/user untuk validasi
   - Jika 200 → navigasi ke Home
   - Jika 401 → hapus token → navigasi ke Login

4. **Logout:**
   - POST /api/auth/logout → revoke current token
   - Hapus token dari storage lokal

### 4.5.2 Alur API Request

```
Flutter App → Dio HTTP Client → API Endpoint (Laravel)
  ├── Request: GET /api/products
  ├── Headers: Authorization Bearer <token> (jika perlu)
  ├── Response: JSON format standar
  └── Error: DioException dengan pesan asli dari API
```

### 4.5.3 Upload & Serving Gambar Produk

**Upload (dari Web atau Mobile):**
1. File gambar dikirim via multipart form dengan field name `image`
2. Laravel menyimpan file ke `storage/app/public/products/` via `$request->file('image')->store('products', 'public')`
3. Path yang disimpan di database: `products/hash.webp`
4. Symlink: `public/storage` → `storage/app/public` (via `php artisan storage:link`)

**Serving (ke Web dan Mobile):**
1. Model accessor: `Storage::disk('public')->url($this->image)`
2. Menghasilkan URL: `http://IP:8000/storage/products/hash.webp`
3. Web: `<img src="{{ $product->image_url }}">`
4. Mobile: `Image.network(product.imageUrl)` atau `CachedNetworkImage(imageUrl: product.imageUrl)`

**Fix untuk akses dari HP:** `APP_URL` di `.env` harus diset ke IP laptop (misal `http://192.168.0.110:8000`) agar gambar bisa diakses dari perangkat lain di jaringan yang sama.

### 4.5.4 CORS Configuration

Karena Flutter membuat request dari origin yang berbeda, CORS dikonfigurasi untuk mengizinkan semua origin (development):

```php
'allowed_origins' => ['*'],
'allowed_methods' => ['*'],
'allowed_headers' => ['*'],
```

Middleware `HandleCors` ditambahkan ke grup middleware API di `bootstrap/app.php`.

---

# BAB 5 — PENGUJIAN

## 5.1 Skenario Pengujian

Pengujian dilakukan menggunakan metode **black-box testing** dengan skenario berdasarkan kebutuhan fungsional yang telah didefinisikan. Setiap fitur diuji pada platform web dan mobile untuk memastikan konsistensi fungsionalitas.

## 5.2 Hasil Pengujian Web

**Tabel 5.1 — Hasil Pengujian Web**

| No | Fitur | Skenario | Hasil |
|----|-------|----------|-------|
| 1 | Registrasi | Mendaftar dengan data valid | Berhasil |
| 2 | Registrasi | Mendaftar dengan email sudah terdaftar | Gagal (error validasi) |
| 3 | Login | Login dengan kredensial valid | Berhasil |
| 4 | Login | Login dengan password salah | Gagal (error) |
| 5 | Beranda | Menampilkan hero, best seller, kategori, new arrival | Berhasil |
| 6 | Katalog Produk | Menampilkan grid produk | Berhasil |
| 7 | Filter Kategori | Filter produk berdasarkan kategori (Vape/Liquid) | Berhasil |
| 8 | Detail Produk | Menampilkan info lengkap + quantity selector | Berhasil |
| 9 | Tambah ke Cart | Menambahkan produk ke cart | Berhasil |
| 10 | Cart | Mengubah quantity, menghapus item | Berhasil |
| 11 | Checkout | Mengisi form + pilih lokasi + metode bayar | Berhasil |
| 12 | Location Picker | Search alamat, drag marker, reverse geocode | Berhasil |
| 13 | Buat Pesanan | Checkout dengan data valid | Berhasil |
| 14 | Konfirmasi Bayar | Menampilkan instruksi sesuai metode bayar | Berhasil |
| 15 | Riwayat Pesanan | Menampilkan daftar pesanan user | Berhasil |
| 16 | Login Admin | Login dengan akun admin | Berhasil |
| 17 | Dashboard Admin | Menampilkan statistik | Berhasil |
| 18 | CRUD Produk | Menambah, mengedit, menghapus produk | Berhasil |
| 19 | CRUD Kategori | Menambah, mengedit, menghapus kategori | Berhasil |

## 5.3 Hasil Pengujian Mobile

**Tabel 5.2 — Hasil Pengujian Mobile**

| No | Fitur | Skenario | Hasil |
|----|-------|----------|-------|
| 1 | Auto-Login | Splash screen cek token valid | Berhasil |
| 2 | Login | Login dengan kredensial valid | Berhasil |
| 3 | Register | Mendaftar akun baru | Berhasil |
| 4 | Home | Hero, kategori, best seller, new arrival, animasi | Berhasil |
| 5 | Cart Badge | Badge real-time mengikuti jumlah cart | Berhasil |
| 6 | Search Produk | Search dengan debounce 500ms | Berhasil |
| 7 | Detail Produk | Info table, quantity, add to cart | Berhasil |
| 8 | Cart | Quantity +/- , delete, total | Berhasil |
| 9 | Checkout | Form + map + metode bayar | Berhasil |
| 10 | Location Picker | flutter_map, tap, drag marker | Berhasil |
| 11 | Buat Pesanan | Checkout sukses | Berhasil |
| 12 | Cancel Order | Batalkan pesanan pending | Berhasil |
| 13 | Copy Payment | Copy nomor rekening/e-wallet ke clipboard | Berhasil |
| 14 | Order History | List order, pagination, filter status | Berhasil |
| 15 | Admin Dashboard | Statistik, menu CRUD | Berhasil |
| 16 | Admin Produk | CRUD + upload gambar | Berhasil |
| 17 | Admin Kategori | CRUD + proteksi delete | Berhasil |
| 18 | Admin Order | List, filter, update status bayar | Berhasil |
| 19 | Logout | Hapus token, redirect ke login | Berhasil |
| 20 | Gambar Produk | Load gambar from storage (via IP) | Berhasil |

## 5.4 Hasil Pengujian API

**Tabel 5.3 — Hasil Pengujian API**

| No | Method | Endpoint | Status Code | Hasil |
|----|--------|----------|-------------|-------|
| 1 | POST | /api/auth/register | 200 | Berhasil |
| 2 | POST | /api/auth/login | 200 | Berhasil |
| 3 | POST | /api/auth/logout | 200 | Berhasil |
| 4 | GET | /api/auth/user | 200 | Berhasil |
| 5 | GET | /api/products | 200 | Berhasil |
| 6 | GET | /api/products/home | 200 | Berhasil |
| 7 | GET | /api/products/{id} | 200 | Berhasil |
| 8 | GET | /api/categories | 200 | Berhasil |
| 9 | GET | /api/cart | 200 | Berhasil |
| 10 | POST | /api/cart/{product} | 200 | Berhasil |
| 11 | PUT | /api/cart/{product} | 200 | Berhasil |
| 12 | DELETE | /api/cart/{product} | 200 | Berhasil |
| 13 | POST | /api/orders | 200 | Berhasil |
| 14 | GET | /api/orders | 200 | Berhasil |
| 15 | GET | /api/orders/{id} | 200 | Berhasil |
| 16 | PUT | /api/orders/{id}/cancel | 200 | Berhasil |
| 17 | GET | /api/orders/{id}/payment | 200 | Berhasil |
| 18 | GET | /api/admin/dashboard | 200 | Berhasil |
| 19 | POST | /api/admin/products | 200 | Berhasil |
| 20 | PUT | /api/admin/products/{id} | 200 | Berhasil |
| 21 | DELETE | /api/admin/products/{id} | 200 | Berhasil |
| 22 | POST | /api/admin/categories | 200 | Berhasil |
| 23 | PUT | /api/admin/categories/{id} | 200 | Berhasil |
| 24 | DELETE | /api/admin/categories/{id} | 200 | Berhasil |
| 25 | GET | /api/admin/orders | 200 | Berhasil |
| 26 | GET | /api/admin/orders/{id} | 200 | Berhasil |
| 27 | PUT | /api/admin/orders/{id}/payment-status | 200 | Berhasil |

## 5.5 Analisis Hasil Pengujian

Berdasarkan hasil pengujian, seluruh fitur fungsional pada aplikasi web dan mobile berjalan sesuai dengan yang diharapkan. API endpoints berfungsi dengan baik dengan response format JSON yang konsisten.

Beberapa temuan selama pengujian:
1. **Gambar produk tidak muncul di mobile** — disebabkan oleh `Storage::url()` yang mengembalikan relative path. Solusi: diganti dengan `Storage::disk('public')->url()` untuk menghasilkan full URL.
2. **Right overflow di OrderDetailScreen** — nomor order panjang melebihi lebar layar. Solusi: dibungkus `Expanded` + `TextOverflow.ellipsis`.
3. **Gesture conflict di flutter_map** — scroll map bentrok dengan scroll halaman. Solusi: bungkus `FlutterMap` dengan `GestureDetector(onVerticalDragUpdate)` + atur `InteractionOptions`.
4. **Dua server PHP bentrok** — jika port 8000 sudah dipakai oleh instance sebelumnya. Solusi: matikan semua proses PHP (`Stop-Process -Name php`) lalu start ulang.

---

# BAB 6 — PENUTUP

## 6.1 Kesimpulan

Berdasarkan hasil analisis, perancangan, implementasi, dan pengujian yang telah dilakukan, dapat disimpulkan:

1. LiquidPedia berhasil diimplementasikan sebagai platform e-commerce khusus liquid dan vape dalam dua platform: aplikasi web (Laravel + Blade + Tailwind CSS) dan aplikasi mobile (Flutter + Provider + Dio).

2. Integrasi antara aplikasi mobile dengan backend Laravel berjalan dengan baik menggunakan REST API yang dilindungi Laravel Sanctum dengan format response JSON yang konsisten.

3. Fitur location picker berhasil diimplementasikan pada kedua platform menggunakan Leaflet.js (web) dan flutter_map (mobile) dengan OpenStreetMap sebagai penyedia peta, Nominatim API untuk geocoding, dan marker interaktif.

4. Panel administrasi berhasil diimplementasikan pada web (Blade) dan mobile (Flutter) mencakup dashboard statistik, CRUD produk, CRUD kategori, dan manajemen pesanan.

5. Aplikasi web menggunakan session-based authentication, sedangkan aplikasi mobile menggunakan token-based authentication dengan Sanctum. Cart di web berbasis session sementara di mobile berbasis database.

## 6.2 Saran

Untuk pengembangan lebih lanjut, beberapa saran yang dapat diberikan:

1. **Integrasi Payment Gateway** — Menggunakan layanan seperti Midtrans, Xendit, atau Tripay untuk proses pembayaran otomatis.

2. **Notifikasi Push** — Menambahkan notifikasi Firebase Cloud Messaging (FCM) untuk memberi tahu user tentang status pesanan.

3. **Fitur Review & Rating** — Memungkinkan customer memberikan ulasan pada produk yang telah dibeli.

4. **Fitur Wishlist** — Memungkinkan customer menyimpan produk favorit untuk dibeli nanti.

5. **Sistem Ekspedisi/Resi** — Integrasi dengan API ekspedisi untuk pelacakan pengiriman otomatis.

6. **Multibahasa** — Menambahkan dukungan bahasa Inggris selain bahasa Indonesia.

7. **Versi iOS** — Mengembangkan aplikasi mobile untuk platform iOS.

8. **Testing Otomatis** — Menambahkan unit test dan integration test untuk meningkatkan kualitas kode.

9. **Deployment Production** — Menggunakan web server (Nginx/Apache) dan mengaktifkan HTTPS.

---

# DAFTAR PUSTAKA

1. Laravel Documentation. (2025). Laravel 13.x Documentation. https://laravel.com/docs/13.x
2. Flutter Documentation. (2025). Flutter SDK Documentation. https://docs.flutter.dev
3. Dart Documentation. (2025). Dart Programming Language. https://dart.dev/guides
4. MySQL Documentation. (2025). MySQL 5.7 Reference Manual. https://dev.mysql.com/doc/refman/5.7/en/
5. Tailwind CSS Documentation. (2025). Tailwind CSS v4. https://tailwindcss.com/docs
6. Leaflet.js Documentation. (2025). Leaflet - a JavaScript library for interactive maps. https://leafletjs.com/reference.html
7. OpenStreetMap Contributors. (2025). OpenStreetMap. https://www.openstreetmap.org/
8. Nominatim Documentation. (2025). Nominatim Usage Policy. https://operations.osmfoundation.org/policies/nominatim/
9. flutter_map Documentation. (2025). flutter_map - OpenStreetMap package for Flutter. https://docs.fleaflet.dev/
10. Provider Package. (2025). provider - State management for Flutter. https://pub.dev/packages/provider
11. Dio Package. (2025). Dio - HTTP client for Dart. https://pub.dev/packages/dio
12. Laravel Sanctum. (2025). Laravel Sanctum Documentation. https://laravel.com/docs/13.x/sanctum
13. Bassil, Y. (2012). A Simulation Model for the Waterfall Software Development Life Cycle. International Journal of Engineering & Technology, 2(5), 2049-3444.
14. Fielding, R. T. (2000). Architectural Styles and the Design of Network-based Software Architectures (Doctoral dissertation). University of California, Irvine.

---

# LAMPIRAN

## A. Kode Program Penting

### A.1 Product Model Accessor (Product.php)
```php
public function getImageUrlAttribute(): string
{
    if (Str::startsWith($this->image, 'http')) {
        return $this->image;
    }
    return Storage::disk('public')->url($this->image);
}
```

### A.2 Cancel Order API (OrderController.php)
```php
public function cancel(Request $request, Order $order)
{
    if ($order->user_id !== $request->user()->id) {
        return response()->json([
            'success' => false,
            'message' => 'Order bukan milik anda',
        ], 403);
    }
    if ($order->payment_status !== 'pending') {
        return response()->json([
            'success' => false,
            'message' => 'Hanya order dengan status pending yang bisa dibatalkan',
        ], 400);
    }
    $order->update(['payment_status' => 'cancelled']);
    return response()->json([
        'success' => true,
        'message' => 'Pesanan berhasil dibatalkan',
        'data' => new OrderResource($order),
    ]);
}
```

### A.3 Dio Service dengan Token Interceptor (api_service.dart)
```dart
class ApiService {
  late final Dio _dio;
  final FlutterSecureStorage _storage = const FlutterSecureStorage();

  ApiService() {
    _dio = Dio(BaseOptions(
      baseUrl: '${ApiConfig.baseUrl}${ApiConfig.apiPrefix}',
      connectTimeout: ApiConfig.timeout,
      receiveTimeout: ApiConfig.timeout,
      headers: {'Accept': 'application/json'},
    ));
    _dio.interceptors.add(InterceptorsWrapper(
      onRequest: (options, handler) async {
        final token = await _storage.read(key: 'auth_token');
        if (token != null) {
          options.headers['Authorization'] = 'Bearer $token';
        }
        handler.next(options);
      },
    ));
  }
}
```

### A.4 Search dengan Debounce (product_list_screen.dart)
```dart
SearchController _searchController = SearchController();
Timer? _debounce;

void _onSearchChanged(String query) {
  _debounce?.cancel();
  _debounce = Timer(const Duration(milliseconds: 500), () {
    _provider.loadProducts(search: query);
  });
}
```

## B. SKPL & DPPL Lengkap

Dokumen SKPL (Spesifikasi Kebutuhan Perangkat Lunak) dan DPPL (Deskripsi Perancangan Perangkat Lunak) dapat dilihat di file:
- `SKPL.md` — Analisis kebutuhan, use case, class diagram analisis
- `DPPL.md` — Perancangan arsitektur, sequence diagram, class diagram perancangan, algoritma

## C. Dokumentasi API

Dokumentasi API lengkap dengan Postman Collection tersedia di file:
- `LiquidPedia-API.postman_collection.json`
