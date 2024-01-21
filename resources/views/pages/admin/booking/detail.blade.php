@extends('layouts.admin.master')
@section('title')
    Detail Invoice Booking
@endsection
@section('page-title')
    Detail Transaksi Booking Rental
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
                <a href="{{ route('bookings.index') }}" class="btn btn-primary w-auto"><i class="fa fa-arrow-left"></i>  Kembali</a>
                <div class="row">
                    <div class="col-6">
                        <h4 class="my-4">Invoice #{{ $booking->id }}
                            @if($booking->transaction_status == 'Belum Dibayar')
                                <span class="badge bg-warning font-size-12">{{ $booking->transaction_status }}</span>
                            @else
                                <span class="badge bg-success font-size-12">{{ $booking->transaction_status }}</span>
                            @endif
                        </h4>
                    </div>
                    <div class="col-6">
                        <div class="btn-toolbar float-end py-3" role="toolbar">
                            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-success me-1" data-toggle="tooltip" data-placement="bottom" title="Edit Booking"><i class="fa fa-edit"></i></a>
                            <a href="{{ route('booking-invoice', $booking->id) }}" class="btn btn-primary me-1" data-toggle="tooltip" data-placement="bottom" title="Invoice Booking"><i class="fa fa-file-invoice"></i></a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="invoice-title">
                                    <h5 class="py-3">Informasi Booking Rental:</h5>
                                </div>

                                <hr class="my-1">

                                <div class="mt-4 py-1 row">
                                    <h5 class="col-md-3 font-size-14">Kendaraan yang Disewa:</h5>
                                    <p class="col-md-9">{{ $booking->vehicle->vehicle_name }}</p>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-3 font-size-14">Plat Nomor Kendaraan:</h5>
                                    <p class="col-md-9">{{ $booking->vehicle_license_plate }}</p>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-3 font-size-14">Total Lama Penyewaan:</h5>
                                    <p class="col-md-9">{{ $booking->total_days_rent }} Hari</p>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-3 font-size-14">Tipe Pembayaran:</h5>
                                    <p class="col-md-9">{{ $booking->transaction_type }}</p>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-3 font-size-14">Tanggal dan Waktu Mulai Sewa:</h5>
                                    @php $pick_up_date = strtotime($booking->pick_up_datetime) @endphp
                                    <p class="col-md-9">{{ date('D, M d, Y',$pick_up_date) }} @ {{ date('g:i A',$pick_up_date) }}</p>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-3 font-size-14">Lokasi Pengantaran:</h5>
                                    <p class="col-md-9">{{ $booking->pick_up_loc }}</p>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-3 font-size-14">Tanggal dan Waktu Selesai Sewa:</h5>
                                    @php $return_date = strtotime($booking->return_datetime) @endphp
                                    <p class="col-md-9">{{ date('D, M d, Y',$return_date) }} @ {{ date('g:i A',$return_date) }}</p>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-3 font-size-14">Lokasi Pengambilan:</h5>
                                    <p class="col-md-9">{{ $booking->return_loc }}</p>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-3 font-size-14">Nama di Reservasi Hotel/Villa:</h5>
                                    <p class="col-md-9">{{ $booking->hotel_booking_name }}</p>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-3 font-size-14">Nomor Kamar:</h5>
                                    <p class="col-md-9">{{ $booking->room_number }}</p>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-3 font-size-14">Asuransi:</h5>
                                    <p class="col-md-9">{{ $booking->insurance }}</p>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-3 font-size-14">FIrst Aid Kit:</h5>
                                    <p class="col-md-9">{{ $booking->first_aid_kit }}</p>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-3 font-size-14">Phone Holder:</h5>
                                    <p class="col-md-9">{{ $booking->phone_holder }}</p>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-3 font-size-14">Raincoat:</h5>
                                    <p class="col-md-9">{{ $booking->raincoat }}</p>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-3 font-size-14">KM Kendaraan (Sebelum Disewa):</h5>
                                    <p class="col-md-9">{{ number_format($booking->start_km_vehicle ?? 0) }} KM</p>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-3 font-size-14">KM Kendaraan (Setelah Disewa):</h5>
                                    <p class="col-md-9">{{ number_format($booking->return_km_vehicle ?? 0) }} KM</p>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-3 font-size-14">KM Kendaraan (Selama Disewa):</h5>
                                    <p class="col-md-9">{{ number_format($booking->total_km_rent ?? 0) }} KM</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="invoice-title">
                                    <h5 class="py-3">Rincian Transaksi Rental:</h5>
                                </div>

                                <hr class="my-1">

                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap table-centered my-0">
                                        <thead>
                                        <tr>
                                            <th class="fw-bold">Rate</th>
                                            <th class="fw-bold">Price</th>
                                            <th class="fw-bold">Total Rent</th>
                                            <th class="text-end fw-bold">Total</th>
                                        </tr>
                                        </thead><!-- end thead -->
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div>
                                                    <p class="text-muted mb-0">Daily</p>
                                                </div>
                                            </td>
                                            <td>Rp. {{ number_format($booking->vehicle->daily_price ?? 0) }}</td>
                                            <td>{{ $booking->day_rent }} Day</td>
                                            <td class="text-end">Rp. {{ number_format($booking->daily_rent_price ?? 0) }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <p class="text-muted mb-0">Monthly</p>
                                                </div>
                                            </td>
                                            <td>Rp. {{ number_format($booking->vehicle->monthly_price ?? 0) }}</td>
                                            <td>{{ $booking->month_rent }} Month</td>
                                            <td class="text-end">Rp. {{ number_format($booking->monthly_rent_price ?? 0) }}</td>
                                        </tr>
                                        <tr class="py-0">
                                            <th scope="row" colspan="3" class="text-end fw-bold">Sub Total :</th>
                                            <td class="text-end">Rp. {{ number_format($booking->booking_price ?? 0) }}</td>
                                        </tr>
                                        <!-- end tr -->
                                        @if($booking->insurance == 'include')
                                            <tr class="py-0">
                                                <th scope="row" colspan="3" class="border-0 text-end fw-bold">
                                                    Insurance (25%) :</th>
                                                <td class="border-0 text-end">Rp. {{ number_format($booking->insurance_price) }}</td>
                                            </tr>
                                        @endif
                                        <!-- end tr -->
                                        @if($booking->first_aid_kit == 'include')
                                            <tr class="py-0">
                                                <th scope="row" colspan="3" class="border-0 text-end fw-bold">
                                                    Accessory - First Aid Kit :</th>
                                                <td class="border-0 text-end">Rp. 0</td>
                                            </tr>
                                        @endif
                                        <!-- end tr -->
                                        @if($booking->phone_holder == 'include')
                                            <tr>
                                                <th scope="row" colspan="3" class="border-0 text-end fw-bold">
                                                    Accessory - Phone Holder :</th>
                                                <td class="border-0 text-end">Rp. 0</td>
                                            </tr>
                                        @endif

                                        @if($booking->raincoat == 'include')
                                            <tr>
                                                <th scope="row" colspan="3" class="border-0 text-end fw-bold">
                                                    Accessory - Raincoat :</th>
                                                <td class="border-0 text-end">Rp. 0</td>
                                            </tr>
                                        @endif

                                        @if($booking->helmet > 0)
                                            <tr>
                                                <th scope="row" colspan="3" class="border-0 text-end fw-bold">
                                                    Accessory - Helmet ({{ $booking->helmet }}pcs) :</th>
                                                <td class="border-0 text-end">Rp. 0</td>
                                            </tr>
                                        @endif

                                        <tr>
                                            <th scope="row" colspan="3" class="border-0 text-end fw-bold">
                                                Delivery Charge ({{ $booking->rounded_distance_pickup }} KM x Rp. 10.000):</th>
                                            <td class="border-0 text-end">Rp. {{ number_format($booking->shipping_price) }}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row" colspan="3" class="border-0 text-end fw-bold">
                                                Collection Charge ({{ $booking->rounded_distance_return }} KM x Rp. 10.000):</th>
                                            <td class="border-0 text-end">Rp. {{ number_format($booking->collection_price) }}</td>
                                        </tr>
                                        <!-- end tr -->
                                        <tr>
                                            <th scope="row" colspan="3" class="border-0 text-end fw-bold">Total :</th>
                                            <td class="border-0 text-end">
                                                <h4 class="m-0 fw-semibold">Rp. {{ number_format($booking->total_price ?? 0) }}</h4>
                                            </td>
                                        </tr>
                                        <!-- end tr -->
                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="invoice-title">
                                    <h5 class="py-3">Status Booking:</h5>
                                </div>

                                <hr class="my-1">

                                <div class="mt-4 py-1 row">
                                    <h5 class="col-md-6 font-size-14">Status Booking:</h5>
                                    <div class="col-md-6">
                                        @if($booking->booking_status == 'Selesai')
                                            <span class="badge bg-success">{{ $booking->booking_status }}</span>
                                        @elseif($booking->booking_status == 'Sedang Disewa')
                                            <span class="badge bg-warning">{{ $booking->booking_status }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ $booking->booking_status }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-6 font-size-14">Status Pembayaran:</h5>
                                    <div class="col-md-6">
                                        @if($booking->transaction_status == 'Belum Dibayar')
                                            <span class="badge bg-warning">{{ $booking->transaction_status }}</span>
                                        @else
                                            <span class="badge bg-success">{{ $booking->transaction_status }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-6 font-size-14">Status Pengantaran:</h5>
                                    <div class="col-md-6">
                                        @if($booking->shipping_status == 'Belum')
                                            <span class="badge bg-warning">{{ $booking->shipping_status }}</span>
                                        @else
                                            <span class="badge bg-success">{{ $booking->shipping_status }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-6 font-size-14">Status Pengembalian:</h5>
                                    <div class="col-md-6">
                                        @if($booking->return_status == 'Belum')
                                            <span class="badge bg-warning">{{ $booking->return_status }}</span>
                                        @else
                                            <span class="badge bg-success">{{ $booking->return_status }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="invoice-title">
                                    <h5 class="py-3">Informasi Customer:</h5>
                                </div>

                                <hr class="my-1">

                                <div class="mt-4 py-1 row">
                                    <h5 class="col-md-6 font-size-14">Nama Depan:</h5>
                                    <p class="col-md-6">{{ $booking->first_name }}</p>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-6 font-size-14">Nama Belakang:</h5>
                                    <p class="col-md-6">{{ $booking->last_name }}</p>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-6 font-size-14">No. HP/WA:</h5>
                                    <p class="col-md-6">{{ $booking->no_hp_wa }}</p>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-6 font-size-14">Whatsapp:</h5>
                                    <div class="col-md-6">
                                        <a
                                            href="https://wa.me/{{ $booking->no_hp_wa }}"
                                            class="btn btn-success mx-1 my-1"
                                        ><i class="bx bxl-whatsapp"></i></a>
                                    </div>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-6 font-size-14">Email:</h5>
                                    <a class="col-md-6" href="mailto:{{ $booking->email }}">{{ $booking->email }}</a>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-6 font-size-14">Instagram:</h5>
                                    <p class="col-md-6">{{ $booking->instagram }}</p>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-6 font-size-14">Facebook:</h5>
                                    <p class="col-md-6">{{ $booking->facebook }}</p>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-6 font-size-14">Negara Asal:</h5>
                                    <p class="col-md-6">{{ $booking->country }}</p>
                                </div>
                                <div class="py-1 row">
                                    <h5 class="col-md-6 font-size-14">Alamat Asal:</h5>
                                    <p class="col-md-6">{{ $booking->home_address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--            <div class="card">--}}
                {{--                <div class="card-header">--}}
                {{--                    <h4 class="card-title">Detail Status Booking</h4>--}}
                {{--                </div>--}}
                {{--                <div class="card-body">--}}
                {{--                    <div class="table-responsive">--}}
                {{--                        <table class="table table-bordered mb-0">--}}
                {{--                            <!-- table mb-0-->--}}
                {{--                            <thead>--}}
                {{--                            <tr>--}}
                {{--                                <th>Kode Transaksi</th>--}}
                {{--                                <th>Whatsapp</th>--}}
                {{--                                <th>Email</th>--}}
                {{--                                <th>Status Booking</th>--}}
                {{--                                <th>Status Pembayaran</th>--}}
                {{--                                <th>Status Pengantaran Kendaraan</th>--}}
                {{--                                <th>Status Pengembalian Kendaraan</th>--}}
                {{--                                <th>Plat Nomor Kendaraan</th>--}}
                {{--                                <th>Jumlah KM Awal Kendaraan</th>--}}
                {{--                                <th>Jumlah KM Akhir Kendaraan</th>--}}
                {{--                                <th>Total KM Sewa Kendaraan</th>--}}
                {{--                                <th>Total Denda</th>--}}
                {{--                            </tr>--}}
                {{--                            </thead>--}}
                {{--                            <tbody>--}}
                {{--                            <tr>--}}
                {{--                                <td>{{ $booking->transaction_code }}</td>--}}
                {{--                                <td><a href="https://wa.me/{{ $booking->no_hp_wa }}" class="btn btn-success me-1">--}}
                {{--                                        <i class="fa-brands fa-whatsapp"></i></a></td>--}}
                {{--                                <td>{{ $booking->email }}</td>--}}
                {{--                                <td>--}}
                {{--                                    @if($booking->booking_status == 'Selesai')--}}
                {{--                                        <span class="badge badge-soft-success">{{ $booking->booking_status }}</span>--}}
                {{--                                    @elseif($booking->booking_status == 'Sedang Disewa')--}}
                {{--                                        <span class="badge badge-soft-warning">{{ $booking->booking_status }}</span>--}}
                {{--                                    @else--}}
                {{--                                        <span class="badge badge-soft-danger">{{ $booking->booking_status }}</span>--}}
                {{--                                    @endif--}}
                {{--                                </td>--}}
                {{--                                <td>--}}
                {{--                                    @if($booking->transaction_status == 'Belum Dibayar')--}}
                {{--                                        <span class="badge badge-soft-warning">{{ $booking->transaction_status }}</span>--}}
                {{--                                    @else--}}
                {{--                                        <span class="badge badge-soft-success">{{ $booking->transaction_status }}</span>--}}
                {{--                                    @endif--}}
                {{--                                </td>--}}
                {{--                                <td>--}}
                {{--                                    @if($booking->shipping_status == 'Belum')--}}
                {{--                                        <span class="badge badge-soft-warning">{{ $booking->shipping_status }}</span>--}}
                {{--                                    @else--}}
                {{--                                        <span class="badge badge-soft-success">{{ $booking->shipping_status }}</span>--}}
                {{--                                    @endif--}}
                {{--                                </td>--}}
                {{--                                <td>--}}
                {{--                                    @if($booking->return_status == 'Belum')--}}
                {{--                                        <span class="badge badge-soft-warning">{{ $booking->return_status }}</span>--}}
                {{--                                    @else--}}
                {{--                                        <span class="badge badge-soft-success">{{ $booking->return_status }}</span>--}}
                {{--                                    @endif--}}
                {{--                                </td>--}}
                {{--                                <td>{{ $booking->vehicle_license_plate }}</td>--}}
                {{--                                <td>{{ number_format($booking->start_km_vehicle) }}</td>--}}
                {{--                                <td>{{ number_format($booking->return_km_vehicle) }}</td>--}}
                {{--                                <td>{{ number_format($booking->total_km_rent) }}</td>--}}
                {{--                                <td>Rp. {{ number_format($booking->total_fine) }}</td>--}}
                {{--                            </tr>--}}
                {{--                            </tbody>--}}
                {{--                        </table>--}}
                {{--                    </div>--}}
                {{--                    <a class="btn btn-primary float-end mx-2" href="{{ route('bookings.edit', $booking->id) }}">--}}
                {{--                        Edit--}}
                {{--                    </a>--}}
                {{--                </div>--}}
                {{--            </div>--}}
            </div><!-- end col -->
        </div><!-- end row -->

        <div id="deleteModal" class="modal fade" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content d-flex justify-content-center">
                    <div class="modal-header">
                        <h4 class="modal-title w-100">Apakah anda yakin?</h4>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin ingin menghapus data booking ini?</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST">
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
    @endsection

    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script src="https://kit.fontawesome.com/bec8d97be0.js" crossorigin="anonymous"></script>

@endsection
