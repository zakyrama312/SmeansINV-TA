<?php

namespace App\Providers;

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
    }
}
