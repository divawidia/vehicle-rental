@extends('layouts.admin.master')
@section('title')
    List Kendaraan
@endsection
@section('page-title')
    List Kendaraan
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
                        <h4 class="card-title">List Kendaraan</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{  route('kendaraan.create') }}" class="btn btn-primary mb-3">
                            + Tambah Kendaraan Baru
                        </a>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="crudTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Kendaraan</th>
                                    <th>Foto</th>
                                    <th>Jumlah</th>
                                    <th>Tahun</th>
                                    <th>Warna</th>
                                    <th>Tipe Transmisi</th>
                                    <th>Kapasitas Mesin</th>
                                    <th>Jenis Kendaraan</th>
                                    <th>Merk</th>
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
                    { data: 'vehicle_name', name: 'vehicle_name' },
                    { data: 'foto', name: 'foto'},
                    { data: 'unit_quantity', name: 'unit_quantity' },
                    { data: 'year', name: 'year' },
                    { data: 'color', name: 'color' },
                    { data: 'transmission.transmission_type', name: 'transmission.transmission_type' },
                    { data: 'engine_capacity', name: 'engine_capacity' },
                    { data: 'vehicle_type.vehicle_type_name', name: 'vehicle_type.vehicle_type_name' },
                    { data: 'brand.brand_name', name: 'brand.brand_name' },
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
