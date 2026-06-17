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

Menyediakan platform e-commerce khusus untuk penjualan liquid (cairan vape) dan device vape secara online dengan dua peran pengguna (customer dan admin), dilengkapi REST API untuk dukungan aplikasi mobile (Flutter).

### Pengguna (Aktor)

| Aktor | Peran |
|-------|-------|
| **Customer / Pelanggan** | Pengguna umum yang dapat melihat produk, melakukan pembelian, mengelola keranjang, dan melihat riwayat pesanan. |
| **Admin / Pengelola Toko** | Pengguna dengan hak akses `is_admin = true` yang dapat mengelola produk, kategori, dan melihat dashboard statistik toko. |

### Batasan Sistem

1. Pembayaran dilakukan secara manual (belum terintegrasi payment gateway).
2. Konfirmasi pembayaran melalui WhatsApp admin.
3. Tidak ada sistem pengiriman/resi otomatis.
4. Tidak ada fitur review/rating produk.
5. Tidak ada fitur wishlist.
6. Tidak ada sistem diskon/kupon.
7. Tidak ada multi-bahasa.
8. Registrasi admin hanya melalui seeder database (tidak ada registrasi mandiri).

### Asumsi dan Dependensi

1. PHP ^8.3 dan Composer terinstal pada server.
2. MySQL / MariaDB sebagai database relasional.
3. Node.js & NPM untuk asset bundling menggunakan Vite.
4. Koneksi internet untuk memuat peta Leaflet (OpenStreetMap) dan font Inter (CDN).
5. Browser modern yang mendukung JavaScript ES6+, Geolocation API, dan CSS Grid/Flexbox.
6. Web server (Apache/Nginx) atau Laravel built-in server (`php artisan serve`).

---

## A2. Kebutuhan Fungsional (Functional Requirements)

| Kode FR | Nama Kebutuhan | Deskripsi Kebutuhan | Aktor |
|---------|---------------|---------------------|-------|
| FR-01 | Registrasi Akun | Sistem menyediakan form registrasi dan mendaftarkan akun customer baru | Customer |
| FR-02 | Login Akun | Sistem menyediakan form login dan mengautentikasi customer | Customer |
| FR-03 | Logout Akun | Sistem menyediakan fitur logout yang mengakhiri sesi customer | Customer |
| FR-04 | Melihat Beranda | Sistem menampilkan halaman beranda berisi best seller, new arrival, dan kategori | Customer |
| FR-05 | Melihat Katalog Produk | Sistem menampilkan daftar produk dalam bentuk grid | Customer |
| FR-06 | Menyaring Produk per Kategori | Sistem menyaring produk berdasarkan kategori yang dipilih melalui pill button | Customer |
| FR-07 | Melihat Detail Produk | Sistem menampilkan detail lengkap suatu produk (gambar, harga, deskripsi, dll) | Customer |
| FR-08 | Menambah ke Keranjang | Sistem menambahkan produk ke keranjang belanja berbasis session | Customer |
| FR-09 | Mengupdate Keranjang | Sistem memperbarui kuantitas produk di keranjang | Customer |
| FR-10 | Menghapus dari Keranjang | Sistem menghapus produk dari keranjang | Customer |
| FR-11 | Melihat Keranjang | Sistem menampilkan isi keranjang belanja dengan subtotal dan total | Customer |
| FR-12 | Menampilkan Form Checkout | Sistem menampilkan form checkout dengan data pengiriman, peta interaktif, dan pilihan metode bayar | Customer |
| FR-13 | Memproses Checkout | Sistem memvalidasi input, membuat pesanan baru, dan mengosongkan keranjang | Customer |
| FR-14 | Melihat Konfirmasi Pembayaran | Sistem menampilkan halaman konfirmasi pembayaran sesuai metode yang dipilih | Customer |
| FR-15 | Melihat Riwayat Pesanan | Sistem menampilkan daftar riwayat pesanan milik customer | Customer |
| FR-16 | Melihat Profil | Sistem menampilkan profil pengguna yang sedang login | Customer |
| FR-17 | Login Admin | Sistem menyediakan halaman login khusus untuk admin dengan pengecekan is_admin | Admin |
| FR-18 | Logout Admin | Sistem menyediakan logout untuk admin | Admin |
| FR-19 | Melihat Dashboard Admin | Sistem menampilkan dashboard admin dengan statistik toko (total produk, kategori, dll) | Admin |
| FR-20 | Mengelola Produk | Sistem menyediakan CRUD lengkap untuk manajemen produk (tambah, lihat, edit, hapus) | Admin |
| FR-21 | Mengelola Kategori | Sistem menyediakan CRUD lengkap untuk manajemen kategori | Admin |
| FR-22 | Proteksi Hapus Kategori | Sistem mencegah penghapusan kategori yang masih memiliki produk terkait | Admin |
| FR-23 | API Registrasi | REST API untuk registrasi customer dari aplikasi mobile | Customer (Mobile) |
| FR-24 | API Login | REST API untuk login customer dari aplikasi mobile | Customer (Mobile) |
| FR-25 | API Katalog Produk | REST API untuk melihat daftar produk dengan pagination & filter kategori | Customer (Mobile) |
| FR-26 | API Beranda | REST API untuk mengambil data beranda (best seller, new arrival, kategori) | Customer (Mobile) |
| FR-27 | API Detail Produk | REST API untuk melihat detail produk | Customer (Mobile) |
| FR-28 | API Keranjang | REST API untuk manajemen keranjang (lihat, tambah, update, hapus) | Customer (Mobile) |
| FR-29 | API Pesanan | REST API untuk membuat pesanan baru dan melihat riwayat/detail pesanan | Customer (Mobile) |
| FR-30 | API User | REST API untuk logout dan melihat profil user | Customer (Mobile) |
| FR-31 | Halaman 404 | Sistem menyediakan halaman error 404 kustom untuk route tidak ditemukan | Customer |
| FR-32 | Badge Cart | Sistem menampilkan badge jumlah item di keranjang pada navbar | Customer |
| FR-33 | WhatsApp Floating | Sistem menyediakan tombol WhatsApp floating untuk menghubungi admin | Customer |

