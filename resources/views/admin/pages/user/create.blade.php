@extends('admin.layouts.master')

@section('title')
    Tambah User Admin
@endsection
{{--@section('css')--}}
{{--    <link rel="stylesheet" href="{{ URL::asset('build/js/jpreview/jpreview.css') }}" type="text/css" />--}}
{{--    @endsection--}}
@section('page-title')
    Tambah User Admin
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah User Admin</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="mb-3 row">
                                    <label for="name" class="col-md-2 col-form-label">Nama</label>
                                    <div class="col-md-10">
                                        <input class="form-control @error('name') is-invalid @enderror" type="text" autocomplete="off" name="name" id="name" value="{{ old('name') }}" required>
                                        @error('name')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="email" class="col-md-2 col-form-label">Email</label>
                                    <div class="col-md-10">
                                        <input class="form-control @error('email') is-invalid @enderror" type="email" autocomplete="off" name="email" id="email" value="{{ old('email') }}" required>
                                        @error('email')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="password" class="col-md-2 col-form-label">Password</label>
                                    <div class="col-md-10">
                                        <input class="form-control @error('password') is-invalid @enderror" type="password" autocomplete="off" name="password" id="password" value="{{ old('password') }}" required>
                                        @error('password')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="password-confirm" class="col-md-2 col-form-label">Confirm
                                        Password</label>
                                    <div class="col-md-10">
                                        <input class="form-control @error('password') is-invalid @enderror" type="password" autocomplete="off" name="password_confirmation" id="password-confirm">
                                        @error('password')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-md-2 col-form-label">Foto Profile</label>
                                    <div class="col-md-10">
                                        <input type="file" id="photo_url" name="photo_url" class="form-control" accept="image/*" value="{{ old('photo_url') }}"/>
                                        <img id="preview" class="rounded img-thumbnail mt-3" src="{{ old('photo_url') }}" alt="foto profile" style="display:none;"/>
                                        @error('photo_url')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="status" class="col-md-2 col-form-label">Status Akun</label>
                                    <div class="col-md-10 d-flex align-items-center">
                                        @foreach([1 => "Aktif", 0 => "Non Aktif"] AS $status => $status_label)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status" id="{{ $status }}" value="{{ $status }}">
                                                <label class="form-check-label" for="{{ $status }}">{{ $status_label }}</label>
                                            </div>
                                        @endforeach
                                    </div>
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
        <script>
            thumbnail_photo.onchange = evt => {
                preview = document.getElementById('preview');
                preview.style.display = 'block';
                const [file] = thumbnail_photo.files
                if (file) {
                    preview.src = URL.createObjectURL(file)
                }
            }
        </script>
@endsection
