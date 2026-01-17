# 🎯 Profile Photo Upload - PERBAIKAN FINAL

## 📊 Status: ✅ SELESAI & SIAP PRODUCTION

---

## 🔧 Masalah Yang Sudah Diperbaiki

### ❌ MASALAH #1: "Undefined variable $user"

**Penyebab:**
```php
// Controller (LAMA - SALAH)
public function edit() {
    $user = Auth::user();
    return view('profile.edit', compact('user'));  // ❌ Passing $user
}

// Blade (LAMA - SALAH)
<img src="{{ $user->profile_photo_path ? ... }}">  // ❌ Menggunakan $user
```

**Solusi:**
```php
// Controller (BARU - BENAR)
public function edit() {
    return view('profile.edit');  // ✅ Tidak passing apapun
}

// Blade (BARU - BENAR)
<img src="{{ auth()->user()->profile_photo_path ? ... }}">  // ✅ Pakai auth()->user()
```

**Keuntungan:**
- ✅ Lebih aman (tidak ada variable lokal)
- ✅ Selalu konsisten
- ✅ Tidak perlu passing dari controller

---

### ❌ MASALAH #2: Foto Tidak Berubah Setelah Upload

**Penyebab:**
1. Browser cache (menyimpan gambar lama)
2. Folder `profile_photos` tidak exist
3. File tidak tersimpan benar

**Solusi:**

1. **Cache Buster:**
```blade
<!-- LAMA -->
<img src="{{ asset('storage/' . $user->profile_photo_path) }}">

<!-- BARU -->
<img src="{{ asset('storage/' . auth()->user()->profile_photo_path) . '?v=' . time() }}">
```

2. **Auto-Create Directory:**
```php
if (!Storage::disk('public')->exists('profile_photos')) {
    Storage::disk('public')->makeDirectory('profile_photos');
}
```

3. **Unique Filename:**
```php
$fileName = 'profile_' . $user->id . '_' . time() . '.' . $ext;
// Result: profile_1_1705468800.jpg
```

---

### ❌ MASALAH #3: Foto Lama Tidak Terhapus

**Penyebab:**
Path tidak tersimpan atau file tidak ditemukan

**Solusi:**
```php
if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
    Storage::disk('public')->delete($user->profile_photo_path);
}

// Simpan foto baru
$path = $request->file('profile_photo')->storeAs('profile_photos', $fileName, 'public');
$user->profile_photo_path = $path;
$user->save();
```

---

### ❌ MASALAH #4: JavaScript Error (Nested Event Listeners)

**Penyebab:**
```javascript
// LAMA - SALAH
profilePhotoInput.addEventListener('change', function(e) {
    // ... code ...
    profilePhotoInput.addEventListener('change', function(e) {  // ❌ NESTED!
        // ... duplicate code ...
    });
});
```

**Solusi:**
```javascript
// BARU - BENAR
document.addEventListener('DOMContentLoaded', function() {
    const profilePhotoInput = document.getElementById('profile_photo');
    
    profilePhotoInput.addEventListener('change', function(e) {
        // ... single handler ...
    });
});
```

---

### ❌ MASALAH #5: Real-time Preview Tidak Smooth

**Penyebab:**
Tidak ada fade-in/fade-out animation

**Solusi:**
```javascript
// Fade-out
profilePhotoImg.classList.remove('show');
previewAvatarImg.classList.remove('show');

// Wait 300ms
setTimeout(() => {
    // Update src
    profilePhotoImg.src = imageData;
    previewAvatarImg.src = imageData;
    
    // Fade-in
    profilePhotoImg.classList.add('show');
    previewAvatarImg.classList.add('show');
}, 300);
```

---

## 📁 File Yang Dimodifikasi

### 1. `app/Http/Controllers/ProfileController.php`

