@extends('layouts.app')

@section('title')
    Booking | Batur Sari Rental Bali
@endsection

@section('content')
    <!-- content begin -->
    <div class="no-bottom space-top" id="content">
        <div id="top"></div>

        <!-- section begin -->
        <section id="subheader" class="jarallax text-light">
            <img src="images/background/16.jpg" class="jarallax-img" alt="">
            <div class="center-y relative text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>Booking</h1>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->

        <section id="section-hero" aria-label="section" class="no-top mt-80 sm-mt-0">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-lg-12">
                        <div class="spacer-single sm-hide"></div>
                        <div class="p-4 rounded-3 shadow-soft" data-bgcolor="#ffffff">
                            <form name="contactForm" id="contact_form" action="{{ route('home.post') }}" method="POST">
                                @csrf
                                <div id="step-1" class="row">
                                    <div class="col-lg-6 mb30">
                                        <h5>What is your vehicle type?</h5>

                                        <div class="de_form de_radio row g-3">
                                            @foreach($vehicleTypes as $vehicleType)
                                                <div class="radio-img col-6 col-sm-4">
                                                    <input
                                                        id="{{ $vehicleType->id }}"
                                                        name="vehicle_type_id"
                                                        type="radio"
                                                        value="{{ $vehicleType->id }}"
                                                        required
                                                    />
                                                    <label for="{{ $vehicleType->id }}"
                                                    ><img
                                                            src="{{ Storage::url($vehicleType->icon) }}"
                                                            alt=""
                                                            height="40px"
                                                        />{{ $vehicleType->vehicle_type_name }}</label
                                                    >
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6 mb20">
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

                                            <div class="col-lg-6 mb20">
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

                                            <div class="col-lg-6 mb20">
                                                <h5>Pick Up Date & time</h5>
                                                <input
                                                    type="datetime-local"
                                                    class="form-control"
                                                    id="pick_up_datetime"
                                                    name="pick_up_datetime"
                                                    value="{{ old('pick_up_datetime') }}"
                                                    required
                                                />
                                            </div>
                                            <div class="col-lg-6 mb20">
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
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <input
                                            type="submit"
                                            id="send_message"
                                            value="Find a Vehicle"
                                            class="btn-main pull-right"
                                        />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="spacer-single"></div>

                <div class="row">

                    <div class="col-md-3 wow fadeInRight" data-wow-delay=".2s" >
                        <div class="feature-box style-4 text-center">
                            <a href="#"><i class="bg-color text-light i-boxed fa fa-car"></i></a>
                            <div class="text">
                                <a href="#"><h4>Choose a vehicle</h4></a>
                                Unlock unparalleled adventures and memorable journeys with our vast fleet of vehicles tailored to suit every need, taste, and destination.
                            </div>
                            <span class="wm">1</span>
                        </div>
                    </div>

                    <div class="col-md-3 wow fadeInRight" data-wow-delay=".4s" >
                        <div class="feature-box style-4 text-center">
                            <a href="#"><i class="bg-color text-light i-boxed fa fa-calendar"></i></a>
                            <div class="text">
                                <a href="#"><h4>Pick location &amp; date</h4></a>
                                Pick your ideal location and date, and let us take you on a journey filled with convenience, flexibility, and unforgettable experiences.
                            </div>
                            <span class="wm">2</span>
                        </div>
                    </div>

                    <div class="col-md-3 wow fadeInRight" data-wow-delay=".6s" >
                        <div class="feature-box style-4 text-center">
                            <a href="#"><i class="bg-color text-light i-boxed fa fa-pencil-square-o"></i></a>
                            <div class="text">
                                <a href="#"><h4>Make a booking</h4></a>
                                Secure your reservation with ease, unlocking a world of possibilities and embarking on your next adventure with confidence.
                            </div>
                            <span class="wm">3</span>
                        </div>
                    </div>

                    <div class="col-md-3 wow fadeInRight" data-wow-delay=".6s" >
                        <div class="feature-box style-4 text-center">
                            <a href="#"><i class="bg-color text-light i-boxed fa fa-smile-o"></i></a>
                            <div class="text">
                                <a href="#"><h4>Sit back & relax</h4></a>
                                Hassle-free convenience as we take care of every detail, allowing you to unwind and embrace a journey filled comfort.
                            </div>
                            <span class="wm">3</span>
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

            autocomplete_pickup.addListener('place_changed', function() {
                var place = autocomplete_pickup.getPlace();
                $('#latitude_pickup').val(place.geometry['location'].lat());
                $('#longitude_pickup').val(place.geometry['location'].lng());
            });
            autocomplete_return.addListener('place_changed', function() {
                var place = autocomplete_return.getPlace();
                $('#latitude_return').val(place.geometry['location'].lat());
                $('#longitude_return').val(place.geometry['location'].lng());
            });
        }
    </script>
    <script>
        var date = new Date().toISOString().slice(0,new Date().toISOString().lastIndexOf(":"));
        const localTime = date.toLocaleString();
        $("input[name='pick_up_datetime']").attr({
            "min" : localTime
        });
    </script>
    <script>
        $("input[name='pick_up_datetime']").change(function() {
            var date = new Date($(this).val());
            var date = date.setDate(date.getDate()+1);
            var date = new Date(date).toISOString().slice(0,new Date(date).toISOString().lastIndexOf(":"));
            $("input[name='return_datetime']").attr({
                "min" : date
            });
        })
    </script>
@endpush
