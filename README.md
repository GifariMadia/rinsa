# Developer Installation Guide - Rinsa Laundry

Dokumen ini adalah panduan komprehensif langkah demi langkah bagi developer untuk melakukan instalasi, setup, dan *running* proyek **Rinsa Laundry** di lingkungan lokal dari nol hingga proyek berjalan penuh (100% *ready* tanpa error).

---

## 🛠 1. Prasyarat Sistem (Prerequisites)
Pastikan sistem operasi Anda (Windows/Mac/Linux) telah terinstal program berikut:
- **PHP** (Minimal versi 8.2)
- **Composer** (Minimal versi 2.x)
- **Node.js** (Minimal versi 18.x) dan **NPM**
- **MySQL Server** (Dapat menggunakan XAMPP, Laragon, MAMP, atau MySQL Community)
- **Git**

Untuk memverifikasi kesiapan sistem, jalankan perintah ini di terminal Anda:
```bash
php -v
composer -V
node -v
npm -v
mysql -V
```

---

## 🚀 2. Kloning Repositori
Clone proyek ke dalam direktori server lokal Anda (misalnya di folder `htdocs` jika memakai XAMPP, atau `www` jika memakai Laragon).

```bash
git clone https://github.com/GifariMadia/rinsa.git
cd rinsa
```

---

## 📦 3. Instalasi Dependensi (Backend & Frontend)
Proyek ini menggabungkan backend Laravel dan frontend Vite (Vanilla JS). Anda harus menginstal dependensi untuk keduanya.

```bash
# Instal dependensi backend PHP (vendor folder)
composer install

# Instal dependensi Node.js / Frontend (node_modules folder)
npm install
```

---

## ⚙️ 4. Konfigurasi Environment (File .env)
Buat salinan file `.env` dari template yang sudah disediakan.

```bash
cp .env.example .env
```

Buat **App Key** unik untuk mengamankan enkripsi session sistem:
```bash
php artisan key:generate
```

Buka file `.env` di text editor (seperti VS Code) dan sesuaikan bagian `DB_` (Database). Pastikan nilainya cocok dengan lokal Anda:
```env
APP_NAME="Rinsa Laundry"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rinsa_db     # Nama database (akan kita buat di langkah 5)
DB_USERNAME=root         # Username default XAMPP/Laragon
DB_PASSWORD=             # Kosongkan jika XAMPP default, atau isi jika ada password
```

---

## 🗄️ 5. Setup Database & Seeding (Penting!)
Pastikan layanan MySQL Anda menyala. Buat database kosong baru bernama `rinsa_db` (bisa lewat phpMyAdmin, DBeaver, atau Command Line).

Jika membuat via Command Line (CLI):
```bash
mysql -u root -p -e "CREATE DATABASE rinsa_db;"
```

Setelah database siap, buat seluruh tabel dan isi dengan **Data Dummy (Seeder)** agar aplikasi langsung "penuh" dengan data akun admin, pelanggan, tipe harga, dan transaksi.
```bash
# Menjalankan migrasi tabel sekaligus mengisi data seeder
php artisan migrate:fresh --seed
```

---

## 🔗 6. Tautan Penyimpanan (Storage Link)
Laravel menyimpan file upload (seperti foto/dokumen jika ada) di folder internal. Jalankan perintah ini agar file tersebut bisa diakses publik (dari folder `public` ke `storage/app/public`):
```bash
php artisan storage:link
```

---

## 🏃 7. Menjalankan Aplikasi (Development)
Untuk menjalankan aplikasi ini secara maksimal di lokal dengan fitur *Hot Module Replacement* (HMR), Anda perlu menjalankan **dua terminal terpisah** di dalam folder `rinsa`.

**Terminal 1 (Menjalankan server Laravel):**
```bash
php artisan serve
```
*(Terminal ini akan membuat server backend berjalan di: `http://127.0.0.1:8000`)*

**Terminal 2 (Menjalankan Vite asset bundler):**
```bash
npm run dev
```
*(Terminal ini bertugas memonitor dan meng-compile setiap ada perubahan pada CSS/JS secara live)*

Buka browser Anda dan akses **`http://localhost:8000`**. Proyek kini berjalan penuh!

---

## 🔐 8. Kredensial Login Bawaan (Hasil Seeder)
Gunakan 3 akun bawaan di bawah ini untuk menguji masing-masing hak akses (Role-Based Access) ke dalam sistem:

- **Login Admin**:
  - Email: `admin@rinsa.id`
  - Password: `rinsa123`
- **Login Kasir**:
  - Email: `kasir@rinsa.id`
  - Password: `rinsa123`
- **Login Customer**:
  - Email: `customer@rinsa.id`
  - Password: `rinsa123`

Untuk pengujian halaman publik pelanggan (tanpa login), Anda bisa langsung mengakses rute pelacakan: **`http://localhost:8000/lacak`**.

---

## 🏗️ 9. Persiapan Rilis Server (Production Build)
Jika proyek sudah siap di-deploy (misalnya ke VPS atau Railway), *matikan* perintah `npm run dev`, lalu jalankan serangkaian perintah *build & cache* ini agar performa maksimal:

```bash
# 1. Compile CSS dan JS menjadi file statis (minified)
npm run build

# 2. Hapus dependensi developer (khusus untuk upload)
composer install --no-dev --optimize-autoloader

# 3. Optimasi Cache Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

---

## 💡 10. Troubleshooting (Penyelesaian Masalah)
Jika Anda mengalami *error*, cek kemungkinan berikut:
- **Error `No supported encrypter found`**: Anda lupa menjalankan `php artisan key:generate`.
- **Error `Connection refused` (Terkait Database)**: Pastikan aplikasi MySQL/XAMPP sudah *Running* / *Start*.
- **Tampilan UI hancur / CSS tidak termuat**: Pastikan Terminal 2 (`npm run dev`) sedang menyala. Jika Anda tidak ingin membiarkan terminal nyala terus, jalankan saja `npm run build` sekali.
- **Error `Permission denied` pada Mac/Linux**: Jalankan perintah perizinan direktori berikut: `chmod -R 775 storage bootstrap/cache`
