@extends('layouts.app')

@section('title')
    Batur Sari Rental Bali  | Rent Scooter and Rent Car in Bali
@endsection

@push('addon-style')
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
@endpush

@section('content')
    <!-- content begin -->
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>
        <section
            id="section-hero"
            aria-label="section"
            class="full-height vertical-center"
        >
            <div class="container">
                <div class="row align-items-center">
                    <div class="spacer-double sm-hide"></div>
                    <div class="col-lg-7">
                        <div class="spacer-single sm-hide"></div>
                        <h2 class="mb-2" style="color: var(--primary-color)">
                            Looking for a <span class="id-color">vehicle</span>? Book now
                            your <span class="id-color">scooter</span> or
                            <span class="id-color">car</span> rental
                        </h2>
                        <div
                            class="p-4 rounded-5 shadow-soft border border-2"
                            data-bgcolor="#ffffff"
                        >
                            <form name="contactForm" id="contact_form" action="{{ route('home.post') }}" method="POST">
                                @csrf
                                <h5>What is your vehicle type?</h5>
                                <div class="de_form de_radio row g-3">
                                        @foreach($vehicleTypes as $vehicleType)
                                            <div class="radio-img col-6 col-sm-4">
                                                <input
                                                    id="{{ $vehicleType->id }}"
                                                    name="vehicle_type_id"
                                                    type="radio"
                                                    value="{{ $vehicleType->id }}"
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

                                <div class="spacer-20"></div>

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
                                        />
                                        <div class="form-group d-none" id="pickupLatitudeArea">
                                            <label>Latitude</label>
                                            <input type="text" id="latitude_pickup" name="latitude_pickup" class="form-control">
                                        </div>
                                        <div class="form-group d-none" id="pickupLongtitudeArea">
                                            <label>Longitude</label>
                                            <input type="text" name="longitude_pickup" id="longitude_pickup" class="form-control">
                                        </div>
{{--                                        <div--}}
{{--                                            class="jls-address-preview jls-address-preview--hidden"--}}
{{--                                        >--}}
{{--                                            <div class="jls-address-preview__header"></div>--}}
{{--                                        </div>--}}
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
                                                        value=""
                                                    />
                                    </div>
                                    <div class="col-lg-6 mb20">
                                                <h5>Drop Off Date & Time</h5>
                                                <input
                                                    type="datetime-local"
                                                    class="form-control"
                                                    id="return_datetime"
                                                    name="return_datetime"
                                                    value=""
                                                />
                                    </div>
                                </div>

                                <input
                                    type="submit"
                                    id="send_message"
                                    value="Find a Vehicle"
                                    class="btn-main pull-right"
                                />

                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <img
                            src="images/misc/Group-24-2.png"
                            class="img-fluid"
                            alt=""
                        />
                    </div>
                </div>
                <div class="spacer-double"></div>

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
                </div></div>
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
                                        <img
                                            src="{{ Storage::url($vehicle->photos->first()->photo_url) }}"
                                            class="img-fluid"
                                            alt=""
                                        />
                                    </div>
                                    <div class="d-info">
                                        <div class="d-text">
                                            <h4>{{ $vehicle->vehicle_name }}</h4>
                                            <!-- <div class="d-item_like">
                                              <i class="fa fa-heart"></i><span>74</span>
                                            </div> -->
                                            <div class="d-atr-group">
                                          <span class="d-atr"
                                          ><img src="images/icons/1.svg" alt="" />{{ $vehicle->passenger }}</span
                                          >
                                                <span class="d-atr"
                                                ><img
                                                        src="images/icons/engine.svg"
                                                        alt=""
                                                    />{{ $vehicle->engine_capacity }}cc</span
                                                >
                                                <span class="d-atr"
                                                ><img
                                                        src="images/icons/transmission.svg"
                                                        alt=""
                                                    />{{ $vehicle->transmission->transmission_type }}</span
                                                >
                                                <span class="d-atr"
                                                ><img
                                                        src="images/icons/scooter.svg"
                                                        alt=""
                                                        height="25px"
                                                    />{{ $vehicle->vehicle_type->vehicle_type_name }}</span
                                                >
                                            </div>
                                            <div class="d-price">
                                                Daily rate from <span>Rp. {{ number_format($vehicle->daily_price) }}</span>
                                                <a class="btn-main" href="{{ route('vehicle-detail', $vehicle->slug) }}"
                                                >Rent Now</a
                                                >
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

