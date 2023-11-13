@extends('layouts.admin.master')
@section('title')
    Tambah Artikel Blog
@endsection
@section('page-title')
    Tambah Artikel Blog
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <form action="{{ route('blogs.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Artikel Blog</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="title" class="col-md-2 col-form-label">Judul Artikel</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" autocomplete="off" name="title" id="title">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="body" class="col-md-2 col-form-label">Isi Konten Artikel</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" id="body" name="body"></textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Kategori Artikel</label>
                                <div class="col-md-10">
                                    <select class="form-select" name="blog_categories_id">
                                        <option selected>Pilih Kategori Artikel</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="form-group">
                                    <label>Foto Artikel</label>
                                    <input type="file" name="photo_url" class="form-control" />
                                    <p class="text-muted">
                                        Kamu dapat memilih lebih dari satu file
                                    </p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary w-md">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    @endsection
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('body');
        </script>
@endsection
