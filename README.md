# Rinsa Laundry — Setup Guide

> Stack: Laravel 11 + Blade + Vanilla JS + MySQL  
> *Bersih itu tenang.*

---

## Kredensial Demo

| Role  | Email             | Password  |
|-------|-------------------|-----------|
| Admin | admin@rinsa.id    | rinsa123  |
| Kasir | kasir@rinsa.id    | rinsa123  |

**Tracking pelanggan** → `/lacak` (tidak perlu login)

---

## Instalasi Lokal

### 1. Clone & install dependencies

```bash
git clone <repo-url> rinsa
cd rinsa

composer install
npm install
```

### 2. Setup environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env`:
```env
APP_NAME=Rinsa
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rinsa_db
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Buat database & migrate

```bash
mysql -u root -e "CREATE DATABASE rinsa_db;"
php artisan migrate
php artisan db:seed
```

### 4. Jalankan dev server

```bash
npm run dev        # terminal 1 (Vite)
php artisan serve  # terminal 2
```

Buka `http://localhost:8000` → login atau `/lacak` untuk tracking.

---

## Deploy ke Railway

### Persiapan

1. Buat akun di [railway.app](https://railway.app)
2. Tambah service **MySQL** dari dashboard Railway
3. Tambah service **PHP** (pilih template Laravel atau deploy via GitHub)

### Environment Variables di Railway

```
APP_KEY=<generate dengan: php artisan key:generate --show>
APP_ENV=production
APP_DEBUG=false
APP_URL=https://<your-domain>.railway.app

DB_CONNECTION=mysql
DB_HOST=<dari Railway MySQL>
DB_PORT=3306
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=<dari Railway MySQL>
```

### Build Command Railway

```bash
composer install --no-dev --optimize-autoloader && \
npm install && npm run build && \
php artisan migrate --force && \
php artisan db:seed --force && \
php artisan config:cache && \
php artisan route:cache && \
php artisan view:cache
```

---

## Struktur Project

```
rinsa/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php        ← Login/logout
│   │   │   ├── DashboardController.php   ← Dashboard summary
│   │   │   ├── OrderController.php       ← CRUD order + status log
│   │   │   ├── CustomerController.php    ← CRUD pelanggan
│   │   │   ├── ReportController.php      ← Laporan & filter periode
│   │   │   └── TrackingController.php    ← Public tracking
│   │   └── Middleware/
│   │       └── EnsureUserIsActive.php    ← Block user nonaktif
│   └── Models/
│       ├── User.php
│       ├── Customer.php
│       ├── Order.php                     ← PRICE_MAP, STATUS_FLOW, helpers
│       └── OrderStatusLog.php            ← Audit trail setiap ganti status
│
├── database/
│   ├── migrations/                       ← 4 migrations
│   └── seeders/
│       └── DatabaseSeeder.php            ← Demo data lengkap
│
├── resources/
│   ├── css/app.css                       ← Brand styles Rinsa (no Tailwind)
│   ├── js/app.js
│   └── views/
│       ├── layouts/app.blade.php         ← Main authenticated layout
│       ├── auth/login.blade.php
│       ├── admin/
│       │   ├── dashboard.blade.php
│       │   ├── report.blade.php
│       │   ├── orders/{index,create,edit,show}.blade.php
│       │   └── customers/{index,create,edit}.blade.php
│       └── tracking/
│           ├── index.blade.php           ← Public tracking form
│           └── result.blade.php          ← Hasil tracking + timeline
│
├── routes/web.php                        ← Semua routes
└── bootstrap/app.php                     ← Middleware alias registration
```

---

## Fitur

| Fitur | Status |
|-------|--------|
| Login / logout dengan session | ✅ |
| Guard: block user nonaktif | ✅ |
| Dashboard metrik real-time | ✅ |
| CRUD Order + kalkulasi harga otomatis | ✅ |
| Status log / audit trail per order | ✅ |
| CRUD Pelanggan | ✅ |
| Search & filter order | ✅ |
| Laporan dengan filter periode | ✅ |
| Tracking publik (tanpa login) | ✅ |
| Responsive mobile (bottom nav) | ✅ |
| Pagination | ✅ |
| Flash messages auto-dismiss | ✅ |

---

## Harga Layanan (edit di `app/Models/Order.php`)

```php
public const PRICE_MAP = [
    'cuci_kering'  => 6000,   // per kg
    'cuci_setrika' => 8000,   // per kg
    'express'      => 12000,  // per kg
];
```
