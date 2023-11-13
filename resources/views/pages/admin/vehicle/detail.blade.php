@extends('layouts.admin.master')
@section('title')
    Detail Kendaraan
@endsection
@section('css')
    <!-- swiper css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}">
@endsection
@section('page-title')
    Detail Kendaraan
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
                        <form action="{{ route('kendaraan.destroy', $vehicle->id) }}" method="POST">
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
                            <a href="{{ route('kendaraan.edit', $vehicle->id) }}" class="btn btn-success me-1" data-toggle="tooltip" data-placement="bottom" title="Edit Kendaraan"><i class="fa fa-edit"></i></a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="product-detail mt-3" dir="ltr">

                                    <div
                                        class="swiper product-thumbnail-slider rounded border overflow-hidden position-relative">
                                        <div class="swiper-wrapper">
                                            @foreach($vehicle->photos as $vehiclePhoto)
                                                <div class="swiper-slide rounded">
                                                    <div class="p-3">
                                                        <div class="product-img bg-light rounded p-3">
                                                            <img
                                                                src="{{ Storage::url($vehiclePhoto->photo_url ?? '') }}"
                                                                class="img-fluid d-block"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="d-none d-md-block">
                                            <div class="swiper-button-next"></div>
                                            <div class="swiper-button-prev"></div>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <div thumbsSlider="" class="swiper product-nav-slider mt-2 overflow-hidden">
                                            <div class="swiper-wrapper">
                                                @foreach($vehicle->photos as $vehiclePhoto)
                                                    <div class="swiper-slide rounded">
                                                        <div class="nav-slide-item"><img
                                                                src="{{ Storage::url($vehiclePhoto->photo_url ?? '') }}"
                                                                class="img-fluid p-1 d-block rounded"/></div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-8">
                                <div class="mt-3 mt-xl-3 ps-xl-5">
                                    <h4 class="font-size-20 mb-3"><a href=""
                                                                     class="text-dark">{{ $vehicle->vehicle_name }}</a>
                                    </h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="text-muted mt-2">
                                                Harga Harian
                                            </div>
                                            <h2 class="text-primary py-2 mb-0">
                                                Rp. {{ number_format($vehicle->daily_price) }}
                                            </h2>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="text-muted mt-2">
                                                Harga Bulanan
                                            </div>
                                            <h2 class="text-primary py-2 mb-0">
                                                Rp. {{ number_format($vehicle->monthly_price) }}
                                            </h2>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mt-3">
                                                    <h5 class="font-size-14">Deskripsi Kendaraan :</h5>

                                                    <p class="text-muted mb-1 text-truncate">
                                                        @php echo $vehicle->description @endphp</p>
                                                </div>
                                                <div class="mt-3">
                                                    <h5 class="font-size-14">Fitur :</h5>

                                                    <p class="text-muted mb-1 text-truncate">
                                                        @php echo $vehicle->features @endphp</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mt-3">
                                                    <h5 class="font-size-14">Spesifikasi :</h5>
                                                    <ul class="list-unstyled ps-0 mb-0 mt-3">
                                                        <li>
                                                            <p class="text-muted mb-1 text-truncate"><i
                                                                    class="mdi mdi-circle-medium align-middle text-primary me-1"></i>
                                                                Tahun : {{ $vehicle->year }}</p>
                                                        </li>
                                                        <li>
                                                            <p class="text-muted mb-1 text-truncate"><i
                                                                    class="mdi mdi-circle-medium align-middle text-primary me-1"></i>
                                                                Warna : {{ $vehicle->color }}</p>
                                                        </li>
                                                        <li>
                                                            <p class="text-muted mb-1 text-truncate"><i
                                                                    class="mdi mdi-circle-medium align-middle text-primary me-1"></i>
                                                                Body : {{ $vehicle->body }}</p>
                                                        </li>
                                                        <li>
                                                            <p class="text-muted mb-1 text-truncate"><i
                                                                    class="mdi mdi-circle-medium align-middle text-primary me-1"></i>
                                                                Jumlah Penumpang : {{ $vehicle->passenger }} orang</p>
                                                        </li>
                                                        <li>
                                                            <p class="text-muted mb-1 text-truncate"><i
                                                                    class="mdi mdi-circle-medium align-middle text-primary me-1"></i>
                                                                Kapasitas Bensin : {{ $vehicle->fuel_capacity }} l</p>
                                                        </li>
                                                        <li>
                                                            <p class="text-muted mb-1 text-truncate"><i
                                                                    class="mdi mdi-circle-medium align-middle text-primary me-1"></i>
                                                                Tipe Bensin : {{ $vehicle->fuel_type }}</p>
                                                        </li>
                                                        <li>
                                                            <p class="text-muted mb-1 text-truncate"><i
                                                                    class="mdi mdi-circle-medium align-middle text-primary me-1"></i>
                                                                Kehematan Bensin : {{ $vehicle->fuel_economy }}km/l</p>
                                                        </li>
                                                        <li>
                                                            <p class="text-muted mb-0 text-truncate"><i
                                                                    class="mdi mdi-circle-medium align-middle text-primary me-1"></i>
                                                                Kapasitas Mesin : {{ $vehicle->engine_capacity }}cc</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="font-size-16 mb-3">Daftar Penyewaan : </h5>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover mb-0" id="crudTable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Plat Kendaraan</th>
                                        <th>Total Lama Rental</th>
                                        <th>Nama Customer</th>
                                        <th>Tanggal & Waktu Booking</th>
                                        <th>Lokasi Pengantaran</th>
                                        <th>Tanggal & Waktu Pengambilan</th>
                                        <th>Lokasi Pengembalian</th>
                                        <th>Tanggal & Waktu Pengembalian</th>
                                        <th>No. HP/WA</th>
                                        <th>Whatsapp</th>
                                        <th>Email</th>
                                        <th>Total Biaya</th>
                                        <th>Tipe Pembayaran</th>
                                        <th>Status Booking</th>
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
                    {data: 'vehicle_license_plate', name: 'vehicle_license_plate'},
                    {data: 'total_days_rent', name: 'total_days_rent'},
                    {data: 'name', name: 'name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'pick_up_loc', name: 'pick_up_loc'},
                    {data: 'pick_up_datetime', name: 'pick_up_datetime'},
                    {data: 'return_loc', name: 'return_loc'},
                    {data: 'return_datetime', name: 'return_datetime'},
                    {data: 'no_hp_wa', name: 'no_hp_wa'},
                    {data: 'whatsapp', name: 'whatsapp'},
                    {data: 'email', name: 'email'},
                    {data: 'total_price', name: 'total_price'},
                    {data: 'transaction_type', name: 'transaction_type'},
                    {data: 'booking_status', name: 'booking_status'},
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
