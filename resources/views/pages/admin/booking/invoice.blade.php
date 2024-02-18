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
                                    <p class="mb-0"><i class="mdi mdi-email-outline me-1"></i>info@batursarirental.com</p>
                                    <p><i class="mdi mdi-phone-outline me-1 mb-0"></i>+62 822-3659-2085</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <h4 class="float-end">Invoice #{{ $booking->transaction_code }}
                                    @if($booking->transaction_status == 'Sudah Dibayar')
                                        <span class="badge bg-success mb-0">Paid</span>
                                    @elseif($booking->transaction_status == 'Belum Dibayar')
                                        <span class="badge bg-warning mb-0">Unpaid</span>
                                    @elseif($booking->transaction_status == 'Batal')
                                        <span class="badge bg-danger mb-0">Cancel</span>
                                    @endif
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
                                <h5 class="font-size-16 mt-3 mb-2">Delivery :</h5>
                                @php $pick_up_date = strtotime($booking->pick_up_date) @endphp
                                @php $pick_up_time = strtotime($booking->pick_up_time) @endphp
                                <p class="mb-0">{{ date('D, M d, Y',$pick_up_date) }} @ {{ date('g:i A',$pick_up_time) }}</p>
                                <p class="mb-0">{{ $booking->pick_up_loc }}</p>
                                @if($booking->hotel_booking_name)
                                    <p class="mb-0">Hotel Booking Name : {{ $booking->hotel_booking_name }}</p>
                                @endif
                                @if($booking->room_number)
                                    <p class="mb-0">Room Number : {{ $booking->room_number }}</p>
                                @endif
                                <h5 class="font-size-16 mt-3 mb-2">Return :</h5>
                                @php $return_date = strtotime($booking->return_date) @endphp
                                @php $return_time = strtotime($booking->return_time) @endphp
                                <p class="mb-0">{{ date('D, M d, Y',$return_date) }} @ {{ date('g:i A',$return_time) }}</p>
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
                                <div>
                                    <h5 class="font-size-15 mb-1">Telegram:</h5>
                                    <p>{{ $booking->telegram }}</p>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-15 mb-1">Email:</h5>
                                    <p>{{ $booking->email }}</p>
                                </div>
                                @if($booking->note)
                                    <div class="mt-4">
                                        <h5 class="font-size-16 mt-3 mb-2">Booking Note:</h5>
                                        <p class="mb-1">{{ $booking->note == null ? '-' : $booking->note }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                    <hr class="my-1">
                    <div class="py-2">
                        <h5 class="font-size-15">Booking Order Summary</h5>
                        <div class="row">
                            <div class="col-5">
                                <h5 class="font-size-15 mt-3 mb-1">Vehicle:</h5>
                                <h5 class="text-truncate font-size-14 mb-1">{{ $booking->vehicle->vehicle_name }}</h5>
                                <p class="text-muted mb-0">{{ $booking->vehicle->color }}, {{ $booking->vehicle->year }}</p>
                            </div>
                                <div class="col-3">
                                    <h5 class="font-size-15 mt-3 mb-1">Plate:</h5>
                                    <p class="text-muted mb-0">{{ $booking->vehicle_detail->plate_number }}</p>
                                </div>
                            <div class="col-3">
                                <h5 class="font-size-15 mt-3 mb-1">Total Days Rent:</h5>
                                <p class="text-muted mb-0">{{ $booking->total_days_rent }} Days</p>
                            </div>
                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table align-middle table-nowrap table-centered my-0">
                                <thead>
                                <tr>
                                    <th class="fw-bold p-0">Rate</th>
                                    <th class="fw-bold p-0">Price</th>
                                    <th class="fw-bold p-0">Total Rent</th>
                                    <th class="text-end fw-bold p-0">Total</th>
                                </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                <tr>
                                    <td class="p-0">
                                        <div>
                                            <p class="text-muted mb-0">Daily</p>
                                        </div>
                                    </td>
                                    <td class="p-0">Rp. {{ number_format($booking->vehicle->daily_price ?? 0) }}</td>
                                    <td class="p-0">{{ $booking->day_rent }} Day</td>
                                    <td class="text-end p-0">Rp. {{ number_format($booking->daily_rent_price ?? 0) }}</td>
                                </tr>
                                @if($booking->monthly_rent_price > 0)
                                    <tr>
                                        <td class="p-0">
                                            <div>
                                                <p class="text-muted mb-0">Monthly</p>
                                            </div>
                                        </td>
                                        <td class="p-0">Rp. {{ number_format($booking->vehicle->monthly_price ?? 0) }}</td>
                                        <td class="p-0">{{ $booking->month_rent }} Month</td>
                                        <td class="text-end p-0">Rp. {{ number_format($booking->monthly_rent_price ?? 0) }}</td>
                                    </tr>
                                @endif
                                <tr class="py-0">
                                    <th scope="row" colspan="3" class="text-end fw-bold p-0">Sub Total :</th>
                                    <td class="text-end p-0">Rp. {{ number_format($booking->booking_price ?? 0) }}</td>
                                </tr>
                                <!-- end tr -->
                                @if($booking->insurance == 'include')
                                    <tr class="py-0">
                                        <th scope="row" colspan="3" class="text-end fw-bold p-0">
                                            Insurance (25%) :</th>
                                        <td class="text-end p-0">Rp. {{ number_format($booking->insurance_price) }}</td>
                                    </tr>
                                @endif
                                <!-- end tr -->
                                @if($booking->first_aid_kit == 'include')
                                    <tr class="py-0">
                                        <th scope="row" colspan="3" class="text-end fw-bold p-0">
                                            Accessory - First Aid Kit :</th>
                                        <td class="text-end p-0">Rp. 0</td>
                                    </tr>
                                @endif
                                <!-- end tr -->
                                @if($booking->phone_holder == 'include')
                                    <tr>
                                        <th scope="row" colspan="3" class="text-end fw-bold p-0">
                                            Accessory - Phone Holder :</th>
                                        <td class="text-end p-0">Rp. 0</td>
                                    </tr>
                                @endif

                                @if($booking->raincoat == 'include')
                                    <tr>
                                        <th scope="row" colspan="3" class="text-end fw-bold p-0">
                                            Accessory - Raincoat :</th>
                                        <td class="text-end p-0">Rp. 0</td>
                                    </tr>
                                @endif

                                @if($booking->helmet > 0)
                                    <tr>
                                        <th scope="row" colspan="3" class="text-end fw-bold p-0">
                                            Accessory - Helmet ({{ $booking->helmet }}pcs) :</th>
                                        <td class="text-end p-0">Rp. 0</td>
                                    </tr>
                                @endif

                                <tr>
                                    <th scope="row" colspan="3" class="text-end fw-bold p-0">
                                        Delivery Charge ({{ $booking->rounded_distance_pickup }} KM x Rp. 10.000):</th>
                                    <td class="text-end p-0">Rp. {{ number_format($booking->shipping_price) }}</td>
                                </tr>
                                <!-- end tr -->
                                <tr>
                                    <th scope="row" colspan="3" class="text-end fw-bold p-0">Total :</th>
                                    <td class="text-end p-0">
                                        <h4 class="m-0 fw-semibold">Rp. {{ number_format($booking->total_price ?? 0) }}</h4>
                                    </td>
                                </tr>
                                <!-- end tr -->
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                            <hr class="my-1">
                            <p class="text-muted mb-0">*You will get free delivery charge if pick up and drop off route distance from our office are less than 5KM</p>
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
        </div><!-- end col -->
    </div><!-- end row -->
@endsection

@section('scripts')
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="https://kit.fontawesome.com/bec8d97be0.js" crossorigin="anonymous"></script>

@endsection
