<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;

    // isi dari properti fillable adalah array, buat ngasih tau field mana aja yang boleh diisi
    // kalau kita gk tulis disini, maka field tersebut gk bisa diisi pake create dan nantinya akan secara otomatis diisi
    // sesuai dengan apa yang kita buat di dalam schema (yg ada difolder migrations sesuai dengan nama tablenya)
    // protected $fillable = ['title','excerpt','body']; // jadi ini yg boleh diisi, sisanya tidak boleh.
    protected $guarded = ['id']; // ini hanya idnya saja yg tidak boleh diisi, sisanya boleh, jadi kebalikannya dari fillable
    protected $with = ['category', 'author'];

    public function scopeFilter($query, array $filters) // ini nanti masuk ke PostController
    {
        // ini untuk melakukan gitur searching
        // if(request('search')){ // kalau request ini sebenarnya kerjaanya Controller, untuk ngecek ada request atau enggak, bukan kerjaanya model
        if(isset($filters['search']) ? $filters['search'] : false){
            // jadi ini sama dengan "SELECT * FROM Post Where title like %search$", jadi ini ditumpuk kalau ada searchnya
            return $query->where('title','like','%' . $filters['search'] . '%') // mencari data berdasarkan title-nya
                ->orWhere('body', 'like', '%'. $filters['search'] . '%'); // mencari data berdasarkan isi body-nya
            // data diatas ini kerjaannya Model
        }

        // jadi kalau "$filters['search']" ini gk ada, maka pilih yg false, tapi kalo ada, pilih "$filters['search']"
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('title','like','%' . $search . '%') // mencari data berdasarkan title-nya
                ->orWhere('body', 'like', '%'. $search . '%');
        });

        $query->when($filters['category'] ?? false, function($query, $category) {
            return $query->whereHas('category', function($query) use ($category) { // jadi querynya memiliki relationship category
                $query->where('slug', $category);
            });
        });

        // ini pake versi callback
        // $query->when($filters['author'] ?? false, function($query, $author) {
        //     return $query->whereHas('author', function($query) use ($author) { // jadi querynya memiliki relationship author
        //         $query->where('username', $author);
        //     });
        // });

        // pake versi ero-functions
        $query->when($filters['author'] ?? false, fn($query, $author) => 
            $query->whereHas('author', fn($query) =>
                $query->where('username', $author)
            )
        );

    }

    public function category()
    {
        // model post sudah berelasi dengan table category
        return $this->belongsTo(Category::class);
    }

    // ini akan error karena laravel akan mengecek ada gk di table posts, field yg namanya author_id sebagai foreign keynya
    // karena di table posts nya ini cuma ada user_id, jadinya error
    public function author()
    {
        // ini artinya Table Post belongsTo/hanya boleh dimiliki 1 kali oleh User
        return $this->belongsTo(User::class, 'user_id'); // user_id nya ini akan diganti aliasnya/nama lainnya menjadi author
    }

    // sekarang, setiap Route otomatis mencarinya slug, bukan lagi id
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