---

## A3. Kebutuhan Non-Fungsional

| No | Quality Criteria | Kode Kebutuhan | Deskripsi |
|----|-----------------|---------------|-----------|
| 1 | **Usability** | NFR-US-01 | Antarmuka menggunakan desain responsif yang menyesuaikan dengan ukuran layar desktop dan mobile (Tailwind CSS) |
| 2 | **Usability** | NFR-US-02 | Navigasi menggunakan breadcrumb untuk memudahkan orientasi pengguna di halaman detail produk |
| 3 | **Usability** | NFR-US-03 | Notifikasi flash message (sukses/error) ditampilkan dan otomatis hilang setelah beberapa detik |
| 4 | **Usability** | NFR-US-04 | Tersedia konfirmasi sebelum penghapusan data (data-confirm) pada panel admin |
| 5 | **Security** | NFR-SC-01 | Password di-hash menggunakan bcrypt sebelum disimpan ke database |
| 6 | **Security** | NFR-SC-02 | Semua form protected dengan CSRF token (Laravel built-in) |
| 7 | **Security** | NFR-SC-03 | Route checkout, profil, dan riwayat pesanan dilindungi middleware `auth` |
| 8 | **Security** | NFR-SC-04 | Route admin dilindungi middleware khusus `admin` yang mengecek `is_admin = true` |
| 9 | **Security** | NFR-SC-05 | REST API dilindungi menggunakan Laravel Sanctum (token-based authentication) |
| 10 | **Security** | NFR-SC-06 | Session ID diregenerasi setelah login dan diinvalidasi setelah logout |
| 11 | **Security** | NFR-SC-07 | Validasi input dilakukan server-side pada semua form menggunakan Laravel Validation |
| 12 | **Security** | NFR-SC-08 | Kepemilikan order diverifikasi — user hanya bisa melihat order miliknya sendiri |
| 13 | **Security** | NFR-SC-09 | Upload gambar divalidasi tipe file (jpeg/png/jpg/gif/webp) dan ukuran maksimal 2MB |
| 14 | **Performance** | NFR-PF-01 | Halaman beranda memuat data dalam waktu < 3 detik |
| 15 | **Performance** | NFR-PF-02 | Query database menggunakan Eloquent ORM dengan eager loading (`with()`) untuk menghindari N+1 problem |
| 16 | **Performance** | NFR-PF-03 | API menggunakan pagination untuk daftar produk dan pesanan dengan limit maksimal 50 per halaman |
| 17 | **Reliability** | NFR-RL-01 | Sistem berjalan di atas web server dengan ketersediaan tinggi |
| 18 | **Reliability** | NFR-RL-02 | Database menggunakan foreign key constraints untuk menjaga integritas referensial data |
| 19 | **Reliability** | NFR-RL-03 | Cascade delete pada relasi (misal: hapus user → order terkait ikut terhapus) |
| 20 | **Maintainability** | NFR-MT-01 | Kode menggunakan arsitektur MVC Laravel dengan pemisahan concerns (Model, View, Controller) |
| 21 | **Maintainability** | NFR-MT-02 | Migrasi database digunakan untuk version control skema database |
| 22 | **Maintainability** | NFR-MT-03 | Seeder digunakan untuk data awal (admin dan produk demo) |
| 23 | **Portability** | NFR-PT-01 | Aplikasi dapat dijalankan di berbagai OS (Windows, Linux, macOS) karena berbasis PHP |
| 24 | **Portability** | NFR-PT-02 | REST API dengan format JSON memungkinkan integrasi dengan aplikasi mobile (Flutter) |
| 25 | **Portability** | NFR-PT-03 | Konfigurasi environment menggunakan file `.env` sehingga mudah dipindahkan |

