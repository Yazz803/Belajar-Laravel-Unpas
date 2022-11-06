<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

// controller berfungsi untuk melakukan semua proses yg akan dilakukan nantinya
// jadi ketika ingin membuat CRUD, prosesnya disini
// bagian ini yang menjembatani antara model dan view

// memanggil/menggunakan class post (berisikan data) yg ada di models
use App\models\post;

class PostController extends Controller
{
    public function index()
    {
        // ini akan menampilkan semua data dari class Post yg ada di folder model (model tu buat nyimpen data)
        // form search yg ada di post.blade.php, akan mengarah kesini
 
        // dd(request('search')); // Melakukan vardump, apakah data yg dikirim sudah diterima atau belum (data form submitsearch)

        $title = '';
        if(request('category')){
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in ' . $category->name;
        }

        if(request('author')){
            $author = User::firstWhere('username', request('author'));
            $title = ' by ' . $author->name;
        }
        return view('posts', [
            "title" => "All Posts" . $title,
            // "posts" => Post::all()
            // ini akan memanggil postingan terbaru
            // penambahan method with ini untuk mencegah N+1 Problem
            // didalam with-nya ada parameternya, kita ambil dulu author, lalu category
            // jadi sekalian diambilin author sama category sehingga pas looping, dia gk query tapi
            // langsung ngambil dari data yg ada di dalam Post::with(['author','category]) nya sekaligus -> udh dimasukin ke Post model
            // get ini "filter(request(['search', 'category', 'author']))->get()" akan diganti dengan 
            // paginate(7) ini untuk menampilkan postingannya hanya 7 saja, jadi dibatesin gitu
            "posts" => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(7)->WithQueryString(), // filter ini didapatkan dari Post Model
            'baseurl' => Controller::BASEURL,
            'active' => 'posts'
        ]);
    }

    // ini namanya Route Model Binding, jadi kita tulis nama modelnya disini
    // variabel yg menerimanya harus sama dengan variabel yg dikirim di Route web.php nya, yg ini {post}
    public function show(Post $post)
    {
        // ini akan menampilkan single data dari kelas Post yg ada di folder model
        return view("post", [
            "title" => "single post",
            "post" => $post,
            'baseurl' => Controller::BASEURL,
            'active' => 'posts'
        ]);
    }
}
