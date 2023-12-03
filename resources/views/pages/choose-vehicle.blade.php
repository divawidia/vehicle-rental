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
                            <h2 class="border-bottom-padding mb-4">Choose Your Vehicle</h2>
                            <div class="de_form de_radio row d-flex justify-content-center">
                                @foreach($vehicles as $vehicle)
                                    <div class="radio-img col-xl-4 col-lg-6">
                                        <div class="de-item mb30">
                                            <div class="d-img">
                                                {{--                                            {{ dd(Storage::url($vehicle->photos->first()->photo_url)) }}--}}
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
                                                            />{{ $vehicle->engine_capacity }}</span
                                                        >
                                                        <span class="d-atr">
                                                            <img
                                                                src="images/icons/transmission.svg"
                                                                alt=""
                                                            @php
                                                                $transmission = \App\Models\Transmission::findOrFail($vehicle->transmission_id)
                                                            @endphp
                                                            {{ $transmission->transmission_type }}
                                                        </span>
                                                        <span class="d-atr">
                                                            <img
                                                                src="images/icons/scooter.svg"
                                                                alt=""
                                                                height="25px"
                                                            />
                                                            @php
                                                                $vehicle_type = \App\Models\VehicleType::findOrFail($vehicle->vehicle_type_id)
                                                            @endphp
                                                            {{ $vehicle_type->vehicle_type_name }}
                                                        </span>
                                                    </div>
                                                    <div class="d-price">
                                                        <div class="row d-flex align-items-center">
                                                            <div class="col-6 mt-n2">
                                                                Daily rate from <span>Rp. {{ number_format($vehicle->daily_price) }}</span>
                                                            </div>
                                                            <div class="col-6">
                                                                <input
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

                            <h2 class="border-bottom-padding mb-4">Additional Features</h2>
                            <div class="row">
                                <div class="col-8 col-lg-3">
                                    <label class="form-check-label" for="insurance"><h3>Insurance</h3></label>
                                </div>
                                <div class="form-check col-2 pt-2">
                                    <input class="form-check-input mx-1" type="checkbox" value="include" id="insurance" name="insurance">
                                </div>

                            </div>
                            {{--                        <h4>@php $insurance_price = $rent_price * 25/100; @endphp</h4>--}}
                            <div class="border-bottom w-50 mb-2"></div>
                            <p>Insurance Covering Damage & Theft to the Motorcycle only 25% from total bike rent rate. With this insurance, you will be free from the risk If your motorcycle is stolen, gets damaged in an accident, or is otherwise engaged in an incident, you won't have to worry about paying hefty repair bills thanks to our motorcycle insurance. Regarding any repair or motorcycle repatriation costs beyond USD 95,- (excess/own risk), we have you completely covered.</p>

                            <div class="row">
                                <div class="col-8 col-lg-3">
                                    <h3>Helmet</h3>
                                </div>
                                <div class="col-4 col-lg-5">
                                    <div class="row">
                                        <div class="nice-number">
                                            <input class="form-control" name="helmet" id="helmet" min="1" max="2" value="1" type="number">
                                        </div>
{{--                                        <div class="input-group">--}}
{{--                                            <div class="col-1">--}}
{{--                                            <span class="input-group-btn">--}}
{{--                                                  <button type="button" class="btn btn-default btn-number p-2" disabled="disabled" data-type="minus" data-field="quant[1]">--}}
{{--                                                      <img src="/images/icons/minus.png" height="20px">--}}
{{--                                                  </button>--}}
{{--                                            </span>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-1">--}}
{{--                                                <input type="number" name="helmet" class="form-control input-number" value="1" min="1" max="2" style="border: 1px solid #dddddd">--}}
{{--                                            </div>--}}
{{--                                            <div class="col-1">--}}
{{--                                            <span class="input-group-btn">--}}
{{--                                                <button type="button" class="btn btn-default btn-number p-2" data-type="plus" data-field="quant[1]">--}}
{{--                                                    <img src="/images/icons/plus.png" height="20px">--}}
{{--                                                </button>--}}
{{--                                            </span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>

                            </div>
                            <h4>Free</h4>
                            <div class="border-bottom w-50 mb-2"></div>
                            <p>You will get free one or two helmet, Our helmet are already cleaned and sanitized, so you dont have to worry if you get stinky helmet</p>

                            <div class="row">
                                <div class="col-8 col-lg-3">
                                    <label class="form-check-label" for="first_aid_kit"><h3>First Aid Kit</h3></label>
                                </div>
                                <div class="form-check col-1 pt-2">
                                    <input class="form-check-input mx-1" type="checkbox" value="include" id="first_aid_kit" name="first_aid_kit">
                                </div>

                            </div>
                            <h4>Free</h4>
                            <div class="border-bottom w-50 mb-2"></div>
                            <p>High Quality International ISO approved First Aid Kit</p>

                            <div class="row">
                                <div class="col-8 col-lg-3">
                                    <label class="form-check-label" for="phone_holder"><h3>Phone Holder</h3></label>
                                </div>
                                <div class="form-check col-1 pt-2">
                                    <input class="form-check-input mx-1" type="checkbox" value="include" id="phone_holder" name="phone_holder">
                                </div>

                            </div>
                            <h4>Free</h4>
                            <div class="border-bottom w-50 mb-2"></div>
                            <p>With our smartphone holders, you may now travel the island with ease and reach your goal while carrying a fully charged phone!</p>

                            <div class="row">
                                <div class="col-8 col-lg-3">
                                    <label class="form-check-label" for="raincoat"><h3>Raincoat</h3></label>
                                </div>
                                <div class="form-check col-1 pt-2">
                                    <input class="form-check-input mx-1" type="checkbox" value="include" id="raincoat" name="raincoat">
                                </div>

                            </div>
                            <h4>Free</h4>
                            <div class="border-bottom w-50 mb-2"></div>
                            <p>You dont have to worry if you getting wet in the rainy season, we have raincoat to cover you from rain</p>

{{--                            <h2 class="border-bottom-padding mb-4">Customer Information</h2>--}}
{{--                            <div class="row">--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <div class="field-set">--}}
{{--                                        <label>First Name:</label>--}}
{{--                                        <input type="text" class="form-control" placeholder="Masukan Nama Depan"--}}
{{--                                               id="first_name" name="first_name">--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <div class="field-set">--}}
{{--                                        <label>Last Name:</label>--}}
{{--                                        <input type="text" class="form-control" placeholder="Masukan Nama Belakang"--}}
{{--                                               id="last_name" name="last_name">--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <div class="field-set">--}}
{{--                                        <label>Phone Number (Whatsapp):</label>--}}
{{--                                        <input type="tel" class="form-control" placeholder="Masukan No. HP/WA"--}}
{{--                                               id="no_hp_wa" name="no_hp_wa">--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <div class="field-set">--}}
{{--                                        <label>Email Address:</label>--}}
{{--                                        <input type="email" class="form-control" placeholder="Masukan Email"--}}
{{--                                               id="email" name="email">--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <div class="field-set">--}}
{{--                                        <label>Instagram Account:</label>--}}
{{--                                        <input type="text" class="form-control" placeholder="Masukan Instagram"--}}
{{--                                               id="instagram" name="instagram">--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <div class="field-set">--}}
{{--                                        <label>Facebook Account:</label>--}}
{{--                                        <input type="text" class="form-control" placeholder="Masukan Akun Facebook"--}}
{{--                                               id="facebook" name="facebook">--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <div class="field-set">--}}
{{--                                        <label>Home Address:</label>--}}
{{--                                        <input type="text" class="form-control" placeholder="Masukan Alamat Asal"--}}
{{--                                               id="home_address" name="home_address">--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <div class="field-set">--}}
{{--                                        <label>Country:</label>--}}
{{--                                        <input type="text" class="form-control" placeholder="Masukan Asal Negara"--}}
{{--                                               id="country" name="country">--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <div class="field-set">--}}
{{--                                        <label>Name on Hotel Booking:</label>--}}
{{--                                        <input type="text" class="form-control" placeholder="Masukan Nama di Booking Hotel"--}}
{{--                                               id="hotel_booking_name" name="hotel_booking_name">--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <div class="field-set">--}}
{{--                                        <label>Room Number:</label>--}}
{{--                                        <input type="text" class="form-control" placeholder="Masukan Nomor Kamar"--}}
{{--                                               id="room_number" name="room_number">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <label>Booking Note:</label>--}}
{{--                                <div class="col-12">--}}
{{--                                    <div class="field-set">--}}
{{--                                    <textarea  class="form-control w-100"--}}
{{--                                               id="note" name="note"></textarea>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            {{--                        <h2 class="border-bottom-padding mb-4">Summary</h2>--}}
                            {{--                        <h3>Delivery/Pickup</h3>--}}
                            {{--                        <p>Sunday, Nov 26, 2023 @ 5:00 PM</p>--}}
                            {{--                        <p>Location: hotel vila lumbung, jalan raya petitenget, no. 1000 x petitenget bali, tua, marga, tabanan regency, bali 82191, indonesia</p>--}}

                            {{--                        <h3>Return/Collection</h3>--}}
                            {{--                        <p>Sunday, Nov 29, 2023 @ 5:00 PM</p>--}}
                            {{--                        <p>Location: hotel vila lumbung, jalan raya petitenget, no. 1000 x petitenget bali, tua, marga, tabanan regency, bali 82191, indonesia</p>--}}

                            {{--                        <h3>Yamaha NMAX 150</h3>--}}
                            {{--                        <div class="row">--}}
                            {{--                            <div class="col-4">--}}
                            {{--                                <p>3X Days :</p>--}}
                            {{--                                <p>Insurances :</p>--}}
                            {{--                                <p>Accessories - Helmet :</p>--}}
                            {{--                                <p>Accessories - First Aid Kit :</p>--}}
                            {{--                                <p>Accessories - Phone Holder :</p>--}}
                            {{--                                <p>Accessories - Raincoat :</p>--}}
                            {{--                                <p>Delivery Charge :</p>--}}
                            {{--                                <p>Collection Charge :</p>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="col-4">--}}
                            {{--                                <p>Rp. 450K</p>--}}
                            {{--                                <p>Rp. 112,5K</p>--}}
                            {{--                                <p>Rp. 0</p>--}}
                            {{--                                <p>Rp. 0</p>--}}
                            {{--                                <p>Rp. 0</p>--}}
                            {{--                                <p>Rp. 0</p>--}}
                            {{--                                <p>Rp. 50K</p>--}}
                            {{--                                <p>Rp. 50K</p>--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}
                            {{--                        <div class="border-bottom w-50 mb-2"></div>--}}
                            {{--                        <div class="row">--}}
                            {{--                            <div class="col-4">--}}
                            {{--                                <h3>Total :</h3>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="col-4">--}}
                            {{--                                <h3>Rp. 662,5K</h3>--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}
                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                <div class="btn-group mx-2" role="group" aria-label="First group">
                                    <a class="btn-main color-2 ml-5" href="{{ url()->previous() }}">Back</a>
                                </div>
                                <div class="btn-group" role="group" aria-label="First group">
                                    <input
                                        type="submit"
                                        id="send_message"
                                        value="Next to Payment"
                                        class="btn-main pull-right"
                                    />
                                </div>
                            </div>
                        </div>
                    </form>
                @else
                    <div class="row">
                        <h2 class="border-bottom-padding mb-4 text-center">Sorry, we dont have the vehicle you want :(</h2>
                    </div>
                @endif
            </div>
        </section>
    </div>
    <!-- content close -->
@endsection

@push('addon-script')
    <script src="/js/jquery.nice-number.js"></script>
    <script>
        $('#helmet').niceNumber();
    </script>

@endpush