---

## A4. Use Case Diagram

### Daftar Use Case

#### A. Use Case untuk Customer

| No | Nama Use Case | Aktor | Relasi |
|----|--------------|-------|--------|
| UC-01 | Registrasi Akun | Customer | - |
| UC-02 | Login Akun | Customer | - |
| UC-03 | Logout Akun | Customer | - |
| UC-04 | Melihat Beranda | Customer | - |
| UC-05 | Melihat Katalog Produk | Customer | - |
| UC-06 | Menyaring Produk per Kategori | Customer | `<<extend>>` UC-05 |
| UC-07 | Melihat Detail Produk | Customer | - |
| UC-08 | Mengelola Keranjang | Customer | `<<include>>` UC-08a, UC-08b, UC-08c |
| UC-08a | Menambah ke Keranjang | Customer | `<<include>>` ke UC-08 |
| UC-08b | Mengupdate Keranjang | Customer | `<<include>>` ke UC-08 |
| UC-08c | Menghapus dari Keranjang | Customer | `<<include>>` ke UC-08 |
| UC-09 | Melakukan Checkout | Customer | `<<include>>` UC-02 (jika belum login), `<<include>>` UC-09a |
| UC-09a | Memilih Lokasi via Peta Interaktif | Customer | `<<include>>` ke UC-09 |
| UC-10 | Melihat Konfirmasi Pembayaran | Customer | `<<include>>` UC-09 |
| UC-11 | Melihat Riwayat Pesanan | Customer | `<<include>>` UC-02 |
| UC-12 | Melihat Profil | Customer | `<<include>>` UC-02 |

#### B. Use Case untuk Admin

| No | Nama Use Case | Aktor | Relasi |
|----|--------------|-------|--------|
| UC-13 | Login Admin | Admin | - |
| UC-14 | Logout Admin | Admin | - |
| UC-15 | Melihat Dashboard Admin | Admin | `<<include>>` UC-13 |
| UC-16 | Mengelola Produk | Admin | `<<include>>` UC-13, `<<include>>` UC-16a, UC-16b, UC-16c, UC-16d |
| UC-16a | Menambah Produk | Admin | `<<include>>` ke UC-16 |
| UC-16b | Melihat Daftar Produk | Admin | `<<include>>` ke UC-16 |
| UC-16c | Mengedit Produk | Admin | `<<include>>` ke UC-16 |
| UC-16d | Menghapus Produk | Admin | `<<include>>` ke UC-16 |
| UC-17 | Mengelola Kategori | Admin | `<<include>>` UC-13, `<<include>>` UC-17a, UC-17b, UC-17c, UC-17d |
| UC-17a | Menambah Kategori | Admin | `<<include>>` ke UC-17 |
| UC-17b | Melihat Daftar Kategori | Admin | `<<include>>` ke UC-17 |
| UC-17c | Mengedit Kategori | Admin | `<<include>>` ke UC-17 |
| UC-17d | Menghapus Kategori | Admin | `<<include>>` ke UC-17 |

#### C. Use Case untuk REST API (Mobile)