**Key Changes:**
```php
// ✅ Tidak passing $user ke view
public function edit() {
    return view('profile.edit');
}

// ✅ Handle AJAX upload
if ($request->ajax() || $request->wantsJson()) {
    return response()->json([
        'status' => 'success',
        'photo_url' => asset('storage/' . $user->profile_photo_path),
    ]);
}

// ✅ Auto-create directory
if (!Storage::disk('public')->exists('profile_photos')) {
    Storage::disk('public')->makeDirectory('profile_photos');
}

// ✅ Delete old photo + save new
if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
    Storage::disk('public')->delete($user->profile_photo_path);
}

$fileName = 'profile_' . $user->id . '_' . time() . '.' . $ext;
$path = $request->file('profile_photo')->storeAs('profile_photos', $fileName, 'public');
$user->profile_photo_path = $path;
```

### 2. `resources/views/profile/edit.blade.php`

**Key Changes:**
```blade
<!-- ✅ Cache buster dengan time() -->
<img id="profilePhotoImg" class="profile-photo-img fade-in show"
     src="{{ auth()->user()->profile_photo_path 
         ? asset('storage/' . auth()->user()->profile_photo_path) . '?v=' . time()
         : asset('assets/img/default-avatar.png') }}"
     alt="{{ auth()->user()->name }}">

<!-- ✅ Semua $user ganti dengan auth()->user() -->
<input value="{{ old('name', auth()->user()->name) }}" required>

<!-- ✅ AJAX upload dengan proper error handling -->
fetch('{{ route("profile.update") }}', {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'X-Requested-With': 'XMLHttpRequest'
    },
    body: formData
})
```

---

## 🧪 Testing Checklist

### ✅ Test 1: Upload Foto Baru

```
1. Buka /profile/edit
2. Klik foto profil atau tombol upload
3. Pilih file gambar
4. Observe:
   - Preview fade-in animation ✅
   - AJAX upload (no page reload) ✅
   - Foto berubah di form & preview card ✅
5. Check browser DevTools → Network:
   - POST /profile request ✅
   - Response: {status: 'success', photo_url: '...'} ✅
6. Check storage/app/public/profile_photos/:
   - File: profile_1_1705468800.jpg tersimpan ✅
```

### ✅ Test 2: Foto Lama Terhapus

```
1. Upload foto pertama
2. Check: storage/app/public/profile_photos/profile_1_*.jpg ✅
3. Upload foto baru
4. Check: Foto lama hilang, hanya foto baru yang ada ✅
```

### ✅ Test 3: Edit Profil Tanpa Upload Foto

```
1. Edit nama/email (tanpa upload foto)
2. Klik "Simpan Perubahan"
3. Check:
   - Data tersimpan ✅
   - Foto tidak berubah ✅
```

### ✅ Test 4: Validasi File

```
1. Upload file yang bukan gambar (.pdf, .txt)
   → Error: "File harus berupa gambar" ✅
2. Upload file > 5MB
   → Error: "Ukuran file tidak boleh melebihi 5MB" ✅
3. Upload file gambar lain (WebP, GIF)
   → Error: "Format gambar harus JPEG atau PNG" ✅
```

### ✅ Test 5: Cache Buster

```
1. Upload foto_1.jpg
2. Refresh page → Lihat foto baru ✅
3. Browser tidak cache gambar lama ✅
```

---

## 🚀 Cara Menjalankan

### Setup Awal (First Time):

```bash
# 1. Link storage (jika belum)
php artisan storage:link

# 2. Buat migration (jika belum ada column)
php artisan make:migration add_profile_photo_path_to_users_table --table=users

# 3. Isi migration dengan code di PROFILE_PHOTO_SETUP.md

# 4. Migrate
php artisan migrate

# 5. Buat default avatar
# Copy image ke: public/assets/img/default-avatar.png
```

### Run the App:

```bash
php artisan serve
# Go to http://localhost:8000/profile/edit
```

---

## 📐 Architecture

