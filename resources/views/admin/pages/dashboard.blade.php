@extends('admin.layouts.master')
@section('title')
    Dashboard
@endsection
@section('css')
    <!-- jsvectormap css -->
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('page-title')
    Dashboard
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-6">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-title rounded bg-soft-primary">
                                                <i class="bx bx-check-shield font-size-24 mb-0 text-primary"></i>
                                            </div>
                                        </div>

                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0 font-size-15">Total Pendapatan</h6>
                                        </div>

                                        <div class="flex-shrink-0">
                                            <div class="dropdown">
                                                <a class="dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                                   aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-horizontal text-muted font-size-22"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Yearly</a>
                                                    <a class="dropdown-item" href="#">Monthly</a>
                                                    <a class="dropdown-item" href="#">Weekly</a>
                                                    <a class="dropdown-item" href="#">Today</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="d-flex mt-3 mb-0 align-items-end overflow-hidden">
                                            <div class="flex-grow-1">
                                                <p class="text-muted text-truncate">Total Pendapatan per Tahun</p>
                                            </div>
                                        </div>
                                        <h4 class="mb-0 font-size-22">
                                            Rp. {{ number_format($yearlyTotalSales[0]->total_sales ?? 0) }}
                                            {{--                                                                                        <span class="text-success fw-medium font-size-13 align-middle">--}}
                                            {{--                                                                                            <i class="mdi mdi-arrow-up"></i> 8.34%--}}
                                            {{--                                                                                        </span>--}}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-title rounded bg-soft-primary">
                                                <i class="bx bx-cart-alt font-size-24 mb-0 text-primary"></i>
                                            </div>
                                        </div>

                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0 font-size-15">Total Penyewaan</h6>
                                        </div>

                                        <div class="flex-shrink-0">
                                            <div class="dropdown">
                                                <a class="dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                                   aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-horizontal text-muted font-size-22"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Yearly</a>
                                                    <a class="dropdown-item" href="#">Monthly</a>
                                                    <a class="dropdown-item" href="#">Weekly</a>
                                                    <a class="dropdown-item" href="#">Today</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="d-flex mt-3 mb-0 align-items-end overflow-hidden">
                                            <div class="flex-grow-1">
                                                <p class="text-muted text-truncate">Total Penyewaan per Tahun</p>
                                            </div>
                                        </div>
                                        <h4 class="mb-0 font-size-22">{{ number_format($yearlyTotalRent) }}
                                            {{--                                            <span class="text-danger fw-medium font-size-13 align-middle"> --}}
                                            {{--                                                <i class="mdi mdi-arrow-down"></i> 3.68% --}}
                                            {{--                                            </span> --}}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-title rounded bg-soft-primary">
                                                <i class="bx bx-cart-alt font-size-24 mb-0 text-primary"></i>
                                            </div>
                                        </div>

                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0 font-size-15">Total Kendaraan</h6>
                                        </div>

                                        <div class="flex-shrink-0">
                                            <div class="dropdown">
                                                <a class="dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                                   aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-horizontal text-muted font-size-22"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Yearly</a>
                                                    <a class="dropdown-item" href="#">Monthly</a>
                                                    <a class="dropdown-item" href="#">Weekly</a>
                                                    <a class="dropdown-item" href="#">Today</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="d-flex mt-3 mb-0 align-items-end overflow-hidden">
                                            <div class="flex-grow-1">
                                                <p class="text-muted text-truncate">Total Kendaraan Tersedia</p>
                                            </div>
                                        </div>
                                        <h4 class="mb-0 font-size-22">{{ number_format($vehicles) }}
                                            {{--                                            <span class="text-danger fw-medium font-size-13 align-middle"> --}}
                                            {{--                                                <i class="mdi mdi-arrow-down"></i> 3.68% --}}
                                            {{--                                            </span> --}}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-title rounded bg-soft-primary">
                                                <i class="bx bx-rocket font-size-24 mb-0 text-primary"></i>
                                            </div>
                                        </div>

                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0 font-size-15">Total Kendaraan</h6>
                                        </div>

                                        <div class="flex-shrink-0">
                                            <div class="dropdown">
                                                <a class="dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                                   aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-horizontal text-muted font-size-22"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Yearly</a>
                                                    <a class="dropdown-item" href="#">Monthly</a>
                                                    <a class="dropdown-item" href="#">Weekly</a>
                                                    <a class="dropdown-item" href="#">Today</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div>
                                        <div class="d-flex mt-3 mb-0 align-items-end overflow-hidden">
                                            <div class="flex-grow-1">
                                                <p class="text-muted text-truncate">Total Kendaraan Disewa</p>
                                            </div>
                                        </div>
                                        <h4 class="mb-0 font-size-22">{{ number_format($totalBooking) }}
                                            {{--                                            <span class="text-danger fw-medium font-size-13 align-middle"> --}}
                                            {{--                                                <i class="mdi mdi-arrow-down"></i> 3.68% --}}
                                            {{--                                            </span> --}}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-title rounded bg-soft-primary">
                                                <i class="bx bx-cart-alt font-size-24 mb-0 text-primary"></i>
                                            </div>
                                        </div>

                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0 font-size-15">Total Kendaraan</h6>
                                        </div>

                                        <div class="flex-shrink-0">
                                            <div class="dropdown">
                                                <a class="dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                                   aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-horizontal text-muted font-size-22"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Yearly</a>
                                                    <a class="dropdown-item" href="#">Monthly</a>
                                                    <a class="dropdown-item" href="#">Weekly</a>
                                                    <a class="dropdown-item" href="#">Today</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="d-flex mt-3 mb-0 align-items-end overflow-hidden">
                                            <div class="flex-grow-1">
                                                <p class="text-muted text-truncate">Total Kendaraan Tersedia</p>
                                            </div>
                                        </div>
                                        <h4 class="mb-0 font-size-22">{{ number_format($vehicles) }}
                                            {{--                                            <span class="text-danger fw-medium font-size-13 align-middle"> --}}
                                            {{--                                                <i class="mdi mdi-arrow-down"></i> 3.68% --}}
                                            {{--                                            </span> --}}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-title rounded bg-soft-primary">
                                                <i class="bx bx-rocket font-size-24 mb-0 text-primary"></i>
                                            </div>
                                        </div>

                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0 font-size-15">Total Booking</h6>
                                        </div>

                                        <div class="flex-shrink-0">
                                            <div class="dropdown">
                                                <a class="dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                                   aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-horizontal text-muted font-size-22"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Yearly</a>
                                                    <a class="dropdown-item" href="#">Monthly</a>
                                                    <a class="dropdown-item" href="#">Weekly</a>
                                                    <a class="dropdown-item" href="#">Today</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div>
                                        <div class="d-flex mt-3 mb-0 align-items-end overflow-hidden">
                                            <div class="flex-grow-1">
                                                <p class="text-muted text-truncate">Total Booking</p>
                                            </div>
                                        </div>
                                        <h4 class="mb-0 font-size-22">{{ number_format($totalBooking) }}
                                            {{--                                            <span class="text-danger fw-medium font-size-13 align-middle"> --}}
                                            {{--                                                <i class="mdi mdi-arrow-down"></i> 3.68% --}}
                                            {{--                                            </span> --}}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body pb-0">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-4">Overview</h5>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <span class="fw-semibold">Sort By:</span>
                                        <span class="text-muted" id="sortTeks">Yearly</span><i class="mdi mdi-chevron-down ms-1"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item yearlyBarChart" href="#">Yearly</a>
                                        <a class="dropdown-item monthlyBarChart" href="#">Monthly</a>
                                        <a class="dropdown-item weeklyBarChart" href="#">Weekly</a>
                                        <a class="dropdown-item todayBarChart" href="#">Today</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="yearTotalSales">
                            {!! $yearTotalSales->container() !!}
                        </div>
                        <div class="monthTotalSales">
                            {!! $monthTotalSales->container() !!}
                        </div>
                        <div class="weekTotalSales">
                            {!! $weekTotalSalesChart->container() !!}
                        </div>
                        <div class="todayTotalSales">
                            {!! $todayTotalSalesChart->container() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-7">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start mb-2">
                            <div class="flex-grow-1">
                                <h5 class="card-title">Kendaraan Terlaris</h5>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-muted" href="#"
                                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Today<i class="mdi mdi-chevron-down ms-1"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Yearly</a>
                                        <a class="dropdown-item" href="#">Monthly</a>
                                        <a class="dropdown-item" href="#">Weekly</a>
                                        <a class="dropdown-item" href="#">Today</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <div class="popular-product-img p-2">
                                    <img src="{{ Storage::url($yearlyKendaraanTerlaris[0]->thumbnail ?? '') }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-7">
                                <span class="badge badge-soft-primary font-size-10 text-uppercase ls-05"> Kendaraan Terlaris</span>
                                <h5 class="mt-2 font-size-16">
                                    <a href="" class="text-dark"></a>{{ $yearlyKendaraanTerlaris[0]->vehicle_name ?? '' }}
                                </h5>

                                <div class="row g-0 mt-3 pt-1 align-items-end">
                                    <div class="col-4">
                                        <div class="mt-1">
                                            <p class="text-muted mb-1">Total Disewa</p>
                                            <h4 class="font-size-16">{{ $yearlyKendaraanTerlaris[0]->total_sewa ?? 0 }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mt-1">
                                            <p class="text-muted mb-1">Total Penjualan</p>
                                            <h4 class="font-size-16">
                                                Rp. {{ number_format($yearlyKendaraanTerlaris[0]->total_penjualan ?? 0) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mx-n4 px-4" data-simplebar style="max-height: 205px;">
                            @foreach($yearlyKendaraanTerlaris as $kendaraanTerlaris)
                                @if ($loop->first)
                                    @continue
                                @endif
                                <div class="popular-product-box rounded my-2">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-md">
                                                <div class="product-img avatar-title img-thumbnail bg-soft-primary border-0">
                                                    <img src="{{ Storage::url($kendaraanTerlaris->thumbnail) }}" class="img-fluid" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3 overflow-hidden">
                                            <h5 class="mb-1 text-truncate">
                                                <a href="{{ route('kendaraan.show', $kendaraanTerlaris->id) }}" class="font-size-15 text-dark">{{ $kendaraanTerlaris->vehicle_name }}</a>
                                            </h5>
                                        </div>
                                        <div class="flex-shrink-0 text-end ms-3">
                                            <h5 class="mb-1">
                                                <a href="#" class="font-size-15 text-dark">Rp. {{ number_format($kendaraanTerlaris->total_penjualan) }}</a>
                                            </h5>
                                            <p class="text-muted fw-semibold mb-0">{{ $kendaraanTerlaris->total_sewa }}
                                                Disewa</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="card-title mb-4 text-truncate">Tipe Kendaraan Terlaris</h5>
                            </div>
                            <div class="flex-shrink-0 ms-2">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <span class="fw-semibold">Sort By:</span> <span class="text-muted">Weekly<i
                                                    class="mdi mdi-chevron-down ms-1"></i></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Yearly</a>
                                        <a class="dropdown-item" href="#">Monthly</a>
                                        <a class="dropdown-item" href="#">Weekly</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="vehicleTypeTotalRent">
                            {!! $vehicleTypeTotalRentChart->container() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start mb-3">
                        <div class="flex-grow-1">
                            <h5 class="card-title">Total Pendapatan Berdasarkan Negara</h5>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="dropdown">
                                <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    <span class="fw-semibold">Year:</span> <span class="text-muted">2024<i
                                                class="mdi mdi-chevron-down ms-1"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">2019</a>
                                    <a class="dropdown-item" href="#">2020</a>
                                    <a class="dropdown-item" href="#">2021</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-center">
                        <div class="col-xxl-7">
                            <div class="py-3">
                                <div id="world-map" style="height: 400px"></div>
                            </div>
                        </div>

                        <div class="col-xl-5">
                            <div class="table-responsive">
                                <table class="table table-centered align-middle table-nowrap mb-0">
                                    <thead>
                                    <tr>
                                        <th style="width: 500px;">Negara</th>
                                        <th>Total Sewa</th>
                                        <th>Total Pendapatan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($yearlyCountryTotalRent as $countryTotalRent)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://flagsapi.com/{{ $countryTotalRent->country_code }}/flat/64.png" class="rounded"
                                                         alt="user-image" height="18">
                                                    <div class="flex-grow-1 ms-3">
                                                        <p class="mb-0 text-truncate">{{ $countryTotalRent->country }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $countryTotalRent->total_sewa }}</td>
                                            <td>Rp. {{ number_format($countryTotalRent->total_pendapatan) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">List Invoice Booking</h4>
                    </div>
                    <div class="card-body">
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

    @endsection
    @push('addon-script')
        <script>
            $('#crudTable').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: '{!! url()->route('admin.bookings.index') !!}',
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'vehicle.vehicle_name', name: 'vehicle.vehicle_name'},
                    {data: 'vehicle_detail.plate_number', name: 'vehicle_detail.plate_number'},
                    {data: 'total_days_rent', name: 'total_days_rent'},
                    {data: 'name', name: 'name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'pick_up_loc', name: 'pick_up_loc'},
                    {data: 'maps_pickup', name: 'maps_pickup'},
                    {data: 'pick_up_datetime', name: 'pick_up_datetime'},
                    {data: 'return_loc', name: 'return_loc'},
                    {data: 'maps_return', name: 'maps_return'},
                    {data: 'return_datetime', name: 'return_datetime'},
                    {data: 'no_hp_wa', name: 'no_hp_wa'},
                    {data: 'whatsapp', name: 'whatsapp'},
                    {data: 'email', name: 'email'},
                    {data: 'total_price', name: 'total_price'},
                    {data: 'transaction_type', name: 'transaction_type'},
                    {data: 'rent_status', name: 'rent_status'},
                    {data: 'transaction_status', name: 'transaction_status'},
                    {data: 'shipping_status', name: 'shipping_status'},
                    {data: 'return_status', name: 'return_status'},
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
        <!-- apexcharts -->
        <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- Vector map-->
        <script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/dashboard.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script>
            $(document).ready(function () {
                $('.monthTotalSales').hide();
                $('.weekTotalSales').hide();
                $('.todayTotalSales').hide();
                $('.yearlyBarChart').click(function () {
                    $('.yearTotalSales').show();
                    $('.monthTotalSales').hide();
                    $('.weekTotalSales').hide();
                    $('.todayTotalSales').hide();
                    $('#sortTeks').text('Yearly')
                });
                $('.monthlyBarChart').click(function () {
                    $('.yearTotalSales').hide();
                    $('.monthTotalSales').show();
                    $('.weekTotalSales').hide();
                    $('.todayTotalSales').hide();
                    $('#sortTeks').text('Monthly')
                });
                $('.weeklyBarChart').click(function () {
                    $('.yearTotalSales').hide();
                    $('.monthTotalSales').hide();
                    $('.weekTotalSales').show();
                    $('.todayTotalSales').hide();
                    $('#sortTeks').text('Weekly')
                });
                $('.todayBarChart').click(function () {
                    $('.yearTotalSales').hide();
                    $('.monthTotalSales').hide();
                    $('.weekTotalSales').hide();
                    $('.todayTotalSales').show();
                    $('#sortTeks').text('Today')
                });
            });
        </script>
        <script>
            var worldemapmarkers = new jsVectorMap({
                map: 'world_merc',
                selector: '#world-map',
                zoomOnScroll: true,
                zoomButtons: true,
                markersSelectable: true,
                regionStyle: {
                    initial: {
                        fill: '#cfd9ed'
                    }
                },
                visualizeData: {
                    scale: ['#eeeeee', '#ff5f02'],
                    values: {!! json_encode($yearlyCountryTotalRentData) !!}
                }
            })
        </script>
        <script src="{{ $yearTotalSales->cdn() }}"></script>

    {{ $yearTotalSales->script() }}
    {{ $monthTotalSales->script() }}
    {{ $weekTotalSalesChart->script() }}
    {{ $todayTotalSalesChart->script() }}
    {{ $vehicleTypeTotalRentChart->script() }}
@endsection
