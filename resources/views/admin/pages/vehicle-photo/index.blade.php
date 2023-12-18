@extends('admin.layouts.master')
@section('title')
    Foto Kendaraan
@endsection
@section('page-title')
    Foto Kendaraan
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
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Foto Kendaraan</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{  route('foto-kendaraan.create') }}" class="btn btn-primary mb-3">
                            + Tambah Foto Kendaraan Baru
                        </a>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="crudTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kendaraan</th>
                                    <th>Foto</th>
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
                    {data: 'id', name: 'id'},
                    {data: 'vehicle.vehicle_name', name: 'vehicle.vehicle_name'},
                    {data: 'photo_url', name: 'photo_url'},
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
    @endpush