| No | Nama Use Case | Aktor | Relasi |
|----|--------------|-------|--------|
| UC-18 | API Registrasi | Customer (Mobile) | - |
| UC-19 | API Login | Customer (Mobile) | - |
| UC-20 | API Logout | Customer (Mobile) | `<<include>>` UC-19 |
| UC-21 | API Beranda | Customer (Mobile) | - |
| UC-22 | API Katalog Produk | Customer (Mobile) | - |
| UC-23 | API Detail Produk | Customer (Mobile) | - |
| UC-24 | API Kelola Keranjang | Customer (Mobile) | `<<include>>` UC-19 |
| UC-25 | API Buat Pesanan | Customer (Mobile) | `<<include>>` UC-19 |
| UC-26 | API Riwayat Pesanan | Customer (Mobile) | `<<include>>` UC-19 |
| UC-27 | API Profil User | Customer (Mobile) | `<<include>>` UC-19 |

---

## A5. Use Case Scenario

### UC-01: Registrasi Akun

| Field | Isi |
|-------|-----|
| Nama Usecase | Registrasi Akun |
| Deskripsi | Customer mendaftarkan akun baru untuk dapat melakukan transaksi |
| Pre-Kondisi | Customer belum memiliki akun dan berada di halaman register |
| Post-Kondisi | Akun baru terdaftar, customer otomatis login, diarahkan ke beranda |
| Skenario Utama | 1. Customer membuka halaman registrasi<br>2. Sistem menampilkan form registrasi (nama, email, password, konfirmasi password)<br>3. Customer mengisi data dan menekan tombol "Daftar"<br>4. Sistem memvalidasi input (name required, email unique, password min 8 & confirmed)<br>5. Sistem membuat user baru dengan password ter-hash (bcrypt)<br>6. Sistem mengautentikasi user (auto-login)<br>7. Sistem mengarahkan ke halaman beranda dengan notifikasi sukses |
| Skenario Eksepsional | 4a. Validasi gagal: Email sudah terdaftar → tampilkan error "The email has already been taken"; Password < 8 karakter → error validasi; Konfirmasi password tidak cocok → error validasi<br>4b. Sistem tetap di halaman register, input terisi sebelumnya |

### UC-02: Login Akun

| Field | Isi |
|-------|-----|
| Nama Usecase | Login Akun |
| Deskripsi | Customer yang sudah memiliki akun masuk ke sistem |
| Pre-Kondisi | Customer belum login dan berada di halaman login |
| Post-Kondisi | Customer berhasil login, session dibuat, diarahkan ke halaman yang dimaksud |
| Skenario Utama | 1. Customer membuka halaman login<br>2. Sistem menampilkan form login (email, password, remember me)<br>3. Customer mengisi email dan password, menekan "Login"<br>4. Sistem memvalidasi input<br>5. Sistem mencocokkan kredensial dengan database (Auth::attempt)<br>6. Sistem meregenerasi session ID<br>7. Sistem mengarahkan ke halaman beranda (atau halaman yang dituju sebelumnya / intended) |
| Skenario Eksepsional | 5a. Email atau password salah: Sistem menampilkan pesan error "Email atau password salah" dan tetap di halaman login |

### UC-03: Logout Akun

| Field | Isi |
|-------|-----|
| Nama Usecase | Logout Akun |
| Deskripsi | Customer keluar dari sistem |
| Pre-Kondisi | Customer sudah login |
| Post-Kondisi | Session dihapus, customer dialihkan ke beranda sebagai tamu |
| Skenario Utama | 1. Customer menekan tombol "Logout" di dropdown navbar<br>2. Sistem menghapus session autentikasi (Auth::logout)<br>3. Sistem menginvalidasi session dan meregenerasi token CSRF<br>4. Sistem mengarahkan ke halaman beranda |
| Skenario Eksepsional | - |

### UC-04: Melihat Beranda

| Field | Isi |
|-------|-----|
| Nama Usecase | Melihat Beranda |
| Deskripsi | Customer melihat halaman utama berisi best seller, new arrival, dan kategori |
| Pre-Kondisi | Customer membuka URL aplikasi |
| Post-Kondisi | Halaman beranda ditampilkan dengan data produk dan kategori |
| Skenario Utama | 1. Customer membuka halaman beranda (/)<br>2. Sistem mengambil 4 produk best seller (is_best_seller = true)<br>3. Sistem mengambil 4 produk new arrival (is_new_arrival = true)<br>4. Sistem mengambil semua kategori<br>5. Sistem menampilkan hero section, grid best seller, kartu kategori, grid new arrival |
| Skenario Eksepsional | 2a. Tidak ada produk: grid kosong dengan pesan informasi |

### UC-05: Melihat Katalog Produk

