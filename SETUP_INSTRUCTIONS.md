# Instruksi Setup Aplikasi Sistem Manajemen Donasi / Bantuan Sosial (Bansos)

## ✅ Yang Sudah Dibuat

### 1. Database & Model
- ✅ Migrasi: `program_bansos`, `penerima_bansos`, `penyaluran_bansos`
- ✅ Model dengan relasi lengkap: `ProgramBansos`, `PenerimaBansos`, `PenyaluranBansos`
- ✅ Seeder untuk data awal (admin, staff, program bansos)

### 2. Controller
- ✅ `ProgramBansosController` - CRUD dengan upload file
- ✅ `PenerimaBansosController` - CRUD, validasi, upload dokumen multiple
- ✅ `PenyaluranBansosController` - CRUD, tracking status
- ✅ `GuestProgramBansosController` - Untuk guest (public)

### 3. Routes
- ✅ Route untuk Admin, Staff, dan Guest dengan middleware yang sesuai
- ✅ RBAC (Role-Based Access Control) sudah diimplementasikan

### 4. Fitur yang Sudah Diimplementasi
- ✅ Upload file (single untuk gambar program, multiple untuk dokumen penerima)
- ✅ Search dan Filter di semua controller
- ✅ Pagination
- ✅ Validasi form lengkap

## 📋 Langkah Setup

### 1. Jalankan Migrasi
```bash
php artisan migrate
```

### 2. Jalankan Seeder
```bash
php artisan db:seed
```

Atau jika ingin menjalankan seeder tertentu:
```bash
php artisan db:seed --class=RoleSeeder
php artisan db:seed --class=ProgramBansosSeeder
```

### 3. Buat Storage Link (untuk upload file)
```bash
php artisan storage:link
```

### 4. Verifikasi User Login
- **Admin**: email: `admin@sejahtera.com`, password: `password`
- **Staff**: email: `staff@sejahtera.com`, password: `password`
- **Guest**: email: `guest@sejahtera.com`, password: `password`

## 🎨 View yang Perlu Dibuat

### View untuk Admin:
1. `resources/views/program-bansos/index.blade.php` - Tabel list program
2. `resources/views/program-bansos/create.blade.php` - Form create
3. `resources/views/program-bansos/edit.blade.php` - Form edit
4. `resources/views/program-bansos/show.blade.php` - Detail program

5. `resources/views/penerima-bansos/admin/index.blade.php` - Tabel list penerima
6. `resources/views/penerima-bansos/create.blade.php` - Form pendaftaran
7. `resources/views/penerima-bansos/edit.blade.php` - Form edit
8. `resources/views/penerima-bansos/show.blade.php` - Detail penerima
9. `resources/views/penerima-bansos/success.blade.php` - Halaman sukses pendaftaran

10. `resources/views/penyaluran-bansos/admin/index.blade.php` - Tabel list penyaluran
11. `resources/views/penyaluran-bansos/create.blade.php` - Form penyaluran
12. `resources/views/penyaluran-bansos/edit.blade.php` - Form edit
13. `resources/views/penyaluran-bansos/show.blade.php` - Detail penyaluran

### View untuk Staff:
1. `resources/views/penerima-bansos/staff/index.blade.php` - Card/List view
2. `resources/views/penyaluran-bansos/staff/index.blade.php` - Card/List view

### View untuk Guest (Public):
1. `resources/views/guest/program-bansos/index.blade.php` - List program dengan search/filter
2. `resources/views/guest/program-bansos/show.blade.php` - Detail program public

## 🔑 Fitur Utama

### Admin:
- Dashboard dengan tabel dan statistik
- CRUD Program Bansos (upload gambar)
- CRUD Penerima Bansos
- CRUD Penyaluran Bansos
- Manajemen User Staff
- Laporan

### Staff:
- Dashboard dengan card/list view
- Melihat data Penerima Bansos
- Validasi Penerima Bansos
- Melihat dan mengelola Penyaluran Bansos

### Guest (Public):
- Melihat informasi Program Bansos
- Search dan filter program
- Pendaftaran sebagai Penerima Bansos (upload dokumen)

## 📝 Catatan Penting

1. **Upload File**: File disimpan di `storage/app/public/`
   - Program Bansos gambar: `program-bansos/`
   - Dokumen penerima: `dokumen-penerima/`
   - Bukti penyaluran: `bukti-penyaluran/`

2. **Validasi**: Semua form sudah memiliki validasi lengkap di controller

3. **Middleware**: 
   - `admin` - Hanya admin
   - `staff` - Hanya staff
   - `adminOrStaff` - Admin dan staff
   - `auth` - User yang sudah login

4. **Pagination**: Semua list menggunakan pagination (15 item per halaman)

5. **Search & Filter**: Sudah diimplementasikan di semua controller

## 🚀 Next Steps

Setelah semua view dibuat, pastikan untuk:
1. Test semua fitur CRUD
2. Test upload file (single dan multiple)
3. Test validasi form
4. Test search dan filter
5. Test pagination
6. Test RBAC (akses berdasarkan role)

