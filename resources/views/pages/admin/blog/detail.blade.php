@extends('layouts.admin.master')
@section('title')
    Detail Artikel Blog
@endsection
@section('css')
    <!-- swiper css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}">
@endsection
@section('page-title')
    Detail Artikel Blog
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div id="deleteModal" class="modal fade" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content d-flex justify-content-center">
                    <div class="modal-header">
                        <h4 class="modal-title w-100">Apakah anda yakin?</h4>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin ingin menghapus data kendaraan ini?</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Hapus Booking">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row py-3">
                    <div class="col-6">
                        <a href="{{ url()->previous() }}" class="btn btn-primary w-auto"><i class="fa fa-arrow-left"></i>  Kembali</a>
                    </div>
                    <div class="col-6">
                        <div class="btn-toolbar float-end" role="toolbar">
                            <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-success me-1" data-toggle="tooltip" data-placement="bottom" title="Edit Artikel"><i class="fa fa-edit"></i></a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-detail mt-3" dir="ltr">
                                    <div class="p-3">
                                        <div class="product-img bg-light rounded p-3">
                                            <img
                                                src="{{ Storage::url($blog->thumbnail_photo ?? '') }}"
                                                class="img-fluid" width="1500px"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mt-3 mt-xl-3 ps-xl-5">
                                    <h1 class="mb-3">
                                        <a href=" " class="text-dark">{{ $blog->title }}</a>
                                    </h1>
                                    <div class="text-muted mt-2">
                                        @foreach($blog->tags as $tag)
                                            <span class="badge badge-soft-primary font-size-14 me-1">{{ $tag->tag_name }}</span>
                                        @endforeach
                                    </div>
                                    @if($blog->status == 1)
                                        <span class="badge badge-soft-success mb-0">Published</span>
                                    @elseif($blog->status == 0)
                                        <span class="badge badge-soft-info mb-0">Private</span>
                                    @endif
                                    <div class="text-muted mt-2">
                                        @php echo $blog->body @endphp
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    @endsection
    @section('scripts')
        <!-- swiper js -->
        <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/ecommerce-product-detail.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
