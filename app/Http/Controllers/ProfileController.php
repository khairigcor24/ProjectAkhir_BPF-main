<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function update(ProfileRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // ============================================
        // HANDLE PROFILE PHOTO UPLOAD
        // ============================================
        if ($request->hasFile('profile_photo')) {
            // Validate photo file
            $request->validate([
                'profile_photo' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            ], [
                'profile_photo.image' => __('File harus berupa gambar.'),
                'profile_photo.mimes' => __('Format gambar harus JPEG atau PNG.'),
                'profile_photo.max' => __('Ukuran file tidak boleh melebihi 5MB.'),
            ]);

            // Ensure the directory exists
            if (!Storage::disk('public')->exists('profile_photos')) {
                Storage::disk('public')->makeDirectory('profile_photos');
            }

            // Delete old photo if exists
            if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            // Save new photo with unique filename
            $fileName = 'profile_' . $user->id . '_' . time() . '.' . $request->file('profile_photo')->getClientOriginalExtension();
            $path = $request->file('profile_photo')->storeAs('profile_photos', $fileName, 'public');
            $user->profile_photo_path = $path;
        }

        // ============================================
        // UPDATE NAME AND EMAIL
        // ============================================
        $user->name = $request->input('name', $user->name);
        $user->email = $request->input('email', $user->email);
        $user->save();

        // ============================================
        // RETURN RESPONSE
        // ============================================
        // If AJAX request (for photo upload), return JSON
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => __('Profil berhasil diperbarui.'),
                'photo_url' => $user->profile_photo_path 
                    ? asset('storage/' . $user->profile_photo_path)
                    : asset('assets/img/default-avatar.png'),
            ]);
        }

        // Regular form submission - redirect with message
        return back()->withStatus(__('Profil berhasil diperbarui.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        if (!$user) {
            return back()->withErrors(['error' => __('User tidak ditemukan.')]);
        }

        // Update password
        $user->password = Hash::make($request->get('password'));
        $user->save();

        return back()->withPasswordStatus(__('Kata sandi berhasil diperbarui.'));
    }
}
