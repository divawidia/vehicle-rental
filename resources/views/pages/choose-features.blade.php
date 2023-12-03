@extends('layouts.app')

@section('title')
    Booking | Batur Sari Rental Bali
@endsection

@push('addon-style')
    <link href="/css/jquery.nice-number.css" rel="stylesheet">

@endpush

@section('content')
    <!-- content begin -->
    <div class="no-bottom space-top zebra" id="content">
        <div id="top"></div>

        <!-- section begin -->
        <section id="subheader" class="jarallax text-light">
            <img src="/images/background/16.jpg" class="jarallax-img" alt="">
            <div class="center-y relative text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>Book Your Vehicle</h1>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->

        <section id="section-hero" aria-label="section" class="mt-50 sm-mt-0">
            <div class="container">
                <form name="contactForm" id="contact_form" class="form-border"
                      action="{{ route('choose-features.post', $vehicle->slug) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-7">
                            <h2 class="border-bottom-padding mb-4">Additional Features</h2>
                            <div class="row">
                                <div class="col-8 col-lg-3">
                                    <label class="form-check-label" for="insurance"><h3>Insurance</h3></label>
                                </div>
                                <div class="form-check col-2 pt-2">
                                    <input class="form-check-input mx-1" type="checkbox" value="include" id="insurance"
                                           name="insurance">
                                </div>

                            </div>
                            <div class="border-bottom w-50 mb-2"></div>
                            <p>Insurance Covering Damage & Theft to the Motorcycle only 25% from total bike rent rate.
                                With this insurance, you will be free from the risk If your motorcycle is stolen, gets
                                damaged in an accident, or is otherwise engaged in an incident, you won't have to worry
                                about paying hefty repair bills thanks to our motorcycle insurance. Regarding any repair
                                or motorcycle repatriation costs beyond USD 95,- (excess/own risk), we have you
                                completely covered.</p>

                            <div class="row">
                                <div class="col-8 col-lg-3">
                                    <h3>Helmet</h3>
                                </div>
                                <div class="col-4 col-lg-5">
                                    <div class="row">
                                        <div class="nice-number">
                                            <input class="form-control" name="helmet" id="helmet" min="1" max="2"
                                                   value="1" type="number">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <h4>Free</h4>
                            <div class="border-bottom w-50 mb-2"></div>
                            <p>You will get free one or two helmet, Our helmet are already cleaned and sanitized, so you
                                dont have to worry if you get stinky helmet</p>

                            <div class="row">
                                <div class="col-8 col-lg-3">
                                    <label class="form-check-label" for="first_aid_kit"><h3>First Aid Kit</h3></label>
                                </div>
                                <div class="form-check col-1 pt-2">
                                    <input class="form-check-input mx-1" type="checkbox" value="include"
                                           id="first_aid_kit" name="first_aid_kit">
                                </div>

                            </div>
                            <h4>Free</h4>
                            <div class="border-bottom w-50 mb-2"></div>
                            <p>High Quality International ISO approved First Aid Kit</p>

                            <div class="row">
                                <div class="col-8 col-lg-3">
                                    <label class="form-check-label" for="phone_holder"><h3>Phone Holder</h3></label>
                                </div>
                                <div class="form-check col-1 pt-2">
                                    <input class="form-check-input mx-1" type="checkbox" value="include"
                                           id="phone_holder" name="phone_holder">
                                </div>

                            </div>
                            <h4>Free</h4>
                            <div class="border-bottom w-50 mb-2"></div>
                            <p>With our smartphone holders, you may now travel the island with ease and reach your goal
                                while carrying a fully charged phone!</p>

                            <div class="row">
                                <div class="col-8 col-lg-3">
                                    <label class="form-check-label" for="raincoat"><h3>Raincoat</h3></label>
                                </div>
                                <div class="form-check col-1 pt-2">
                                    <input class="form-check-input mx-1" type="checkbox" value="include" id="raincoat"
                                           name="raincoat">
                                </div>

                            </div>
                            <h4>Free</h4>
                            <div class="border-bottom w-50 mb-2"></div>
                            <p>You dont have to worry if you getting wet in the rainy season, we have raincoat to cover
                                you from rain</p>
                        </div>
                        <div class="col-lg-5">
                            <h2 class="border-bottom-padding mb-2">Booking Summary</h2>
                            <div class="text-muted">
                                <h3 class="font-size-16 mt-3 mb-2">Pick Up:</h3>
                                @php $pick_up_date = strtotime($booking['pick_up_datetime']) @endphp
                                <p class="mb-0">{{ date('D, M d, Y',$pick_up_date) }}
                                    @ {{ date('g:i A',$pick_up_date) }}</p>
                                <p class="mb-0">{{ $booking['pick_up_loc'] }}</p>
                                <h3 class="font-size-16 mt-3 mb-2">Drop Off:</h3>
                                @php $return_date = strtotime($booking['return_datetime']) @endphp
                                <p class="mb-0">{{ date('D, M d, Y',$return_date) }}
                                    @ {{ date('g:i A',$return_date) }}</p>
                                <p class="mb-0">{{ $booking['return_loc'] }}</p>
                            </div>
                            <h3 class="text-truncate font-size-14 mt-3 mb-0">{{ $vehicle->vehicle_name }}</h3>
                            <p class="text-muted mb-0">{{ $vehicle->color }}, {{ $vehicle->year }}</p>
                            <h5 class="font-size-15 mt-3 mb-1">Total Days Rent:</h5>
                            <p class="text-muted mb-0" id="rentDays"></p>
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap table-centered my-0">
                                    <thead>
                                    <tr>
                                        <th class="fw-bold">Rate</th>
                                        <th class="fw-bold">Price</th>
                                        <th class="fw-bold">Total Rent</th>
                                        <th class="fw-bold">Total</th>
                                    </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div>
                                                <p class="text-muted mb-0">Daily</p>
                                            </div>
                                        </td>
                                        <td>Rp. {{ number_format($vehicle->daily_price ?? 0) }}</td>
                                        <td id="rentDays2"></td>
                                        <td class="text-end" id="dailyRentPrice"></td>
                                    </tr>
                                    <tr id="monthRow">
                                        <td>
                                            <div>
                                                <p class="text-muted mb-0" id="monthRate"></p>
                                            </div>
                                        </td>
                                        <td id="monthPrice"></td>
                                        <td id="monthRent"></td>
                                        <td id="monthRentTotal"></td>
                                    </tr>
                                    <tr class="py-0">
                                        <th scope="row" colspan="3" class="text-end fw-bold">Sub Total :</th>
                                        <td class="text-end" id="bookingPrice"></td>
                                    </tr>
                                    <tr class="py-0" id="insuranceRow">
                                        <th scope="row" colspan="3" class="border-0 text-end fw-bold">
                                            Insurance (25%) :
                                        </th>
                                        <td class="border-0 text-end" id="rentInsurance"></td>
                                    </tr>
                                    <tr class="py-0" id="first_aid_kit_row">
                                        <th scope="row" colspan="3" class="border-0 text-end fw-bold">
                                            Accessory - First Aid Kit :
                                        </th>
                                        <td class="border-0">Rp. 0</td>
                                    </tr>
                                    <tr id="phone_holder_row">
                                        <th scope="row" colspan="3" class="border-0 text-end fw-bold">
                                            Accessory - Phone Holder :
                                        </th>
                                        <td class="border-0">Rp. 0</td>
                                    </tr>
                                    <tr id="raincoat_row">
                                        <th scope="row" colspan="3" class="border-0 text-end fw-bold">
                                            Accessory - Raincoat :
                                        </th>
                                        <td class="border-0">Rp. 0</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="3" class="border-0 text-end fw-bold">Accessory -
                                            Helmet :
                                        </th>
                                        <td class="border-0">Rp. 0</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="3" class="border-0 text-end fw-bold"
                                            id="pickup_distance"></th>
                                        <td class="border-0 text-end" id="delivery_charge"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="3" class="border-0 text-end fw-bold"><h4
                                                class="m-0 fw-semibold">Total :</h4></th>
                                        <td class="border-0 text-end">
                                            <h4 class="m-0 fw-semibold" id="total_price"></h4>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group mx-2" role="group" aria-label="First group">
                                <a class="btn-main color-2 ml-5" href="{{ url()->previous() }}">Back</a>
                            </div>
                            <div class="btn-group" role="group" aria-label="First group">
                                <input
                                    type="submit"
                                    id="send_message"
                                    value="Next to Payment"
                                    class="btn-main pull-right"
                                />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <!-- content close -->
