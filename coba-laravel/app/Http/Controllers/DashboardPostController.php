<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return dd(Post::where('user_id', auth()->user()->id)->get());
        return view('dashboard.posts.index',[
            'baseurl' => Controller::BASEURL,
            'posts' => Post::where('user_id', auth()->user()->id)->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.create',[
            'baseurl' => Controller::BASEURL,
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // ddd($request); // dump die and debug

        // ini akan mengirimkan file apapun ke dalam folder post-images
        // store('post-images'); fungsi ini mengembalikan path-nya selain memasukan/mengupload file-nya
        // return $request->file('image')->store('post-images'); debuging

        $validateData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'image' => 'image|file|max:1024', // jadi ini selain image itu gk bole, file ini untuk ngebaca bahwa ini tu bukan karakter/integer, tapi ukuran file, max=maksimal ukuran, min=minimal, size=ukurannya sama persis, ini satuannya kilobyte
            'body' => 'required'
        ]);

        // jika user ada yg upload image, maka jalankan validasi ini
        if($request->file('image')){ 
            $validateData['image'] = $request->file('image')->store('post-images');
        }
        // jadi kalau image kosong, code diatas gk dijalanin, tapi kalau ada isinya, dengan asumsi udah lolos dari validasi
        // upload ke post-images, lalu insert ke dalam database

        $validateData['user_id'] = auth()->user()->id;
        $validateData['excerpt'] = Str::limit(strip_tags($request->body, 200)); // fungsi dari class Str::limit ini, dia akan membatasi string sesuai dengan keinginan kita, misal mau dilimit 200 karakter, bisa tulis 200 setelah stringnya. function strip_tags untuk menghilangkan tag html 

        Post::create($validateData);

        return redirect('/dashboard/posts')->with('success', 'Postingan baru berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
            'post' => $post,
            'baseurl' => Controller::BASEURL
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('dashboard.posts.edit',[
            'post' => $post,
            'categories' => Category::all(),
            'baseurl' => Controller::BASEURL
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ];

        // untuk mengecek apakah slugnya masih yg sama atau beda
        // jika beda, ini dijalankan, tapi jika sama, ini tidak akan dijalankan dan meskipun slugnya sama, itu tidak akan error
        if($request->slug != $post->slug){
            $rules['slug'] = 'required|unique:posts';
        }

        
        $validateData = $request->validate($rules);
        // jika user ada yg upload image, maka jalankan validasi ini
        if($request->file('image')){ 
            if($request->oldImage){
                Storage::delete($request->oldImage); // untuk menghapus file yg ada di storage
            }
            $validateData['image'] = $request->file('image')->store('post-images');
        }
        // jadi kalau image kosong, code diatas gk dijalanin, tapi kalau ada isinya, dengan asumsi udah lolos dari validasi
        // upload ke post-images, lalu insert ke dalam database
        
        $validateData['user_id'] = auth()->user()->id;
        $validateData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        // ini akan mencari id berdasarkan id postingannya, lalu semua data berdasarkan id tersebut akan di update
        // proses updatenya ada di $validateData
        Post::where('id', $post->id)
            ->update($validateData);

        return redirect('/dashboard/posts')->with('success', 'Postingan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->image){
            Storage::delete($post->image); // untuk menghapus file yg ada di storage
        }
        Post::destroy($post->id);
        return redirect('/dashboard/posts')->with('success', 'Postingan berhasil dihapus!');
    }

    // proses pengambilan data slug-nya
    // yg nanti akan mengambil request, request akan didapatkan ketika kita berpindah tab, akan mengambil isi dari inputan titlenya
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        // Post::class = ngambil table Posts
        // 'slug' = ngambil field-nya slug, supaya nanti diubah ke field slug
        // $request->title =  diambil dari /dashboard/posts/createSlug?title=' + title.value yg ada di file create.blade.php (javascriptnya)
        
        return response()->json(['slug' => $slug]);
    }
}
