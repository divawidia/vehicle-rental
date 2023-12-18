@extends('admin.layouts.master')
@section('title')
    Detail Artikel Blog
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
                        <p>Apakah anda yakin ingin menghapus artikel {{ $blog->title }} dengan id {{ $blog->id }}?</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form action="{{ route('artikel.destroy', $blog->id) }}" method="POST">
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
                        <a href="{{ url()->previous() }}" class="btn btn-secondary w-auto"><i class="fa fa-arrow-left"></i>
                            Kembali</a>
                    </div>
                    <div class="col-6">
                        <div class="btn-toolbar float-end" role="toolbar">
                            <a href="{{ route('artikel.edit', $blog->id) }}" class="btn btn-success me-1" data-toggle="tooltip" data-placement="bottom" title="Edit Artikel"><i class="fa fa-edit"></i></a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="product-detail mt-3" dir="ltr">
                                            <div class="p-3">
                                                <h1 class="mb-3">
                                                    <a href=" " class="text-dark">{{ $blog->title }}</a>
                                                </h1>
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
                                            <div class="text-muted mt-2">
                                                @foreach($blog->tags as $tag)
                                                    <span class="badge badge-soft-primary font-size-14 me-1">{{ $tag->tag_name }}</span>
                                                @endforeach
                                            </div>
                                            <div class="text-muted mt-4">
                                                @php echo $blog->body @endphp
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="mt-4 py-1 row">
                                    <h5 class="col-md-5 font-size-14">Dibuat oleh :</h5>
                                    <p class="col-md-7">{{ $blog->user->name }}</p>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-5 font-size-14">Tanggal Dibuat:</h5>
                                    @php $created_date = strtotime($blog->created_at) @endphp
                                    <p class="col-md-7">{{ date('D, M d, Y',$created_date) }}</p>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-5 font-size-14">Update Terakhir:</h5>
                                    @php $updated_date = strtotime($blog->updated_at) @endphp
                                    <p class="col-md-7">{{ date('D, M d, Y',$updated_date) }}</p>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-5 font-size-14">Status Artikel:</h5>
                                    <div class="col-md-7">
                                        @if($blog->status == 1)
                                            <span class="badge badge-soft-success mb-0">Published</span>
                                        @elseif($blog->status == 0)
                                            <span class="badge badge-soft-secondary mb-0">Private</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
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
