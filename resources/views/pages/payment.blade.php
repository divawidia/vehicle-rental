@extends('layouts.app')

@section('title')
    Payment | Batur Sari Rental Bali
@endsection

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
                            <h1>Pay your Rent</h1>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->

        <section id="section-hero" aria-label="section" class="mt-50 sm-mt-0">
            <div class="container">
                <form name="contactForm" id="contact_form" class="form-border" action="{{ route('booking-payment.post') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="text-muted">
                                <h3 class="font-size-16 mb-3">Billed To:</h3>
                                <h5 class="font-size-15 mb-2">{{ $booking->first_name }} {{ $booking->last_name }}</h5>
                                <p class="mb-0">{{ $booking->home_address }}, {{ $booking->country }}</p>
                                <div>
                                    <h5 class="font-size-15 mt-3 mb-1">Phone Number/Whatsapp:</h5>
                                    <p>{{ $booking->no_hp_wa }}</p>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-15 mt-3 mb-1">Email:</h5>
                                    <p>{{ $booking->email }}</p>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-16 mt-3 mb-2">Booking Note:</h5>
                                    <p class="mb-1">{{ $booking->note == null ? '-' : $booking->note }}</p>
                                </div>
                                <h3 class="font-size-16 mt-3 mb-2">Pick Up:</h3>
                                @php $pick_up_date = strtotime($booking->pick_up_datetime) @endphp
                                <p class="mb-0">{{ date('D, M d, Y',$pick_up_date) }} @ {{ date('g:i A',$pick_up_date) }}</p>
                                <p class="mb-0">{{ $booking->pick_up_loc }}</p>
                                <p class="mb-0">Hotel Booking Name : {{ $booking->hotel_booking_name }}</p>
                                <p class="mb-0">Room Number : {{ $booking->room_number }}</p>
                                <h3 class="font-size-16 mt-3 mb-2">Drop Off:</h3>
                                @php $return_date = strtotime($booking->return_datetime) @endphp
                                <p class="mb-0">{{ date('D, M d, Y',$return_date) }} @ {{ date('g:i A',$return_date) }}</p>
                                <p class="mb-0">{{ $booking->return_loc }}</p>
                            </div>
                            <h3 class="text-truncate font-size-14 mb-1">{{ $booking->vehicle->vehicle_name }}</h3>
                            <p class="text-muted mb-0">{{ $booking->vehicle->color }}, {{ $booking->vehicle->year }}</p>
                            <div class="col-3">
                                <h5 class="font-size-15 mt-3 mb-1">Total Days Rent:</h5>
                                <p class="text-muted mb-0">{{ $booking->total_days_rent }} Days</p>
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
                            </div><!-- end table responsive -->
                        </div>
                        <div class="col-lg-6">
                            <h3 class="border-bottom-padding mb-4">Please Select your Payment Method</h3>
                            <div class="form-check mb-3 form-check-inline">
                                <input class="form-check-input" value="COD" type="radio" name="transaction_type"
                                       id="COD">
                                <label class="form-check-label" for="COD">
                                    Cash on Delivery
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" value="Transfer" type="radio" name="transaction_type"
                                       id="Transfer">
                                <label class="form-check-label" for="Transfer">
                                    Transfer
                                </label>
                            </div>
                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                <div class="btn-group mx-2" role="group" aria-label="First group">
                                    <a class="btn-main color-2 ml-5" href="{{ route('home') }}">Back</a>
                                </div>
                                <div class="btn-group" role="group" aria-label="First group">
                                    <input
                                        type="submit"
                                        id="send_message"
                                        value="Pay Now"
                                        class="btn-main pull-right"
                                    />
                                </div>
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
        $('.btn-number').click(function(e){
            e.preventDefault();

            fieldName = $(this).attr('data-field');
            type      = $(this).attr('data-type');
            var input = $("input[name='"+fieldName+"']");
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
                if(type == 'minus') {

                    if(currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                    if(parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if(type == 'plus') {

                    if(currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if(parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }

                }
            } else {
                input.val(0);
            }
        });
        $('.input-number').focusin(function(){
            $(this).data('oldValue', $(this).val());
        });
        $('.input-number').change(function() {

            minValue =  parseInt($(this).attr('min'));
            maxValue =  parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());

            name = $(this).attr('name');
            if(valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if(valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }


        });
        $(".input-number").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    </script>

@endpush
