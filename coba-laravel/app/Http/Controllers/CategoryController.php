<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index ()
    {
        return view('categories', [
            'title' => 'Post Categories',
            'categories' => Category::all(),
            'active' => 'categories',
            'baseurl' => Controller::BASEURL
        ]);
    }

    public function show (Category $category)
    {
        return view('posts', [
            'title' => "Post By Category : $category->name",
            'posts' => $category->posts->load('category','author'), // menambahkan teknik lazy eager loading, agar querynya bisa diminimalisir agar nantinya tidak memperlambat aplikasinya
            'baseurl' => Controller::BASEURL,
            'active' => 'categories'
        ]);
    }
}
