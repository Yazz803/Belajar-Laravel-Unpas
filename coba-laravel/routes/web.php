<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home', [
        "title" => "Home",
        'active' => 'home',
        'baseurl' => Controller::BASEURL
    ]);
});

Route::get('/about', function(){
    return view('about', [
        "title" => "About",
        "name" => "Muhammad Yazid Akbar",
        "email" => "muhammadyazidakbar@gmail.com",
        "image" => "pic121.jpeg",
        'active' => 'about',
        'baseurl' => Controller::BASEURL
    ]);
});


/*
Closure adalah anonymous function, yg bisa ngakses variabel yg di import dari luar lingkungannya tanpa
menggunakan variabel global apapun

contoh :

Route::get('/blog', function () {
    return view('posts', [
        "title" => "Posts",
        "posts" => Post::all()
    ]);
});

bagian function dan seterusnya itu adalah closure
*/
// Route::get('/posts', function () {
//     return view('posts', [
//         "title" => "Posts",
//         // Posts dibawah ini, nyambung ke foreach yg ada di posts.blade.php, jadi ini isinya semua data yg ada di database
//         "posts" => Post::all()
//     ]);
// });

// string index dibawah ini adalah nama method yg ada di controllernya
Route::get('/posts',[PostController::class, 'index']);
// halaman single post
// {post:slug} ini akan mencari data berdasarkan slugnya, kalau {post} doang, dia akan mencari idnya
Route::get('/posts/{post:slug}',[PostController::class, 'show'] );

Route::get('/categories', [CategoryController::class, 'index']);

// Route::get('/categories/{category:slug}', [CategoryController::class, 'show']);

// Route::get('/categories', function () {
//     return view('categories', [
//         'title' => 'Post Categories',
//         'categories' => Category::all()
//     ]);
// });

// Route::get('categories/{category:slug}', function (Category $category){
//     return view('category', [
//         'title' => $category->name,
//         'posts' => $category->posts,
//         'category' => $category->name
//     ]);
// });


// ini nanti akan ditambahkan teknik lazy eager loading
// Route::get('/authors/{author:username}', function(User $author){
//     return view('posts', [
//         'title' => "Post By Author : $author->name",
//         'posts' => $author->posts->load('category', 'author'),
//         'gambar' => Controller::BASEURL,
//         'active' => 'blog'
//     ]);
// });

// untuk bisa mengubah default redirectnya, kita bisa mengubahnya di app->providers->RouteServiceProvider.php
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest'); // ini artinya, halaman login bisa diakses oleh user yg belum ter-autentikasi
// jadi ketika ada user iseng nyari di urlnya misal coba-laravel/dashboard, kan user harus login dulu sebelum masuk ke
// dashboard, jadi yg perlu dilakukan adalah menambahkan method nama di Routenya, agar nanti ketika user ngetik dashboard
// di url, dia akan di redirect ke halaman login
// defaultnya bisa dilihat di app/http/middleware/Authenticate.php
// untuk code diatas

Route::post('/login',[LoginController::class, 'authenticate']);
Route::post('/logout',[LoginController::class, 'logout'] );

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function(){
    return view('dashboard.index', [
        'baseurl' => Controller::BASEURL
    ]);
})->middleware('auth');

Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware("auth");

// ketik php artisan route:list untuk melihat list dari semua routenya
// fungsi except ini mengecualikan mehtod yg ada di AdminCategoryController-nya, jadi method show ini dihapus gitu
Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin');