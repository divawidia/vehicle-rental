@extends('layouts.admin.master')
@section('title')
    Tambah Tag Artikel Blog
@endsection
@section('page-title')
    Tambah Tag Artikel Blog
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <form action="{{ route('tags.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Tag Artikel Blog</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Nama Tag</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" autocomplete="off" name="tag_name" id="tag_name" placeholder="Isikan nama tag" value="{{ old('tag_name') }}">
                                    @error('tag_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
