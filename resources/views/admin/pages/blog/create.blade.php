@extends('admin.layouts.master')

@section('title')
    Tambah Artikel Blog
@endsection
{{--@section('css')--}}
{{--    <link rel="stylesheet" href="{{ URL::asset('build/js/jpreview/jpreview.css') }}" type="text/css" />--}}
{{--    @endsection--}}
@section('page-title')
    Tambah Artikel Blog
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <form action="{{ route('artikel.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Artikel Blog</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Thumbnail Artikel Blog</label>
                                <div class="col-md-10">
                                    <input type="file" id="thumbnail_photo" name="thumbnail_photo" class="form-control" accept="image/*" required value="{{ old('thumbnail_photo') }}"/>
                                    <img id="preview" class="rounded img-thumbnail mt-3" src="{{ old('thumbnail_photo') }}" alt="image thumbnail" style="display:none;"/>
                                    @error('thumbnail_photo')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="title" class="col-md-2 col-form-label">Judul Artikel</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" autocomplete="off" name="title" id="title" value="{{ old('title') }}">
                                    @error('title')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="body" class="col-md-2 col-form-label">Isi Konten Artikel</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" id="body" name="body">{{ old('body') }}</textarea>
                                    @error('body')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" for="tag">Tag Artikel</label>
                                <div class="col-md-10">
                                    <select class="form-select" name="tag_id[]" multiple="multiple" data-placeholder="Pilih Tag Artikel Blog" id="tag" required>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('tags')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" for="status_artikel">Status Publish
                                    Artikel</label>
                                <div class="col-md-10">
                                    <select class="form-select" name="status" id="status_artikel" data-placeholder="Pilih Status Artikel Blog" required>
                                        <option value="" selected disabled>Pilih Status Artikel Blog</option>
                                        @foreach([1 => "Publish", 0 => "Private"] AS $status => $status_label)
                                            <option value="{{ $status }}">{{ $status_label }}</option>
                                        @endforeach
                                        @error('status')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </select>
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
        <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor.create(document.querySelector('#body'), {
                ckfinder: {
                    uploadUrl: '{{route('blog-photo-upload', ['_token' => csrf_token()])}}'
                }
            })
                .catch(error => {
                    console.error(error);
                });
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#tag').select2({
                    width: '100%',
                    theme: 'bootstrap-5'
                });
                $('#status_artikel').select2({
                    width: '100%',
                    theme: 'bootstrap-5'
                });
            });
        </script>
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
