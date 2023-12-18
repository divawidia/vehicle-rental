@extends('admin.layouts.master')

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
                <a href="{{ url()->previous() }}" class="btn btn-secondary w-auto my-3"><i class="fa fa-arrow-left"></i>
                    Kembali</a>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit artikel {{ $artikel->title }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('artikel.update', ['artikel'=>$artikel]) }}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Thumbnail Artikel Blog</label>
                                <div class="col-md-10">
                                    <input type="file" id="thumbnail_photo" name="thumbnail_photo" class="form-control" accept="image/*" required value="{{ $artikel->thumbnail_photo }}"/>
                                    <img id="preview" class="rounded img-thumbnail mt-3" src="{{ Storage::url($artikel->thumbnail_photo ?? '') }}" alt="image thumbnail"/>
                                    @error('thumbnail_photo')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="title" class="col-md-2 col-form-label">Judul Artikel</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" autocomplete="off" name="title" id="title" value="{{ $artikel->title }}" required>
                                    @error('title')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="body" class="col-md-2 col-form-label">Isi Konten Artikel</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" id="body" name="body">@php echo $artikel->body @endphp</textarea>
                                    @error('body')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" for="tag">Tag Artikel</label>
                                <div class="col-md-10">
                                    <select class="form-select" name="tag_id[]" multiple="multiple" data-placeholder="Pilih Tag Artikel Blog" id="blog_categories" required>
                                        @php
                                            $tag_id = [];
                                        @endphp
                                        @foreach($artikel->tags as $tag)
                                            @php(array_push($tag_id, $tag->id))
                                        @endforeach
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}" {{ in_array($tag->id,$tag_id) ? 'selected' : '' }}>{{ $tag->tag_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('tags')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" for="status">Status Publish Artikel</label>
                                <div class="col-md-10">
                                    <select class="form-select" name="status" data-placeholder="Pilih status publish artikel" id="status" required>
                                        @foreach([1 => "Publish", 0 => "Private"] AS $status => $status_label)
                                            <option value="{{ $status }}" {{ old("status", $artikel->status) == $status ? "selected" : "" }}>{{ $status_label }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary w-md float-end">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
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
                // var values = $('#tags option[selected="true"]').map(function() { return $(this).val(); }).get();
                $('.form-select').select2({
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