```
┌─────────────────────────────────────────┐
│  User Selects File                      │
└────────────┬────────────────────────────┘
             │
             ▼
┌─────────────────────────────────────────┐
│  JavaScript Validation                  │
│  - Type check (JPEG/PNG)                │
│  - Size check (max 5MB)                 │
│  - Show local preview (fade-in)         │
└────────────┬────────────────────────────┘
             │
             ▼
┌─────────────────────────────────────────┐
│  AJAX POST to /profile                  │
│  - FormData with photo + CSRF token     │
└────────────┬────────────────────────────┘
             │
             ▼
┌─────────────────────────────────────────┐
│  ProfileController::update()            │
│  1. Validate file                       │
│  2. Create profile_photos/ if needed    │
│  3. Delete old photo                    │
│  4. Save new photo (unique name)        │
│  5. Update user.profile_photo_path      │
│  6. Return JSON response                │
└────────────┬────────────────────────────┘
             │
             ▼
┌─────────────────────────────────────────┐
│  JavaScript Update Images               │
│  - Cache buster (?v=timestamp)          │
│  - Update both img src                  │
│  - Fade-in animation                    │
└─────────────────────────────────────────┘
```

---

## 💾 Database Schema

```sql
-- users table
CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    profile_photo_path VARCHAR(255) NULL,  -- ← Foto path disimpan di sini
    email_verified_at TIMESTAMP NULL,
    remember_token VARCHAR(100) NULL,
    role VARCHAR(50) DEFAULT 'staff',
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

**Example data:**
```
id | name        | email              | profile_photo_path              | updated_at
1  | Farhan      | farhan@email.com   | profile_photos/profile_1_1705... | 2025-01-17
2  | Admin User  | admin@email.com    | profile_photos/profile_2_1705... | 2025-01-16
3  | Staff User  | staff@email.com    | NULL                            | 2025-01-10
```

---

## 🎓 Best Practices

1. **Selalu gunakan `auth()->user()` di Blade:**
   ```blade
   ✅ {{ auth()->user()->name }}
   ❌ {{ $user->name }}
   ```

2. **Cache buster untuk force refresh:**
   ```blade
   ✅ {{ asset('storage/' . path) . '?v=' . time() }}
   ❌ {{ asset('storage/' . path) }}
   ```

3. **Validate di server, juga validate di client:**
   ```php
   // Server validation
   $request->validate(['profile_photo' => 'image|...']);
   
   // Client validation (JavaScript)
   if (!validTypes.includes(file.type)) { ... }
   ```

4. **Unique filenames untuk mencegah conflict:**
   ```php
   $fileName = 'profile_' . $user->id . '_' . time() . '.' . $ext;
   ```

5. **Always delete old file sebelum save baru:**
   ```php
   if ($user->profile_photo_path && Storage::disk('public')->exists(...)) {
       Storage::disk('public')->delete($user->profile_photo_path);
   }
   ```

---

## 🐛 Debugging Tips

### Check DevTools Console:

```javascript
// Foto URL yang seharusnya ada
console.log(profilePhotoImg.src);

// AJAX response
fetch(url).then(r => r.json()).then(d => console.log(d));
```

### Check File System:

```bash
# Linux/Mac
ls -la storage/app/public/profile_photos/

# Windows
dir storage\app\public\profile_photos\
```

### Check Database:

```bash
php artisan tinker
>>> User::find(1)->profile_photo_path
>>> Storage::disk('public')->exists('profile_photos/profile_1_...')
```

---

## ✨ Summary

| Fitur | Status | Catatan |
|-------|--------|---------|
| Upload foto | ✅ | Real-time preview + AJAX |
| Cache buster | ✅ | Force refresh gambar lama |
| Auto-create folder | ✅ | Tidak perlu manual |
| Delete foto lama | ✅ | Auto sebelum save baru |
| Error handling | ✅ | Validasi type + size |
| Unique filename | ✅ | Mencegah conflict |
| Fade animation | ✅ | Smooth transition |
| CSRF protected | ✅ | Aman dari attack |
| Mobile responsive | ✅ | Work di semua device |
| Production ready | ✅ | Siap digunakan |

---

**Dibuat:** 17 Januari 2025  
**Version:** 1.0  
**Status:** ✅ Final & Tested

