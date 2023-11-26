@extends('layouts.admin.master')
@section('title')
    Gallery Batur Sari Rental
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.0/dropzone.min.css">
@endsection
@section('page-title')
    Gallery Batur Sari Rental
@endsection
@section('body')

<body>
@endsection
@section('content')
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('status') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div id="addModal" class="modal fade" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content d-flex justify-content-center">
                <div class="modal-header">
                    <h4 class="modal-title w-100">Upload Foto Baru</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('gallery-photo-upload') }}" method="post" enctype="multipart/form-data" class="dropzone" id="dropzone">
                        @csrf
                    </form>
                </div>
                <div class="modal-footer justify-content-center">
                    <a class="btn btn-success" href="{{ route('galleries.index') }}">Selesai</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Gallery</h4>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
                        <i class="fa fa-plus"></i> Tambah Foto
                    </button>
{{--                    <a href="{{  route('galleries.create') }}" class="btn btn-primary mb-3">--}}
{{--                        + Tambah Foto--}}
{{--                    </a>--}}
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="crudTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Foto</th>
                                <th>Diunggah oleh</th>
                                <th>Tanggal Unggah</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@push('addon-script')
    <script>
        // AJAX DataTable
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'photo_url', name: 'photo_url' },
                { data: 'user.name', name: 'user.name' },
                { data: 'created_at', name: 'created_at' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '15%'
                },
            ]
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.0/dropzone.js"></script>
    <script type="text/javascript">
        Dropzone.options.dropzone =
            {
                maxFilesize: 12,
                renameFile: function(file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time+file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png",
                addRemoveLinks: true,
                timeout: 5000,
                success: function(file, response) {
                    console.log(response);
                },
                error: function(file, response){
                    return false;
                }
            };
    </script>
@endpush
