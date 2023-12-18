@extends('client.layouts.app')

@section('title')
    Rent Scooter and Rent Car in Bali
@endsection

@section('content')
    <!-- content begin -->
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>

        <section id="section-hero" aria-label="section" class="full-height vertical-center">
            <div class="container pt-0 pt-lg-5">
                <div class="row align-items-center">
                    <div class="spacer-double sm-hide"></div>
                    <div class="col-lg-7">
                        <div class="spacer-single sm-hide"></div>
                        <h2 class="mb-2" style="color: var(--primary-color)">
                            Looking for a <span class="id-color">vehicle</span>? <br/>
                            Book now your <span class="id-color">scooter</span> or
                            <span class="id-color">car</span> rental
                        </h2>
                        <div class="p-4 rounded-5 shadow-soft border border-2" data-bgcolor="#ffffff">
                            <form name="contactForm" id="contact_form" action="{{ route('home.post') }}" method="POST">
                                @csrf
                                <h5>What is your vehicle type?</h5>
                                <div class="de_form de_radio row g-3">
                                    @foreach($vehicleTypes as $vehicleType)
                                        <div class="radio-img col-4 col-sm-4">
                                            <input id="{{ $vehicleType->id }}" name="vehicle_type_id" type="radio" value="{{ $vehicleType->id }}"@checked(old("vehicle_type_id") == $vehicleType->id)/>
                                            <label class="text-center px-0" for="{{ $vehicleType->id }}">
                                                <img src="{{ Storage::url($vehicleType->icon) }}" alt="{{ $vehicleType->vehicle_type_name }}" height="30px"/>
                                                {{ $vehicleType->vehicle_type_name }}
                                            </label>
                                        </div>
                                    @endforeach
                                    @error('vehicle_type_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 px-3 mt-3">
                                        <h5>Delivery Location</h5>
                                        <select class="form-select @error('pickup_location_type') is-invalid @enderror" name="pickup_location_type" id="pickup_location_type">
                                            @if(old("pickup_location_type")==null)
                                                <option selected disabled>Choose your desired location</option>
                                            @endif
                                            @foreach(["office" => "Batur Sari Rental Office (Gg. Beji, Seminyak, Kuta)", "hotel_villa" => "Hotel/Villa", "custom_address" => "My own address (Pinpoint Map)"] AS $pickup_location_type => $pickup_location_type_label)
                                                <option value="{{ $pickup_location_type }}" @selected(old("pickup_location_type") == $pickup_location_type)>{{ $pickup_location_type_label }}</option>
                                            @endforeach
                                        </select>
                                        @error('pickup_location_type')
                                            <div class="alert alert-danger mt-3">{{ $message }}</div>
                                        @enderror
                                        <h5 id="pickupAddressLabel" class="mt-3">Address of my villa / hotel :</h5>
                                        <input type="text" name="pick_up_loc" placeholder="Enter delivery location" id="autocomplete_pickup" autocomplete="on" class="form-control" value="{{ old('pick_up_loc') }}"/>
                                        <div class="form-group d-none" id="pickupLatitudeArea">
                                            <label>Latitude</label>
                                            <input type="text" id="latitude_pickup" name="latitude_pickup" class="form-control" value="{{ old('latitude_pickup') }}">
                                        </div>
                                        <div class="form-group d-none" id="pickupLongtitudeArea">
                                            <label>Longitude</label>
                                            <input type="text" name="longitude_pickup" id="longitude_pickup" class="form-control" value="{{ old('longitude_pickup') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 px-3 mt-3">
                                        <h5>Return Location</h5>
                                        <select class="form-select @error('return_location_type') is-invalid @enderror" name="return_location_type" id="return_location_type">
                                            @if(old("return_location_type")==null)
                                                <option selected disabled>Choose your desired location</option>
                                            @endif
                                            @foreach(["office" => "Batur Sari Rental Office (Gg. Beji, Seminyak, Kuta)", "hotel_villa" => "Hotel/Villa", "custom_address" => "My own address (Pinpoint Map)"] AS $return_location_type => $return_location_type_label)
                                                <option value="{{ $return_location_type }}" @selected(old("pickup_location_type") == $return_location_type)>{{ $return_location_type_label }}</option>
                                            @endforeach
                                        </select>
                                        @error('return_location_type')
                                            <div class="alert alert-danger mt-3">{{ $message }}</div>
                                        @enderror
                                        <h5 id="returnAddressLabel" class="mt-3">Address of my villa / hotel :</h5>
                                        <input type="text" name="return_loc" placeholder="Enter return location" id="autocomplete_return" autocomplete="on" class="form-control" value="{{ old('return_loc') }}"/>
                                        <div class="form-group d-none" id="returnLatitudeArea">
                                            <label>Latitude</label>
                                            <input type="text" id="latitude_return" name="latitude_return" class="form-control" value="{{ old('latitude_return') }}">
                                        </div>
                                        <div class="form-group d-none" id="returnLongtitudeArea">
                                            <label>Longitude</label>
                                            <input type="text" name="longitude_return" id="longitude_return" class="form-control" value="{{ old('longitude_return') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div id="mapLabel">
                                            <h5 class="mt-4">Pinpoint my location (delivery & return):</h5>
                                            <p class="mt-n3">*Drag the marker point to set your location</p>
                                        </div>
                                        <div id="map" class="mt-3" style="height: 280px; border-radius:15px;"></div>
                                        <div id="infowindow-content">
                                            <span id="place-name" class="title"></span><br/>
                                            <span id="place-address"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 my-3">
                                        <div class="row px-3">
                                            <div class="col-7 px-1">
                                                <h5>Delivery Date</h5>
                                                <input type="date" class="form-control @error('pick_up_date') is-invalid @enderror" id="pick_up_date" name="pick_up_date" value="{{ old('pick_up_date') }}" required/>
                                                @error('pick_up_date')
                                                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-5 px-0">
                                                <h5>Time</h5>
                                                <select class="form-select @error('pick_up_time') is-invalid @enderror" name="pick_up_time" id="pick_up_time" required>
                                                    <option selected disabled>Select Time</option>
                                                    <option value="08:00">08:00</option>
                                                    <option value="08:30">08:30</option>
                                                    <option value="09:00">09:00</option>
                                                    <option value="09:30">09:30</option>
                                                    <option value="10:00">10:00</option>
                                                    <option value="10:30">10:30</option>
                                                    <option value="11:00">11:00</option>
                                                    <option value="11:30">11:30</option>
                                                    <option value="12:00">12:00</option>
                                                    <option value="12:30">12:30</option>
                                                    <option value="13:00">13:00</option>
                                                    <option value="13:30">13:30</option>
                                                    <option value="14:00">14:00</option>
                                                    <option value="14:30">14:30</option>
                                                    <option value="15:00">15:00</option>
                                                    <option value="15:30">15:30</option>
                                                    <option value="16:00">16:00</option>
                                                    <option value="16:30">16:30</option>
                                                    <option value="17:00">17:00</option>
                                                    <option value="17:30">17:30</option>
                                                    <option value="18:00">18:00</option>
                                                </select>
                                                @error('pick_up_time')
                                                <div class="alert alert-danger mt-3">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 my-3">
                                        <div class="row px-3">
                                            <div class="col-7 px-1">
                                                <h5>Return Date</h5>
                                                <input type="date" class="form-control @error('return_date') is-invalid @enderror" id="return_date" name="return_date" value="{{ old('return_date') }}" required/>
                                                @error('return_date')
                                                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-5 px-0">
                                                <h5>Time</h5>
                                                <select class="form-select @error('return_time') is-invalid @enderror" name="return_time" id="return_time" required>
                                                    <option selected disabled>Select Time</option>
                                                    <option value="08:00">08:00</option>
                                                    <option value="08:30">08:30</option>
                                                    <option value="09:00">09:00</option>
                                                    <option value="09:30">09:30</option>
                                                    <option value="10:00">10:00</option>
                                                    <option value="10:30">10:30</option>
                                                    <option value="11:00">11:00</option>
                                                    <option value="11:30">11:30</option>
                                                    <option value="12:00">12:00</option>
                                                    <option value="12:30">12:30</option>
                                                    <option value="13:00">13:00</option>
                                                    <option value="13:30">13:30</option>
                                                    <option value="14:00">14:00</option>
                                                    <option value="14:30">14:30</option>
                                                    <option value="15:00">15:00</option>
                                                    <option value="15:30">15:30</option>
                                                    <option value="16:00">16:00</option>
                                                    <option value="16:30">16:30</option>
                                                    <option value="17:00">17:00</option>
                                                    <option value="17:30">17:30</option>
                                                    <option value="18:00">18:00</option>
                                                </select>
                                                @error('return_time')
                                                <div class="alert alert-danger mt-3">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" id="send_message" value="Find a Vehicle" class="btn-main pull-right"/>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-5 mt-5 mt-lg-0" style="background-image: url({{ asset('images/misc/circle.png') }});
                        background-repeat: no-repeat;
                        background-size: cover;
                        overflow: hidden;
                        background-position: center;">
                        <img src="{{asset('/images/misc/Group-152.png')}}" class="img-fluid" alt=""/>
                    </div>
                </div>
                <div class="spacer-double"></div>

                <div class="row">

                    <div class="col-md-3 wow fadeInRight" data-wow-delay=".2s">
                        <div class="feature-box style-4 text-center">
                            <a href="#"><i class="bg-color text-light i-boxed fa fa-car"></i></a>
                            <div class="text">
                                <a href="#"><h4>Choose a vehicle</h4></a>
                                Unlock unparalleled adventures and memorable journeys with our vast fleet of vehicles
                                tailored to suit every need, taste, and destination.
                            </div>
                            <span class="wm">1</span>
                        </div>
                    </div>

                    <div class="col-md-3 wow fadeInRight" data-wow-delay=".4s">
                        <div class="feature-box style-4 text-center">
                            <a href="#"><i class="bg-color text-light i-boxed fa fa-calendar"></i></a>
                            <div class="text">
                                <a href="#"><h4>Pick location &amp; date</h4></a>
                                Pick your ideal location and date, and let us take you on a journey filled with
                                convenience, flexibility, and unforgettable experiences.
                            </div>
                            <span class="wm">2</span>
                        </div>
                    </div>

                    <div class="col-md-3 wow fadeInRight" data-wow-delay=".6s">
                        <div class="feature-box style-4 text-center">
                            <a href="#"><i class="bg-color text-light i-boxed fa fa-pencil-square-o"></i></a>
                            <div class="text">
                                <a href="#"><h4>Make a booking</h4></a>
                                Secure your reservation with ease, unlocking a world of possibilities and embarking on
                                your next adventure with confidence.
                            </div>
                            <span class="wm">3</span>
                        </div>
                    </div>

                    <div class="col-md-3 wow fadeInRight" data-wow-delay=".6s">
                        <div class="feature-box style-4 text-center">
                            <a href="#"><i class="bg-color text-light i-boxed fa fa-smile-o"></i></a>
                            <div class="text">
                                <a href="#"><h4>Sit back & relax</h4></a>
                                Hassle-free convenience as we take care of every detail, allowing you to unwind and
                                embrace a journey filled comfort.
                            </div>
                            <span class="wm">3</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-motorbike" class="no-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 offset-lg-3 text-center">
                        <h2>Our Scooter & Motorbike Fleet</h2>
                        <p>
                            Driving your dreams to reality with an exquisite fleet of
                            versatile vehicles for unforgettable journeys.
                        </p>
                        <div class="spacer-20"></div>
                    </div>

                    <div class="clearfix"></div>

                    <div id="items-carousel" class="owl-carousel wow fadeIn">
                        @foreach($vehicles as $vehicle)
                            <div class="col-lg-12">
                                <div class="de-item mb30">
                                    <div class="d-img">
                                        <img src="{{ Storage::url($vehicle->thumbnail) }}" class="img-fluid" alt="thumbnail {{ $vehicle->vehicle_name }}"/>
                                    </div>
                                    <div class="d-info">
                                        <div class="d-text">
                                            <h4>{{ $vehicle->vehicle_name }}</h4>
                                            <div class="d-atr-group">
                                                <span class="d-atr">
                                                    <img src="{{asset('images/icons/1.svg')}}" alt="passenger"/>
                                                    {{ $vehicle->passenger }}
                                                </span>
                                                <span class="d-atr">
                                                    <img src="{{asset('images/icons/engine.svg')}}" alt="engine capacity"/>
                                                    {{ $vehicle->engine_capacity }}cc
                                                </span>
                                                <span class="d-atr">
                                                    <img src="{{asset('images/icons/transmission.svg')}}" alt=""/>
                                                    {{ $vehicle->transmission->transmission_type }}
                                                </span>
                                                <span class="d-atr">
                                                    <img src="{{asset('images/icons/scooter.svg')}}" alt="" height="25px"/>
                                                    {{ $vehicle->vehicle_type->vehicle_type_name }}
                                                </span>
                                            </div>
                                            <div class="row d-flex align-items-center">
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
                                                        Daily rate
                                                        <div class="d-flex justify-content-start">
                                                            <span class="text-danger">Rp. {{ number_format($daily_price) }}</span>
                                                            <h4 class="badge bg-danger w-25 text-white mx-3">-{{ $discount_percentage }}%</h4>
                                                        </div>
                                                        <div class="d-price-old">Rp. {{ number_format($vehicle->daily_price) }}</div>
                                                    </div>
                                                    <div class="d-price-month">
                                                        Monthly rate
                                                        <div class="d-flex justify-content-start">
                                                            <span class="text-danger">Rp. {{ number_format($monthly_price) }}</span>
                                                            <h4 class="badge bg-danger w-25 text-white mx-3">-{{ $discount_percentage }}%</h4>
                                                        </div>
                                                        <div class="d-price-month-old">Rp. {{ number_format($vehicle->monthly_price) }}</div>
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
                                                <a class="btn-main w-100 mt-3" href="{{ route('vehicle-detail', $vehicle->slug) }}">
                                                    Rent Now
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section aria-label="section" class="no-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 offset-lg-3 text-center">
                        <h2>Our Features</h2>
                        <p>
                            Discover a world of convenience, safety, and customization,
                            paving the way for unforgettable adventures and seamless
                            mobility solutions.
                        </p>
                        <div class="spacer-20"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-3">
                        <div class="box-icon s2 p-small mb20 wow fadeInRight" data-wow-delay=".5s">
                            <i class="fa bg-color fa-trophy"></i>
                            <div class="d-inner">
                                <h4>First class services</h4>
                                Where luxury meets exceptional care, creating unforgettable
                                moments and exceeding your every expectation.
                            </div>
                        </div>
                        <div class="box-icon s2 p-small mb20 wow fadeInL fadeInRight" data-wow-delay=".75s">
                            <i class="fa bg-color fa-road"></i>
                            <div class="d-inner">
                                <h4>24/7 road assistance</h4>
                                Reliable support when you need it most, keeping you on the
                                move with confidence and peace of mind.
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <img src="{{ asset('images/misc/bike.png')}}" alt="" class="img-fluid wow fadeInUp"/>
                    </div>

                    <div class="col-lg-3">
                        <div class="box-icon s2 d-invert p-small mb20 wow fadeInL fadeInLeft" data-wow-delay="1s">
                            <i class="fa bg-color fa-tag"></i>
                            <div class="d-inner">
                                <h4>Quality at Minimum Expense</h4>
                                Unlocking affordable brilliance with elevating quality while
                                minimizing costs for maximum value.
                            </div>
                        </div>
                        <div class="box-icon s2 d-invert p-small mb20 wow fadeInL fadeInLeft" data-wow-delay="1.25s">
                            <i class="fa bg-color fa-map-pin"></i>
                            <div class="d-inner">
                                <h4>Free Pick-Up & Drop-Off</h4>
                                Enjoy free pickup and drop-off services within 10km, adding an extra
                                layer of ease to your car rental experience.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="text-light jarallax" aria-label="section">
            <img src="{{asset('images/background/16.jpg')}}" alt="" class="jarallax-img"/>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <h1>Let's Your Adventure Begin</h1>
                        <div class="spacer-20"></div>
                    </div>
                    <div class="col-md-3">
                        <i class="fa fa-trophy de-icon mb20"></i>
                        <h4>First Class Services</h4>
                        <p>
                            Where luxury meets exceptional care, creating unforgettable
                            moments and exceeding your every expectation.
                        </p>
                    </div>
                    <div class="col-md-3">
                        <i class="fa fa-road de-icon mb20"></i>
                        <h4>24/7 road assistance</h4>
                        <p>
                            Reliable support when you need it most, keeping you on the
                            move with confidence and peace of mind.
                        </p>
                    </div>
                    <div class="col-md-3">
                        <i class="fa fa-map-pin de-icon mb20"></i>
                        <h4>Free Pick-Up & Drop-Off</h4>
                        <p>
                            Enjoy free pickup and drop-off services, adding an extra layer
                            of ease to your car rental experience.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('addon-script')
    <script async src="https://maps.google.com/maps/api/js?key=AIzaSyBzmaIUkgLYiiWK_0tbyqbx31ZsmyA0uoY&callback=initMap&libraries=places,maps,marker&v=weekly"></script>
    <script>
        $(document).ready(function () {
            $('#autocomplete_pickup').hide();
            $('#pickupAddressLabel').hide();
            $('#returnAddressLabel').hide();
            $('#mapLabel').hide();
            $('#map').hide();
            $('#infowindow-content').hide();
            $('#autocomplete_return').hide();
            $('#pickup_location_type').on('change', function () {
                if (document.getElementById("pickup_location_type").value === 'office') {
                    $('#pickupAddressLabel').hide();
                    $('#returnAddressLabel').hide();
                    $('#autocomplete_pickup').val('Batur Sari Rental, Gang Beji, Seminyak, Badung Regency, Bali, Indonesia').hide();
                    $('#autocomplete_return').val('Batur Sari Rental, Gang Beji, Seminyak, Badung Regency, Bali, Indonesia').hide();
                    $('#latitude_pickup').val(-8.6836849);
                    $('#longitude_pickup').val(115.1631064);
                    $('#latitude_return').val(-8.6836849);
                    $('#longitude_return').val(115.1631064);
                    $('#mapLabel').hide();
                    $('#map').hide();
                    $('#infowindow-content').hide();
                    $('#return_location_type').val('office');
                } else if (document.getElementById("pickup_location_type").value === 'hotel_villa') {
                    $('#pickupAddressLabel').show();
                    $('#returnAddressLabel').show();
                    $('#autocomplete_pickup').val('').show();
                    $('#autocomplete_return').val('').show();
                    $('#latitude_pickup').val('');
                    $('#longitude_pickup').val('');
                    $('#latitude_return').val('');
                    $('#longitude_return').val('');
                    $('#mapLabel').hide();
                    $('#map').hide();
                    $('#infowindow-content').hide();
                    $('#return_location_type').val('hotel_villa');
                } else if (document.getElementById("pickup_location_type").value === 'custom_address') {
                    $('#pickupAddressLabel').hide();
                    $('#returnAddressLabel').hide();
                    $('#autocomplete_pickup').val('').hide();
                    $('#autocomplete_return').val('').hide();
                    $('#infowindow-content-pickup').show();
                    $('#infowindow-content-return').show();
                    $('#latitude_pickup').val('');
                    $('#longitude_pickup').val('');
                    $('#latitude_return').val('');
                    $('#longitude_return').val('');
                    $('#mapLabel').show();
                    $('#map').show();
                    $('#infowindow-content').show();
                    $('#return_location_type').val('custom_address');
                }
            });
            $('#return_location_type').on('change', function () {
                if (document.getElementById("return_location_type").value === 'office') {
                    $('#returnAddressLabel').hide();
                    $('#autocomplete_return').val('Batur Sari Rental, Gang Beji, Seminyak, Badung Regency, Bali, Indonesia').hide();
                    $('#latitude_return').val(-8.6836849);
                    $('#longitude_return').val(115.1631064);
                    $('#mapLabel').hide();
                    $('#map').hide();
                    $('#infowindow-content').hide();
                } else if (document.getElementById("return_location_type").value === 'hotel_villa') {
                    if (document.getElementById("pickup_location_type").value === 'custom_address') {
                        $('#pickupAddressLabel').show();
                        $('#autocomplete_pickup').val('').show();
                        $('#latitude_pickup').val('');
                        $('#longitude_pickup').val('');
                        $('#pickup_location_type').val('hotel_villa');
                    }
                    $('#returnAddressLabel').show();
                    $('#autocomplete_return').val('').show();
                    $('#latitude_return').val('');
                    $('#longitude_return').val('');
                    $('#mapLabel').hide();
                    $('#map').hide();
                    $('#infowindow-content').hide();
                } else if (document.getElementById("return_location_type").value === 'custom_address') {
                    $('#pickupAddressLabel').hide();
                    $('#returnAddressLabel').hide();
                    $('#autocomplete_pickup').val('').hide();
                    $('#autocomplete_return').val('').hide();
                    $('#latitude_return').val('');
                    $('#longitude_return').val('');
                    $('#mapLabel').show();
                    $('#map').show();
                    $('#infowindow-content').show();
                    $('#pickup_location_type').val('custom_address');
                }
            });
        });

        function initMap() {
            var map = new google.maps.Map(document.getElementById("map"), {
                center: {lat: -8.6836849, lng: 115.1631064},
                zoom: 13
            });

            let input_pickup = document.getElementById("autocomplete_pickup");
            let input_return = document.getElementById("autocomplete_return");

            let autocomplete_pickup = new google.maps.places.Autocomplete(input_pickup);
            let autocomplete_return = new google.maps.places.Autocomplete(input_return);

            autocomplete_pickup.bindTo("bounds", map);

            let infowindow = new google.maps.InfoWindow();
            let infowindowContent = document.getElementById("infowindow-content");

            infowindow.setContent(infowindowContent);

            let marker = new google.maps.Marker({
                map,
                position: {lat: -8.6836849, lng: 115.1631064},
                anchorPoint: new google.maps.Point(0, -29)
            });
            marker.setVisible(true);
            marker.setDraggable(true);

            autocomplete_pickup.addListener("place_changed", () => {
                infowindow.close();
                marker.setVisible(false);

                let place = autocomplete_pickup.getPlace();

                if (!place.geometry || !place.geometry.location) {
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }

                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
                infowindowContent.children["place-name"].textContent = place.name;
                infowindowContent.children["place-address"].textContent = place.formatted_address;
                infowindow.open(map, marker);
                $('#latitude_pickup').val(place.geometry['location'].lat());
                $('#longitude_pickup').val(place.geometry['location'].lng());
                $('#latitude_return').val(place.geometry['location'].lat());
                $('#longitude_return').val(place.geometry['location'].lng());
                input_return.value = input_pickup.value;
            });

            autocomplete_return.addListener("place_changed", () => {
                let place = autocomplete_return.getPlace();
                $('#latitude_return').val(place.geometry['location'].lat());
                $('#longitude_return').val(place.geometry['location'].lng());

            });
            marker.addListener('dragend', () => {
                infowindow.close();
                const latLang = marker.getPosition();
                infowindowContent.children["place-name"].textContent = latLang;
                infowindowContent.children["place-address"].textContent = '';
                infowindow.open(map, marker);
                input_pickup.value = '';
                input_return.value = '';
                $('#latitude_pickup').val(latLang.lat());
                $('#longitude_pickup').val(latLang.lng());
                $('#latitude_return').val(latLang.lat());
                $('#longitude_return').val(latLang.lng());
            });
        }

        initMap();
    </script>
    <script>
        var date = new Date().toISOString().slice(0, new Date().toISOString().lastIndexOf("T"));
        const localTime = date.toLocaleString();
        $("input[name='pick_up_date']").attr({
            "min": localTime
        });
    </script>
    <script>
        $("input[name='pick_up_date']").change(function () {
            let date = new Date($(this).val());
            date = date.setDate(date.getDate() + 1);
            date = new Date(date).toISOString().slice(0, new Date(date).toISOString().lastIndexOf("T"));
            $("input[name='return_date']").attr({
                "min": date,
                "value": date
            });
        })
        $("select[name='pick_up_time']").change(function () {
            let pickupTime = $("#pick_up_time").val();
            $("#return_time").val(pickupTime);
        })
    </script>
@endpush