{{--        <section id="section-cars" class="no-top">--}}
{{--            <div class="container">--}}
{{--                <div class="row align-items-center">--}}
{{--                    <div class="col-lg-6 offset-lg-3 text-center">--}}
{{--                        <h2>Our Cars Fleet</h2>--}}
{{--                        <p>--}}
{{--                            Driving your dreams to reality with an exquisite fleet of--}}
{{--                            versatile vehicles for unforgettable journeys.--}}
{{--                        </p>--}}
{{--                        <div class="spacer-20"></div>--}}
{{--                    </div>--}}

{{--                    <div class="clearfix"></div>--}}

{{--                    <div id="items-carousel2" class="owl-carousel wow fadeIn">--}}
{{--                        <div class="col-lg-12">--}}
{{--                            <div class="de-item mb30">--}}
{{--                                <div class="d-img">--}}
{{--                                    <img--}}
{{--                                        src="images/cars/avanza.png"--}}
{{--                                        class="img-fluid"--}}
{{--                                        alt=""--}}
{{--                                    />--}}
{{--                                </div>--}}
{{--                                <div class="d-info">--}}
{{--                                    <div class="d-text">--}}
{{--                                        <h4>Toyota All New Avanza</h4>--}}
{{--                                        <div class="d-item_like">--}}
{{--                                            <i class="fa fa-heart"></i><span>74</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="d-atr-group">--}}
{{--                      <span class="d-atr"--}}
{{--                      ><img src="images/icons/1.svg" alt="" />7</span--}}
{{--                      >--}}
{{--                                            <span class="d-atr"--}}
{{--                                            ><img--}}
{{--                                                    src="images/icons/engine.svg"--}}
{{--                                                    alt=""--}}
{{--                                                />1500cc</span--}}
{{--                                            >--}}
{{--                                            <span class="d-atr"--}}
{{--                                            ><img--}}
{{--                                                    src="images/icons/transmission.svg"--}}
{{--                                                    alt=""--}}
{{--                                                />automatic</span--}}
{{--                                            >--}}
{{--                                            <span class="d-atr"--}}
{{--                                            ><img--}}
{{--                                                    src="images/icons/4.svg"--}}
{{--                                                    alt=""--}}
{{--                                                    height="25px"--}}
{{--                                                />MPV</span--}}
{{--                                            >--}}
{{--                                        </div>--}}
{{--                                        <div class="d-price">--}}
{{--                                            Daily rate from <span>Rp. 250K</span>--}}
{{--                                            <a class="btn-main" href="{{ route('vehicle-detail') }}"--}}
{{--                                            >Rent Now</a--}}
{{--                                            >--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="col-lg-12">--}}
{{--                            <div class="de-item mb30">--}}
{{--                                <div class="d-img">--}}
{{--                                    <img--}}
{{--                                        src="images/cars/agya.png"--}}
{{--                                        class="img-fluid"--}}
{{--                                        alt=""--}}
{{--                                    />--}}
{{--                                </div>--}}
{{--                                <div class="d-info">--}}
{{--                                    <div class="d-text">--}}
{{--                                        <h4>Toyota All New Agya</h4>--}}
{{--                                        <div class="d-item_like">--}}
{{--                                            <i class="fa fa-heart"></i><span>74</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="d-atr-group">--}}
{{--                      <span class="d-atr"--}}
{{--                      ><img src="images/icons/1.svg" alt="" />5</span--}}
{{--                      >--}}
{{--                                            <span class="d-atr"--}}
{{--                                            ><img--}}
{{--                                                    src="images/icons/engine.svg"--}}
{{--                                                    alt=""--}}
{{--                                                />1200cc</span--}}
{{--                                            >--}}
{{--                                            <span class="d-atr"--}}
{{--                                            ><img--}}
{{--                                                    src="images/icons/transmission.svg"--}}
{{--                                                    alt=""--}}
{{--                                                />automatic</span--}}
{{--                                            >--}}
{{--                                            <span class="d-atr"--}}
{{--                                            ><img--}}
{{--                                                    src="images/icons/4.svg"--}}
{{--                                                    alt=""--}}
{{--                                                    height="25px"--}}
{{--                                                />Hatchback</span--}}
{{--                                            >--}}
{{--                                        </div>--}}
{{--                                        <div class="d-price">--}}
{{--                                            Daily rate from <span>Rp. 200K</span>--}}
{{--                                            <a class="btn-main" href="{{ route('vehicle-detail') }}"--}}
{{--                                            >Rent Now</a--}}
{{--                                            >--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}

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
                        <div
                            class="box-icon s2 p-small mb20 wow fadeInRight"
                            data-wow-delay=".5s"
                        >
                            <i class="fa bg-color fa-trophy"></i>
                            <div class="d-inner">
                                <h4>First class services</h4>
                                Where luxury meets exceptional care, creating unforgettable
                                moments and exceeding your every expectation.
                            </div>
                        </div>
                        <div
                            class="box-icon s2 p-small mb20 wow fadeInL fadeInRight"
                            data-wow-delay=".75s"
                        >
                            <i class="fa bg-color fa-road"></i>
                            <div class="d-inner">
                                <h4>24/7 road assistance</h4>
                                Reliable support when you need it most, keeping you on the
                                move with confidence and peace of mind.
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <img
                            src="images/cars/nmax-no-bg.png"
                            alt=""
                            class="img-fluid wow fadeInUp"
                        />
                    </div>

                    <div class="col-lg-3">
                        <div
                            class="box-icon s2 d-invert p-small mb20 wow fadeInL fadeInLeft"
                            data-wow-delay="1s"
                        >
                            <i class="fa bg-color fa-tag"></i>
                            <div class="d-inner">
                                <h4>Quality at Minimum Expense</h4>
                                Unlocking affordable brilliance with elevating quality while
                                minimizing costs for maximum value.
                            </div>
                        </div>
                        <div
                            class="box-icon s2 d-invert p-small mb20 wow fadeInL fadeInLeft"
                            data-wow-delay="1.25s"
                        >
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
            <img src="images/background/16.jpg" alt="" class="jarallax-img" />
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

        <section id="section-testimonials">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="de-image-text">
                            <div class="d-text">
                                <div class="d-quote id-color">
                                    <i class="fa fa-quote-right"></i>
                                </div>
                                <h4>Excellent Service! Car Rent Service!</h4>
                                <blockquote>
                                    I have been using Rentaly for my Car Rental needs for over
                                    5 years now. I have never had any problems with their
                                    service. Their customer support is always responsive and
                                    helpful. I would recommend Rentaly to anyone looking for a
                                    reliable Car Rental provider.
                                    <span class="by">Stepanie Hutchkiss</span>
                                </blockquote>
                            </div>
                            <img
                                src="images/testimonial/1.jpg"
                                class="img-fluid"
                                alt=""
                            />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="de-image-text">
                            <div class="d-text">
                                <div class="d-quote id-color">
                                    <i class="fa fa-quote-right"></i>
                                </div>
                                <h4>Excellent Service! Car Rent Service!</h4>
                                <blockquote>
                                    We have been using Rentaly for our trips needs for several
                                    years now and have always been happy with their service.
                                    Their customer support is Excellent Service! and they are
                                    always available to help with any issues we have. Their
                                    prices are also very competitive.
                                    <span class="by">Jovan Reels</span>
                                </blockquote>
                            </div>
                            <img
                                src="images/testimonial/2.jpg"
                                class="img-fluid"
                                alt=""
                            />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="de-image-text">
                            <div class="d-text">
                                <div class="d-quote id-color">
                                    <i class="fa fa-quote-right"></i>
                                </div>
                                <h4>Excellent Service! Car Rent Service!</h4>
                                <blockquote>
                                    Endorsed by industry experts, Rentaly is the Car Rental
                                    solution you can trust. With years of experience in the
                                    field, we provide fast, reliable and secure Car Rental
                                    services.
                                    <span class="by">Kanesha Keyton</span>
                                </blockquote>
                            </div>
                            <img
                                src="images/testimonial/3.jpg"
                                class="img-fluid"
                                alt=""
                            />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
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
@endpush
