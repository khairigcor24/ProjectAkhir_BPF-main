#!/bin/bash

# 🎨 SISTEM BANSOS - UI COMPONENTS SHOWCASE & USAGE GUIDE

## AVAILABLE COMPONENTS

### 1. BUTTONS
```html
<!-- Primary Button -->
<button class="btn btn-primary">Simpan</button>

<!-- Secondary Button -->
<button class="btn btn-secondary">Batal</button>

<!-- Outline Button -->
<button class="btn btn-outline-primary">Lihat Detail</button>

<!-- Small Button -->
<button class="btn btn-primary btn-sm">Kecil</button>

<!-- Large Button -->
<button class="btn btn-primary btn-lg">Besar</button>

<!-- Disabled Button -->
<button class="btn btn-primary" disabled>Tidak Aktif</button>
```

---

### 2. ALERTS
```html
<!-- Success Alert -->
<div class="alert alert-success">
    <strong>Berhasil!</strong> Data telah disimpan.
</div>

<!-- Info Alert -->
<div class="alert alert-info">
    <strong>Informasi:</strong> Terdapat update baru.
</div>

<!-- Warning Alert -->
<div class="alert alert-warning">
    <strong>Perhatian:</strong> Pastikan data sudah benar.
</div>

<!-- Danger Alert -->
<div class="alert alert-danger">
    <strong>Kesalahan!</strong> Data tidak ditemukan.
</div>

<!-- Dismissible Alert -->
<div class="alert alert-success alert-dismissible fade show">
    <strong>Berhasil!</strong> Data telah disimpan.
    <button type="button" class="close" data-dismiss="alert">
        <span>&times;</span>
    </button>
</div>
```

---

### 3. BADGES
```html
<!-- Primary Badge -->
<span class="badge badge-primary">Aktif</span>

<!-- Success Badge -->
<span class="badge badge-success">Terverifikasi</span>

<!-- Warning Badge -->
<span class="badge badge-warning">Menunggu</span>

<!-- Danger Badge -->
<span class="badge badge-danger">Ditolak</span>
```

---

### 4. CARDS
```html
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Judul Kartu</h5>
    </div>
    <div class="card-body">
        <p class="card-text">Isi konten kartu di sini.</p>
    </div>
</div>
```

---

### 5. FORMS
```html
<form>
    <!-- Text Input -->
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" placeholder="Masukkan username">
    </div>

    <!-- Email Input -->
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" placeholder="Masukkan email">
    </div>

    <!-- Select Dropdown -->
    <div class="form-group">
        <label for="role">Role</label>
        <select class="form-control" id="role">
            <option>-- Pilih Role --</option>
            <option>Admin</option>
            <option>Staff</option>
            <option>User</option>
        </select>
    </div>

    <!-- Textarea -->
    <div class="form-group">
        <label for="description">Deskripsi</label>
        <textarea class="form-control" id="description" rows="4"></textarea>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
```

---

### 6. TABLES
```html
<div class="card">
    <div class="card-header">
        <h5>Daftar Data</h5>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>john@example.com</td>
                    <td><span class="badge badge-success">Aktif</span></td>
                    <td>
                        <button class="btn btn-sm btn-primary">Edit</button>
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
```

---

### 7. MODALS
```html
<!-- Trigger Button -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Buka Modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Judul Modal</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Isi modal di sini.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
```

---

### 8. PAGINATION
```html
<nav>
    <ul class="pagination">
        <li class="page-item disabled">
            <a class="page-link" href="#">Sebelumnya</a>
        </li>
        <li class="page-item active">
            <a class="page-link" href="#">1</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="#">2</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="#">3</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="#">Selanjutnya</a>
        </li>
    </ul>
</nav>
```

---

### 9. TOOLTIPS
```html
<!-- Hover untuk lihat tooltip -->
<button class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Klik untuk menyimpan">
    Simpan Data
</button>

<script>
    $('[data-toggle="tooltip"]').tooltip();
</script>
```

