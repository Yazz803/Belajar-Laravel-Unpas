@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-8">
            {{-- menggunakan htmlspecialchars --}}
            <h1>{{ $post->title }}</h1>
            <a href="/dashboard/posts" class="btn btn-success"><span data-feather="arrow-left"></span> Back To All My Posts</a>
            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning"><span data-feather="edit"></span> Edit</a>
            <form action="/dashboard/posts/{{ $post->slug }}" method="POST" class="d-inline">
              @method('delete')
              @csrf
              <button class="btn btn-danger" onclick="return confirm('Datanya akan dihapus, Tekan \'Ok\' untuk menghapus data')"><span data-feather="x-circle"></span>Delete</button>
            </form>
            {{-- ini untuk menghapus htmlspecialcharsnya, agar tag p yg ada di dalam echo phpnya, bisa dijalankan --}}

            @if ($post->image)
                <div style="max-height:350px; overflow:hidden">
                    <img src="{{ asset('storage/'. $post->image) }}" class="card-img-top mt-3" alt="{{ $post->category->name }}" class="img-fluid">
                </div>
            @else
                <div style="max-height:350px; overflow:hidden">
                    <img src="{{ $baseurl }}/img/profilewebsite2.png" class="card-img-top mt-3" alt="{{ $post->category->name }}" class="img-fluid">
                </div>
            @endif


            <article class="my-3 fs-6">
                {!! $post->body !!}
            </article>
        </div>
    </div>
</div>
@endsection