@endsection

@push('addon-script')
    <script>
        $(document).ready(function () {
            var pick_up_loc = "{{$booking['pick_up_loc']}}";
            var return_loc = "{{$booking['return_loc']}}";
            var pick_up_datetime = "{!! $booking['pick_up_datetime'] !!}";
            var return_datetime = "{!! $booking['return_datetime'] !!}";
            var vehicle_id = {!! $booking['vehicle_id'] !!};
            var helmet = document.getElementById('helmet').value;
            $("#rentDays").html('');
            $("#rentDays2").html('');
            $("#dailyRentPrice").html('');
            $("#monthlyRentPrice").html('');
            $("#monthRow").hide();
            $("#insuranceRow").hide();
            $("#first_aid_kit_row").hide();
            $("#phone_holder_row").hide();
            $("#raincoat_row").hide();
            $("#pickup_distance").html('');
            $("#delivery_charge").html('');
            $("#total_price").html('');
            $.ajax({
                url: "{{ url()->route('get-rent-price')}}",
                type: "POST",
                data: {
                    pick_up_loc: pick_up_loc,
                    return_loc: return_loc,
                    pick_up_datetime: pick_up_datetime,
                    return_datetime: return_datetime,
                    vehicle_id: vehicle_id,
                    helmet: helmet,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#rentDays').html('<p>' + result.total_days_rent + ' Days</p>');
                    $('#rentDays2').html('<td>' + result.total_days_rent + ' Days</td>');
                    $('#dailyRentPrice').html('<td>' + result.daily_rent_price.toLocaleString('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }) + '</td>');
                    $('#bookingPrice').html('<td>' + result.booking_price.toLocaleString('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }) + '</td>');
                    $("#pickup_distance").html('<th scope="row" colspan="3" class="border-0 text-end fw-bold" id="pickup_distance">Delivery Charge (' + result.rounded_distance_pickup + ' KM x Rp. 10.000):</th>');
                    $("#delivery_charge").html('<td class="border-0 text-end" id="delivery_charge">' + result.shipping_price.toLocaleString('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }) + '</td>');
                    $("#total_price").html('<h4 class="m-0 fw-semibold" id="total_price">' + result.total_price.toLocaleString('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }) + '</h4>')
                    if (result.monthly_rent_price > 0) {
                        $("#monthRow").show();
                        $('#monthRate').html('<p>Monthly</p>');
                        $('#monthPrice').html('<td>Rp. {{ number_format($vehicle->monthly_price ?? 0) }}</td>');
                        $('#monthRent').html('<td>' + result.month_rent + ' Month</td>');
                        $('#monthRentTotal').html('<td class="text-end">' + result.monthly_rent_price.toLocaleString('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }) + '</td>');
                    }
                }
            });
            $('#insurance').on('change', function () {
                if (this.checked) {
                    var insurance = this.value;
                    $.ajax({
                        url: "{{ url()->route('get-rent-price')}}",
                        type: "POST",
                        data: {
                            insurance: insurance,
                            pick_up_loc: pick_up_loc,
                            return_loc: return_loc,
                            pick_up_datetime: pick_up_datetime,
                            return_datetime: return_datetime,
                            vehicle_id: vehicle_id,
                            _token: '{{csrf_token()}}'
                        },
                        dataType: 'json',
                        success: function (result) {
                            $("#insuranceRow").show();
                            $('#rentInsurance').html('<td>' + result.insurance_price.toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            }) + '</td>');
                            $("#total_price").html('<h4 class="m-0 fw-semibold" id="total_price">' + result.total_price.toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            }) + '</h4>')
                        }
                    });
                } else {
                    $("#insuranceRow").hide();
                }
            });
            $('#first_aid_kit').on('change', function () {
                if (this.checked) {
                    $("#first_aid_kit_row").show();
                } else {
                    $("#first_aid_kit_row").hide();
                }
            });
            $('#raincoat').on('change', function () {
                if (this.checked) {
                    $("#raincoat_row").show();
                } else {
                    $("#raincoat_row").hide();
                }
            });
            $('#phone_holder').on('change', function () {
                if (this.checked) {
                    $("#phone_holder_row").show();
                } else {
                    $("#phone_holder_row").hide();
                }
            });
        });
    </script>
    <script src="/js/jquery.nice-number.js"></script>
    <script>
        $('#helmet').niceNumber();
    </script>
@endpush
