@extends('layouts.admin.master')

@section('title')
    Edit Artikel Blog
@endsection
{{--@section('css')--}}
{{--    <link rel="stylesheet" href="{{ URL::asset('build/js/jpreview/jpreview.css') }}" type="text/css" />--}}
{{--    @endsection--}}
@section('page-title')
    Edit Artikel Blog
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit {{ $blog->title }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Thumbnail Artikel Blog</label>
                                <div class="col-md-10">
                                        <div class="col-md-4">
                                            <div class="gallery-container">
                                                <img
                                                    src="{{ Storage::url($blog->thumbnail_photo ?? '') }}"
                                                    alt=""
                                                    class="w-100"
                                                />
                                                <a href="{{ route('blog-photo-delete', $blog->thumbnail_photo) }}" class="delete-gallery">
                                                    <img src="/images/icon-delete.svg" alt="" />
                                                </a>
                                            </div>
                                        </div>
                                    <div class="col-12">
                                        <form action="{{ route('blog-thumbnail-upload') }}" method="POST" enctype="multipart/form-data">
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
                                                class="btn btn-secondary btn-block mt-3"
                                                onclick="thisFileUpload()"
                                            >
                                                Add Photo
                                            </button>
                                        </form>
                                    </div>
{{--                                    <img--}}
{{--                                        src="{{ Storage::url($blog->photos->photo_url ?? '') }}"--}}
{{--                                        alt=""--}}
{{--                                        class="w-100"--}}
{{--                                    />--}}
{{--                                    <a href="{{ route('blog-photo-delete', $blog->photos->id) }}" class="delete-gallery">--}}
{{--                                        <img src="/images/icon-delete.svg" alt="" />--}}
{{--                                    </a>--}}
{{--                                    <input type="file" name="photo_url" class="form-control" accept="image/*" required/>--}}
                                </div>
                            </div>
                            <form action="{{ route('blogs.update', $blog->id) }}" method="post" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="mb-3 row">
                                    <label for="title" class="col-md-2 col-form-label">Judul Artikel</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" autocomplete="off" name="title" id="title" value="{{ $blog->title }}" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="body" class="col-md-2 col-form-label">Isi Konten Artikel</label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" id="body" name="body">@php echo $blog->body @endphp</textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-md-2 col-form-label" for="tag">Tag Artikel</label>
                                    <div class="col-md-10">
                                        <select class="form-select" name="tag_id[]" multiple="multiple" data-placeholder="Pilih Tag Artikel Blog" id="blog_categories" required>
                                            @php
                                                $tag_id = [];
                                            @endphp
                                            @foreach($blog->tags as $tag)
                                                @php(array_push($tag_id, $tag->id))
                                            @endforeach
                                            @foreach($tags as $tag)
                                                <option value="{{ $tag->id }}" {{ in_array($tag->id,$tag_id) ? 'selected' : '' }}>{{ $tag->tag_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-md-2 col-form-label" for="status">Status Publish Artikel</label>
                                    <div class="col-md-10">
                                        <select class="form-select" name="status" data-placeholder="Pilih status publish artikel" id="status" required>
                                            @foreach([1 => "Publish", 0 => "Private"] AS $status => $status_label)
                                                <option value="{{ $status }}" {{ old("status", $blog->status) == $status ? "selected" : "" }}>{{ $status_label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-md">Submit</button>
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
        <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

        <script>
            ClassicEditor.create( document.querySelector( '#body' ),{
                ckfinder: {
                    uploadUrl: '{{route('blog-photo-upload', ['_token' => csrf_token()])}}'
                }
            })
                .catch( error => {
                    console.error( error );
                } );
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                var values = $('#tags option[selected="true"]').map(function() { return $(this).val(); }).get();
                $('.form-select').select2({
                    width:'100%',
                    theme: 'bootstrap-5'
                });
            });
        </script>
        <script>
            function thisFileUpload() {
                document.getElementById("file").click();
            }
        </script>
@endsection
