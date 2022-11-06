<?php

namespace App\Models;


class Post
{
    // isi datanya
    private static  $blog_posts = [
        [
            "title" => "Judul Post Pertama",
            "slug" => "judul-post-pertama",
            "author" => "Muhammad Yazid",
            "body" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Delectus, iste vero. Facere natus adipisci delectus veniam fugit totam itaque qui blanditiis maxime nostrum, vitae aliquid ea eius aliquam quia sint ipsum voluptates ex! Quas delectus veniam quos qui, repellat iure. Ratione hic minus maxime libero, molestiae impedit vel omnis commodi assumenda sint consequatur porro reprehenderit fuga ex fugiat consequuntur nam itaque nemo eaque sunt mollitia natus! Soluta, sunt velit repudiandae nostrum voluptas a architecto qui ipsa culpa accusamus, cum impedit."
        ],
        [
            "title" => "Judul Post Kedua",
            "slug" => "judul-post-kedua",
            "author" => "Firdaus",
            "body" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Delectus, iste vero. Facere natus adipisci delectus veniam fugit totam itaque qui blanditiis maxime nostrum, vitae aliquid ea eius aliquam quia sint ipsum voluptates ex! Quas delectus veniam quos qui, repellat iure. Ratione hic minus maxime libero, molestiae impedit vel omnis commodi assumenda sint consequatur porro reprehenderit fuga ex fugiat consequuntur nam itaque nemo eaque sunt mollitia natus! Soluta, sunt velit repudiandae nostrum voluptas a architecto qui ipsa culpa accusamus, cum impedit. Quas delectus veniam quos qui, repellat iure. Ratione hic minus maxime libero, molestiae impedit vel omnis commodi assumenda sint consequatur porro reprehenderit fuga ex fugiat consequuntur nam itaque nemo eaque sunt mollitia natus! Soluta, sunt velit repudiandae nostrum voluptas a architecto qui ipsa culpa accusamus, cum impedit."
        ]
    ];

    // mengambil semua data yg ada di properti diatas ini
    public static function all()
    {
        // membuat collection dari value yg diberikan
        return collect(self::$blog_posts);
    }

    // mencari single data berdasarkan slugnya, dan ditampilkan single data tersebut
    public static function find($slug)
    {
        // ambil dulu semua datanya (keyword static ini untuk memanggil method, sedangkan self untuk memanggil properti)
        $posts = static::all();
        // $post = [];
        // foreach($posts as $p){
        //     if($p['slug'] === $slug){
        //         $post = $p;
        //     }
        // }
            
        // ini artinya akan mencarikan data yg dimana slug yg di urlnya nya sama dengan slug di dalam data arraynya
        // dan ini akan menampilkan single datanya
        return $posts->firstWhere('slug', $slug);
    }
}