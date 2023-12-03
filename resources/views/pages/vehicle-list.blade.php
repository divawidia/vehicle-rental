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
                            <form action="{{ route('vehicle-list') }}" method="get">
                                <div class="item_filter_group">
                                    <h4>Vehicle Type</h4>
                                    <div class="de_form">
                                        @foreach($vehicleTypes as $vehicleType)
                                                <div class="de_checkbox">
                                                    <input
                                                        id="{{ $vehicleType->id }}"
                                                        name="vehicle_type_id[]"
                                                        type="checkbox"
                                                        value="{{ $vehicleType->id }}"
                                                        {{ in_array($vehicleType->id, $previousData['vehicle_type_id'])  ? 'checked' : '' }}
                                                    />
                                                    <label for="{{ $vehicleType->id }}">{{ $vehicleType->vehicle_type_name }}</label>
                                                </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="item_filter_group">
                                    <h4>Transmission Type</h4>
                                    <div class="de_form">
                                        @foreach($transmissions as $transmission)
                                            <div class="de_checkbox">
                                                <input
                                                    id="{{ $transmission->id }}"
                                                    name="transmission_id[]"
                                                    type="checkbox"
                                                    value="{{ $transmission->id }}"
                                                    {{ in_array($transmission->id, $previousData['transmission_id']) ? 'checked' : '' }}
                                                />
                                                <label for="{{ $transmission->id }}">{{ $transmission->transmission_type }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="item_filter_group">
                                    <h4>Vehicle Brand</h4>
                                    <div class="de_form">
                                        @foreach($brands as $brand)
                                            <div class="de_checkbox">
                                                <input
                                                    id="{{ $brand->id }}"
                                                    name="brand_id[]"
                                                    type="checkbox"
                                                    value="{{ $brand->id }}"
                                                    {{ in_array($brand->id, $previousData['brand_id']) ? 'checked' : '' }}
                                                />
                                                <label for="{{ $brand->id }}">{{ $brand->brand_name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="item_filter_group">
                                    <h4>Engine Capacity (Cc)</h4>
                                    <div class="price-input">
                                        <div class="field">
                                            <span>Min</span>
                                            <input type="number" class="input-min" name="engine_capacity_min" value="{{ $previousData['engine_capacity_min'] }}" />
                                        </div>
                                        <div class="field">
                                            <span>Max</span>
                                            <input type="number" class="input-max" name="engine_capacity_max" value="{{ $previousData['engine_capacity_max'] }}" />
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
                                            value="{{ $previousData['engine_capacity_min'] }}"
                                            step="1"
                                            name="engine_capacity_min"
                                        />
                                        <input
                                            type="range"
                                            class="range-max"
                                            min="0"
                                            max="2000"
                                            value="{{ $previousData['engine_capacity_max'] }}"
                                            step="1"
                                            name="engine_capacity_max"
                                        />
                                    </div>
                                </div>
                                <div class="item_filter_group">
                                    <h4>Price per Day (Rp)</h4>
                                    <div class="price-input">
                                        <div class="field">
                                            <span>Min</span>
                                            <input type="number" class="input-min" name="daily_price_min" value="{{ $previousData['daily_price_min'] }}" />
                                        </div>
                                        <div class="field">
                                            <span>Max</span>
                                            <input type="number" class="input-max" name="daily_price_max" value="{{ $previousData['daily_price_max'] }}" />
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
                                            max="3000000"
                                            value="{{ $previousData['daily_price_min'] }}"
                                            step="1"
                                            name="daily_price_min"
                                        />
                                        <input
                                            type="range"
                                            class="range-max"
                                            min="0"
                                            max="3000000"
                                            value="{{ $previousData['daily_price_max'] }}"
                                            step="1"
                                            name="daily_price_max"

                                        />
                                    </div>
                                </div>
                                <div class="item_filter_group">
                                    <h4>Price per Month (Rp)</h4>
                                    <div class="price-input">
                                        <div class="field">
                                            <span>Min</span>
                                            <input type="number" class="input-min" name="monthly_price_min" value="{{ $previousData['monthly_price_min'] }}" />
                                        </div>
                                        <div class="field">
                                            <span>Max</span>
                                            <input type="number" class="input-max" name="monthly_price_max" value="{{ $previousData['monthly_price_max'] }}" />
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
                                            max="3000000"
                                            value="{{ $previousData['monthly_price_min'] }}"
                                            step="1"
                                            name="monthly_price_min"
                                        />
                                        <input
                                            type="range"
                                            class="range-max"
                                            min="0"
                                            max="3000000"
                                            value="{{ $previousData['monthly_price_max'] }}"
                                            step="1"
                                            name="monthly_price_max"
                                        />
                                    </div>
                                </div>
                                <input
                                    type="submit"
                                    id="send_message"
                                    value="Apply Filter"
                                    class="btn-main pull-right w-100"
                                />
                            </form>
                        </div>

                    <div class="col-lg-9">
                        <div class="row">
                            @if($vehicles->count() > 0)
                                @foreach($vehicles as $vehicle)
                                    <div class="col-xl-4 col-lg-6">
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
                            @else
                                <h2 class="text-center">No Vehicle Available :(</h2>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- content close -->
@endsection
