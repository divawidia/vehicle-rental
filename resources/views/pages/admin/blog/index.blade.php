@extends('layouts.admin.master')
@section('title')
    Artikel Blog
@endsection
@section('page-title')
    Artikel Blog
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="mb-3">
                    <h5 class="card-title">Daftar Artikel Blog <span class="text-muted fw-normal ms-2"></span></h5>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                    <div>
                        <a href="{{ route('blogs.create') }}" class="btn btn-primary"><i class="bx bx-plus me-1"></i> Tambah Artikel Blog</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row mt-2">
            @foreach($blogs as $blog)
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <img src="{{ Storage::url($blog->thumbnail_photo ?? '') }}" alt=""
                                         class="img-thumbnail">
                                </div>
                            </div>
                            <div class="flex-1 ms-3">
                                <h5 class="font-size-16 mb-1"><a href="#" class="text-dark">{{ $blog->title }}</a></h5>
                                @foreach($blog->tags as $tag)
                                    <span class="badge badge-soft-primary mb-0">{{ $tag->tag_name }}</span>
                                @endforeach
                                @if($blog->status == 1)
                                    <span class="badge badge-soft-success mb-0">Published</span>
                                @elseif($blog->status == 0)
                                    <span class="badge badge-soft-info mb-0">Private</span>
                                @endif
                            </div>
                            <p class="text-muted mt-3 mb-0">
                                @php echo \Illuminate\Support\Str::limit($blog->body, 100); @endphp
                            </p>

                            <div class="mt-3 pt-1">
                                <p class="mb-0"><i class="bx bx-user font-size-15 align-middle pe-2 text-primary"></i>
                                    {{ $blog->user->name }}
                                </p>
                                <p class="mb-0 mt-2"><i class="bx bx-calendar font-size-15 align-middle pe-2 text-primary"></i>
                                    {{ $blog->created_at }}
                                </p>
                            </div>

                            <div class="d-flex justify-content-center gap-2 pt-4">
                                <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-success me-1 w-100" data-toggle="tooltip" data-placement="bottom" title="Edit Blog"><i class="fa fa-edit"></i></a>
                                <a href="{{ route('blogs.show', $blog->slug) }}" class="btn btn-primary me-1 w-100" data-toggle="tooltip" data-placement="bottom" title="Lihat Blog"><i class="fa fa-eye"></i></a>
                                <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div id="deleteModal" class="modal fade" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-confirm">
                            <div class="modal-content d-flex justify-content-center">
                                <div class="modal-header">
                                    <h4 class="modal-title w-100">Apakah anda yakin?</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah anda yakin ingin menghapus data artikel blog ini?</p>
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
                </div>
            @endforeach
        </div>
    @endsection

@section('scripts')
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
