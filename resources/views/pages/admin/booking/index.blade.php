@extends('layouts.admin.master')
@section('title')
    List Invoice Booking
@endsection
@section('page-title')
    List Invoice Booking
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
                        <h4 class="card-title">List Invoice Booking</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{  route('bookings.create') }}" class="btn btn-primary mb-3">
                            + Tambah Invoice Booking
                        </a>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="crudTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Kendaraan</th>
                                    <th>Plat Kendaraan</th>
                                    <th>Total Lama Rental</th>
                                    <th>Nama Customer</th>
                                    <th>Tanggal & Waktu Booking</th>
                                    <th>Lokasi Pengantaran</th>
                                    <th>Google Maps Pengantaran</th>
                                    <th>Tanggal & Waktu Pengambilan</th>
                                    <th>Lokasi Pengembalian</th>
                                    <th>Google Maps Pengembalian</th>
                                    <th>Tanggal & Waktu Pengembalian</th>
                                    <th>No. HP/WA</th>
                                    <th>Whatsapp</th>
                                    <th>Email</th>
                                    <th>Total Biaya</th>
                                    <th>Tipe Pembayaran</th>
                                    <th>Status Rental</th>
                                    <th>Status Pembayaran</th>
                                    <th>Status Pengantaran</th>
                                    <th>Status Pengembalian</th>
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
                    { data: 'vehicle.vehicle_name', name: 'vehicle.vehicle_name' },
                    { data: 'vehicle_detail.plate_number', name: 'vehicle_detail.plate_number' },
                    { data: 'total_days_rent', name: 'total_days_rent' },
                    { data: 'name', name: 'name' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'pick_up_loc', name: 'pick_up_loc' },
                    { data: 'maps_pickup', name: 'maps_pickup' },
                    { data: 'pick_up_datetime', name: 'pick_up_datetime' },
                    { data: 'return_loc', name: 'return_loc' },
                    { data: 'maps_return', name: 'maps_return' },
                    { data: 'return_datetime', name: 'return_datetime' },
                    { data: 'no_hp_wa', name: 'no_hp_wa' },
                    { data: 'whatsapp', name: 'whatsapp' },
                    { data: 'email', name: 'email' },
                    { data: 'total_price', name: 'total_price' },
                    { data: 'transaction_type', name: 'transaction_type' },
                    { data: 'rent_status', name: 'rent_status' },
                    { data: 'transaction_status', name: 'transaction_status' },
                    { data: 'shipping_status', name: 'shipping_status' },
                    { data: 'return_status', name: 'return_status' },
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