| Field | Isi |
|-------|-----|
| Nama Usecase | Melihat Katalog Produk |
| Deskripsi | Customer melihat semua produk dalam tampilan grid |
| Pre-Kondisi | Customer membuka halaman produk |
| Post-Kondisi | Halaman katalog produk ditampilkan |
| Skenario Utama | 1. Customer membuka halaman produk (/products)<br>2. Sistem mengambil semua produk dengan relasi kategori<br>3. Sistem menampilkan produk dalam grid dengan pill filter kategori di atasnya<br>4. Setiap kartu produk menampilkan: gambar, nama, kategori badge, harga, tombol "Tambah ke Cart" |
| Skenario Eksepsional | 2a. Tidak ada produk: ditampilkan empty state "Tidak ada produk yang ditemukan" |

### UC-06: Menyaring Produk per Kategori

| Field | Isi |
|-------|-----|
| Nama Usecase | Menyaring Produk per Kategori |
| Deskripsi | Customer memfilter daftar produk berdasarkan kategori |
| Pre-Kondisi | Customer berada di halaman produk |
| Post-Kondisi | Halaman hanya menampilkan produk dari kategori terpilih |
| Skenario Utama | 1. Customer menekan pill kategori tertentu (misal: "Vape")<br>2. Sistem mencari kategori berdasarkan slug dari query parameter<br>3. Sistem mengambil produk dengan category_id sesuai kategori yang ditemukan<br>4. Sistem menampilkan produk yang sudah difilter<br>5. Pill kategori yang aktif diberi highlight |
| Skenario Eksepsional | 2a. Slug tidak ditemukan: tampilkan semua produk (fallback ke semua) |

### UC-07: Melihat Detail Produk

| Field | Isi |
|-------|-----|
| Nama Usecase | Melihat Detail Produk |
| Deskripsi | Customer melihat informasi lengkap suatu produk |
| Pre-Kondisi | Customer membuka halaman detail produk tertentu |
| Post-Kondisi | Halaman detail produk ditampilkan |
| Skenario Utama | 1. Customer menekan salah satu produk dari grid<br>2. Sistem mengambil data produk dengan relasi kategori<br>3. Sistem menampilkan: breadcrumb, gambar produk (hover zoom), badge kategori/best seller/new arrival, harga, deskripsi, quantity selector (+/-), tombol "Tambah ke Cart", tabel info produk |
| Skenario Eksepsional | - |

### UC-08: Mengelola Keranjang (UC-08a, 08b, 08c)

| Field | Isi |
|-------|-----|
| Nama Usecase | Mengelola Keranjang |
| Deskripsi | Customer menambah/mengupdate/menghapus item di keranjang dan melihat isi keranjang |
| Pre-Kondisi | Customer berada di halaman produk/detail/keranjang |
| Post-Kondisi | Isi keranjang berubah sesuai aksi |
| Skenario Utama (Tambah) | 1. Customer menekan "Tambah ke Cart" pada produk (dengan quantity pilihan)<br>2. Sistem mengambil cart dari session<br>3. Jika produk sudah ada di cart: tambahkan quantity baru ke quantity lama<br>4. Jika belum: set quantity baru<br>5. Sistem menyimpan cart ke session<br>6. Sistem menampilkan notifikasi sukses, badge cart di navbar diperbarui |
| Skenario Utama (Update) | 1. Customer mengubah quantity di halaman cart (tombol +/-)<br>2. Jika quantity < 1: produk dihapus dari cart<br>3. Sistem memperbarui session cart<br>4. Sistem menghitung ulang subtotal per item dan grand total |
| Skenario Utama (Hapus) | 1. Customer menekan tombol X (remove) pada item di cart<br>2. Sistem menghapus produk dari session cart (unset)<br>3. Sistem menghitung ulang total |
| Skenario Eksepsional | Cart kosong: halaman cart menampilkan pesan "Cart masih kosong!" dengan tombol lanjut belanja |

### UC-09: Melakukan Checkout

