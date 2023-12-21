@extends('admin.layouts.master')
@section('title')
    Kendaraan Rental
@endsection
@section('page-title')
    @yield('title')
@endsection
@section('content')
    <x-admin.alerts.basic />
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">@yield('title')</h4>
            <x-admin.buttons.link-button
                color="primary"
                icon="plus"
                text="Tambah Kendaraan Baru"
                :route="route('kendaraan.create')"
            />
        </div>
        <div class="card-body">
            <x-admin.tables.main
                tableId="crudTable"
                :headers="[
                    '#',
                    'Nama Kendaraan',
                    'Foto',
                    'Jumlah',
                    'Tahun',
                    'Warna',
                    'Tipe Transmisi',
                    'Kapasitas Mesin',
                    'Jenis Kendaraan',
                    'Merk',
                    'Aksi'
                ]"
            />
        </div>
    </div>
@endsection
@push('addon-script')
    <script>
        $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'vehicle_name', name: 'vehicle_name'},
                {data: 'foto', name: 'foto'},
                {data: 'unit_quantity', name: 'unit_quantity'},
                {data: 'year', name: 'year'},
                {data: 'color', name: 'color'},
                {data: 'transmission.transmission_type', name: 'transmission.transmission_type'},
                {data: 'engine_capacity', name: 'engine_capacity'},
                {data: 'vehicle_type.vehicle_type_name', name: 'vehicle_type.vehicle_type_name'},
                {data: 'brand.brand_name', name: 'brand.brand_name'},
                {data: 'action', name: 'action', orderable: false, searchable: false, width: '15%'},
            ]
        });
    </script>
@endpush
