<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id']; // ini digunakan untuk menghindari mass assignment ketika membuat field baru yg banyak,
    // jadi field id itu tidak boleh diisi, sedangkan yg lainnya boleh diisi.
    // $data_diri = new DataDiri
    // Post::create(['nama' => 'Muhammad Yazid Akbar', 'umur' => '17']) 
    // code diatas nanti bisa digunakan untuk membuat field baru di table DataDiri yg berisikan field nama dan umur
    /*
        Cara Update data field :

        $namatable = new nama_model (harus sesuai dengan yg ada di folder models)
        Post::find(3)->update(['title' => 'Judul ke tiga berubah'])
        ini akan mengupdate title berdasarkan id yg ada di table post

        Post::where(['title', 'Judul ke tiga berubah'])->update(['excerpt' => 'excerpt ke tiga berubah'])
        ini akan mengupdate excerpt yg dimana titlenya itu Judul ke tiga berubah (ini sama dengan yg di SQL, 'WHERE id = $id' gitu)
    */

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
