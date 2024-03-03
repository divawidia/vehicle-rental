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
            <img src="images/background/16.jpg" class="jarallax-img" alt="">
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
                @if($vehicles->count() > 0)
                    <form name="contactForm" id="contact_form" class="form-border" action="{{ route('choose-vehicle.post') }}" method="POST">
                        @csrf
                        <div class="row">
                            <h2 class="border-bottom-padding pt-lg-5 mb-4">Choose Your Vehicle</h2>
                                <div class="de_form de_radio row d-flex justify-content-center">
                                    <div id="items-carousel" class="owl-carousel wow fadeIn">
                                        @foreach($vehicles as $vehicle)
                                        <div class="radio-img col-lg-12">
                                            <div class="de-item mb30">
                                            <div class="d-img">
                                                <img src="{{ Storage::url($vehicle->thumbnail) }}" class="img-fluid" alt="vehicle_thumbnail"/>
                                            </div>
                                            <div class="d-info">
                                                <div class="d-text">
                                                    <h4>{{ $vehicle->vehicle_name }}</h4>
                                                    <div class="d-atr-group">
                                                        <span class="d-atr">
                                                            <img src="images/icons/1.svg" alt="" />
                                                            {{ $vehicle->passenger }}
                                                        </span>
                                                        <span class="d-atr">
                                                            <img src="images/icons/engine.svg" alt=""/>
                                                            {{ $vehicle->engine_capacity }}
                                                        </span>
                                                        <span class="d-atr">
                                                            <img src="images/icons/transmission.svg" alt=""/>
                                                            @php
                                                                $transmission = \App\Models\Transmission::findOrFail($vehicle->transmission_id);
                                                            @endphp
                                                            {{ $transmission->transmission_type }}
                                                        </span>
                                                        <span class="d-atr">
                                                            <img class="pt-0" src="images/icons/scooter.svg" alt="" height="30px"/>
                                                            @php
                                                                $vehicle_type = \App\Models\VehicleType::findOrFail($vehicle->vehicle_type_id);
                                                            @endphp
                                                            {{ $vehicle_type->vehicle_type_name }}
                                                        </span>
                                                    </div>
                                                    <div class="d-price">
                                                        <div class="row d-flex align-items-center">
                                                            @php
                                                                if (!$vehicle->promos->isEmpty()){
                                                                    foreach ($vehicle->promos as $promo){
                                                                        $discount_status = $promo->status;
                                                                        $discount_percentage = $promo->discount_amount;
                                                                        $discount_daily = $vehicle->daily_price * $discount_percentage / 100;
                                                                        $daily_price = $vehicle->daily_price - $discount_daily;
                                                                        $discount_monthly = $vehicle->monthly_price * $discount_percentage / 100;
                                                                        $monthly_price = $vehicle->monthly_price - $discount_daily;
                                                                    }
                                                                }else{
                                                                    $discount_status = '0';
                                                                }
                                                            @endphp
                                                            @if($discount_status == '1')
                                                                <div class="d-price">
                                                                    Daily rate
                                                                    <div class="d-flex justify-content-start">
                                                                <span
                                                                    class="text-danger">Rp. {{ number_format($daily_price) }}</span>
                                                                        <h4 class="badge bg-danger w-25 text-white mx-3">
                                                                            -{{ $discount_percentage }}%</h4>
                                                                    </div>
                                                                    <div class="d-price-old">
                                                                        Rp. {{ number_format($vehicle->daily_price) }}</div>
                                                                </div>
                                                                <div class="d-price-month">
                                                                    Monthly rate
                                                                    <div class="d-flex justify-content-start">
                                                                <span
                                                                    class="text-danger">Rp. {{ number_format($monthly_price) }}</span>
                                                                        <h4 class="badge bg-danger w-25 text-white mx-3">
                                                                            -{{ $discount_percentage }}%</h4>
                                                                    </div>
                                                                    <div class="d-price-month-old">
                                                                        Rp. {{ number_format($vehicle->monthly_price) }}</div>
                                                                </div>
                                                            @elseif($discount_status == '0')
                                                                <div class="d-price">
                                                                    Daily rate
                                                                    <span>Rp. {{ number_format($vehicle->daily_price) }}</span>
                                                                </div>
                                                                <div class="d-price-month">
                                                                    Monthly rate
                                                                    <span>Rp. {{ number_format($vehicle->monthly_price) }}</span>
                                                                </div>
                                                            @endif
                                                            <div class="mt-4">
                                                                <input
                                                                    class="vehicle"
                                                                    id="{{ $vehicle->id }}"
                                                                    name="vehicle_id"
                                                                    type="radio"
                                                                    value="{{ $vehicle->id }}"
                                                                    required
                                                                />
                                                                <label for="{{ $vehicle->id }}" style="padding: 10px">
                                                                    Choose This
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                    </div>
                                </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <h2 class="border-top pt-3 mb-0">Additional Features</h2>
                                    <p>*Check the checkbox if want to add the additional feature</p>
                                    <div class="border-bottom w-100 mb-3"></div>
                                    <div class="row">
                                        <div class="col-7 col-lg-4 pb-2">
                                            <label class="form-check-label" for="insurance"><h3>Insurance</h3></label>
                                        </div>
                                        <div class="form-check col-3 col-lg-2 d-flex justify-content-center">
                                            <input class="form-check-input mx-1" type="checkbox" value="include" id="insurance" name="insurance">
                                            <p id="ntahlah"></p>
                                        </div>
                                        <div class="border-bottom w-75 mb-2"></div>
                                        <div id="summary">
                                            <p class="collapse mb-0" id="collapseSummary">
                                                Insurance Covering Damage & Theft to the Motorcycle only 25% from total bike rent rate. With this insurance, you will be free from the risk If your motorcycle is stolen, gets damaged in an accident, or is otherwise engaged in an incident, you won't have to worry about paying hefty repair bills thanks to our motorcycle insurance. Regarding any repair or motorcycle repatriation costs beyond USD 95,- (excess/own risk), we have you completely covered.
                                            </p>
                                            <a class="collapsed" data-bs-toggle="collapse" href="#collapseSummary" role="button" aria-expanded="false" aria-controls="collapseSummary"></a>
                                        </div>
{{--                                        <p>Insurance Covering Damage & Theft to the Motorcycle only 25% from total bike rent rate. With this insurance, you will be free from the risk If your motorcycle is stolen, gets damaged in an accident, or is otherwise engaged in an incident, you won't have to worry about paying hefty repair bills thanks to our motorcycle insurance. Regarding any repair or motorcycle repatriation costs beyond USD 95,- (excess/own risk), we have you completely covered.</p>--}}
                                    </div>
                                    <div class="border-bottom w-100 mt-3 mb-3"></div>
                                    <div class="row">
                                        <div class="col-7 col-lg-4">
                                            <h3>Helmet</h3>
                                        </div>
                                        <div class="col-3 col-lg-2 mx-2">
                                            <div class="row">
                                                <div class="nice-number d-flex justify-content-center">
                                                    <input class="form-control" name="helmet" id="helmet" min="1" max="2" value="1" type="number" style="width: 30px; height: 30px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-bottom w-75 mt-3 mb-3"></div>
                                        <h4>Free</h4>
                                        <p>You will get free one or two helmet, Our helmet are already cleaned and sanitized, so you dont have to worry if you get stinky helmet</p>
                                    </div>
                                    <div class="row">
                                        <div class="border-top w-100 mb-3"></div>
                                        <div class="col-7 col-lg-4">
                                            <label class="form-check-label" for="first_aid_kit"><h3>First Aid Kit</h3></label>
                                        </div>
                                        <div class="form-check col-3 col-lg-2 d-flex justify-content-center">
                                            <input class="form-check-input mx-1" type="checkbox" value="include" id="first_aid_kit" name="first_aid_kit">
                                        </div>
                                        <div class="border-bottom w-75 mt-2 mb-3"></div>
                                        <h4 class="mt-0">Free</h4>
                                        <p>High Quality International ISO approved First Aid Kit</p>
                                    </div>
                                    <div class="row">
                                        <div class="border-top w-100 mb-3"></div>
                                        <div class="col-8 col-lg-5">
                                            <label class="form-check-label" for="phone_holder"><h3>Phone Holder</h3></label>
                                        </div>
                                        <div class="form-check col-2 col-lg-1 d-flex justify-content-start px-1 px-lg-0">
                                            <input class="form-check-input mx-1" type="checkbox" value="include" id="phone_holder" name="phone_holder">
                                        </div>
                                        <div class="border-bottom w-75 mt-2 mb-3"></div>
                                        <h4>Free</h4>
                                        <p>With our smartphone holders, you may now travel the island with ease and reach your goal while carrying a fully charged phone!</p>
                                    </div>
                                    <div class="row">
                                        <div class="border-top w-100 mb-3"></div>
                                        <div class="col-7 col-lg-4">
                                            <label class="form-check-label" for="raincoat"><h3>Raincoat</h3></label>
                                        </div>
                                        <div class="form-check col-3 col-lg-2 d-flex justify-content-center">
                                            <input class="form-check-input mx-1" type="checkbox" value="include" id="raincoat" name="raincoat">
                                        </div>
                                        <div class="border-bottom w-75 mt-2 mb-3"></div>
                                        <h4>Free</h4>
                                        <p>You dont have to worry if you getting wet in the rainy season, we have raincoat to cover you from rain</p>
                                    </div>
                                    <div class="row">
                                        <div class="border-top w-100 mb-3"></div>
                                        <div class="row">
                                            <h4>Voucher Code : </h4>
                                            <p>If you have valid voucher code, use your voucher code to claim your rental discount</p>
                                            <div class="col-9 col-lg-6">
                                                <input type="text" class="form-control" placeholder="Input your voucher code" id="voucher" name="voucher" required>
                                                <span class="" id="voucher-validation"></span>
                                            </div>
                                            <div class="col-3">
                                                <a class="btn-main color-2 mx-2" id="apply-voucher-btn" href="#voucher">Apply</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <h2 class="border-bottom-padding border-top pt-3 mb-2">Booking Summary</h2>
                                    <div class="text-muted">
                                        <h3 class="font-size-16 mt-3 mb-2">Delivery :</h3>
                                        @php $pick_up_date = strtotime($booking['pick_up_date']) @endphp
                                        @php $pick_up_time = strtotime($booking['pick_up_time']) @endphp
                                        <p class="mb-0">{{ date('D, M d, Y',$pick_up_date) }}
                                            @ {{ date('g:i A',$pick_up_time) }}</p>
                                        <p class="mb-0">{{ $booking['pick_up_loc'] }}</p>
                                        <h3 class="font-size-16 mt-3 mb-2">Return :</h3>
                                        @php $return_date = strtotime($booking['return_date']) @endphp
                                        @php $return_time = strtotime($booking['return_time']) @endphp
                                        <p class="mb-0">{{ date('D, M d, Y',$return_date) }}
                                            @ {{ date('g:i A',$return_time) }}</p>
                                        <p class="mb-0">{{ $booking['return_loc'] }}</p>
                                    </div>
                                    <h3 class="text-truncate font-size-14 mt-3 mb-0" id="vehicleName"></h3>
                                    <p class="text-muted mb-0" id="vehicleColorYear"></p>
                                    <h5 class="font-size-15 mt-3 mb-1">Total Days Rent:</h5>
                                    <p class="text-muted mb-0" id="rentDays"></p>
                                    <div class="table-responsive">
                                        <table class="table align-middle table-nowrap table-centered my-0">
                                            <thead>
                                            <tr>
                                                <th class="fw-bold p-1">Rate</th>
                                                <th class="fw-bold p-1">Price</th>
                                                <th class="fw-bold p-1">Total Rent</th>
                                                <th class="fw-bold p-1">Total</th>
                                            </tr>
                                            </thead><!-- end thead -->
                                            <tbody>
                                            <tr>
                                                <td class="p-1">
                                                    <div>
                                                        <p class="text-muted mb-0">Daily</p>
                                                    </div>
                                                </td>
                                                <td id="vehiclePrice" class="p-1"></td>
                                                <td id="rentDays2" class="p-1"></td>
                                                <td class="text-end p-1" id="dailyRentPrice"></td>
                                            </tr>
                                            <tr id="monthRow">
                                                <td class="p-1">
                                                    <div>
                                                        <p class="text-muted mb-0" id="monthRate"></p>
                                                    </div>
                                                </td>
                                                <td id="monthPrice" class="p-1"></td>
                                                <td id="monthRent" class="p-1"></td>
                                                <td id="monthRentTotal" class="p-1"></td>
                                            </tr>
                                            <tr class="py-0">
                                                <th scope="row" colspan="3" class="text-end fw-bold p-1">Sub Total :</th>
                                                <td class="text-end p-1" id="bookingPrice"></td>
                                            </tr>
                                            <tr class="py-0" id="insuranceRow">
                                                <th scope="row" colspan="3" class="border-0 text-end fw-bold p-1">
                                                    Insurance (25%) :
                                                </th>
                                                <td class="border-0 text-end p-1" id="rentInsurance"></td>
                                            </tr>
                                            <tr class="py-0" id="first_aid_kit_row">
                                                <th scope="row" colspan="3" class="border-0 text-end fw-bold p-1">
                                                    Accessory - First Aid Kit :
                                                </th>
                                                <td class="border-0 p-1">Rp. 0</td>
                                            </tr>
                                            <tr id="phone_holder_row">
                                                <th scope="row" colspan="3" class="border-0 text-end fw-bold p-1">
                                                    Accessory - Phone Holder :
                                                </th>
                                                <td class="border-0 p-1">Rp. 0</td>
                                            </tr>
                                            <tr id="raincoat_row">
                                                <th scope="row" colspan="3" class="border-0 text-end fw-bold p-1">
                                                    Accessory - Raincoat :
                                                </th>
                                                <td class="border-0 p-1">Rp. 0</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="3" class="border-0 text-end fw-bold p-1">Accessory -
                                                    Helmet :
                                                </th>
                                                <td class="border-0 p-1">Rp. 0</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="3" class="border-0 text-end fw-bold p-1"
                                                    id="pickup_distance"></th>
                                                <td class="border-0 text-end p-1" id="delivery_charge"></td>
                                            </tr>
                                            <tr id="discount_row">
                                                <th scope="row" colspan="3" class="border-0 text-end fw-bold p-1" id="discount_percentage">
                                                </th>
                                                <td class="border-0 p-1" id="discount_price"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="3" class="border-0 text-end fw-bold p-1"><h4
                                                        class="m-0 fw-semibold">Total :</h4></th>
                                                <td class="border-0 text-start p-1">
                                                    <h4 class="m-0 fw-semibold" id="total_price"></h4>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-5 d-flex justify-content-center">
                                        <a class="btn-main color-2 mx-2" href="{{ url()->previous() }}">Back</a>
                                        <input
                                            type="submit"
                                            id="send_message"
                                            value="Next to Payment"
                                            class="btn-main"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @else
                    <div class="row">
                        <h2 class="border-bottom-padding pt-lg-5 mb-4 text-center">Sorry, we dont have the vehicle you want :(</h2>
                    </div>
                @endif
            </div>
        </section>
    </div>
    <!-- content close -->
@endsection

@push('addon-script')
    <script>
        $(document).ready(function () {
            const pick_up_loc = "{{$booking['pick_up_loc']}}";
            const return_loc = "{{$booking['return_loc']}}";
            const pick_up_date = "{!! $booking['pick_up_date'] !!}";
            const return_date = "{!! $booking['return_date'] !!}";
            const helmet = document.getElementById('helmet').value;
            const voucherValidation = document.getElementById("voucher-validation");
            $("#vehicleName").html('');
            $("#vehicleColorYear").html('');
            $("#rentDays").html('');
            $("#vehiclePrice").html('');
            $("#rentDays2").html('');
            $("#dailyRentPrice").html('');
            $("#monthlyRentPrice").html('');
            $("#monthRow").hide();
            $("#insuranceRow").hide();
            $("#first_aid_kit_row").hide();
            $("#phone_holder_row").hide();
            $("#raincoat_row").hide();
            $("#discount_row").hide();
            $("#pickup_distance").html('');
            $("#delivery_charge").html('');
            $("#total_price").html('');

            $('.vehicle').on('change', function () {
                const vehicle_id = $("input[name='vehicle_id']:checked").val();
                const insurance = $("input[name='insurance']:checked").val();
                const voucher = $('#voucher').val();
                // alert(insurance);
                $.ajax({
                    url: "{{ url()->route('get-rent-price')}}",
                    type: "POST",
                    data: {
                        pick_up_loc: pick_up_loc,
                        return_loc: return_loc,
                        pick_up_date: pick_up_date,
                        return_date: return_date,
                        vehicle_id: vehicle_id,
                        helmet: helmet,
                        insurance: insurance,
                        voucher: voucher,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#vehicleName').html('<h4 class="text-truncate mb-0">' + result[0].vehicle_name + '</h4>');
                        $('#vehicleColorYear').html('<p class="text-muted mb-0">' + result[0].vehicle_color + ', '+result.vehicle_year+'</p>');
                        $('#rentDays').html('<p>' + result[0].total_days_rent + ' Days</p>');
                        $('#vehiclePrice').html(result[0].vehicle_daily_price.toLocaleString('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }));
                        $('#rentDays2').html('<td>' + result[0].total_days_rent + ' Days</td>');
                        $('#dailyRentPrice').html('<td>' + result[0].daily_rent_price.toLocaleString('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }) + '</td>');
                        $('#bookingPrice').html('<td>' + result[0].booking_price.toLocaleString('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }) + '</td>');
                        $("#pickup_distance").html('Delivery Charge (' + result[0].rounded_distance_pickup + ' KM x Rp. 10.000):');
                        $("#delivery_charge").html('<td class="border-0 text-end" id="delivery_charge">' + result[0].shipping_price.toLocaleString('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }) + '</td>');
                        $("#total_price").html('<h4 class="m-0 fw-semibold" id="total_price">' + result[0].total_price.toLocaleString('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }) + '</h4>')
                        if (result[0].monthly_rent_price > 0) {
                            $("#monthRow").show();
                            $('#monthRate').html('<p>Monthly</p>');
                            $('#monthPrice').html('<td>Rp. {{ number_format($vehicle->monthly_price ?? 0) }}</td>');
                            $('#monthRent').html('<td>' + result[0].month_rent + ' Month</td>');
                            $('#monthRentTotal').html(result[0].monthly_rent_price.toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            }));
                        }
                        if (result[0].insurance_price > 0) {
                            $("#insuranceRow").show();
                            $('#rentInsurance').html('<td>' + result[0].insurance_price.toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            }) + '</td>');
                        } else {
                            $("#insuranceRow").hide();
                        }
                        if (result[0].discount_price > 0) {
                            $("#discount_row").show();
                            $('#discount_percentage').html('Discount (' + result[0].discount + '%) :');
                            $('#discount_price').html('- ' + result[0].discount_price.toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            }));
                        }else {
                            $("#discount_row").hide();
                        }
                    }
                });
            });
            $('#insurance').on('change', function () {
                const vehicle_id = $("input[name='vehicle_id']:checked").val();
                const insurance = $("input[name='insurance']:checked").val();
                const voucher = $('#voucher').val();
                if (vehicle_id) {
                    $.ajax({
                        url: "{{ url()->route('get-rent-price')}}",
                        type: "POST",
                        data: {
                            insurance: insurance,
                            pick_up_loc: pick_up_loc,
                            return_loc: return_loc,
                            pick_up_date: pick_up_date,
                            return_date: return_date,
                            vehicle_id: vehicle_id,
                            voucher: voucher,
                            _token: '{{csrf_token()}}'
                        },
                        dataType: 'json',
                        success: function (result) {
                            if (result[0].insurance_price > 0) {
                                $("#insuranceRow").show();
                                $('#rentInsurance').html('<td>' + result[0].insurance_price.toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                }) + '</td>');
                            }else {
                                $("#insuranceRow").hide();
                            }
                            if (result[0].discount_price > 0) {
                                $("#discount_row").show();
                                $('#discount_percentage').html('Discount (' + result[0].discount + '%) :');
                                $('#discount_price').html('- ' + result[0].discount_price.toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                }));
                            }else {
                                $("#discount_row").hide();
                            }
                            $("#total_price").html('<h4 class="m-0 fw-semibold" id="total_price">' + result[0].total_price.toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            }) + '</h4>')
                        }
                    });
                } else if (!vehicle_id) {
                    alert('Please choose your vehicle first');
                    $('#insurance').prop("checked", false);
                }
            });
            $('#apply-voucher-btn').on('click', function () {
                const vehicle_id = $("input[name='vehicle_id']:checked").val();
                const insurance = $("input[name='insurance']:checked").val();
                    const voucher = $('#voucher').val();
                    if (!voucher) {
                        $('#voucher').removeClass('is-valid').addClass("is-invalid");
                        $('#voucher-validation').removeClass('text-success').addClass("text-danger").html('<strong>*Please input your voucher code</strong>');
                    }else if (!vehicle_id){
                        $('#voucher').removeClass('is-valid').addClass("is-invalid");
                        $('#voucher-validation').removeClass('text-success').addClass("text-danger").html('<strong>*Please choose your vehicle first</strong>');
                    }
                    else {
                        $.ajax({
                            url: "{{ url()->route('get-rent-price')}}",
                            type: "POST",
                            data: {
                                insurance: insurance,
                                pick_up_loc: pick_up_loc,
                                return_loc: return_loc,
                                pick_up_date: pick_up_date,
                                return_date: return_date,
                                vehicle_id: vehicle_id,
                                voucher: voucher,
                                _token: '{{csrf_token()}}'
                            },
                            dataType: 'json',
                            success: function (result) {
                                if (result[0].insurance_price > 0) {
                                    $("#insuranceRow").show();
                                    $('#rentInsurance').html('<td>' + result[0].insurance_price.toLocaleString('id-ID', {
                                        style: 'currency',
                                        currency: 'IDR'
                                    }) + '</td>');
                                }else {
                                    $("#insuranceRow").hide();
                                }
                                if (result.message === 'Your voucher code are valid') {
                                    $('#voucher').removeClass('is-invalid').addClass("is-valid");
                                    $('#voucher-validation').removeClass('text-danger').addClass("text-success").html('<strong>*' + result['message'] + '</strong>');
                                    $("#discount_row").show();
                                    $('#discount_percentage').html('Discount (' + result[0].discount + '%) :');
                                    $('#discount_price').html('- ' + result[0].discount_price.toLocaleString('id-ID', {
                                        style: 'currency',
                                        currency: 'IDR'
                                    }));
                                }else {
                                    $('#voucher').removeClass('is-valid').addClass("is-invalid");
                                    $('#voucher-validation').removeClass('text-success').addClass("text-danger").html('<strong>*' + result['message'] + '</strong>');
                                    $("#discount_row").hide();
                                }
                                $("#total_price").html('<h4 class="m-0 fw-semibold" id="total_price">' + result[0].total_price.toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                }) + '</h4>')
                                // }
                            }
                        });
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
