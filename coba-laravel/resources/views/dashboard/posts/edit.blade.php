@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Post</h1>
</div>
<div class="col-lg-8">
    <form method="POST" action="/dashboard/posts/{{ $post->slug }}" class="mb-5" enctype="multipart/form-data">
      @method('put') {{-- boleh put, boleh patch --}}
        @csrf
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $post->title) }}" autofocus required>
        @error('title')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" value="{{ old('slug', $post->slug) }}" name="slug" required>
        @error('slug')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select class="form-select" name="category_id">
          @foreach ($categories as $category)
          @if(old('category_id', $post->category_id) == $category->id)
          <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
          @else
          <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endif
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label for="image" class="form-label">Pilih Gambar</label>
        <input type="hidden" name="oldImage" value="{{ $post->image }}"> {{-- ini menyimpan gambar lama --}}
        @if($post->image)
          <img src="{{ asset('storage/'. $post->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
        @else
          <img class="img-preview img-fluid mb-3 col-sm-5">
        @endif
          <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="image" onchange="previewImage()">
        @error('image')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        @error('body')
        <p class="text-danger">{{ $message }}</p>
        @enderror
        <input id="body" type="hidden" name="body" value="{{ old('body', $post->body) }}">
        <trix-editor input="body"></trix-editor>
      </div>

      <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>

{{-- Menggunakan fetch API Javascript untuk slug --}}
<script>
  const title = document.querySelector('#title');
  const slug = document.querySelector('#slug');

  title.addEventListener('change', function(){
    // kita akan fetch data dari method yg akan kita buat di DasboardPostController, jadi nanti disitu akan dibuat 1 method baru yg tugasnya untuk menangani ketika ada permintaan slug
    fetch('/dashboard/posts/checkSlug?title=' + title.value)
    .then(response => response.json())
    .then(data => slug.value = data.slug)
  });

  document.addEventListener('trix-file-accept', function(e){
    e.preventDefault();
  });

  function previewImage(){
    const image = document.querySelector('#image')
    const imgPreview = document.querySelector('.img-preview')

    imgPreview.style.display = 'block'

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0])

    oFReader.onload = function(oFREvenet){
      imgPreview.src = oFREvenet.target.result
    }
  }
</script>
@endsection