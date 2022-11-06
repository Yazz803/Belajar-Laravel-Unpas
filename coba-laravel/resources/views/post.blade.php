@extends('layouts.main')

@section('container')

<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            {{-- menggunakan htmlspecialchars --}}
            <h1>{{ $post->title }}</h1>
            <p>By. <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> in <a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a></p>
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

            <a href="/posts" class="d-block btn btn-primary mb-5">Back to post</a>
        </div>
    </div>
</div>


    
@endsection

