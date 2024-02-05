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
            <img src="images/background/16.jpg" class="jarallax-img" alt="" />
            <div class="center-y relative text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>Our Vehicles</h1>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->

        <section id="section-cars">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="item_filter_group">
                            <h4>Vehicle Type</h4>
                            <div class="de_form">
                                <div class="de_checkbox">
                                    <input
                                        id="vehicle_type_1"
                                        name="vehicle_type_1"
                                        type="checkbox"
                                        value="vehicle_type_1"
                                    />
                                    <label for="vehicle_type_1">Car</label>
                                </div>

                                <div class="de_checkbox">
                                    <input
                                        id="vehicle_type_2"
                                        name="vehicle_type_2"
                                        type="checkbox"
                                        value="vehicle_type_2"
                                    />
                                    <label for="vehicle_type_2">Motorbike</label>
                                </div>

                                <div class="de_checkbox">
                                    <input
                                        id="vehicle_type_3"
                                        name="vehicle_type_3"
                                        type="checkbox"
                                        value="vehicle_type_3"
                                    />
                                    <label for="vehicle_type_3">Scooter</label>
                                </div>
                            </div>
                        </div>

                        <div class="item_filter_group">
                            <h4>Transmission Type</h4>
                            <div class="de_form">
                                <div class="de_checkbox">
                                    <input
                                        id="car_body_type_1"
                                        name="car_body_type_1"
                                        type="checkbox"
                                        value="car_body_type_1"
                                    />
                                    <label for="car_body_type_1">Automatic</label>
                                </div>

                                <div class="de_checkbox">
                                    <input
                                        id="car_body_type_2"
                                        name="car_body_type_2"
                                        type="checkbox"
                                        value="car_body_type_2"
                                    />
                                    <label for="car_body_type_2">Manual</label>
                                </div>
                            </div>
                        </div>

                        <div class="item_filter_group">
                            <h4>Scooter & Motorbike Engine Capacity (cc)</h4>
                            <div class="de_form">
                                <div class="de_checkbox">
                                    <input
                                        id="car_engine_1"
                                        name="car_engine_1"
                                        type="checkbox"
                                        value="car_engine_1"
                                    />
                                    <label for="car_engine_1">100 - 150</label>
                                </div>

                                <div class="de_checkbox">
                                    <input
                                        id="car_engine_2"
                                        name="car_engine_2"
                                        type="checkbox"
                                        value="car_engine_2"
                                    />
                                    <label for="car_engine_2">150 - 200</label>
                                </div>

                                <div class="de_checkbox">
                                    <input
                                        id="car_engine_3"
                                        name="car_engine_3"
                                        type="checkbox"
                                        value="car_engine_3"
                                    />
                                    <label for="car_engine_3">200+</label>
                                </div>
                            </div>
                        </div>
                        <div class="item_filter_group">
                            <h4>Car Engine Capacity (cc)</h4>
                            <div class="de_form">
                                <div class="de_checkbox">
                                    <input
                                        id="car_engine_1"
                                        name="car_engine_1"
                                        type="checkbox"
                                        value="car_engine_1"
                                    />
                                    <label for="car_engine_1">100 - 150</label>
                                </div>

                                <div class="de_checkbox">
                                    <input
                                        id="car_engine_2"
                                        name="car_engine_2"
                                        type="checkbox"
                                        value="car_engine_2"
                                    />
                                    <label for="car_engine_2">1000 - 2000</label>
                                </div>

                                <div class="de_checkbox">
                                    <input
                                        id="car_engine_3"
                                        name="car_engine_3"
                                        type="checkbox"
                                        value="car_engine_3"
                                    />
                                    <label for="car_engine_3">2000+</label>
                                </div>
                            </div>
                        </div>

                        <div class="item_filter_group">
                            <h4>Price per Day (Rp)</h4>
                            <div class="price-input">
                                <div class="field">
                                    <span>Min</span>
                                    <input type="number" class="input-min" value="0" />
                                </div>
                                <div class="field">
                                    <span>Max</span>
                                    <input type="number" class="input-max" value="250000" />
                                </div>
                            </div>
                            <div class="slider">
                                <div class="progress"></div>
                            </div>
                            <div class="range-input">
                                <input
                                    type="range"
                                    class="range-min"
                                    min="0"
                                    max="2000"
                                    value="0"
                                    step="1"
                                />
                                <input
                                    type="range"
                                    class="range-max"
                                    min="0"
                                    max="2000"
                                    value="2000"
                                    step="1"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div class="row">
                            @foreach($vehicles as $vehicle)
                                <div class="col-xl-4 col-lg-6">
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
            </div>
        </section>
    </div>
    <!-- content close -->
@endsection
