# Sistem Bantuan Sosial - SEJAHTERA

Aplikasi web berbasis Laravel untuk sistem bantuan sosial dengan Role-Based Access Control (RBAC) yang mencakup Admin, Staff, dan Guest.

## Fitur Utama

- **Authentication & Authorization**: Login, register, dan RBAC dengan 3 role (Admin, Staff, Guest)
- **Manajemen Donasi**: CRUD donasi dengan validasi oleh Staff/Admin
- **Manajemen Bansos**: CRUD bantuan sosial dengan upload gambar
- **Dashboard**: Dashboard berbeda untuk setiap role
- **Laporan**: Laporan donasi untuk Admin dan Staff
- **Public Access**: Halaman publik untuk Guest dengan search dan filter

## Persyaratan Sistem

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL atau database lainnya yang didukung Laravel
- Web server (Apache/Nginx) atau Laragon/XAMPP untuk lokal

## Instalasi dan Setup

### 1. Clone Repository
```bash
git clone <repository-url>
cd ProjectAkhir_BPF-main
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Environment Setup
```bash
cp .env.example .env
```

Edit file `.env` dan sesuaikan konfigurasi database:
```env
APP_NAME="SEJAHTERA"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sejahtera_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Database Setup
```bash
php artisan migrate
php artisan db:seed
```

### 6. Build Assets
```bash
npm run build
# atau untuk development
npm run dev
```

### 7. Jalankan Aplikasi
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## Akun Default

Setelah seeding, akun berikut tersedia:

- **Admin**: admin@sejahtera.com / password
- **Staff**: staff@sejahtera.com / password
- **Guest**: guest@sejahtera.com / password

## Deployment

### Lokal (Laragon/XAMPP)
1. Pastikan PHP, MySQL, dan web server terinstall
2. Import database dari file SQL jika ada, atau jalankan migration
3. Copy project ke folder web server
4. Akses via browser

### Online (Shared Hosting/VPS)
1. Upload semua file ke hosting
2. Setup database dan update `.env`
3. Jalankan `composer install --no-dev --optimize-autoloader`
4. Jalankan `php artisan migrate --seed`
5. Build assets: `npm run build`
6. Set permissions untuk storage dan bootstrap/cache
7. Konfigurasi web server (Apache/Nginx) untuk point ke `public/index.php`

### VPS Deployment Script (Linux/Unix)
```bash
# Install dependencies
composer install --no-dev --optimize-autoloader

# Setup environment
cp .env.example .env
# Edit .env sesuai kebutuhan

# Generate key
php artisan key:generate

# Database
php artisan migrate --seed

# Build assets
npm install
npm run build

# Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

### Windows Deployment (Laragon/XAMPP)
Untuk pengguna Windows dengan Laragon/XAMPP:
1. Copy project ke folder web server (misal: `C:\laragon\www\` untuk Laragon)
2. Jalankan command di Command Prompt atau PowerShell:
```cmd
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
npm install
npm run build
php artisan serve
```
3. Akses aplikasi di browser sesuai konfigurasi web server

## Struktur Database

- **users**: Tabel user dengan role (admin, staff, guest)
- **donasi**: Tabel donasi dengan relasi ke users (validator)
- **bansos**: Tabel bantuan sosial
- **migrations**: Default Laravel (cache, jobs)

## Testing

```bash
php artisan test
```

## Lisensi

MIT License