| Field | Isi |
|-------|-----|
| Nama Usecase | Melakukan Checkout |
| Deskripsi | Customer mengisi data pengiriman dan membuat pesanan |
| Pre-Kondisi | Customer sudah login, keranjang tidak kosong |
| Post-Kondisi | Pesanan baru terbuat, keranjang dikosongkan, diarahkan ke konfirmasi bayar |
| Skenario Utama | 1. Customer menekan "Checkout" di halaman cart<br>2. Sistem memvalidasi login (middleware auth). Jika belum login → redirect ke login<br>3. Sistem memvalidasi cart tidak kosong<br>4. Sistem menampilkan form checkout: data pengiriman (nama, negara, provinsi, kota, kecamatan, kode pos, alamat, telepon, email), location picker (peta interaktif Leaflet.js), pilihan metode bayar (Transfer Bank / E-Wallet / QRIS / COD), ringkasan pesanan<br>5. Customer mengisi data, memilih lokasi via peta (marker bisa di-drag atau klik), memilih metode bayar<br>6. Customer menekan "Buat Pesanan"<br>7. Sistem memvalidasi semua input<br>8. Sistem membuat Order baru dengan order_number unik (format: INV/YYYYMMDD/RANDOM6) dan payment_status = 'pending'<br>9. Untuk setiap item di cart: Sistem membuat OrderItem dengan snapshot nama produk, quantity, price, subtotal<br>10. Sistem mengosongkan cart session<br>11. Sistem mengarahkan ke halaman konfirmasi pembayaran |
| Skenario Eksepsional | 7a. Validasi gagal → kembali ke form checkout dengan error validasi, data yang sudah diisi tetap terisi |

### UC-10: Melihat Konfirmasi Pembayaran

| Field | Isi |
|-------|-----|
| Nama Usecase | Melihat Konfirmasi Pembayaran |
| Deskripsi | Customer melihat instruksi pembayaran setelah membuat pesanan |
| Pre-Kondisi | Pesanan sudah dibuat, customer adalah pemilik pesanan |
| Post-Kondisi | Halaman instruksi pembayaran sesuai metode ditampilkan |
| Skenario Utama | 1. Sistem mengarahkan customer ke halaman konfirmasi setelah checkout (atau dari link "Lihat Petunjuk Pembayaran" di riwayat pesanan)<br>2. Sistem mengambil data order + items (load relationship)<br>3. Sistem memvalidasi kepemilikan order (order->user_id === auth()->id())<br>4. Sistem menampilkan: nomor pesanan, status pembayaran, daftar item, total, alamat pengiriman (link Google Maps jika ada koordinat)<br>5. Sistem menampilkan instruksi sesuai metode bayar:<br>&nbsp;&nbsp;- **Transfer Bank**: daftar 4 bank (BCA, Mandiri, BRI, BNI) + nomor rekening + tombol "Salin"<br>&nbsp;&nbsp;- **E-Wallet**: daftar 3 provider (GoPay, OVO, Dana) + nomor tujuan<br>&nbsp;&nbsp;- **QRIS**: gambar QR Code untuk scan<br>&nbsp;&nbsp;- **COD**: informasi bayar di tempat<br>6. Sistem menampilkan tombol WhatsApp yang pre-filled dengan nomor pesanan untuk konfirmasi |
| Skenario Eksepsional | 3a. Customer bukan pemilik order → error 403 Forbidden |

### UC-11: Melihat Riwayat Pesanan

| Field | Isi |
|-------|-----|
| Nama Usecase | Melihat Riwayat Pesanan |
| Deskripsi | Customer melihat semua pesanan yang pernah dibuat |
| Pre-Kondisi | Customer sudah login |
| Post-Kondisi | Halaman daftar pesanan ditampilkan |
| Skenario Utama | 1. Customer membuka halaman "Pesanan Saya" (/orders)<br>2. Sistem mengambil semua pesanan milik user yang sedang login dengan items (eager loading)<br>3. Sistem mengurutkan dari yang terbaru (latest)<br>4. Sistem menampilkan setiap pesanan: nomor pesanan, badge status (color-coded: amber = pending, green = paid, red = cancelled), tanggal, item (nama x quantity + subtotal), total, metode bayar<br>5. Untuk pesanan dengan status pending, ada link "Lihat Petunjuk Pembayaran" |
| Skenario Eksepsional | 2a. Belum pernah order: tampilkan daftar kosong dengan pesan |

### UC-12: Melihat Profil

| Field | Isi |
|-------|-----|
| Nama Usecase | Melihat Profil |
| Deskripsi | Customer melihat informasi akunnya |
| Pre-Kondisi | Customer sudah login |
| Post-Kondisi | Halaman profil ditampilkan |
| Skenario Utama | 1. Customer membuka halaman profil (/profile)<br>2. Sistem menampilkan avatar inisial (huruf pertama dari nama), nama, email, role (Pelanggan), tanggal bergabung (Member Since)<br>3. Link ke riwayat pesanan |
| Skenario Eksepsional | - |

### UC-13: Login Admin

