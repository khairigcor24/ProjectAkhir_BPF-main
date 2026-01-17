@extends('layouts.app', ['activePage' => 'user', 'title' => 'SEJAHTERA', 'navName' => 'Edit Profil', 'activeButton' => 'laravel'])

@push('css')
<style>
    /* ============================================ */
    /* MODERN PROFILE EDIT PAGE - CUSTOM STYLES    */
    /* ============================================ */

    :root {
        --gradient-primary: linear-gradient(135deg, #17a2b8 0%, #20c997 100%);
        --gradient-accent: linear-gradient(135deg, #20c997 0%, #00bcd4 100%);
        --color-teal: #17a2b8;
        --color-cyan: #00bcd4;
        --color-success: #28a745;
        --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.08);
        --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.12);
        --shadow-lg: 0 12px 40px rgba(23, 162, 184, 0.15);
    }

    * {
        font-family: 'Poppins', sans-serif;
    }

    h1, h2, h3, h4, h5, h6 {
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
    }

    /* ============================================ */
    /* PAGE BACKGROUND & CONTAINER                 */
    /* ============================================ */

    .profile-edit-wrapper {
        background: linear-gradient(135deg, #f5f8fa 0%, #e8f4f8 100%);
        min-height: 100vh;
        padding: 40px 20px;
        animation: fadeInPage 0.6s ease-out;
    }

    @keyframes fadeInPage {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ============================================ */
    /* PAGE TITLE WITH GRADIENT UNDERLINE           */
    /* ============================================ */

    .profile-title-section {
        margin-bottom: 40px;
        animation: slideInDown 0.5s ease-out;
    }

    .profile-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2d3436;
        margin-bottom: 10px;
        letter-spacing: -0.5px;
    }

    .profile-title-underline {
        width: 100px;
        height: 4px;
        background: var(--gradient-primary);
        border-radius: 2px;
        margin: 0;
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ============================================ */
    /* TWO-COLUMN LAYOUT                            */
    /* ============================================ */

    .profile-container {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
        align-items: start;
    }

    @media (max-width: 1024px) {
        .profile-container {
            grid-template-columns: 1fr;
        }
    }

    /* ============================================ */
    /* MODERN CARD DESIGN                          */
    /* ============================================ */

    .modern-card {
        background: #fff;
        border-radius: 16px;
        padding: 30px;
        box-shadow: var(--shadow-md);
        border: 1px solid rgba(23, 162, 184, 0.08);
        backdrop-filter: blur(10px);
        animation: fadeInCard 0.6s ease-out;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .modern-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    @keyframes fadeInCard {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ============================================ */
    /* SECTION TITLES WITH ICONS                   */
    /* ============================================ */

    .section-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2d3436;
        margin-bottom: 25px;
        padding-bottom: 12px;
        border-bottom: 2px solid #f0f0f0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        color: var(--color-teal);
        font-size: 1.5rem;
    }

    /* ============================================ */
    /* PROFILE PHOTO SECTION                       */
    /* ============================================ */

    .profile-photo-container {
        text-align: center;
        margin-bottom: 35px;
        padding-bottom: 30px;
        border-bottom: 2px solid #f0f0f0;
    }

    .profile-photo-wrapper {
        position: relative;
        width: 160px;
        height: 160px;
        margin: 0 auto;
        background: var(--gradient-primary);
        border-radius: 50%;
        padding: 3px;
        box-shadow: 0 8px 24px rgba(23, 162, 184, 0.2);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .profile-photo-wrapper:hover {
        box-shadow: 0 12px 40px rgba(23, 162, 184, 0.3);
        transform: scale(1.02);
    }

    .profile-photo-wrapper:hover .photo-overlay {
        opacity: 1;
    }

    .profile-photo-inner {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        overflow: hidden;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .profile-photo-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .photo-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .photo-overlay-text {
        color: #fff;
        font-size: 0.9rem;
        font-weight: 600;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
    }

    .photo-overlay-icon {
        font-size: 1.8rem;
    }

    .upload-photo-btn {
        margin-top: 15px;
        display: inline-block;
        padding: 10px 20px;
        background: var(--gradient-accent);
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(32, 201, 151, 0.3);
    }

    .upload-photo-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(32, 201, 151, 0.4);
    }

    .upload-photo-btn:active {
        transform: translateY(0);
    }

    /* ============================================ */
    /* MODERN FORM INPUTS                          */
    /* ============================================ */

    .form-group {
        margin-bottom: 22px;
    }

    .form-group label {
        font-weight: 600;
        color: #2d3436;
        font-size: 0.95rem;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-group label i {
        color: var(--color-teal);
        font-size: 1.1rem;
        min-width: 20px;
    }

    .form-control {
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: #fafafa;
        font-family: 'Poppins', sans-serif;
    }

    .form-control:focus {
        border-color: var(--color-teal);
        background: #fff;
        box-shadow: 0 0 0 0.2rem rgba(23, 162, 184, 0.15);
        outline: none;
    }

    .form-control:read-only,
    .form-control:disabled {
        background-color: #f5f5f5;
        color: #6c757d;
        cursor: not-allowed;
    }

    .form-control.is-invalid {
        border-color: #dc3545;
        background: rgba(220, 53, 69, 0.05);
    }

    .form-control.is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.15);
    }

    /* ============================================ */
    /* ROLE BADGE IN FORM                          */
    /* ============================================ */

    .role-badge-inline {
        display: inline-block;
        background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
        color: #fff;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-left: 8px;
        box-shadow: 0 3px 12px rgba(255, 152, 0, 0.3);
    }

    /* ============================================ */
    /* FORM SECTION DIVIDER                        */
    /* ============================================ */

    .form-section-divider {
        height: 1px;
        background: linear-gradient(90deg, transparent, #e0e0e0, transparent);
        margin: 35px 0;
        border: none;
    }

    /* ============================================ */
    /* BUTTON STYLES                               */
    /* ============================================ */

    .btn-gradient-primary {
        background: var(--gradient-primary);
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 14px 32px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 6px 20px rgba(23, 162, 184, 0.3);
        width: 100%;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-family: 'Montserrat', sans-serif;
    }

    .btn-gradient-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(23, 162, 184, 0.4);
    }

    .btn-gradient-primary:active {
        transform: translateY(-1px);
    }

    .btn-gradient-primary:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .btn-group-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-top: 30px;
    }

    @media (max-width: 640px) {
        .btn-group-row {
            grid-template-columns: 1fr;
        }
    }

    .text-center-btn {
        text-align: center;
    }

    .text-center-btn .btn-gradient-primary {
        width: auto;
        display: inline-block;
        min-width: 200px;
    }

    /* ============================================ */
    /* USER PREVIEW CARD (RIGHT COLUMN)             */
    /* ============================================ */

    .user-preview-card {
        position: relative;
        overflow: hidden;
    }

    .preview-bg-gradient {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 120px;
        background: var(--gradient-primary);
        z-index: 1;
    }

    .preview-content {
        position: relative;
        z-index: 2;
        padding-top: 40px;
        text-align: center;
    }

    .preview-avatar-wrapper {
        width: 140px;
        height: 140px;
        margin: 0 auto 20px;
        background: var(--gradient-accent);
        border-radius: 50%;
        padding: 3px;
        box-shadow: 0 10px 30px rgba(23, 162, 184, 0.25);
    }

    .preview-avatar-inner {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        overflow: hidden;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .preview-avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .preview-name {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2d3436;
        margin-bottom: 5px;
    }

    .preview-email {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 12px;
        word-break: break-all;
    }

    .preview-role-badge {
        display: inline-block;
        background: linear-gradient(135deg, #20c997 0%, #17a2b8 100%);
        color: #fff;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 20px;
        box-shadow: 0 4px 15px rgba(23, 162, 184, 0.3);
    }

    .preview-divider {
        height: 1px;
        background: linear-gradient(90deg, transparent, #e0e0e0, transparent);
        margin: 20px 0;
    }

    .preview-social {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin: 20px 0;
    }

    .social-icon {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #f5f5f5;
        color: var(--color-teal);
        font-size: 1.2rem;
        transition: all 0.3s ease;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .social-icon:hover {
        background: var(--gradient-primary);
        color: #fff;
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(23, 162, 184, 0.3);
    }

    /* ============================================ */
    /* ALERT STYLES                                */
    /* ============================================ */

    .alert {
        border-radius: 12px;
        border: 1px solid;
        padding: 15px 20px;
        margin-bottom: 20px;
        font-size: 0.95rem;
        animation: slideInAlert 0.4s ease-out;
    }

    .alert-success {
        background: rgba(40, 167, 69, 0.1);
        border-color: rgba(40, 167, 69, 0.3);
        color: #155724;
    }

    .alert-danger {
        background: rgba(220, 53, 69, 0.1);
        border-color: rgba(220, 53, 69, 0.3);
        color: #721c24;
    }

    @keyframes slideInAlert {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ============================================ */
    /* PLACEHOLDER AVATAR                          */
    /* ============================================ */

    .avatar-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #f0f0f0 0%, #e8e8e8 100%);
        color: #999;
        font-size: 3rem;
        border-radius: 50%;
    }

    /* ============================================ */
    /* INPUT FILE HIDDEN                           */
    /* ============================================ */

    #profile_photo {
        display: none;
    }

    /* ============================================ */
    /* RESPONSIVE ADJUSTMENTS                      */
    /* ============================================ */

    @media (max-width: 768px) {
        .profile-title {
            font-size: 1.8rem;
        }

        .modern-card {
            padding: 25px;
        }

        .profile-photo-wrapper {
            width: 130px;
            height: 130px;
        }

        .preview-avatar-wrapper {
            width: 110px;
            height: 110px;
        }

        .section-title {
            font-size: 1.1rem;
        }

        .btn-group-row {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .profile-edit-wrapper {
            padding: 20px 15px;
        }

        .profile-title {
            font-size: 1.5rem;
        }

        .modern-card {
            padding: 20px;
        }

        .profile-photo-wrapper {
            width: 120px;
            height: 120px;
        }

        .preview-avatar-wrapper {
            width: 100px;
            height: 100px;
        }

        .preview-name {
            font-size: 1.3rem;
        }

        .btn-group-row {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="profile-edit-wrapper">
    <div class="container-fluid">
        <!-- Page Title -->
        <div class="profile-title-section">
            <h1 class="profile-title">
                <i class="fa fa-user-circle" style="margin-right: 12px;"></i>Edit Profil
            </h1>
            <div class="profile-title-underline"></div>
        </div>

        <!-- Two Column Layout -->
        <div class="profile-container">

            <!-- ========================================== -->
            <!-- LEFT COLUMN: EDIT FORMS                   -->
            <!-- ========================================== -->
            <div>

                <!-- Profile Photo Upload Form -->
                <form id="photoForm" method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" style="display: none;">
                    @csrf
                    @method('patch')
                    <input type="file" id="profile_photo" name="profile_photo" accept="image/jpeg,image/png,image/jpg">
                </form>

                <!-- Profile Information Card -->
                <div class="modern-card" style="animation-delay: 0.1s;">
                    <div class="profile-photo-container">
                        <!-- Profile Photo Display -->
                        <div class="profile-photo-wrapper" onclick="document.getElementById('profile_photo').click();">
                            <div class="profile-photo-inner">
                                <img id="profilePhotoImg" class="profile-photo-img"
                                     src="{{ auth()->user()->profile_photo_path ? asset('storage/' . auth()->user()->profile_photo_path) : asset('assets/img/default-avatar.png') }}"
                                     alt="{{ auth()->user()->name }}">
                            </div>
                            <div class="photo-overlay">
                                <div class="photo-overlay-text">
                                    <span class="photo-overlay-icon"><i class="fa fa-camera"></i></span>
                                    <span>{{ __('Ubah Foto') }}</span>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="upload-photo-btn" onclick="document.getElementById('profile_photo').click();">
                            <i class="fa fa-cloud-upload" style="margin-right: 8px;"></i>{{ __('Unggah Foto Profil') }}
                        </button>
                    </div>

                    <form method="post" action="{{ route('profile.update') }}" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <!-- User Information Section -->
                        <h3 class="section-title">
                            <i class="fa fa-info-circle"></i>{{ __('Informasi Pengguna') }}
                        </h3>

                        @include('alerts.success')
                        @include('alerts.error_self_update', ['key' => 'not_allow_profile'])

                        <!-- Name Field -->
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label for="input-name" class="form-control-label">
                                <i class="fa fa-user"></i>{{ __('Nama Lengkap') }}
                            </label>
                            <input type="text"
                                   name="name"
                                   id="input-name"
                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   placeholder="{{ __('Masukkan nama lengkap') }}"
                                   value="{{ old('name', auth()->user()->name) }}"
                                   required
                                   autofocus>
                            @include('alerts.feedback', ['field' => 'name'])
                        </div>

                        <!-- Email Field -->
                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <label for="input-email" class="form-control-label">
                                <i class="fa fa-envelope"></i>{{ __('Email') }}
                            </label>
                            <input type="email"
                                   name="email"
                                   id="input-email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   placeholder="{{ __('Masukkan email') }}"
                                   value="{{ old('email', auth()->user()->email) }}"
                                   required>
                            @include('alerts.feedback', ['field' => 'email'])
                        </div>

                        <!-- Role Field (Read-only) -->
                        <div class="form-group">
                            <label for="input-role" class="form-control-label">
                                <i class="fa fa-shield"></i>{{ __('Role / Peran') }}
                                <span class="role-badge-inline" style="text-transform: capitalize;">
                                    {{ ucfirst(auth()->user()->role ?? 'staff') }}
                                </span>
                            </label>
                            <input type="text"
                                   id="input-role"
                                   class="form-control"
                                   value="{{ ucfirst(auth()->user()->role ?? 'staff') }}"
                                   readonly
                                   disabled>
                        </div>

                        <!-- Save Button -->
                        <div class="text-center-btn" style="margin-top: 30px;">
                            <button type="submit" class="btn-gradient-primary">
                                <i class="fa fa-check-circle" style="margin-right: 8px;"></i>{{ __('Simpan Perubahan') }}
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Password Change Card -->
                <div class="modern-card" style="animation-delay: 0.2s; margin-top: 30px;">
                    <form method="post" action="{{ route('profile.password') }}">
                        @csrf
                        @method('patch')

                        <!-- Password Section Title -->
                        <h3 class="section-title">
                            <i class="fa fa-lock"></i>{{ __('Ubah Kata Sandi') }}
                        </h3>

                        @include('alerts.success', ['key' => 'password_status'])
                        @include('alerts.error_self_update', ['key' => 'not_allow_password'])

                        <!-- Current Password Field -->
                        <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                            <label for="input-current-password" class="form-control-label">
                                <i class="fa fa-key"></i>{{ __('Kata Sandi Saat Ini') }}
                            </label>
                            <input type="password"
                                   name="old_password"
                                   id="input-current-password"
                                   class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}"
                                   placeholder="{{ __('Masukkan kata sandi saat ini') }}"
                                   required>
                            @include('alerts.feedback', ['field' => 'old_password'])
                        </div>

                        <!-- New Password Field -->
                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label for="input-password" class="form-control-label">
                                <i class="fa fa-lock"></i>{{ __('Kata Sandi Baru') }}
                            </label>
                            <input type="password"
                                   name="password"
                                   id="input-password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   placeholder="{{ __('Masukkan kata sandi baru') }}"
                                   required>
                            @include('alerts.feedback', ['field' => 'password'])
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="form-group">
                            <label for="input-password-confirmation" class="form-control-label">
                                <i class="fa fa-check-square"></i>{{ __('Konfirmasi Kata Sandi') }}
                            </label>
                            <input type="password"
                                   name="password_confirmation"
                                   id="input-password-confirmation"
                                   class="form-control"
                                   placeholder="{{ __('Konfirmasi kata sandi baru') }}"
                                   required>
                        </div>

                        <!-- Change Password Button -->
                        <div class="text-center-btn" style="margin-top: 30px;">
                            <button type="submit" class="btn-gradient-primary">
                                <i class="fa fa-refresh" style="margin-right: 8px;"></i>{{ __('Ubah Kata Sandi') }}
                            </button>
                        </div>
                    </form>
                </div>

            </div>

            <!-- ========================================== -->
            <!-- RIGHT COLUMN: USER PREVIEW CARD             -->
            <!-- ========================================== -->
            <div class="modern-card user-preview-card" style="animation-delay: 0.3s;">
                <!-- Gradient Background -->
                <div class="preview-bg-gradient"></div>

                <!-- Preview Content -->
                <div class="preview-content">
                    <!-- Avatar -->
                    <div class="preview-avatar-wrapper">
                        <div class="preview-avatar-inner">
                            <img id="previewAvatarImg" class="preview-avatar-img"
                                 src="{{ auth()->user()->profile_photo_path ? asset('storage/' . auth()->user()->profile_photo_path) : asset('assets/img/default-avatar.png') }}"
                                 alt="{{ auth()->user()->name }}">
                        </div>
                    </div>

                    <!-- User Name -->
                    <h2 class="preview-name">{{ auth()->user()->name }}</h2>

                    <!-- User Email -->
                    <p class="preview-email">
                        <i class="fa fa-envelope" style="margin-right: 6px; color: var(--color-teal);"></i>
                        {{ auth()->user()->email }}
                    </p>

                    <!-- Role Badge -->
                    <div>
                        <span class="preview-role-badge" style="text-transform: capitalize;">
                            <i class="fa fa-badge" style="margin-right: 6px;"></i>
                            {{ ucfirst(auth()->user()->role ?? 'staff') }}
                        </span>
                    </div>

                    <div class="preview-divider"></div>

                    <!-- Social Media Icons -->
                    <div class="preview-social">
                        <a href="https://facebook.com" target="_blank" class="social-icon" title="Facebook">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a href="https://twitter.com" target="_blank" class="social-icon" title="Twitter">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a href="https://instagram.com" target="_blank" class="social-icon" title="Instagram">
                            <i class="fa fa-instagram"></i>
                        </a>
                    </div>

                    <div class="preview-divider"></div>

                    <!-- Profile Status -->
                    <div style="padding: 20px; background: rgba(23, 162, 184, 0.05); border-radius: 10px; margin-top: 20px;">
                        <p style="font-size: 0.9rem; color: #666; margin-bottom: 10px;">
                            <i class="fa fa-check-circle" style="color: #28a745; margin-right: 8px;"></i>
                            <strong>Status:</strong> Aktif
                        </p>
                        <p style="font-size: 0.85rem; color: #999; margin: 0;">
                            <i class="fa fa-calendar" style="color: var(--color-teal); margin-right: 8px;"></i>
                            {{ __('Terakhir diperbarui:') }} {{ auth()->user()->updated_at ? auth()->user()->updated_at->format('d M Y H:i') : 'N/A' }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
    // ============================================
    // PROFILE PHOTO PREVIEW & UPLOAD
    // ============================================

    const profilePhotoInput = document.getElementById('profile_photo');
    const profilePhotoImg = document.getElementById('profilePhotoImg');
    const previewAvatarImg = document.getElementById('previewAvatarImg');
    const photoForm = document.getElementById('photoForm');

    // Update preview images on file selection
    profilePhotoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];

        if (file) {
            // Validate file type
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!validTypes.includes(file.type)) {
                alert('{{ __("Hanya file gambar (JPEG, PNG) yang diperbolehkan") }}');
                return;
            }

            // Validate file size (max 5MB)
            const maxSize = 5 * 1024 * 1024;
            if (file.size > maxSize) {
                alert('{{ __("Ukuran file tidak boleh melebihi 5MB") }}');
                return;
            }

            // Preview the image
            const reader = new FileReader();
            reader.onload = function(event) {
                const imageData = event.target.result;
                profilePhotoImg.src = imageData;
                previewAvatarImg.src = imageData;

                // Auto-submit the photo form
                photoForm.submit();
            };
            reader.readAsDataURL(file);
        }
    });

    // ============================================
    // PAGE ANIMATIONS
    // ============================================

    document.addEventListener('DOMContentLoaded', function() {
        // Smooth scroll on page load
        window.scrollTo(0, 0);
    });

    // ============================================
    // FORM VALIDATION FEEDBACK
    // ============================================

    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = form.querySelector('[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{ __("Memproses...") }}';
            }
        });
    });
</script>
@endpush

@endsection
