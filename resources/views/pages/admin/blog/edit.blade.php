@extends('layouts.admin.master')
@section('title')
    Edit Artikel Blog
@endsection
@section('page-title')
    Edit Artikel Blog
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <form action="{{ route('blogs.update', $blog->slug) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Artikel Blog {{ $blog->title }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="title" class="col-md-2 col-form-label">Judul Artikel</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" autocomplete="off" name="title" id="title" value="{{ $blog->title }}" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="body" class="col-md-2 col-form-label">Isi Konten Artikel</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" id="body" name="body" rows="4" required>{{ $blog->body }}</textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Kategori Artikel</label>
                                <div class="col-md-10">
                                    <select class="form-select" name="vehicle_type_id" required>
                                        <option value="{{ $blog->categories->blog_categories_id }}">{{ $blog->categories->category_name }}</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mt-4 float-end">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary w-auto"><i class="fa fa-arrow-left"></i>  Kembali</a>
                                <button type="submit" class="btn btn-primary w-md">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($blog->photos as $photo)
                                <div class="col-md-4">
                                    <div class="gallery-container">
                                        <img
                                            src="{{ Storage::url($photo->photo_url ?? '') }}"
                                            alt=""
                                            class="w-100"
                                        />
                                        <a href="{{ route('blog-photo-delete', $photo->id) }}" class="delete-gallery">
                                            <img src="/images/icon-delete.svg" alt="" />
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-12">
                                <form action="{{ route('blog-photo-upload') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $blog->id }}" name="blog_id">
                                    <input
                                        type="file"
                                        name="photo_url"
                                        id="file"
                                        style="display: none;"
                                        multiple
                                        onchange="form.submit()"
                                    />
                                    <button
                                        type="button"
                                        class="btn btn-success btn-block mt-3 w-100"
                                        onclick="thisFileUpload()"
                                    >
                                        Tambah Foto Kendaraan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script>
            function thisFileUpload() {
                document.getElementById("file").click();
            }
        </script>
        <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('body');
        </script>
@endsection