| Field | Isi |
|-------|-----|
| Nama Usecase | Login Admin |
| Deskripsi | Admin masuk ke panel administrasi |
| Pre-Kondisi | Admin membuka halaman /admin/login dan belum login |
| Post-Kondisi | Admin masuk ke dashboard admin |
| Skenario Utama | 1. Admin membuka /admin/login<br>2. Jika sudah login sebagai admin, redirect langsung ke dashboard<br>3. Sistem menampilkan form login admin<br>4. Admin mengisi email & password, menekan "Login"<br>5. Sistem memvalidasi kredensial (Auth::attempt)<br>6. Jika sukses: sistem mengecek field is_admin = true<br>7. Jika admin valid: session diregenerasi, redirect ke dashboard<br>8. Jika bukan admin: logout otomatis, tampilkan error |
| Skenario Eksepsional | 5a. Email/password salah: kembali ke form dengan error<br>6a. User bukan admin (is_admin = false): logout otomatis, error "Anda tidak memiliki akses admin" |

### UC-14: Logout Admin

| Field | Isi |
|-------|-----|
| Nama Usecase | Logout Admin |
| Deskripsi | Admin keluar dari panel administrasi |
| Pre-Kondisi | Admin sudah login |
| Post-Kondisi | Session dihapus, diarahkan ke login admin |
| Skenario Utama | 1. Admin menekan tombol logout di sidebar<br>2. Sistem menghapus session (Auth::logout)<br>3. Sistem menginvalidasi session dan meregenerasi token<br>4. Sistem mengarahkan ke halaman login admin |
| Skenario Eksepsional | - |

### UC-15: Melihat Dashboard Admin

| Field | Isi |
|-------|-----|
| Nama Usecase | Melihat Dashboard Admin |
| Deskripsi | Admin melihat statistik toko |
| Pre-Kondisi | Admin sudah login |
| Post-Kondisi | Halaman dashboard dengan statistik ditampilkan |
| Skenario Utama | 1. Admin membuka halaman dashboard (/admin)<br>2. Sistem menghitung: total produk, total kategori, jumlah best seller, jumlah new arrival<br>3. Sistem mengambil data jumlah produk per kategori (withCount)<br>4. Sistem menampilkan kartu statistik dan bar chart "Produk per Kategori" |
| Skenario Eksepsional | - |

### UC-16: Mengelola Produk

| Field | Isi |
|-------|-----|
| Nama Usecase | Mengelola Produk (CRUD) |
| Deskripsi | Admin melakukan Create, Read, Update, Delete pada data produk |
| Pre-Kondisi | Admin sudah login |
| Post-Kondisi | Data produk berubah sesuai operasi |
| Skenario Utama (Read) | 1. Admin membuka menu Produk<br>2. Sistem menampilkan tabel daftar produk (thumbnail, nama, kategori badge, harga, status, tombol aksi edit/hapus) |
| Skenario Utama (Create) | 1. Admin menekan "Tambah Produk"<br>2. Sistem menampilkan form: nama, deskripsi, harga, kategori (dropdown), gambar (file upload), checkbox best seller & new arrival<br>3. Admin mengisi data + upload gambar lalu submit<br>4. Sistem memvalidasi input (termasuk tipe & ukuran file)<br>5. Sistem menyimpan gambar ke storage public/products<br>6. Sistem membuat record produk baru<br>7. Redirect ke daftar produk dengan notifikasi sukses |
| Skenario Utama (Update) | 1. Admin menekan tombol edit<br>2. Sistem menampilkan form pre-filled dengan data produk<br>3. Admin mengubah data (gambar opsional — jika tidak diupload, gambar lama tetap dipakai)<br>4. Jika upload gambar baru: hapus gambar lama (jika lokal), simpan yang baru<br>5. Redirect dengan notifikasi sukses |
| Skenario Utama (Delete) | 1. Admin menekan tombol hapus<br>2. Konfirmasi melalui dialog data-confirm<br>3. Sistem menghapus file gambar dari storage (jika bukan URL eksternal)<br>4. Sistem menghapus produk dari database<br>5. Redirect dengan notifikasi sukses |
| Skenario Eksepsional | Validasi gagal (gambar > 2MB, format tidak sesuai, field kosong) → kembali ke form dengan error |

### UC-17: Mengelola Kategori

