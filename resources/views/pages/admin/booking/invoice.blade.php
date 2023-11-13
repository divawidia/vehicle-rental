@extends('layouts.admin.master')
@section('title')
    Detail Invoice Booking
@endsection
@section('page-title')
    Detail Invoice Booking
@endsection
@section('body')

    <body>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-title">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-4">
                                    <img src="{{ URL::asset('images/logo-with-text.png') }}" alt="logo" height="75" />
                                </div>
                                <div class="text-muted">
                                    <p class="mb-0">Jl. Kayu Aya, Gg, Beji No. 60x, Seminyak, Kec. Kuta, Kabupaten Badung, Bali</p>
                                    <p class="mb-0"><i class="mdi mdi-email-outline me-1"></i>admin@batursarirentalbali.com</p>
                                    <p><i class="mdi mdi-phone-outline me-1 mb-0"></i>+62 822-3659-2085</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <h4 class="float-end">Invoice #{{ $booking->id }}
                                    <span class="badge bg-success font-size-12 ms-2">
                                        {{ $booking->transaction_status }}
                                    </span>
                                </h4>
                                <div class="text-end mt-5">
                                    <h5>Invoice Date:</h5>
                                    <p>{{ date_format($booking->created_at, "d-m-Y") }}</p>
                                </div>
                                <div class="text-end mt-0">
                                    <h5>Payment Method:</h5>
                                    <p>{{ $booking->transaction_type }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-1">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="text-muted">
                                <h5 class="font-size-16 mb-3">Billed To:</h5>
                                <h5 class="font-size-15 mb-2">{{ $booking->first_name }} {{ $booking->last_name }}</h5>
                                <p class="mb-0">{{ $booking->home_address }}, {{ $booking->country }}</p>
                                <h5 class="font-size-16 mt-3 mb-2">Pick Up:</h5>
                                @php $pick_up_date = strtotime($booking->pick_up_datetime) @endphp
                                <p class="mb-0">{{ date('D, M d, Y',$pick_up_date) }} @ {{ date('g:i A',$pick_up_date) }}</p>
                                <p class="mb-0">{{ $booking->pick_up_loc }}</p>
                                <p class="mb-0">Hotel Booking Name : {{ $booking->hotel_booking_name }}</p>
                                <p class="mb-0">Room Number : {{ $booking->room_number }}</p>
                                <h5 class="font-size-16 mt-3 mb-2">Drop Off:</h5>
                                @php $return_date = strtotime($booking->return_datetime) @endphp
                                <p class="mb-0">{{ date('D, M d, Y',$return_date) }} @ {{ date('g:i A',$return_date) }}</p>
                                <p class="mb-0">{{ $booking->return_loc }}</p>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-sm-6">
                            <div class="text-muted text-sm-end">
                                <div>
                                    <h5 class="font-size-15 mb-1">Phone Number/Whatsapp:</h5>
                                    <p>{{ $booking->no_hp_wa }}</p>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-15 mb-1">Email:</h5>
                                    <p>{{ $booking->email }}</p>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-16 mt-3 mb-2">Booking Note:</h5>
                                    <p class="mb-1">{{ $booking->note == null ? '-' : $booking->note }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                    <hr class="my-1">
                    <div class="py-2">
                        <h5 class="font-size-15">Booking Order Summary</h5>
                        <div class="row">
                            <div class="col-3">
                                <h5 class="font-size-15 mt-3 mb-1">Vehicle:</h5>
                                <h5 class="text-truncate font-size-14 mb-1">{{ $booking->vehicle->vehicle_name }}</h5>
                                <p class="text-muted mb-0">{{ $booking->vehicle->color }}, {{ $booking->vehicle->year }}</p>
                            </div>
                            <div class="col-3">
                                <h5 class="font-size-15 mt-3 mb-1">Plate:</h5>
                                <p class="text-muted mb-0">{{ $booking->vehicle_license_plate }}</p>
                            </div>
                            <div class="col-3">
                                <h5 class="font-size-15 mt-3 mb-1">Total Days Rent:</h5>
                                <p class="text-muted mb-0">{{ $booking->total_days_rent }} Days</p>
                            </div>
                        </div>

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
                            <hr class="my-1">
                            <p class="text-muted mb-0">*You will get free delivery & collection charge if pick up and drop off route distance from our office are less than 5KM</p>
                        </div><!-- end table responsive -->
                        <div class="d-print-none mt-4">
                            <a href="{{ url()->previous() }}" class="btn btn-primary w-auto"><i class="fa fa-arrow-left"></i>  Kembali</a>
                            <div class="float-end">
                                <a href="javascript:window.print()" class="btn btn-success me-1"><i
                                        class="fa fa-print"></i></a>
                                <a href="#" class="btn btn-primary w-md">Send</a>
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
@endsection

@section('scripts')
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="https://kit.fontawesome.com/bec8d97be0.js" crossorigin="anonymous"></script>

@endsection