---

### 10. UTILITY CLASSES
```html
<!-- Text Colors -->
<p class="text-primary">Teks Primary</p>
<p class="text-secondary">Teks Secondary</p>

<!-- Background Colors -->
<div class="bg-light-primary">Background Primary Light</div>

<!-- Text Alignment -->
<p class="text-center">Teks Tengah</p>
<p class="text-right">Teks Kanan</p>

<!-- Shadows -->
<div class="card shadow-sm">Shadow Kecil</div>
<div class="card shadow-md">Shadow Medium</div>
<div class="card shadow-lg">Shadow Besar</div>

<!-- Padding & Margin -->
<div class="p-3 m-2">Padding dan Margin</div>

<!-- Borders -->
<div class="border-primary">Border Primary</div>
<div class="rounded">Border Radius</div>
<div class="rounded-lg">Border Radius Large</div>
```

---

## JAVASCRIPT UTILITIES

### Show Notification
```javascript
showNotification('Data berhasil disimpan!', 'success', 3000);
showNotification('Terjadi kesalahan!', 'danger', 5000);
```

### Search & Filter
```html
<input type="text" data-search="table tbody tr" placeholder="Cari...">
```

### Session Timeout Warning
Otomatis berjalan - memberikan warning 5 menit sebelum timeout

### Form Submission
```html
<form>
    <!-- Form fields -->
    <button type="submit" class="btn btn-primary">Simpan</button>
    <!-- Button otomatis disabled dan show loading state -->
</form>
```

---

## COLOR PALETTE

```css
--primary-teal: #51cbce
--primary-teal-dark: #3fb1ba
--success: #4caf50
--warning: #ffc107
--danger: #f44336
--info: #51cbce
--bg-light: #f8fafc
--text-primary: #2d3748
--text-secondary: #718096
```

---

## RESPONSIVE BREAKPOINTS

- **Mobile:** `< 768px`
- **Tablet:** `768px - 991px`
- **Desktop:** `> 991px`

---

## ANIMATION CLASSES

```css
animation: slideInUp 0.4s ease-out
animation: fadeIn 0.3s ease-out
animation: slideInLeft 0.4s ease-out
animation: pulse 1.5s ease-in-out
```

---

## TIPS & BEST PRACTICES

1. **Always use proper button types:**
   - `btn btn-primary` untuk actions penting
   - `btn btn-secondary` untuk actions secondary
   - `btn btn-outline-primary` untuk actions preview

2. **Use alerts properly:**
   - Success untuk operasi sukses
   - Danger untuk errors atau warnings serius
   - Warning untuk cautions
   - Info untuk informasi umum

3. **Keep forms accessible:**
   - Selalu gunakan `<label>` dengan `for` attribute
   - Gunakan placeholder sebagai hints, bukan labels
   - Gunakan required attribute

4. **Table best practices:**
   - Jangan overload table dengan terlalu banyak columns
   - Gunakan paginations untuk data besar
   - Add row numbers untuk clarity

5. **Performance:**
   - Lazy load images jika memungkinkan
   - Minimize CSS/JS files
   - Use CDN untuk external libraries

---

## TROUBLESHOOTING

### Buttons tidak responsive
✓ Pastikan Bootstrap CSS di-load
✓ Check console untuk error messages

### Animations tidak smooth
✓ Check GPU acceleration di CSS
✓ Verify transition duration values

### Dropdown tidak berfungsi
✓ Pastikan jQuery di-load
✓ Pastikan Bootstrap JS di-load
✓ Check data-toggle attribute

### Forms tidak tersubmit
✓ Check form method (POST/GET)
✓ Verify CSRF token included
✓ Check form validation

---

## ADDITIONAL RESOURCES

- Bootstrap Docs: https://getbootstrap.com/docs
- jQuery Docs: https://jquery.com/
- Font Awesome Icons: https://fontawesome.com/

---

**Last Updated:** January 17, 2026  
**Status:** ✅ Complete
