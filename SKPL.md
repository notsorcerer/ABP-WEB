# SKPL — Spesifikasi Kebutuhan Perangkat Lunak

**Aplikasi:** LiquidPedia (Web E-Commerce Liquid & Vape)
**Mata Kuliah:** Analisis dan Perancangan Perangkat Lunak (ABP)
**Prodi:** Informatika — Telkom University

---

## Daftar Isi

- [A1. Deskripsi Umum Aplikasi](#a1-deskripsi-umum-aplikasi)
- [A2. Kebutuhan Fungsional](#a2-kebutuhan-fungsional-functional-requirements)
- [A3. Kebutuhan Non-Fungsional](#a3-kebutuhan-non-fungsional)
- [A4. Use Case Diagram](#a4-use-case-diagram)
- [A5. Use Case Scenario](#a5-use-case-scenario)
- [A6. Class Diagram (Analisis)](#a6-class-diagram-analisis)
- [A7. Antarmuka Sistem](#a7-antarmuka-sistem)

---

## A1. Deskripsi Umum Aplikasi

### Nama Aplikasi

**LiquidPedia** — Web E-Commerce Liquid & Vape

### Tujuan Utama

Menyediakan platform e-commerce khusus untuk penjualan liquid (cairan vape) dan device vape secara online dengan dua peran pengguna (Customer dan Admin), dilengkapi sistem keranjang belanja berbasis session, location picker interaktif (Leaflet.js + OpenStreetMap), serta REST API untuk dukungan aplikasi mobile (Flutter).

### Pengguna (Aktor)

| Aktor | Peran |
|-------|-------|
| **Customer (Pelanggan)** | Pengguna umum yang dapat mendaftar/login, melihat produk, mengelola keranjang, melakukan checkout dengan pemilihan lokasi via peta interaktif, melihat konfirmasi pembayaran, dan melihat riwayat pesanan. |
| **Admin (Pengelola Toko)** | Pengguna dengan hak akses `is_admin = true` yang dapat login ke panel admin, melihat dashboard statistik toko, serta melakukan CRUD produk dan kategori. |

### Batasan Sistem

1. Pembayaran dilakukan secara manual (belum terintegrasi payment gateway).
2. Konfirmasi pembayaran melalui WhatsApp admin.
3. Tidak ada sistem pengiriman/resi otomatis.
4. Tidak ada fitur review/rating produk.
5. Tidak ada fitur wishlist.
6. Tidak ada sistem diskon/kupon.
7. Tidak ada multi-bahasa.
8. Admin tidak bisa registrasi mandiri (hanya via seeder database).
9. Tidak ada fitur manajemen pesanan dari sisi admin (status pembayaran diubah manual via database).

### Asumsi dan Dependensi

1. PHP ^8.3 dan Composer terinstal pada server.
2. MySQL / MariaDB (5.7+ / 10.4+) sebagai database relasional.
3. Node.js & NPM untuk asset bundling menggunakan Vite.
4. Koneksi internet untuk memuat peta Leaflet (OpenStreetMap tiles dan Nominatim API) serta font Inter (CDN).
5. Browser modern yang mendukung JavaScript ES6+, Geolocation API, dan CSS Grid/Flexbox.
6. Web server (Apache/Nginx) atau Laravel built-in server (`php artisan serve`).

---

## A2. Kebutuhan Fungsional (Functional Requirements)

| Kode FR | Nama Kebutuhan | Deskripsi Kebutuhan | Aktor |
|---------|---------------|---------------------|-------|
| FR-01 | Registrasi Akun | Sistem menyediakan form registrasi dan mendaftarkan akun customer baru dengan data nama, email, dan password | Customer |
| FR-02 | Login Akun | Sistem menyediakan form login dan mengautentikasi customer berdasarkan email dan password | Customer |
| FR-03 | Melihat & Menyaring Produk | Sistem menampilkan katalog produk dalam bentuk grid yang dapat difilter berdasarkan kategori (Vape/Liquid) | Customer |
| FR-04 | Melihat Detail Produk | Sistem menampilkan informasi lengkap suatu produk termasuk gambar, harga, deskripsi, dan badge status | Customer |
| FR-05 | Mengelola Keranjang Belanja | Sistem menyediakan fitur menambah, mengubah kuantitas, menghapus, dan melihat isi keranjang belanja berbasis session | Customer |
| FR-06 | Melakukan Checkout | Sistem menampilkan form checkout dengan data pengiriman, location picker interaktif (Leaflet.js), pilihan metode bayar, dan memproses pembuatan pesanan | Customer |
| FR-07 | Melihat Konfirmasi Pembayaran | Sistem menampilkan halaman instruksi pembayaran sesuai metode yang dipilih (Transfer Bank, E-Wallet, QRIS, COD) | Customer |
| FR-08 | Melihat Riwayat Pesanan | Sistem menampilkan daftar semua pesanan milik customer yang sedang login, diurutkan dari terbaru | Customer |
| FR-09 | Login & Dashboard Admin | Sistem menyediakan halaman login khusus admin (dengan pengecekan `is_admin`) dan menampilkan dashboard berisi statistik toko | Admin |
| FR-10 | Mengelola Produk | Sistem menyediakan CRUD (Create, Read, Update, Delete) untuk manajemen data produk termasuk upload gambar | Admin |

---

## A3. Kebutuhan Non-Fungsional

| No | Quality Criteria | Kode Kebutuhan | Deskripsi |
|----|-----------------|---------------|-----------|
| 1 | **Usability** | NFR-US-01 | Antarmuka menggunakan desain responsif (Tailwind CSS) yang menyesuaikan dengan ukuran layar desktop dan mobile |
| 2 | **Usability** | NFR-US-02 | Notifikasi flash message (sukses/error) ditampilkan dan otomatis hilang setelah beberapa detik |
| 3 | **Usability** | NFR-US-03 | Navigasi menggunakan breadcrumb pada halaman detail produk untuk memudahkan orientasi pengguna |
| 4 | **Usability** | NFR-US-04 | Tersedia konfirmasi sebelum penghapusan data pada panel admin (data-confirm dialog) |
| 5 | **Security** | NFR-SC-01 | Password di-hash menggunakan bcrypt sebelum disimpan ke database |
| 6 | **Security** | NFR-SC-02 | Semua form dilindungi CSRF token (Laravel built-in) |
| 7 | **Security** | NFR-SC-03 | Route checkout, profil, dan riwayat pesanan dilindungi middleware `auth` |
| 8 | **Security** | NFR-SC-04 | Route admin dilindungi middleware khusus `admin` yang mengecek `is_admin = true` |
| 9 | **Security** | NFR-SC-05 | REST API dilindungi menggunakan Laravel Sanctum (token-based authentication) |
| 10 | **Security** | NFR-SC-06 | Kepemilikan order diverifikasi — customer hanya bisa melihat order miliknya sendiri |
| 11 | **Security** | NFR-SC-07 | Upload gambar divalidasi tipe file (jpeg/png/jpg/gif/webp) dan ukuran maksimal 2MB |
| 12 | **Performance** | NFR-PF-01 | Halaman beranda memuat data dalam waktu < 3 detik |
| 13 | **Performance** | NFR-PF-02 | Query database menggunakan Eloquent ORM dengan eager loading (`with()`) untuk menghindari N+1 problem |
| 14 | **Performance** | NFR-PF-03 | Location picker menggunakan debounce 300ms pada pencarian alamat untuk mengurangi panggilan API Nominatim |
| 15 | **Reliability** | NFR-RL-01 | Database menggunakan foreign key constraints untuk menjaga integritas referensial data |
| 16 | **Reliability** | NFR-RL-02 | Cascade delete tidak diterapkan — kategori yang memiliki produk tidak bisa dihapus (dicegah di controller) |
| 17 | **Maintainability** | NFR-MT-01 | Kode menggunakan arsitektur MVC Laravel dengan pemisahan concerns (Model, View, Controller) |
| 18 | **Maintainability** | NFR-MT-02 | Migrasi database digunakan untuk version control skema database |
| 19 | **Maintainability** | NFR-MT-03 | Seeder digunakan untuk data awal (admin dan produk demo) |
| 20 | **Portability** | NFR-PT-01 | Aplikasi dapat dijalankan di berbagai OS (Windows, Linux, macOS) karena berbasis PHP |
| 21 | **Portability** | NFR-PT-02 | Konfigurasi environment menggunakan file `.env` sehingga mudah dipindahkan antar lingkungan |
| 22 | **Portability** | NFR-PT-03 | REST API dengan format JSON memungkinkan integrasi dengan aplikasi mobile (Flutter) |

---

## A4. Use Case Diagram

### Daftar 10 Use Case

| No | Nama Use Case | Aktor | Relasi |
|----|--------------|-------|--------|
| UC-01 | Registrasi Akun | Customer | - |
| UC-02 | Login Akun | Customer | - |
| UC-03 | Melihat & Menyaring Produk | Customer | - |
| UC-04 | Melihat Detail Produk | Customer | - |
| UC-05 | Mengelola Keranjang Belanja | Customer | - |
| UC-06 | Melakukan Checkout | Customer | `<<include>>` UC-02 (jika belum login) |
| UC-07 | Melihat Konfirmasi Pembayaran | Customer | `<<include>>` UC-06 |
| UC-08 | Melihat Riwayat Pesanan | Customer | `<<include>>` UC-02 |
| UC-09 | Login & Dashboard Admin | Admin | - |
| UC-10 | Mengelola Produk | Admin | `<<include>>` UC-09 |

### Struktur Diagram (untuk digambar manual)

**Aktor:** Terdapat 2 aktor: **Customer** dan **Admin** (tidak ada generalization).

**Use Case** digambar dalam *system boundary* bernama **LiquidPedia**.

**Relasi:**
- UC-06 (Checkout) → *include* → UC-02 (Login) — jika belum login
- UC-07 (Konfirmasi Pembayaran) → *include* → UC-06 (Checkout) — terjadi setelah checkout
- UC-08 (Riwayat Pesanan) → *include* → UC-02 (Login) — harus login
- UC-10 (Mengelola Produk) → *include* → UC-09 (Login & Dashboard Admin) — harus login sebagai admin

---

## A5. Use Case Scenario

### UC-01: Registrasi Akun

| Field | Isi |
|-------|-----|
| Nama Usecase | Registrasi Akun |
| Deskripsi | Customer mendaftarkan akun baru untuk dapat melakukan transaksi |
| Pre-Kondisi | Customer belum memiliki akun dan berada di halaman register |
| Post-Kondisi | Akun baru terdaftar, customer otomatis login, diarahkan ke beranda |
| Skenario Utama | 1. Customer membuka halaman `/register`<br>2. Sistem menampilkan form registrasi (nama, email, password, konfirmasi password)<br>3. Customer mengisi data dan menekan tombol "Daftar"<br>4. Sistem memvalidasi input (name required, email unique, password min 8 & confirmed)<br>5. Sistem membuat user baru dengan password ter-hash (bcrypt)<br>6. Sistem mengautentikasi user (auto-login)<br>7. Sistem meregenerasi session ID<br>8. Sistem mengarahkan ke halaman beranda dengan notifikasi sukses |
| Skenario Eksepsional | 4a. Validasi gagal: Email sudah terdaftar → error "The email has already been taken"; Password < 8 karakter → error validasi; Konfirmasi password tidak cocok → error validasi. Sistem tetap di halaman register, input terisi sebelumnya. |

### UC-02: Login Akun

| Field | Isi |
|-------|-----|
| Nama Usecase | Login Akun |
| Deskripsi | Customer yang sudah memiliki akun masuk ke sistem |
| Pre-Kondisi | Customer belum login dan berada di halaman login |
| Post-Kondisi | Customer berhasil login, session dibuat, diarahkan ke halaman beranda atau halaman yang dituju sebelumnya (intended) |
| Skenario Utama | 1. Customer membuka halaman `/login`<br>2. Sistem menampilkan form login (email, password, "Ingat Saya")<br>3. Customer mengisi email dan password, menekan "Login"<br>4. Sistem memvalidasi input<br>5. Sistem mencocokkan kredensial dengan database (`Auth::attempt`)<br>6. Sistem meregenerasi session ID<br>7. Sistem mengarahkan ke halaman beranda (atau intended URL) |
| Skenario Eksepsional | 5a. Email atau password salah: Sistem menampilkan pesan error "Email atau password salah" dan tetap di halaman login |

### UC-03: Melihat & Menyaring Produk

| Field | Isi |
|-------|-----|
| Nama Usecase | Melihat & Menyaring Produk |
| Deskripsi | Customer melihat katalog produk dalam bentuk grid dan dapat memfilter berdasarkan kategori |
| Pre-Kondisi | Customer membuka halaman produk |
| Post-Kondisi | Halaman katalog produk (terfilter atau semua) ditampilkan |
| Skenario Utama | 1. Customer membuka halaman `/products` (atau `/` untuk beranda)<br>2. Sistem mengambil semua produk dengan relasi kategori (atau best seller/new arrival untuk beranda)<br>3. Sistem menampilkan produk dalam grid dengan pill button filter kategori di atasnya<br>4. Customer menekan pill kategori tertentu (misal: "Vape")<br>5. Sistem mencari kategori berdasarkan slug dari query parameter<br>6. Sistem mengambil produk dengan `category_id` sesuai kategori yang ditemukan<br>7. Sistem menampilkan produk yang sudah difilter, pill yang aktif diberi highlight |
| Skenario Eksepsional | 2a. Tidak ada produk: ditampilkan empty state "Tidak ada produk yang ditemukan"<br>6a. Slug tidak ditemukan: tampilkan semua produk (fallback) |

### UC-04: Melihat Detail Produk

| Field | Isi |
|-------|-----|
| Nama Usecase | Melihat Detail Produk |
| Deskripsi | Customer melihat informasi lengkap suatu produk |
| Pre-Kondisi | Customer membuka halaman detail produk tertentu |
| Post-Kondisi | Halaman detail produk ditampilkan |
| Skenario Utama | 1. Customer menekan salah satu produk dari grid<br>2. Sistem mengambil data produk dengan relasi kategori<br>3. Sistem menampilkan: breadcrumb, gambar produk (hover zoom), badge kategori/best seller/new arrival, harga, deskripsi, quantity selector (+/-), tombol "Tambah ke Cart", tabel info produk |
| Skenario Eksepsional | - |

### UC-05: Mengelola Keranjang Belanja

| Field | Isi |
|-------|-----|
| Nama Usecase | Mengelola Keranjang Belanja |
| Deskripsi | Customer menambah, mengubah kuantitas, menghapus, dan melihat isi keranjang belanja |
| Pre-Kondisi | Customer berada di halaman produk, detail produk, atau keranjang |
| Post-Kondisi | Isi keranjang berubah sesuai aksi, badge cart di navbar diperbarui |
| Skenario Utama (Tambah) | 1. Customer menekan "Tambah ke Cart" (dengan quantity pilihan)<br>2. Sistem mengambil cart dari session<br>3. Jika produk sudah ada: tambahkan quantity baru ke quantity lama<br>4. Jika belum: set quantity baru<br>5. Sistem menyimpan cart ke session<br>6. Sistem menampilkan notifikasi sukses, badge cart diperbarui |
| Skenario Utama (Update) | 1. Customer mengubah quantity di halaman cart (tombol +/-)<br>2. Jika quantity < 1: produk dihapus dari cart<br>3. Sistem memperbarui session cart<br>4. Sistem menghitung ulang subtotal per item dan grand total |
| Skenario Utama (Hapus) | 1. Customer menekan tombol X (remove) pada item di cart<br>2. Sistem menghapus produk dari session cart<br>3. Sistem menghitung ulang total |
| Skenario Eksepsional | Cart kosong: halaman cart menampilkan pesan "Cart masih kosong!" dengan tombol lanjut belanja |

### UC-06: Melakukan Checkout

| Field | Isi |
|-------|-----|
| Nama Usecase | Melakukan Checkout |
| Deskripsi | Customer mengisi data pengiriman, memilih lokasi via peta interaktif, memilih metode bayar, dan membuat pesanan |
| Pre-Kondisi | Customer sudah login (jika belum → redirect ke login), keranjang tidak kosong |
| Post-Kondisi | Pesanan baru terbuat, keranjang dikosongkan, diarahkan ke konfirmasi bayar |
| Skenario Utama | 1. Customer menekan "Checkout" di halaman cart<br>2. Sistem memvalidasi cart tidak kosong<br>3. Sistem menampilkan form checkout: data pengiriman (nama, provinsi, kota, kecamatan, kode pos, alamat, telepon, email), location picker (Leaflet.js + OpenStreetMap), pilihan metode bayar (Transfer Bank / E-Wallet / QRIS / COD), ringkasan pesanan<br>4. Customer mengisi data, memilih lokasi via peta (marker bisa di-drag/klik peta/cari alamat), memilih metode bayar<br>5. Customer menekan "Buat Pesanan"<br>6. Sistem memvalidasi semua input<br>7. Sistem membuat Order baru dengan `order_number` unik (format: `INV/YYYYMMDD/RANDOM6`) dan `payment_status = 'pending'`<br>8. Untuk setiap item di cart: Sistem membuat OrderItem dengan snapshot nama produk, quantity, price, subtotal<br>9. Sistem mengosongkan cart session<br>10. Sistem mengarahkan ke halaman konfirmasi pembayaran |
| Skenario Eksepsional | 1a. Cart kosong: redirect ke cart dengan error "Cart masih kosong!"<br>6a. Validasi gagal → kembali ke form checkout dengan error validasi, data tetap terisi |

### UC-07: Melihat Konfirmasi Pembayaran

| Field | Isi |
|-------|-----|
| Nama Usecase | Melihat Konfirmasi Pembayaran |
| Deskripsi | Customer melihat instruksi pembayaran setelah membuat pesanan |
| Pre-Kondisi | Pesanan sudah dibuat, customer adalah pemilik pesanan |
| Post-Kondisi | Halaman instruksi pembayaran sesuai metode ditampilkan |
| Skenario Utama | 1. Customer diarahkan ke halaman konfirmasi (setelah checkout) atau dari link "Lihat Petunjuk Pembayaran" di riwayat pesanan<br>2. Sistem mengambil data order + items<br>3. Sistem memvalidasi kepemilikan order (`order->user_id === auth()->id()`)<br>4. Sistem menampilkan: nomor pesanan, status pembayaran, daftar item, total, alamat pengiriman (link Google Maps jika ada koordinat)<br>5. Sistem menampilkan instruksi sesuai metode bayar:<br>&nbsp;&nbsp;- **Transfer Bank**: daftar 4 bank (BCA, Mandiri, BRI, BNI) + tombol "Salin"<br>&nbsp;&nbsp;- **E-Wallet**: daftar 3 provider (GoPay, OVO, Dana)<br>&nbsp;&nbsp;- **QRIS**: gambar QR Code<br>&nbsp;&nbsp;- **COD**: informasi bayar di tempat<br>6. Sistem menampilkan tombol WhatsApp pre-filled dengan nomor pesanan |
| Skenario Eksepsional | 3a. Customer bukan pemilik order → error 403 Forbidden |

### UC-08: Melihat Riwayat Pesanan

| Field | Isi |
|-------|-----|
| Nama Usecase | Melihat Riwayat Pesanan |
| Deskripsi | Customer melihat semua pesanan yang pernah dibuat |
| Pre-Kondisi | Customer sudah login |
| Post-Kondisi | Halaman daftar pesanan ditampilkan |
| Skenario Utama | 1. Customer membuka halaman `/orders` ("Pesanan Saya")<br>2. Sistem mengambil semua pesanan milik user yang login dengan items (eager loading)<br>3. Sistem mengurutkan dari yang terbaru (latest)<br>4. Sistem menampilkan setiap pesanan: nomor pesanan, badge status (color-coded: amber = pending, hijau = paid, merah = cancelled), tanggal, item (nama x quantity + subtotal), total, metode bayar<br>5. Untuk pesanan dengan status `pending`, ada link "Lihat Petunjuk Pembayaran" |
| Skenario Eksepsional | 2a. Belum pernah order: tampilkan daftar kosong |

### UC-09: Login & Dashboard Admin

| Field | Isi |
|-------|-----|
| Nama Usecase | Login & Dashboard Admin |
| Deskripsi | Admin masuk ke panel administrasi dan melihat statistik toko |
| Pre-Kondisi | Admin membuka halaman `/admin/login` dan belum login |
| Post-Kondisi | Admin masuk ke dashboard dengan data statistik |
| Skenario Utama | 1. Admin membuka `/admin/login`<br>2. Sistem menampilkan form login admin<br>3. Admin mengisi email & password, menekan "Login"<br>4. Sistem memvalidasi kredensial (`Auth::attempt`)<br>5. Sistem mengecek field `is_admin = true`<br>6. Jika valid: session diregenerasi, redirect ke dashboard<br>7. Dashboard menampilkan: total produk, total kategori, jumlah best seller, jumlah new arrival, bar chart produk per kategori |
| Skenario Eksepsional | 4a. Email/password salah: kembali ke form dengan error "Email atau password salah"<br>5a. User bukan admin (`is_admin = false`): logout otomatis, error "Anda tidak memiliki akses admin" |

### UC-10: Mengelola Produk

| Field | Isi |
|-------|-----|
| Nama Usecase | Mengelola Produk |
| Deskripsi | Admin melakukan Create, Read, Update, Delete pada data produk |
| Pre-Kondisi | Admin sudah login |
| Post-Kondisi | Data produk berubah sesuai operasi |
| Skenario Utama (Read) | 1. Admin membuka menu Produk<br>2. Sistem menampilkan tabel daftar produk (thumbnail, nama, kategori badge, harga, status, tombol aksi edit/hapus) |
| Skenario Utama (Create) | 1. Admin menekan "Tambah Produk"<br>2. Sistem menampilkan form: nama, deskripsi, harga, kategori (dropdown), gambar (upload file), checkbox best seller & new arrival<br>3. Admin mengisi data + upload gambar lalu submit<br>4. Sistem memvalidasi input (termasuk tipe & ukuran file)<br>5. Sistem menyimpan gambar ke `storage/app/public/products/`<br>6. Sistem membuat record produk baru<br>7. Redirect ke daftar produk dengan notifikasi sukses |
| Skenario Utama (Update) | 1. Admin menekan tombol edit<br>2. Sistem menampilkan form pre-filled dengan data produk<br>3. Admin mengubah data (gambar opsional)<br>4. Jika upload gambar baru: hapus gambar lama (jika lokal), simpan yang baru<br>5. Redirect dengan notifikasi sukses |
| Skenario Utama (Delete) | 1. Admin menekan tombol hapus<br>2. Konfirmasi melalui dialog data-confirm<br>3. Sistem menghapus file gambar dari storage (jika bukan URL eksternal)<br>4. Sistem menghapus produk dari database<br>5. Redirect dengan notifikasi sukses |
| Skenario Eksepsional | Validasi gagal (gambar > 2MB, format tidak sesuai, field kosong) → kembali ke form dengan error |

---

## A6. Class Diagram (Analisis)

### Entitas dan Atribut

#### 1. User
| Atribut | Tipe Data | Keterangan |
|---------|-----------|------------|
| id | bigInteger (PK) | Auto increment |
| name | string(255) | Nama lengkap |
| email | string(255) | Unique, digunakan untuk login |
| password | string(255) | Hashed (bcrypt) |
| is_admin | boolean, default false | Flag admin |
| timestamps | timestamp | created_at, updated_at |

#### 2. Category
| Atribut | Tipe Data | Keterangan |
|---------|-----------|------------|
| id | bigInteger (PK) | Auto increment |
| name | string(255) | Nama kategori |
| slug | string(255) | Unique, auto-generated dari nama |
| timestamps | timestamp | created_at, updated_at |

#### 3. Product
| Atribut | Tipe Data | Keterangan |
|---------|-----------|------------|
| id | bigInteger (PK) | Auto increment |
| name | string(255) | Nama produk |
| description | text | Deskripsi produk |
| price | decimal(12,2) | Harga |
| category_id | bigInteger (FK) | → categories.id |
| image | string(255) | Path/URL gambar |
| is_best_seller | boolean, default false | Flag best seller |
| is_new_arrival | boolean, default false | Flag new arrival |
| timestamps | timestamp | created_at, updated_at |

#### 4. Order
| Atribut | Tipe Data | Keterangan |
|---------|-----------|------------|
| id | bigInteger (PK) | Auto increment |
| user_id | bigInteger (FK) | → users.id |
| order_number | string(255) | Unique, format INV/YYYYMMDD/RANDOM6 |
| shipping_name | string(255) | Nama penerima |
| shipping_country | string(255) | Default 'Indonesia' |
| shipping_province | string(255) | Provinsi |
| shipping_city | string(255) | Kota |
| shipping_district | string(255) | Kecamatan |
| shipping_postal_code | string(20) | Kode pos |
| shipping_address | text | Alamat lengkap |
| shipping_phone | string(20) | No. telepon |
| shipping_email | string(255) | Email penerima |
| shipping_latitude | string, nullable | Koordinat latitude |
| shipping_longitude | string, nullable | Koordinat longitude |
| payment_method | string(255) | bank_transfer / ewallet / qr_code / cod |
| payment_status | string(255) | pending / paid / cancelled |
| total | decimal(12,2) | Total pesanan |
| timestamps | timestamp | created_at, updated_at |

#### 5. OrderItem
| Atribut | Tipe Data | Keterangan |
|---------|-----------|------------|
| id | bigInteger (PK) | Auto increment |
| order_id | bigInteger (FK) | → orders.id |
| product_id | bigInteger (FK) | → products.id |
| product_name | string(255) | Snapshot nama saat order |
| quantity | integer | Jumlah |
| price | decimal(12,2) | Snapshot harga saat order |
| subtotal | decimal(12,2) | quantity × price |
| timestamps | timestamp | created_at, updated_at |

#### 6. CartItem
| Atribut | Tipe Data | Keterangan |
|---------|-----------|------------|
| id | bigInteger (PK) | Auto increment |
| user_id | bigInteger (FK) | → users.id |
| product_id | bigInteger (FK) | → products.id |
| quantity | integer, default 1 | Jumlah |
| timestamps | timestamp | created_at, updated_at |

> **Unique Constraint:** (user_id, product_id)

### Relasi Antar Class

| Class 1 | Class 2 | Tipe Relasi | Nama Relasi | Keterangan |
|---------|---------|-------------|-------------|------------|
| **User** | **Order** | one-to-many | "memesan" | Satu user dapat memiliki banyak order |
| **Order** | **OrderItem** | one-to-many | "memiliki" | Satu order memiliki banyak item |
| **Product** | **OrderItem** | one-to-many | "diorder" | Satu produk bisa muncul di banyak order item |
| **User** | **CartItem** | one-to-many | "memiliki" | Satu user memiliki banyak cart item (API) |
| **Product** | **CartItem** | one-to-many | "dikeranjangkan" | Satu produk bisa ada di banyak cart |
| **Category** | **Product** | one-to-many | "memiliki" | Satu kategori memiliki banyak produk |

### Diagram Relasi Database

```
users ──1:N──> orders ──1:N──> order_items ──N:1──> products
  │                                                │
  └──1:N──> cart_items ──N:1───────────────────────┘
                    │
                    └──N:1──> products

categories ──1:N──> products
```

---

## A7. Antarmuka Sistem

### Antarmuka Pengguna (Halaman)

#### Customer
| No | Halaman | URL | Deskripsi |
|----|---------|-----|-----------|
| 1 | Beranda | `/` | Hero section, best seller, kategori, new arrival |
| 2 | Katalog Produk | `/products` | Grid produk dengan pill filter kategori |
| 3 | Detail Produk | `/products/{id}` | Informasi lengkap produk + quantity selector + add to cart |
| 4 | Keranjang | `/cart` | Daftar item cart, subtotal, grand total |
| 5 | Checkout | `/checkout` | Form data pengiriman + location picker (Leaflet) + metode bayar |
| 6 | Konfirmasi Pembayaran | `/orders/{id}/payment-confirmation` | Instruksi bayar sesuai metode |
| 7 | Riwayat Pesanan | `/orders` | Daftar semua pesanan user |
| 8 | Profil | `/profile` | Informasi akun |
| 9 | Login | `/login` | Form login customer |
| 10 | Register | `/register` | Form registrasi customer |
| 11 | 404 | - | Halaman error kustom |

#### Admin
| No | Halaman | URL | Deskripsi |
|----|---------|-----|-----------|
| 12 | Login Admin | `/admin/login` | Form login khusus admin |
| 13 | Dashboard | `/admin` | Kartu statistik + chart produk per kategori |
| 14 | Daftar Produk | `/admin/products` | Tabel manajemen produk |
| 15 | Tambah Produk | `/admin/products/create` | Form tambah produk |
| 16 | Edit Produk | `/admin/products/{id}/edit` | Form edit produk |

### Antarmuka Perangkat Keras
| Perangkat | Keterangan |
|-----------|------------|
| **Server** | Komputer/VPS untuk menjalankan aplikasi (PHP 8.3+, MySQL, Composer) |
| **Client** | Perangkat dengan browser modern (Chrome, Firefox, Edge, Safari) |
| **Storage** | Harddisk/SSD untuk penyimpanan file upload (gambar produk) |
| **Jaringan** | Koneksi internet untuk mengakses OpenStreetMap tiles dan font CDN |

### Antarmuka Perangkat Lunak
| Komponen | Teknologi | Versi |
|----------|-----------|-------|
| **Bahasa Pemrograman** | PHP | ^8.3 |
| **Framework Backend** | Laravel | ^13.8 |
| **Database** | MySQL / MariaDB | 5.7+ / 10.4+ |
| **Template Engine** | Blade | Laravel built-in |
| **CSS Framework** | Tailwind CSS | v4 |
| **Asset Bundler** | Vite | ^8.0 |
| **Peta Interaktif** | Leaflet.js + OpenStreetMap | 1.x |
| **Geocoding** | Nominatim API (gratis) | - |
| **Icons** | Heroicons | Inline SVG |
| **Font** | Inter (Bunny Fonts CDN) | - |

### Antarmuka Komunikasi
| Protokol | Penggunaan |
|----------|------------|
| **HTTP / HTTPS** | Komunikasi web browser ke server |
| **JSON** | Format data REST API |
| **Session-based Auth** | Autentikasi web (cookie session) |
| **CSRF Token** | Proteksi form web (Laravel built-in) |
