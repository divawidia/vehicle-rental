@extends('layouts.admin.master')
@section('title')
    Tambah Kategori Blog
@endsection
@section('page-title')
    Tambah Kategori Blog
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <form action="{{ route('kategori-blog.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Data Kategori Blog</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="category_name" class="col-md-2 col-form-label">Nama Kategori Blog</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" autocomplete="off" name="category_name" id="category_name" placeholder="Isikan nama jenis kategori blog" required>
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
@endsection
