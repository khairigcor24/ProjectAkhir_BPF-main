# 🚀 Quick Reference - Profile Photo Upload

## ⚡ 5-Minute Setup

```bash
# 1. Link storage
php artisan storage:link

# 2. Create migration (if needed)
php artisan make:migration add_profile_photo_path_to_users_table --table=users

# 3. Migrate
php artisan migrate

# Done! ✅
```

---

## 📝 Key Code Snippets

### ProfileController.php - Update Method

```php
public function update(ProfileRequest $request)
{
    $user = Auth::user();

    if ($request->hasFile('profile_photo')) {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if (!Storage::disk('public')->exists('profile_photos')) {
            Storage::disk('public')->makeDirectory('profile_photos');
        }

        if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        $fileName = 'profile_' . $user->id . '_' . time() . '.' . $request->file('profile_photo')->getClientOriginalExtension();
        $path = $request->file('profile_photo')->storeAs('profile_photos', $fileName, 'public');
        $user->profile_photo_path = $path;
    }

    $user->name = $request->input('name', $user->name);
    $user->email = $request->input('email', $user->email);
    $user->save();

    if ($request->ajax() || $request->wantsJson()) {
        return response()->json([
            'status' => 'success',
            'photo_url' => asset('storage/' . $user->profile_photo_path),
        ]);
    }

    return back()->withStatus(__('Profil berhasil diperbarui.'));
}
```

---

### Blade - Display Photo

```blade
<!-- Main image -->
<img id="profilePhotoImg" class="profile-photo-img fade-in show"
     src="{{ auth()->user()->profile_photo_path 
         ? asset('storage/' . auth()->user()->profile_photo_path) . '?v=' . time()
         : asset('assets/img/default-avatar.png') }}"
     alt="{{ auth()->user()->name }}">

<!-- Preview image -->
<img id="previewAvatarImg" class="preview-avatar-img"
     src="{{ auth()->user()->profile_photo_path 
         ? asset('storage/' . auth()->user()->profile_photo_path) . '?v=' . time()
         : asset('assets/img/default-avatar.png') }}"
     alt="{{ auth()->user()->name }}">
```

---

### Blade - Form

```blade
<!-- Hidden photo form -->
<form id="photoForm" method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" style="display: none;">
    @csrf
    @method('patch')
    <input type="file" id="profile_photo" name="profile_photo" accept="image/jpeg,image/png,image/jpg">
</form>

<!-- Upload button -->
<button type="button" class="upload-photo-btn" onclick="document.getElementById('profile_photo').click();">
    <i class="fa fa-cloud-upload"></i>{{ __('Unggah Foto Profil') }}
</button>
```

---

### JavaScript - Upload Handler

```javascript
document.addEventListener('DOMContentLoaded', function() {
    const profilePhotoInput = document.getElementById('profile_photo');
    const profilePhotoImg = document.getElementById('profilePhotoImg');
    const previewAvatarImg = document.getElementById('previewAvatarImg');

    profilePhotoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;

        // Validate
        const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!validTypes.includes(file.type)) {
            alert('{{ __("Hanya JPEG/PNG") }}');
            return;
        }

        const maxSize = 5 * 1024 * 1024;
        if (file.size > maxSize) {
            alert('{{ __("Max 5MB") }}');
            return;
        }

        // Preview with fade effect
        const reader = new FileReader();
        reader.onload = function(event) {
            profilePhotoImg.classList.remove('show');
            previewAvatarImg.classList.remove('show');

            setTimeout(() => {
                profilePhotoImg.src = event.target.result;
                previewAvatarImg.src = event.target.result;
                profilePhotoImg.classList.add('show');
                previewAvatarImg.classList.add('show');
            }, 300);

            // AJAX upload
            const formData = new FormData();
            formData.append('profile_photo', file);
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('_method', 'PATCH');

            fetch('{{ route("profile.update") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(r => r.json())
            .then(data => {
                if (data.status === 'success') {
                    const newUrl = data.photo_url + '?v=' + new Date().getTime();
                    profilePhotoImg.src = newUrl;
                    previewAvatarImg.src = newUrl;
                }
            })
            .catch(err => alert('{{ __("Upload gagal") }}'));
        };
        reader.readAsDataURL(file);
    });
});
```

---

### CSS - Fade Animation

```css
.fade-in {
    opacity: 0;
    transition: opacity 0.6s ease-in-out;
}

.fade-in.show {
    opacity: 1;
}
```

---

## 🔍 Troubleshooting

| Problem | Solution |
|---------|----------|
| Undefined $user | Use `auth()->user()` instead |
| Photo not updating | Add cache buster: `?v=timestamp` |
| Photo not deleting | Check folder permissions |
| AJAX error | Check browser console + network tab |
| File not uploading | Verify multipart form-data |
| 500 error | Check Laravel logs (storage/logs/) |

---

## ✅ Testing

```javascript
// In browser console:
console.log(document.getElementById('profilePhotoImg').src);
console.log(document.getElementById('previewAvatarImg').src);

// Should show:
// storage/profile_photos/profile_1_1705...jpg?v=1705468800
```

---

## 📁 File Structure

```
storage/app/public/
├── profile_photos/
│   ├── profile_1_1705468800.jpg   ← User 1
│   ├── profile_2_1705468900.jpg   ← User 2
│   └── profile_3_1705469000.png   ← User 3
```

---

## 🎯 What Was Fixed

✅ Undefined $user error  
✅ Photo not showing after upload  
✅ Old photo not deleting  
✅ Real-time preview not smooth  
✅ Nested event listener bug  
✅ Cache not busting  
✅ Directory not creating  
✅ Filename conflicts  

---

**Made with ❤️ for Laravel 12 & PHP 8.4**

