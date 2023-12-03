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
            <div class="container pt-5">
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
                                            <div class="radio-img col-4 col-sm-4">
                                                <input
                                                    id="{{ $vehicleType->id }}"
                                                    name="vehicle_type_id"
                                                    type="radio"
                                                    value="{{ $vehicleType->id }}"
                                                    required
                                                />
                                                <label class="text-center px-0" for="{{ $vehicleType->id }}"
                                                ><img
                                                        src="{{ Storage::url($vehicleType->icon) }}"
                                                        alt=""
                                                        height="30px"
                                                    />{{ $vehicleType->vehicle_type_name }}</label
                                                >
                                            </div>
                                        @endforeach
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 px-3 mt-3">
                                        <h5>Delivery Location</h5>
                                        <select class="form-select" required name="pickup_location_type" id="pickup_location_type">
                                            <option selected disabled>Choose your desired location</option>
                                            <option value="office">Batur Sari Rental Office (Gg. Beji, Seminyak, Kuta)</option>
                                            <option value="hotel_villa">Hotel/Villa</option>
                                            <option value="custom_address">My own address (Pinpoint Map)</option>
                                        </select>
                                        <h5 id="pickupAddressLabel" class="mt-3">Address of my villa / hotel :</h5>
                                        <input
                                            type="text"
                                            name="pick_up_loc"
                                            placeholder="Enter delivery location"
                                            id="autocomplete_pickup"
                                            autocomplete="on"
                                            class="form-control"
                                            value="{{ old('pick_up_loc') }}"
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
                                    <div class="col-lg-6 px-3 mt-3">
                                        <h5>Return Location</h5>
                                        <select class="form-select" required name="return_location_type" id="return_location_type">
                                            <option selected disabled>Choose your desired location</option>
                                            <option value="office">Batur Sari Rental Office (Gg. Beji, Seminyak, Kuta)</option>
                                            <option value="hotel_villa">Hotel/Villa</option>
                                            <option value="custom_address">My Own Address (Pinpoint Map)</option>
                                        </select>
                                        <h5 id="returnAddressLabel" class="mt-3">Address of my villa / hotel :</h5>
                                        <input
                                            type="text"
                                            name="return_loc"
                                            placeholder="Enter return location"
                                            id="autocomplete_return"
                                            autocomplete="on"
                                            class="form-control"
                                            value="{{ old('return_loc') }}"
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
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div id="mapLabel">
                                            <h5 class="mt-4">Pinpoint my location (delivery & return):</h5>
                                            <p class="mt-n3">*Drag the marker point to set your location</p>
                                        </div>
                                        <div id="map" class="mt-3" style="height: 280px; border-radius:15px;"></div>
                                        <div id="infowindow-content">
                                            <span id="place-name" class="title"></span><br />
                                            <span id="place-address"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 my-3">
                                        <div class="row px-3">
                                            <div class="col-7 px-1">
                                                <h5>Delivery Date</h5>
                                                <input
                                                    type="date"
                                                    class="form-control"
                                                    id="pick_up_datetime"
                                                    name="pick_up_datetime"
                                                    value="{{ old('pick_up_datetime') }}"
                                                    required
                                                />
                                            </div>
                                            <div class="col-5 px-0">
                                                <h5>Delivery Time</h5>
                                                <input
                                                    type="time"
                                                    class="form-control"
                                                    id="pick_up_datetime"
                                                    name="pick_up_datetime"
                                                    value="{{ old('pick_up_datetime') }}"
                                                    required
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 my-3">
                                        <div class="row px-3">
                                            <div class="col-7 px-1">
                                                <h5>Return Date</h5>
                                                <input
                                                    type="date"
                                                    class="form-control"
                                                    id="return_datetime"
                                                    name="return_datetime"
                                                    value="{{ old('return_datetime') }}"
                                                    required
                                                />
                                            </div>
                                            <div class="col-5 px-0">
                                                <h5>Return Time</h5>
                                                <input
                                                    type="time"
                                                    class="form-control"
                                                    id="return_datetime"
                                                    name="return_datetime"
                                                    value="{{ old('return_datetime') }}"
                                                    required
                                                />
                                            </div>
                                        </div>
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
                            src="images/misc/Group-152.png"
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
                                            src="{{ Storage::url($vehicle->thumbnail) }}"
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
    <script async src="https://maps.google.com/maps/api/js?key=AIzaSyBzmaIUkgLYiiWK_0tbyqbx31ZsmyA0uoY&callback=initMap&libraries=places,maps,marker&v=weekly"
    >
    </script>
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
                if (document.getElementById("pickup_location_type").value === 'office'){
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
                } else if (document.getElementById("pickup_location_type").value === 'hotel_villa'){
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
                } else if (document.getElementById("pickup_location_type").value === 'custom_address'){
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
                if (document.getElementById("return_location_type").value === 'office'){
                    $('#returnAddressLabel').hide();
                    $('#autocomplete_return').val('Batur Sari Rental, Gang Beji, Seminyak, Badung Regency, Bali, Indonesia').hide();
                    $('#latitude_return').val(-8.6836849);
                    $('#longitude_return').val(115.1631064);
                    $('#mapLabel').hide();
                    $('#map').hide();
                    $('#infowindow-content').hide();
                } else if (document.getElementById("return_location_type").value === 'hotel_villa'){
                    if (document.getElementById("pickup_location_type").value === 'custom_address'){
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
                } else if (document.getElementById("return_location_type").value === 'custom_address'){
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
                center: { lat: -8.6836849, lng: 115.1631064 },
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
                position: { lat: -8.6836849, lng: 115.1631064 },
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
            marker.addListener('dragend', () =>{
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
