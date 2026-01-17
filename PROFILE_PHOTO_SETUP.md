# ✅ Panduan Setup Profile Photo Upload - Laravel 12 & PHP 8.4

## 🎯 Alur Yang Sudah Diperbaiki

Sistem upload foto profil sekarang bekerja dengan:
- ✅ Storage directory auto-create (tidak perlu manual)
- ✅ Foto lama otomatis terhapus saat upload baru
- ✅ Preview real-time dengan fade-in animation
- ✅ AJAX upload tanpa page refresh
- ✅ Cache buster untuk force refresh gambar
- ✅ Unique filename (mencegah conflict)
- ✅ Proper error handling & validation

---

## 📋 Checklist Setup Awal

Pastikan sudah jalankan perintah ini di project:

```bash
# 1. Buat symbolic link storage (jika belum)
php artisan storage:link

# 2. Set permissions (Windows bisa skip, Linux harus)
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/

# 3. Buat migration untuk add column (jika belum ada)
php artisan make:migration add_profile_photo_path_to_users_table --table=users

# 4. Isi migration file (di database/migrations):
```

### Migration File Content (jika belum ada):

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambah column jika belum ada
            if (!Schema::hasColumn('users', 'profile_photo_path')) {
                $table->string('profile_photo_path')->nullable()->after('email');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile_photo_path');
        });
    }
};
```

Kemudian jalankan:

```bash
php artisan migrate
```

---

## 🗂️ File Structure

```
storage/app/public/
├── profile_photos/           ← Foto-foto profil user disimpan di sini
│   ├── profile_1_1705468800.jpg
│   ├── profile_2_1705468900.png
│   └── ...
```

---

## 📝 File Yang Sudah Dimodifikasi

### 1️⃣ `app/Http/Controllers/ProfileController.php`

**Perubahan:**
- ✅ Hapus passing `$user` ke view (gunakan `auth()->user()` di Blade)
- ✅ Auto-create directory `profile_photos` jika belum ada
- ✅ Unique filename: `profile_{user_id}_{timestamp}.{ext}`
- ✅ Hapus foto lama saat upload baru
- ✅ Return JSON untuk AJAX requests
- ✅ Better error messages

**Key Methods:**
- `edit()` - Tampilkan form (tanpa compact('user'))
- `update()` - Handle photo upload + name/email update
- `password()` - Handle password change

### 2️⃣ `resources/views/profile/edit.blade.php`

**Perubahan:**
- ✅ Hapus semua `$user` variable → ganti dengan `auth()->user()`
- ✅ Fix image src dengan cache buster: `?v=' . time()`
- ✅ Clean up JavaScript (hapus nested event listeners)
- ✅ Proper fade-in/fade-out animation
- ✅ Better error handling & validation

**Key Features:**
```blade
<!-- Use auth()->user() everywhere -->
<img src="{{ auth()->user()->profile_photo_path 
    ? asset('storage/' . auth()->user()->profile_photo_path) . '?v=' . time()
    : asset('assets/img/default-avatar.png') }}"
     alt="{{ auth()->user()->name }}">
```

### 3️⃣ JavaScript Upload Handler

**Fitur:**
```javascript
// Validasi file (type, size)
// Fade-out → Update src → Fade-in
// AJAX upload dengan CSRF protection
// Cache buster (?v=timestamp)
// Error handling
// Loading state feedback
```

---

## 🔧 How It Works

### Alur Upload Foto:

1. **User klik foto atau tombol upload** 
   → File input dialog terbuka

2. **User pilih file**
   → JavaScript validasi (type, size)
   → Show preview dengan fade-in

3. **AJAX upload ke server**
   ```javascript
   fetch('{{ route("profile.update") }}', {
       method: 'POST',
       body: formData,  // Termasuk photo + CSRF token
   })
   ```

4. **Server process:**
   - Validasi file lagi
   - Cek & create directory
   - Hapus foto lama
   - Simpan foto baru dengan unique name
   - Return JSON: `{status: 'success', photo_url: '...'}`

5. **JavaScript update both images:**
   ```javascript
   const newUrl = data.photo_url + '?v=' + new Date().getTime();
   profilePhotoImg.src = newUrl;  // Edit form
   previewAvatarImg.src = newUrl; // Preview card
   ```

6. **Cache buster (`?v=timestamp`)** memaksa browser reload gambar

---

## 🐛 Troubleshooting

### ❌ "Undefined variable $user" error

**Solusi:**
- Ganti `$user->property` dengan `auth()->user()->property` di Blade
- Jangan pass `compact('user')` dari controller

### ❌ Foto tidak berubah setelah upload

**Periksa:**
```bash
# 1. Storage link sudah ada?
ls -la public/storage  # Linux/Mac
dir public\storage     # Windows

# 2. Folder profile_photos sudah ada?
ls -la storage/app/public/profile_photos/

# 3. File sudah tersimpan?
# (Harus ada file: profile_{id}_{timestamp}.jpg)
```

**Perbaikan:**
```bash
# Re-link storage jika perlu
rm public/storage
php artisan storage:link
```

### ❌ Foto lama tidak terhapus

**Periksa di ProfileController:**
```php
if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
    Storage::disk('public')->delete($user->profile_photo_path);
}
```

### ❌ AJAX upload error

**Debug:**
1. Buka DevTools → Console tab
2. Cek error message
3. Pastikan CSRF token ada: `<meta name="csrf-token">`

---

## 📸 Display Profile Photo Di Tempat Lain

Contoh di user profile page:

```blade
<!-- Safe way to display user photo -->
<img src="{{ auth()->user()->profile_photo_path 
    ? asset('storage/' . auth()->user()->profile_photo_path) 
    : asset('assets/img/default-avatar.png') }}"
     alt="{{ auth()->user()->name }}"
     class="avatar">
```

Atau di admin dashboard:

```blade
@foreach($users as $user)
    <img src="{{ $user->profile_photo_path 
        ? asset('storage/' . $user->profile_photo_path)
        : asset('assets/img/default-avatar.png') }}"
         alt="{{ $user->name }}"
         class="small-avatar">
@endforeach
```

---

## 🎨 Customization

### Mengubah Folder Penyimpanan

Di `ProfileController.php`:
```php
// Default: 'profile_photos'
// Ganti dengan folder lain:
$path = $request->file('profile_photo')->storeAs('user_avatars', $fileName, 'public');
```

### Mengubah Max File Size

Di Blade form validation:
```php
'profile_photo' => 'image|mimes:jpeg,png,jpg|max:10240', // 10MB
```

### Menambah Format File

```php
'profile_photo' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
```

---

## ✨ Testing

### Manual Test Upload:

1. Buka `/profile/edit` page
2. Klik profile photo atau tombol upload
3. Pilih file gambar
4. Observe:
   - Preview fade-in animation ✅
   - AJAX upload (no page reload) ✅
   - Foto berubah di form & preview card ✅
   - Check DevTools → Network tab (POST request) ✅
   - Cek `storage/app/public/profile_photos/` (file tersimpan) ✅

### Check Database:

```bash
# View user profile_photo_path
php artisan tinker
>>> $user = App\Models\User::find(1);
>>> $user->profile_photo_path;
=> "profile_photos/profile_1_1705468800.jpg"
```

---

## 🚀 Production Ready

Sistem upload foto profil sekarang:
- ✅ Production-ready
- ✅ Aman (CSRF protected)
- ✅ User-friendly (real-time preview)
- ✅ Error-handled
- ✅ Performance optimized (cache buster)
- ✅ Mobile responsive

Enjoy! 🎉

