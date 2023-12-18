@extends('client.layouts.app')

@section('title')
    Our Vehicle | Batur Sari Rental Bali
@endsection

@section('content')
    <!-- content begin -->
    <div class="no-bottom space-top zebra" id="content">
        <div id="top"></div>

        <!-- section begin -->
        <section id="subheader" class="jarallax text-light">
            <img src="/images/background/16.jpg" class="jarallax-img" alt=""/>
            <div class="center-y relative text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>{{ $vehicle->vehicle_name }}</h1>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->

        <section id="section-car-details">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-6">
                        <div id="slider-carousel" class="owl-carousel">
                            <div class="item">
                                <img src="{{ Storage::url($vehicle->thumbnail) }}" alt=""/>
                            </div>
                            @foreach($vehicle->photos as $photo)
                                <div class="item">
                                    <img src="{{ Storage::url($photo->photo_url) }}" alt=""/>
                                </div>
                            @endforeach
                            {{--                            <div class="item">--}}
                            {{--                                <img src="images/car-single/2.jpg" alt="">--}}
                            {{--                            </div>--}}
                            {{--                            <div class="item">--}}
                            {{--                                <img src="images/car-single/3.jpg" alt="">--}}
                            {{--                            </div>--}}
                            {{--                            <div class="item">--}}
                            {{--                                <img src="images/car-single/4.jpg" alt="">--}}
                            {{--                            </div>--}}
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <h3 class="bold">{{ $vehicle->vehicle_name }}</h3>
                        <p>
                            @php echo $vehicle->description @endphp
                        </p>

                        <div class="spacer-10"></div>

                        <h4>Specifications</h4>
                        <div class="de-spec">
                            <div class="d-row">
                                <span class="d-title">Body</span>
                                <spam class="d-value">{{ $vehicle->body }}</spam>
                            </div>
                            <div class="d-row">
                                <span class="d-title">Seat</span>
                                <spam class="d-value">{{ $vehicle->passenger }} seats</spam>
                            </div>
                            <div class="d-row">
                                <span class="d-title">Fue Capacity</span>
                                <spam class="d-value">{{ $vehicle->fuel_capacity }} Litre</spam>
                            </div>
                            <div class="d-row">
                                <span class="d-title">Fuel Type</span>
                                <spam class="d-value">{{ $vehicle->fuel_type }}</spam>
                            </div>
                            <div class="d-row">
                                <span class="d-title">Engine</span>
                                <spam class="d-value">{{ $vehicle->engine_capacity }}cc</spam>
                            </div>
                            <div class="d-row">
                                <span class="d-title">Transmission</span>
                                <spam class="d-value">{{ $vehicle->transmission->transmission_type }}</spam>
                            </div>
                            <div class="d-row">
                                <span class="d-title">Year</span>
                                <spam class="d-value">{{ $vehicle->year }}</spam>
                            </div>
                            <div class="d-row">
                                <span class="d-title">Fuel Economy</span>
                                <spam class="d-value">{{ $vehicle->fuel_economy }} Km/L</spam>
                            </div>
                        </div>

                        <div class="spacer-single"></div>

                        <h4>Features</h4>
                        <ul class="ul-style-2">
                            @foreach($vehicle->features as $feature)
                                <li>{{ $feature->feature }}</li>
                            @endforeach
                        </ul>
                        <h4>Available Units</h4>
                        <h5>
                            {{ $vehicleUnit }} Unit
                        </h5>
                    </div>

                    <div class="col-lg-3">
                        <div class="de-item">
                            @php
                                if (!$vehicle->promos->isEmpty()){
                                    foreach ($vehicle->promos as $promo){
                                        $discount_status = $promo->status;
                                        $discount_percentage = $promo->discount_amount;
                                        $discount_daily = $vehicle->daily_price * $discount_percentage / 100;
                                        $daily_price = $vehicle->daily_price - $discount_daily;
                                        $discount_monthly = $vehicle->monthly_price * $discount_percentage / 100;
                                        $monthly_price = $vehicle->monthly_price - $discount_monthly;
                                    }
                                }else{
                                    $discount_status = '0';
                                }
                            @endphp
                            @if($discount_status == '1')
                                <div class="d-price">
                                    <h4>Daily rate</h4>
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
                                    <h4>Monthly rate</h4>
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
                        </div>
                        <div class="spacer-30"></div>

                        <div class="de-box mb25">
                            @if($vehicleUnit > 0)
                                <form name="contactForm" id="contact_form" action="{{ route('book-vehicle.post', $vehicle->slug) }}" method="post">
                                    @csrf
                                    <h4>Rent This {{ $vehicle->vehicle_type->vehicle_type_name }}</h4>

                                    <div class="spacer-20"></div>

                                    <div class="row">
                                        <input type="hidden" value="{{ $vehicle->id }}" name="vehicle_id" id="vehicle_id">
                                        <div class="col-lg-12 mb20">
                                            <h5>Pick Up Location</h5>
                                            <input
                                                type="text"
                                                name="pick_up_loc"
                                                placeholder="Enter your pickup location"
                                                id="autocomplete_pickup"
                                                autocomplete="on"
                                                class="form-control"
                                                value="{{ old('pick_up_loc') }}"
                                                required
                                            />
                                            <div class="form-group d-none" id="pickupLatitudeArea">
                                                <label>Latitude</label>
                                                <input type="text" id="latitude_pickup" name="latitude_pickup" class="form-control">
                                            </div>
                                            <div class="form-group d-none" id="pickupLongtitudeArea">
                                                <label>Longitude</label>
                                                <input type="text" name="longitude_pickup" id="longitude_pickup" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mb20">
                                            <h5>Drop Off Location</h5>
                                            <input
                                                type="text"
                                                name="return_loc"
                                                placeholder="Enter your dropoff location"
                                                id="autocomplete_return"
                                                autocomplete="on"
                                                class="form-control"
                                                value="{{ old('return_loc') }}"
                                                required
                                            />
                                            <div class="form-group d-none" id="returnLatitudeArea">
                                                <label>Latitude</label>
                                                <input type="text" id="latitude_return" name="latitude_return" class="form-control">
                                            </div>
                                            <div class="form-group d-none" id="returnLongtitudeArea">
                                                <label>Longitude</label>
                                                <input type="text" name="longitude_return" id="longitude_return" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mb20">
                                            <div class="date-time-field">
                                                <h5>Pick Up Date & Time</h5>
                                                <input
                                                    type="datetime-local"
                                                    class="form-control"
                                                    id="pick_up_datetime"
                                                    name="pick_up_datetime"
                                                    value="{{ old('pick_up_datetime') }}"
                                                    required
                                                />
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mb20">
                                            <h5>Drop Off Date & Time</h5>
                                            <input
                                                type="datetime-local"
                                                class="form-control"
                                                id="return_datetime"
                                                name="return_datetime"
                                                value="{{ old('return_datetime') }}"
                                                required
                                            />
                                        </div>
                                        <div class="col-lg-12 mb20">
                                            <h5 id="rentDays"></h5>
                                            {{--                                                <p></p>--}}
                                            <h5 id="rentPrice"></h5>
                                            {{--                                                <h4></h4>--}}
                                        </div>
                                    </div>

                                    <input
                                        type="submit"
                                        id="send_message"
                                        value="Book Now"
                                        class="btn-main btn-fullwidth"
                                    />

                                    <div class="clearfix"></div>
                                </form>
                            @else
                                <h4>Sorry, you can't rent this {{ $vehicle->vehicle_type->vehicle_type_name }} because
                                    there is no unit available at this momment :(</h4>
                            @endif
                        </div>

                        <div class="de-box">
                            <h4>Share</h4>
                            <div class="de-color-icons">
                                <span><i class="fa fa-twitter fa-lg"></i></span>
                                <span><i class="fa fa-facebook fa-lg"></i></span>
                                <span><i class="fa fa-reddit fa-lg"></i></span>
                                <span><i class="fa fa-linkedin fa-lg"></i></span>
                                <span><i class="fa fa-pinterest fa-lg"></i></span>
                                <span><i class="fa fa-stumbleupon fa-lg"></i></span>
                                <span><i class="fa fa-delicious fa-lg"></i></span>
                                <span><i class="fa fa-envelope fa-lg"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- content close -->

@endsection
@push('addon-script')
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyBzmaIUkgLYiiWK_0tbyqbx31ZsmyA0uoY&libraries=places&callback=initAutocomplete" type="text/javascript"></script>

    <script>
        google.maps.event.addDomListener(window, 'load', initialize);

        function initialize() {
            var input_pickup = document.getElementById('autocomplete_pickup');
            var input_return = document.getElementById('autocomplete_return');
            var autocomplete_pickup = new google.maps.places.Autocomplete(input_pickup);
            var autocomplete_return = new google.maps.places.Autocomplete(input_return);
            autocomplete_pickup.setComponentRestrictions({
                country: 'id',
            });
            autocomplete_return.setComponentRestrictions({
                country: 'id',
            });

            autocomplete_pickup.addListener('place_changed', function () {
                var place = autocomplete_pickup.getPlace();
                $('#latitude_pickup').val(place.geometry['location'].lat());
                $('#longitude_pickup').val(place.geometry['location'].lng());
            });
            autocomplete_return.addListener('place_changed', function () {
                var place = autocomplete_return.getPlace();
                $('#latitude_return').val(place.geometry['location'].lat());
                $('#longitude_return').val(place.geometry['location'].lng());
            });
        }
    </script>
    <script>
        var date = new Date().toISOString().slice(0, new Date().toISOString().lastIndexOf(":"));
        const localTime = date.toLocaleString();
        $("input[name='pick_up_datetime']").attr({
            "min": localTime
        });
    </script>
    {{--    <script>--}}
    {{--        $("input[name='pick_up_datetime']").change(function() {--}}
    {{--            var date = new Date($(this).val());--}}
    {{--            var date = date.setDate(date.getDate()+1);--}}
    {{--            var date = new Date(date).toISOString().slice(0,new Date(date).toISOString().lastIndexOf(":"));--}}
    {{--            $("input[name='return_datetime']").attr({--}}
    {{--                "min" : date--}}
    {{--            });--}}
    {{--        })--}}
    {{--    </script>--}}
    <script>
        $(document).ready(function () {
            $("input[name='pick_up_datetime']").change(function () {
                var date = new Date($(this).val());
                var date = date.setDate(date.getDate() + 1);
                var date = new Date(date).toISOString().slice(0, new Date(date).toISOString().lastIndexOf(":"));
                $("input[name='return_datetime']").attr({
                    "min": date
                });
            })
            $('#return_datetime').on('change', function () {
                var pick_up_loc = document.getElementById('autocomplete_pickup').value;
                var return_loc = document.getElementById('autocomplete_return').value;
                var pick_up_datetime = document.getElementById('pick_up_datetime').value;
                var vehicle_id = document.getElementById('vehicle_id').value;
                var return_datetime = this.value;
                $("#rentDays").html('');
                $("#rentPrice").html('');
                $.ajax({
                    url: "{{ url()->route('get-rent-price')}}",
                    type: "POST",
                    data: {
                        pick_up_loc: pick_up_loc,
                        return_loc: return_loc,
                        pick_up_datetime: pick_up_datetime,
                        return_datetime: return_datetime,
                        vehicle_id: vehicle_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#rentDays').html('<h5>Total Rent Days :</h5><p>' + result.total_days_rent + ' Day</p>');
                        $('#rentPrice').html('<h5>Total Rent Price :</h5><h4>' + result.total_price.toLocaleString('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }) + '</h4><p>*Include Delivery Charge  : ' + result.shipping_price.toLocaleString('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }) + '</p>');
                    }
                });
            });
        });
    </script>
@endpush
