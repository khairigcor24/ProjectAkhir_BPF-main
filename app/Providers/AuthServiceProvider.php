<?php

namespace App\Providers;

use App\Models\Donasi;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Gate untuk Admin - Full Access
        Gate::define('is-admin', function (User $user) {
            return $user->isAdmin();
        });

        // Gate untuk Staff - Limited Access
        Gate::define('is-staff', function (User $user) {
            return $user->isStaff();
        });

        // Gate untuk Admin atau Staff
        Gate::define('is-admin-or-staff', function (User $user) {
            return $user->isAdminOrStaff();
        });

        // Gate untuk menghapus donasi (hanya Admin)
        Gate::define('delete-donasi', function (User $user) {
            return $user->isAdmin();
        });

        // Gate untuk mengubah konfigurasi (hanya Admin)
        Gate::define('manage-config', function (User $user) {
            return $user->isAdmin();
        });

        // Gate untuk memvalidasi donasi (Admin dan Staff)
        Gate::define('validate-donasi', function (User $user) {
            return $user->isAdminOrStaff();
        });

        // Gate untuk melihat laporan (Admin dan Staff)
        Gate::define('view-report', function (User $user) {
            return $user->isAdminOrStaff();
        });
    }
}



