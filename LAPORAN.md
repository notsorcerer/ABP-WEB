# LAPORAN FINAL PROJECT — LIQUIDPEDIA

**Web E-Commerce (Laravel) + Aplikasi Mobile (Flutter)**

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

3. [BAB 3 — FITUR & FUNGSIONALITAS APLIKASI](#bab-3--fitur--fungsionalitas-aplikasi)
   - 3.1 Fitur untuk Customer
   - 3.2 Fitur untuk Admin
   - 3.3 Perbandingan Platform Web & Mobile
   - 3.4 REST API Endpoints
   - 3.5 Struktur Database
   - 3.6 Arsitektur Sistem

4. [BAB 4 — IMPLEMENTASI](#bab-4--implementasi)
   - 4.1 Lingkungan Pengembangan
   - 4.2 Implementasi Backend (Laravel)
   - 4.3 Implementasi Frontend Web
   - 4.4 Implementasi Aplikasi Mobile
   - 4.5 Integrasi Web & Mobile

5. [BAB 5 — PENGUJIAN](#bab-5--pengujian)
   - 5.1 Pengujian Web
   - 5.2 Pengujian Mobile
   - 5.3 Pengujian API

6. [BAB 6 — PENUTUP](#bab-6--penutup)
   - 6.1 Kesimpulan
   - 6.2 Saran

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
1. Pengguna login/register server membuat token baru
2. Token dikembalikan ke Flutter dan disimpan di encrypted storage
3. Setiap request API menyertakan token di header `Authorization: Bearer <token>`
4. Server memvalidasi token melalui middleware `auth:sanctum`

## 2.5 Provider (State Management)

Provider adalah state management pattern untuk Flutter yang direkomendasikan oleh tim Flutter. Provider menggunakan konsep ChangeNotifier dan Consumer untuk memisahkan logika bisnis dari tampilan UI.

Dalam LiquidPedia, terdapat 5 provider:
- **AuthProvider**: manajemen autentikasi pengguna
- **ProductProvider**: data produk dan kategori
- **CartProvider**: data keranjang belanja
- **OrderProvider**: data pesanan
- **AdminProvider**: data panel administrasi

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

# BAB 3 — FITUR & FUNGSIONALITAS APLIKASI

## 3.1 Fitur untuk Customer

Berikut adalah fitur yang tersedia untuk customer pada platform web dan mobile:

**Registrasi & Login** — Customer dapat mendaftar akun baru atau login via session-based auth (web) atau token-based Sanctum (mobile).

**Beranda** — Menampilkan hero banner gradien merah, 4 produk Best Seller, 2 kartu kategori (Vape & Liquid), banner promosi, 4 produk New Arrival, dan cart badge real-time (mobile).

**Katalog Produk** — Grid produk dengan filter kategori, pencarian nama (debounce 500ms di mobile), dan infinite scroll (mobile).

**Detail Produk** — Informasi lengkap: gambar, harga, badge kategori/Best Seller/New Arrival, tabel info (Kategori, Status Stok, Garansi), deskripsi, quantity selector, dan tombol Add to Cart.

**Keranjang Belanja** — Kelola item cart (tambah/ubah/hapus quantity), subtotal per item, grand total. Web: berbasis session (tanpa login). Mobile: berbasis database (harus login).

**Checkout + Location Picker** — Form data pengiriman (9 field), peta interaktif OpenStreetMap (Leaflet.js di web, flutter_map di mobile) dengan fitur forward geocoding, drag/tap marker, reverse geocoding, dan deteksi lokasi otomatis. Metode pembayaran: Transfer Bank (BCA, Mandiri, BRI, BNI), E-Wallet (GoPay, OVO, Dana), QRIS, COD.

**Konfirmasi Pembayaran** — Invoice (nomor: INV/YYYYMMDD/RANDOM6), status bayar, daftar item, total, alamat kirim, instruksi bayar sesuai metode, tombol WhatsApp, dan copy-to-clipboard (mobile).

**Riwayat Pesanan** — Daftar pesanan terbaru dengan status badge color-coded, item, total, metode bayar, tombol petunjuk bayar & batalkan untuk status pending.

**Profil** — Informasi akun (nama, email, avatar inisial), tautan ke pesanan dan logout.

**Screenshot:** Halaman Login Web
**Screenshot:** Halaman Login Mobile
**Screenshot:** Halaman Beranda Web
**Screenshot:** Halaman Beranda Mobile
**Screenshot:** Katalog Produk Web
**Screenshot:** Katalog Produk Mobile
**Screenshot:** Detail Produk Web
**Screenshot:** Detail Produk Mobile
**Screenshot:** Keranjang Belanja Web
**Screenshot:** Keranjang Belanja Mobile
**Screenshot:** Checkout Web (form + location picker)
**Screenshot:** Checkout Mobile (form + location picker)
**Screenshot:** Location Picker Web (Leaflet.js)
**Screenshot:** Location Picker Mobile (flutter_map)
**Screenshot:** Konfirmasi Pembayaran Web
**Screenshot:** Konfirmasi Pembayaran Mobile
**Screenshot:** Riwayat Pesanan Web
**Screenshot:** Riwayat Pesanan Mobile
**Screenshot:** Detail Pesanan Mobile
**Screenshot:** Halaman Profil Mobile

## 3.2 Fitur untuk Admin

Berikut adalah fitur yang tersedia untuk admin pada platform web dan mobile:

**Dashboard** — Menampilkan statistik toko: total produk, total kategori, jumlah best seller, jumlah new arrival, dan jumlah produk per kategori.

**Manajemen Produk (CRUD)** — Tambah (form + upload gambar max 2MB, jpeg/png/jpg/gif/webp + toggle best seller/new arrival), lihat (tabel dengan thumbnail), edit (form pre-filled, gambar opsional), hapus (konfirmasi, gambar ikut terhapus).

**Manajemen Kategori (CRUD)** — Tambah (nama, slug otomatis), lihat (grid dengan jumlah produk), edit (ubah nama), hapus (dicegah jika kategori masih memiliki produk).

**Manajemen Pesanan** — Lihat semua pesanan, filter status pembayaran, update status (lunas / batalkan).

**Screenshot:** Admin Dashboard Web
**Screenshot:** Admin Dashboard Mobile
**Screenshot:** Admin Produk List Web
**Screenshot:** Admin Produk Form Web
**Screenshot:** Admin Produk List Mobile
**Screenshot:** Admin Produk Form Mobile
**Screenshot:** Admin Kategori Web
**Screenshot:** Admin Kategori Mobile
**Screenshot:** Admin Pesanan Web
**Screenshot:** Admin Pesanan Mobile

## 3.3 Perbandingan Platform Web & Mobile

| Fitur | Web | Mobile |
|-------|-----|--------|
| Autentikasi | Session-based | Token-based (Sanctum) |
| Cart | Session (tanpa login) | Database (harus login) |
| Search | Filter kategori + search | Search debounce 500ms |
| Location Picker | Leaflet.js | flutter_map |
| Cart Badge | Badge di navbar (session) | Badge real-time dari API |
| Admin Panel | Blade views | Flutter screens |
| Animasi | Hover CSS | Fade-in + SlideTransition |
| Payment Copy | Manual select + copy | Tap to copy (clipboard) |
| Pagination | Page load | Infinite scroll |
| Cancel Order | URL dengan konfirmasi | Dialog + API call |

## 3.4 REST API Endpoints

Aplikasi mobile terhubung ke backend melalui 20 REST API endpoint yang dibagi dalam tiga kategori:

**Public Endpoints (tanpa token):**
| Method | Endpoint | Fungsi |
|--------|----------|--------|
| POST | /api/auth/register | Registrasi akun |
| POST | /api/auth/login | Login |
| GET | /api/products | List produk + filter + search |
| GET | /api/products/home | Data beranda |
| GET | /api/products/{id} | Detail produk |
| GET | /api/categories | List kategori |

**Protected Endpoints (Sanctum):**
| Method | Endpoint | Fungsi |
|--------|----------|--------|
| POST | /api/auth/logout | Hapus token |
| GET | /api/auth/user | Profil user |
| GET | /api/cart | Lihat cart |
| POST | /api/cart/{product} | Tambah ke cart |
| PUT | /api/cart/{product} | Update quantity |
| DELETE | /api/cart/{product} | Hapus dari cart |
| GET | /api/orders | Riwayat pesanan |
| GET | /api/orders/{id} | Detail pesanan |
| POST | /api/orders | Buat pesanan |
| PUT | /api/orders/{id}/cancel | Batalkan pesanan |
| GET | /api/orders/{id}/payment | Instruksi bayar |

**Admin Endpoints (Sanctum + is_admin check):**
| Method | Endpoint | Fungsi |
|--------|----------|--------|
| GET | /api/admin/dashboard | Statistik dashboard |
| GET/POST | /api/admin/products | List / tambah produk |
| PUT/DELETE | /api/admin/products/{id} | Edit / hapus produk |
| GET/POST | /api/admin/categories | List / tambah kategori |
| PUT/DELETE | /api/admin/categories/{id} | Edit / hapus kategori |
| GET | /api/admin/orders | List pesanan |
| GET | /api/admin/orders/{id} | Detail pesanan |
| PUT | /api/admin/orders/{id}/payment-status | Update status bayar |

Format respons JSON standar:
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

## 3.5 Struktur Database

Terdapat 6 tabel utama dalam database LiquidPedia:

| Tabel | Kolom Penting | Relasi |
|-------|--------------|--------|
| **users** | id, name, email, password, is_admin | hasMany orders, hasMany cart_items |
| **categories** | id, name, slug (unique) | hasMany products |
| **products** | id, name, description, price, category_id, image, is_best_seller, is_new_arrival | belongsTo category |
| **orders** | id, user_id, order_number (unique), shipping_*, payment_method, payment_status, total | belongsTo user, hasMany order_items |
| **order_items** | id, order_id, product_id, product_name, quantity, price, subtotal | belongsTo order, belongsTo product |
| **cart_items** | id, user_id, product_id, quantity, unique(user_id, product_id) | belongsTo user, belongsTo product |

Order number format: `INV/YYYYMMDD/RANDOM6` (contoh: `INV/20260628/A3B7C9`)

## 3.6 Arsitektur Sistem

LiquidPedia menggunakan arsitektur Client-Server. Server Laravel melayani dua jenis klien: web browser (melalui Blade views) dan aplikasi mobile Flutter (melalui REST API).

```
Web Browser (Blade + JS)      Flutter App (Android)
         |                            |
         +-------- HTTP/JSON ---------+
                      |
              Laravel Server
         - Web Controllers (Blade)
         - API Controllers (JSON)
         - Eloquent ORM
         - Sanctum Auth
                      |
                MySQL Database
```

**Lapisan pada server:**
- **Router**: Memetakan URL ke controller yang sesuai (routes/web.php, routes/api.php)
- **Controller**: Menerima request, menjalankan logika bisnis, mengembalikan response
- **Model**: Representasi data dan logika relasi
- **View (Web)**: Template Blade untuk rendering HTML
- **Middleware**: Autentikasi, CORS, admin check
- **Database**: MySQL dengan migration

**Lapisan pada mobile:**
- **ApiService**: Dio HTTP client dengan token interceptor
- **Repository**: Layer akses data untuk setiap entitas
- **Provider**: State management (ChangeNotifier)
- **Screen**: Halaman aplikasi (Widget tree)
- **Widget**: Komponen reusable

---

# BAB 4 — IMPLEMENTASI

## 4.1 Lingkungan Pengembangan

| Perangkat | Spesifikasi |
|-----------|-------------|
| Sistem Operasi | Windows 11 |
| PHP | 8.3+ |
| Laravel | ^13.8 |
| Flutter | 3.41+ |
| Dart | 3.11+ |
| Database | MySQL 5.7+ |
| Web Server | Built-in (`php artisan serve`) |

## 4.2 Implementasi Backend (Laravel)

### 4.2.1 Struktur Proyek

```
liquid/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/              # Web admin controllers
│   │   │   ├── Api/
│   │   │   │   └── Admin/          # API admin controllers
│   │   │   ├── AuthController.php   # Web auth
│   │   │   ├── CartController.php   # Web cart
│   │   │   ├── HomeController.php   # Web home
│   │   │   └── ProductController.php# Web produk
│   │   ├── Resources/
│   │   │   ├── ProductResource.php  # Format API produk
│   │   │   └── OrderResource.php    # Format API pesanan
│   └── Models/                      # 6 model (User, Category, Product, Order, OrderItem, CartItem)
├── bootstrap/app.php                # CORS + middleware
├── config/cors.php                  # CORS config
├── database/migrations/             # 6 migration files
├── resources/views/                 # Blade templates
├── routes/
│   ├── web.php                      # 18 web routes
│   └── api.php                      # 20 API routes
└── storage/app/public/products/     # Product images
```

### 4.2.2 Model & Relasi

Enam model Eloquent merepresentasikan entitas database. Relasi antar model:
- **User**: `hasMany(Order)`, `hasMany(CartItem)`
- **Category**: `hasMany(Product)`
- **Product**: `belongsTo(Category)`, accessor `getImageUrlAttribute()`
- **Order**: `belongsTo(User)`, `hasMany(OrderItem)`, accessor status label
- **OrderItem**: `belongsTo(Order)`, `belongsTo(Product)`
- **CartItem**: `belongsTo(User)`, `belongsTo(Product)`

Accessor gambar produk adalah komponen penting yang memastikan URL gambar dapat diakses dari web dan mobile:
```php
public function getImageUrlAttribute(): string
{
    if (Str::startsWith($this->image, 'http')) {
        return $this->image;
    }
    return Storage::disk('public')->url($this->image);
}
```

### 4.2.3 CORS Configuration

Karena Flutter membuat request dari origin yang berbeda, CORS dikonfigurasi di `bootstrap/app.php` dan `config/cors.php`:
```php
// config/cors.php
'allowed_origins' => ['*'],
'allowed_methods' => ['*'],
'allowed_headers' => ['*'],
```

```php
// bootstrap/app.php - middleware API
->withMiddleware(function (Middleware $middleware) {
    $middleware->api(prepend: [
        \Illuminate\Http\Middleware\HandleCors::class,
    ]);
})
```

## 4.3 Implementasi Frontend Web

Frontend web menggunakan Blade templating engine dengan Tailwind CSS untuk styling. Struktur view:

```
resources/views/
├── layouts/app.blade.php           # Layout utama (navbar, footer, cart badge, WA float)
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
├── components/location-picker.blade.php  # Leaflet component
└── admin/
    ├── login.blade.php
    ├── dashboard.blade.php
    ├── products/index.blade.php, create.blade.php, edit.blade.php
    └── categories/index.blade.php, create.blade.php, edit.blade.php
```

**Location Picker** adalah komponen utama yang diimplementasikan menggunakan Leaflet.js. Komponen ini menyediakan:
- Search bar dengan debounce 300ms (Nominatim API)
- Peta interaktif dengan marker draggable
- Reverse geocoding otomatis
- Tombol "Gunakan Lokasi Saya" (browser geolocation)
- Modal interaktif yang reusable

## 4.4 Implementasi Aplikasi Mobile

### 4.4.1 Struktur Proyek

```
Mobile_liquid/lib/
├── main.dart                       # Entry point + MultiProvider
├── config/
│   ├── api_config.dart             # Base URL API
│   ├── theme.dart                  # Tema LiquidPedia
│   └── routes.dart                 # Route constants
├── services/
│   └── api_service.dart            # Dio + Token Interceptor
├── models/                         # 7 model class
├── repositories/                   # 5 repository
├── providers/                      # 5 provider (ChangeNotifier)
├── views/
│   ├── splash_screen.dart
│   ├── auth/ (login, register)
│   ├── home/ (beranda + bottom nav)
│   ├── products/ (list, detail)
│   ├── cart/
│   ├── checkout/ (form + map)
│   ├── orders/ (list, detail)
│   ├── profile/
│   └── admin/ (dashboard, product CRUD, category CRUD, order management)
└── widgets/
    ├── product_card.dart           # Card dengan badge + add-to-cart mini
    ├── loading_widget.dart
    ├── location_picker.dart        # flutter_map
    └── payment_method_picker.dart
```

### 4.4.2 ApiService dengan Dio

ApiService mengelola semua komunikasi HTTP dengan backend:
```dart
class ApiService {
  late final Dio _dio;

  ApiService() {
    _dio = Dio(BaseOptions(
      baseUrl: '${ApiConfig.baseUrl}${ApiConfig.apiPrefix}',
      timeout: ApiConfig.timeout,
      headers: {'Accept': 'application/json'},
    ));

    _dio.interceptors.add(InterceptorsWrapper(
      onRequest: (options, handler) async {
        final token = await storage.read(key: 'auth_token');
        if (token != null) {
          options.headers['Authorization'] = 'Bearer $token';
        }
        handler.next(options);
      },
    ));
  }
}
```

### 4.4.3 State Management (Provider)

MultiProvider di main.dart mendaftarkan 5 provider yang masing-masing mengelola state dan terhubung ke repository:
- **AuthProvider**: user, isLoggedIn, login(), register(), logout(), checkAuth()
- **ProductProvider**: bestSellers, newArrivals, categories, products, loadHomeData(), loadProducts(), loadProductDetail()
- **CartProvider**: items, total, totalItems, loadCart(), addToCart(), updateQuantity()
- **OrderProvider**: orders, selectedOrder, loadOrders(), createOrder(), cancelOrder()
- **AdminProvider**: dashboardStats, CRUD methods untuk produk, kategori, orders

### 4.4.4 Halaman Customer Mobile

**HomeScreen:** BottomNavigationBar dengan 3 tab (Beranda, Pesanan, Profil). Beranda menampilkan hero banner gradien merah, category cards horizontal, best seller row, promo banner, new arrivals row. Cart badge di AppBar real-time dari CartProvider.totalItems. Entry animations menggunakan AnimatedOpacity dan SlideTransition.

**ProductListScreen:** GridView 2 kolom dengan ProductCard. Search bar dengan debounce 500ms. Infinite scroll pagination dengan pull-to-refresh.

**ProductDetailScreen:** Gambar full-width, info produk, info table (Kategori, Status, Garansi) dengan icon. Quantity selector (+/-) dan tombol Add to Cart.

**CartScreen:** Item list dengan quantity +/- dan delete. "Lanjut Belanja" link. Bottom bar total harga + checkout button.

**CheckoutScreen:** Form 9 field data pengiriman. LocationPicker dengan flutter_map (tap/drag marker, pusatkan tombol). PaymentMethodPicker (4 metode). Error handling menampilkan pesan asli dari API.

**OrderListScreen:** Card untuk setiap pesanan. Tombol "Petunjuk" dan "Batalkan" untuk pending orders. Infinite scroll pagination.

**OrderDetailScreen:** Informasi lengkap pesanan. Payment instructions dengan copy-to-clipboard. Tombol WhatsApp. Cancel button untuk pending.

### 4.4.5 Halaman Admin Mobile

**AdminDashboardScreen:** Grid statistik 4 kartu. List produk per kategori. Menu navigasi ke CRUD produk, kategori, orders.

**AdminProductListScreen:** Search, list dengan tap to edit, delete with confirmation, FAB add.

**AdminProductFormScreen:** Image picker (gallery), form fields, best seller/new arrival switches, create/edit mode.

**AdminCategoryListScreen:** List + product count, delete protection, FAB add.

**AdminOrderListScreen:** Filter chips (Semua/Menunggu/Lunas/Dibatalkan), order list.

**AdminOrderDetailScreen:** Info customer, items, shipping, update payment status.

## 4.5 Integrasi Web & Mobile

### 4.5.1 Alur Autentikasi Mobile

1. Login/register POST /api/auth/login atau /api/auth/register
2. Server membuat token via `$user->createToken('mobile-app')`
3. Response: `{ user: {...}, token: "1|abc123..." }`
4. Flutter menyimpan token di FlutterSecureStorage (encrypted)
5. Setiap request Dio interceptor membaca token dan menambahkan header Authorization
6. Logout: POST /api/auth/logout revoke token, hapus dari storage

### 4.5.2 Upload & Serving Gambar

**Upload:**
1. File dikirim via multipart form (web: input file, mobile: image_picker gallery)
2. Laravel: `$request->file('image')->store('products', 'public')`
3. File tersimpan di `storage/app/public/products/hash.webp`
4. Symlink `public/storage` ke `storage/app/public` (`php artisan storage:link`)

**Serving:**
1. Model accessor: `Storage::disk('public')->url($this->image)`
2. Menghasilkan full URL: `http://IP:8000/storage/products/hash.webp`
3. Web: `<img src="{{ $product->image_url }}">`
4. Mobile: `CachedNetworkImage(imageUrl: product.imageUrl)`

**Catatan:** `APP_URL` di `.env` harus diset ke IP laptop (misal `http://192.168.0.110:8000`) agar gambar bisa diakses dari perangkat lain di jaringan yang sama.

---

# BAB 5 — PENGUJIAN

## 5.1 Pengujian Web

| No | Fitur | Skenario | Hasil |
|----|-------|----------|-------|
| 1 | Registrasi | Mendaftar dengan data valid | Berhasil |
| 2 | Registrasi | Mendaftar dengan email sudah terdaftar | Error validasi |
| 3 | Login | Login dengan kredensial valid | Berhasil |
| 4 | Beranda | Menampilkan hero, best seller, kategori, new arrival | Berhasil |
| 5 | Katalog | Grid produk + filter kategori | Berhasil |
| 6 | Detail Produk | Info lengkap + quantity selector | Berhasil |
| 7 | Keranjang | Tambah/ubah/hapus item | Berhasil |
| 8 | Checkout | Form + Leaflet map + metode bayar | Berhasil |
| 9 | Location Picker | Search, drag marker, reverse geocode | Berhasil |
| 10 | Buat Pesanan | Checkout sukses | Berhasil |
| 11 | Konfirmasi Bayar | Instruksi sesuai metode bayar | Berhasil |
| 12 | Riwayat Pesanan | Daftar pesanan user | Berhasil |
| 13 | Login Admin | Login dengan akun admin | Berhasil |
| 14 | Dashboard Admin | Statistik tampil | Berhasil |
| 15 | CRUD Produk | Tambah/edit/hapus produk | Berhasil |
| 16 | CRUD Kategori | Tambah/edit/hapus kategori | Berhasil |

## 5.2 Pengujian Mobile

| No | Fitur | Skenario | Hasil |
|----|-------|----------|-------|
| 1 | Auto-Login | Splash cek token valid | Berhasil |
| 2 | Login | Login dengan kredensial valid | Berhasil |
| 3 | Register | Mendaftar akun baru | Berhasil |
| 4 | Home | Hero, kategori, best seller, new arrival, animasi | Berhasil |
| 5 | Cart Badge | Badge real-time mengikuti cart | Berhasil |
| 6 | Search Produk | Search dengan debounce 500ms | Berhasil |
| 7 | Detail Produk | Info table, quantity, add to cart | Berhasil |
| 8 | Cart | Quantity +/- , delete, total | Berhasil |
| 9 | Checkout | Form + flutter_map + metode bayar | Berhasil |
| 10 | Location Picker | Tap/drag marker, tombol pusatkan | Berhasil |
| 11 | Buat Pesanan | Checkout sukses | Berhasil |
| 12 | Cancel Order | Batalkan pesanan pending | Berhasil |
| 13 | Copy Payment | Copy nomor ke clipboard | Berhasil |
| 14 | Order History | List, pagination, status filter | Berhasil |
| 15 | Admin Dashboard | Statistik, menu CRUD | Berhasil |
| 16 | Admin Produk | CRUD + upload gambar | Berhasil |
| 17 | Admin Kategori | CRUD + proteksi delete | Berhasil |
| 18 | Admin Order | List, filter, update status | Berhasil |
| 19 | Logout | Hapus token, redirect login | Berhasil |
| 20 | Gambar Produk | Load dari storage via IP | Berhasil |

## 5.3 Pengujian API

| No | Method | Endpoint | Status | Hasil |
|----|--------|----------|--------|-------|
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

**Temuan selama pengujian:**
1. **Gambar tidak muncul di mobile** — `Storage::url()` mengembalikan relative path. Solusi: ganti ke `Storage::disk('public')->url()` untuk full URL.
2. **Right overflow OrderDetailScreen** — Nomor panjang. Solusi: `Expanded` + `TextOverflow.ellipsis`.
3. **Gesture conflict flutter_map** — Scroll bentrok. Solusi: `GestureDetector(onVerticalDragUpdate)` + `InteractionOptions`.
4. **Dua server PHP bentrok** — Port 8000 dipakai dua proses. Solusi: matikan semua proses PHP lalu start ulang.

---

# BAB 6 — PENUTUP

## 6.1 Kesimpulan

Berdasarkan hasil analisis, perancangan, implementasi, dan pengujian yang telah dilakukan, dapat disimpulkan:

1. LiquidPedia berhasil diimplementasikan sebagai platform e-commerce khusus liquid dan vape dalam dua platform: aplikasi web (Laravel + Blade + Tailwind CSS) dan aplikasi mobile (Flutter + Provider + Dio). Seluruh fitur fungsional berjalan sesuai dengan yang direncanakan.

2. Integrasi antara aplikasi mobile dengan backend Laravel berjalan dengan baik menggunakan REST API yang dilindungi Laravel Sanctum. Format response JSON yang konsisten memudahkan parsing data di sisi mobile.

3. Fitur location picker berhasil diimplementasikan pada kedua platform menggunakan Leaflet.js (web) dan flutter_map (mobile) dengan OpenStreetMap sebagai penyedia peta. Nominatim API digunakan untuk geocoding dan reverse geocoding.

4. Panel administrasi berhasil diimplementasikan pada web (Blade) dan mobile (Flutter) mencakup dashboard statistik, CRUD produk, CRUD kategori, dan manajemen pesanan.

5. Aplikasi web menggunakan session-based authentication dengan cart berbasis session, sedangkan aplikasi mobile menggunakan token-based authentication dengan cart berbasis database.

## 6.2 Saran

Untuk pengembangan lebih lanjut, beberapa saran yang dapat diberikan:

1. **Integrasi Payment Gateway** — Menggunakan layanan seperti Midtrans atau Xendit untuk proses pembayaran otomatis dan real-time.

2. **Notifikasi Push** — Menambahkan Firebase Cloud Messaging (FCM) untuk memberi tahu customer tentang perubahan status pesanan.

3. **Fitur Review & Rating** — Memungkinkan customer memberikan ulasan pada produk yang telah dibeli.

4. **Fitur Wishlist** — Memungkinkan customer menyimpan produk favorit untuk dibeli nanti.

5. **Sistem Ekspedisi/Resi** — Integrasi dengan API ekspedisi untuk pelacakan pengiriman otomatis.

6. **Versi iOS** — Mengembangkan aplikasi mobile untuk platform iOS.

---

# DAFTAR PUSTAKA

1. Laravel Documentation. (2025). Laravel 13.x Documentation. https://laravel.com/docs/13.x
2. Flutter Documentation. (2025). Flutter SDK Documentation. https://docs.flutter.dev
3. MySQL Documentation. (2025). MySQL 5.7 Reference Manual. https://dev.mysql.com/doc/refman/5.7/en/
4. Tailwind CSS Documentation. (2025). Tailwind CSS v4. https://tailwindcss.com/docs
5. Leaflet.js Documentation. (2025). Leaflet - a JavaScript library for interactive maps. https://leafletjs.com/reference.html
6. OpenStreetMap Contributors. (2025). OpenStreetMap. https://www.openstreetmap.org/
7. Nominatim Documentation. (2025). Nominatim Usage Policy. https://operations.osmfoundation.org/policies/nominatim/
8. flutter_map Documentation. (2025). flutter_map - OpenStreetMap package for Flutter. https://docs.fleaflet.dev/
9. Provider Package. (2025). provider - State management for Flutter. https://pub.dev/packages/provider
10. Dio Package. (2025). Dio - HTTP client for Dart. https://pub.dev/packages/dio
11. Laravel Sanctum. (2025). Laravel Sanctum Documentation. https://laravel.com/docs/13.x/sanctum
