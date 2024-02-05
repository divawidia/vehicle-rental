@extends('layouts.app')

@section('title')
    Our Vehicle | Batur Sari Rental Bali
@endsection

@section('content')
    <!-- content begin -->
    <div class="no-bottom space-top zebra" id="content">
        <div id="top"></div>

        <!-- section begin -->
        <section id="subheader" class="jarallax text-light">
            <img src="/images/background/16.jpg" class="jarallax-img" alt="" />
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
{{--                                <img src="{{ Storage::url($vehicle->thumbnail) }}" alt="" />--}}
                                @foreach($vehicle->photos as $photo)
                                    <img src="{{ Storage::url($photo->photo_url) }}" alt="" />
                                @endforeach
                            </div>
                            <!-- <div class="item">
                                              <img src="images/car-single/2.jpg" alt="">
                                          </div>
                                          <div class="item">
                                              <img src="images/car-single/3.jpg" alt="">
                                          </div>
                                          <div class="item">
                                              <img src="images/car-single/4.jpg" alt="">
                                          </div> -->
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <h3>{{ $vehicle->vehicle_name }}</h3>
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
                    </div>

                    <div class="col-lg-3">
                        <div class="de-price text-center">
                            Daily
                            <h4>Rp. {{ number_format($vehicle->daily_price) }}</h4>
                        </div>
                        <div class="de-price text-center">
                            Monthly
                            <h4>Rp. {{ number_format($vehicle->monthly_price) }}</h4>
                        </div>
                        <div class="spacer-30"></div>
                        <div class="de-box mb25">
                            <form name="contactForm" id="contact_form" method="post">
                                <h4>Booking this Scooter</h4>

                                <div class="spacer-20"></div>

                                <div class="row">
                                    <div class="col-lg-12 mb20">
                                        <h5>Pick Up Location</h5>
                                        <input
                                            type="text"
                                            name="PickupLocation"
                                            onfocus="geolocate()"
                                            placeholder="Enter your pickup location"
                                            id="autocomplete"
                                            autocomplete="off"
                                            class="form-control"
                                        />

                                        <div
                                            class="jls-address-preview jls-address-preview--hidden"
                                        >
                                            <div class="jls-address-preview__header"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb20">
                                        <h5>Drop Off Location</h5>
                                        <input
                                            type="text"
                                            name="DropoffLocation"
                                            onfocus="geolocate()"
                                            placeholder="Enter your dropoff location"
                                            id="autocomplete2"
                                            autocomplete="off"
                                            class="form-control"
                                        />

                                        <div
                                            class="jls-address-preview jls-address-preview--hidden"
                                        >
                                            <div class="jls-address-preview__header"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb20">
                                        <h5>Pick Up Date & Time</h5>
                                        <div class="date-time-field">
                                            <input
                                                type="text"
                                                id="date-picker"
                                                name="Pick Up Date"
                                                value=""
                                            />
                                            <select name="Pick Up Time" id="pickup-time">
                                                <option selected disabled value="Select time">
                                                    Time
                                                </option>
                                                <option value="00:00">00:00</option>
                                                <option value="00:30">00:30</option>
                                                <option value="01:00">01:00</option>
                                                <option value="01:30">01:30</option>
                                                <option value="02:00">02:00</option>
                                                <option value="02:30">02:30</option>
                                                <option value="03:00">03:00</option>
                                                <option value="03:30">03:30</option>
                                                <option value="04:00">04:00</option>
                                                <option value="04:30">04:30</option>
                                                <option value="05:00">05:00</option>
                                                <option value="05:30">05:30</option>
                                                <option value="06:00">06:00</option>
                                                <option value="06:30">06:30</option>
                                                <option value="07:00">07:00</option>
                                                <option value="07:30">07:30</option>
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
                                                <option value="18:30">18:30</option>
                                                <option value="19:00">19:00</option>
                                                <option value="19:30">19:30</option>
                                                <option value="20:00">20:00</option>
                                                <option value="20:30">20:30</option>
                                                <option value="21:00">21:00</option>
                                                <option value="21:30">21:30</option>
                                                <option value="22:00">22:00</option>
                                                <option value="22:30">22:30</option>
                                                <option value="23:00">23:00</option>
                                                <option value="23:30">23:30</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb20">
                                        <h5>Return Date & Time</h5>
                                        <div class="date-time-field">
                                            <input
                                                type="text"
                                                id="date-picker-2"
                                                name="Collection Date"
                                                value=""
                                            />
                                            <select name="Collection Time" id="collection-time">
                                                <option selected disabled value="Select time">
                                                    Time
                                                </option>
                                                <option value="00:00">00:00</option>
                                                <option value="00:30">00:30</option>
                                                <option value="01:00">01:00</option>
                                                <option value="01:30">01:30</option>
                                                <option value="02:00">02:00</option>
                                                <option value="02:30">02:30</option>
                                                <option value="03:00">03:00</option>
                                                <option value="03:30">03:30</option>
                                                <option value="04:00">04:00</option>
                                                <option value="04:30">04:30</option>
                                                <option value="05:00">05:00</option>
                                                <option value="05:30">05:30</option>
                                                <option value="06:00">06:00</option>
                                                <option value="06:30">06:30</option>
                                                <option value="07:00">07:00</option>
                                                <option value="07:30">07:30</option>
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
                                                <option value="18:30">18:30</option>
                                                <option value="19:00">19:00</option>
                                                <option value="19:30">19:30</option>
                                                <option value="20:00">20:00</option>
                                                <option value="20:30">20:30</option>
                                                <option value="21:00">21:00</option>
                                                <option value="21:30">21:30</option>
                                                <option value="22:00">22:00</option>
                                                <option value="22:30">22:30</option>
                                                <option value="23:00">23:00</option>
                                                <option value="23:30">23:30</option>
                                            </select>
                                        </div>
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
