<?php

namespace App\Providers;

use App\Models\Peminjaman;
use App\Models\Permintaan;
use App\Models\Ruang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.sidebar', function ($view) {
            if (Auth::check()) {
                // Ambil ruang yang sesuai dengan prodi teknisi yang login
                $sidebarRuangs = Ruang::where('prodi_id', Auth::user()->prodi_id)->get();
                $view->with('sidebarRuangs', $sidebarRuangs);
            }
        });

        View::composer('*', function ($view) {
            if (Auth::check() && in_array(Auth::user()->role, ['teknisi', 'kaprodi'])) {
                $prodiId = Auth::user()->prodi_id;

                $notifPeminjaman = Peminjaman::where('prodi_id', $prodiId)->where('status', 'pending')->latest()->get();
                $notifPermintaan = Permintaan::where('prodi_id', $prodiId)->where('status', 'pending')->latest()->get();

                $totalPending = $notifPeminjaman->count() + $notifPermintaan->count();

                $view->with(compact('notifPeminjaman', 'notifPermintaan', 'totalPending'));
            }
        });
    }
}
