<?php

namespace App\Providers;

// use Illuminate\Auth\Access\Gate;
use Illuminate\Pagination\Paginator;
// use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // menambahkan bootstrap
        Paginator::useBootstrapFive();

        // membuat gate. nama dari 'admin' ini bebas
        Gate::define('admin', function(User $user){
            return $user->must_admin; // jika user mempunyai must_admin(di dalam table users) 1 atau true, maka gerbangnya boleh diakses
        });
        // kita akan mendifinisikan sebuah gate yang namanya admin, dimana gate ini, hanya bisa diakses pagarnya/gerbangnya
        // oleh user yang usernamenya 'yazz'
        // sekarang jadi kita punya cara lain untuk bisa melakukan otorisasi
        // otorisasi yang pertama kita pakai middleware, kelebihan dari middelware itu gampang ketika kita mau ngasih
        // otorisasi untuk banyak method sekaligus, kekurangannya adalah dia gk fleksibel
    }
}
