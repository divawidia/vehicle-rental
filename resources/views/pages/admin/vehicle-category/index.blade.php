@extends('layouts.admin.master')
@section('title')
    Kategori Kendaraan
@endsection
@section('page-title')
    Kategori Kendaraan
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
                        <h4 class="card-title">Tipe Kendaraan</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{  route('tipe.create') }}" class="btn btn-primary mb-3">
                            + Tambah Tipe Kendaraan Baru
                        </a>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="tipeTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Tipe Kendaraan</th>
                                    <th>Icon</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Jenis Transmisi Kendaraan</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{  route('transmisi.create') }}" class="btn btn-primary mb-3">
                            + Tambah Jenis Transmisi Baru
                        </a>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="transmissionTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Jenis Transmisi</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Brand Kendaraan</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{  route('brand.create') }}" class="btn btn-primary mb-3">
                            + Tambah Brand Kendaraan Baru
                        </a>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="brandTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Brand</th>
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
            var datatable = $('#tipeTable').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: '{!! url()->route('tipe.index') !!}',
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'vehicle_type_name', name: 'vehicle_type_name' },
                    { data: 'icon', name: 'icon' },
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
        <script>
            // AJAX DataTable
            var datatable = $('#transmissionTable').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: '{!! url()->route('transmisi.index') !!}',
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'transmission_type', name: 'transmission_type' },
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
        <script>
            // AJAX DataTable
            var datatable = $('#brandTable').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: '{!! url()->route('brand.index') !!}',
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'brand_name', name: 'brand_name' },
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
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