| Field | Isi |
|-------|-----|
| Nama Usecase | Mengelola Kategori (CRUD) |
| Deskripsi | Admin melakukan Create, Read, Update, Delete pada data kategori |
| Pre-Kondisi | Admin sudah login |
| Post-Kondisi | Data kategori berubah sesuai operasi |
| Skenario Utama (Read) | 1. Admin membuka menu Kategori<br>2. Sistem menampilkan grid kartu kategori (icon, nama, jumlah produk, tombol aksi) |
| Skenario Utama (Create) | 1. Admin menekan "Tambah Kategori"<br>2. Form input nama → slug otomatis dibuat dari nama (Str::slug)<br>3. Admin submit<br>4. Sistem menyimpan kategori baru<br>5. Redirect sukses |
| Skenario Utama (Update) | 1. Form pre-filled, admin ubah nama<br>2. Slug otomatis diperbarui<br>3. Sistem update data |
| Skenario Utama (Delete) | 1. Admin menekan tombol hapus<br>2. Sistem mengecek apakah kategori masih memiliki produk (count > 0)<br>3. Jika masih ada produk: redirect dengan error "Kategori tidak bisa dihapus karena masih memiliki produk"<br>4. Jika tidak ada produk: hapus kategori, redirect sukses |
| Skenario Eksepsional | 3a. Kategori masih memiliki produk → hapus ditolak |

---

## A6. Class Diagram (Analisis)

### Entitas dan Atribut

#### 1. User

| Atribut | Tipe Data | Keterangan |
|---------|-----------|------------|
| id | bigInteger (PK) | Auto increment |
| name | string(255) | Nama lengkap |
| email | string(255) | Unique, used for login |
| email_verified_at | timestamp, nullable | Email verification |
| password | string(255) | Hashed (bcrypt) |
| remember_token | string(100), nullable | "Remember me" token |
| is_admin | boolean, default false | Flag admin |
| created_at | timestamp | - |
| updated_at | timestamp | - |

#### 2. Category

| Atribut | Tipe Data | Keterangan |
|---------|-----------|------------|
| id | bigInteger (PK) | Auto increment |
| name | string(255) | Nama kategori |
| slug | string(255) | Unique, auto-generated |
| created_at | timestamp | - |
| updated_at | timestamp | - |

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
| created_at | timestamp | - |
| updated_at | timestamp | - |

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
| created_at | timestamp | - |
| updated_at | timestamp | - |

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
| created_at | timestamp | - |
| updated_at | timestamp | - |

#### 6. CartItem

| Atribut | Tipe Data | Keterangan |
|---------|-----------|------------|
| id | bigInteger (PK) | Auto increment |
| user_id | bigInteger (FK) | → users.id |
| product_id | bigInteger (FK) | → products.id |
| quantity | integer, default 1 | Jumlah |
| created_at | timestamp | - |
| updated_at | timestamp | - |

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
users ──hasMany──> orders ──hasMany──> order_items ──belongsTo──> products
  │                                                │
  └──hasMany──> cart_items ──belongsTo─────────────┘
                    │
                    └──belongsTo──> products

categories ──hasMany──> products
```

---

## A7. Antarmuka Sistem

### Antarmuka Pengguna (Halaman)

#### Customer

| No | Halaman | URL | Deskripsi |
|----|---------|-----|-----------|
| 1 | Beranda | `/` | Hero section, best seller, kategori, new arrival |
| 2 | Katalog Produk | `/products` | Grid produk dengan filter kategori |
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
| 17 | Daftar Kategori | `/admin/categories` | Grid manajemen kategori |
| 18 | Tambah Kategori | `/admin/categories/create` | Form tambah kategori |
| 19 | Edit Kategori | `/admin/categories/{id}/edit` | Form edit kategori |

### Antarmuka Perangkat Keras

| Perangkat | Keterangan |
|-----------|------------|
| **Server** | Komputer / VPS untuk menjalankan aplikasi (minimum PHP 8.3, MySQL, Composer) |
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
| **Geocoding** | Nominatim API (free) | - |
| **API Authentication** | Laravel Sanctum | v4 |
| **Icons** | Heroicons | Inline SVG |
| **Font** | Inter (Bunny Fonts CDN) | - |

### Antarmuka Komunikasi

| Protokol | Penggunaan |
|----------|------------|
| **HTTP / HTTPS** | Komunikasi web browser ke server |
| **JSON** | Format data REST API |
| **Session-based Auth** | Autentikasi web (cookie session) |
| **Token-based Auth** | Autentikasi API (Bearer token via Authorization header) |
| **CSRF Token** | Proteksi form web (Laravel built-in) |
