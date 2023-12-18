@extends('client.layouts.app')

@section('title')
    Payment | Batur Sari Rental Bali
@endsection

@section('content')
    <!-- content begin -->
    <div class="no-bottom space-top zebra" id="content">
        <div id="top"></div>

        <!-- section begin -->
        <section id="subheader" class="jarallax text-light">
            <img src="/images/background/16.jpg" class="jarallax-img" alt="">
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
                            <h2 class="border-top pt-3 mb-2">Customer Information</h2>
                            <p class="mb-4 border-bottom-padding">*Please input your data</p>
                            <div class="row mb-3">

                                <div class="col-md-6">
                                    <div class="field-set">
                                        <label for="first_name">First Name:<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" placeholder="Input your first name"
                                               id="first_name" name="first_name" required>
                                        @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="field-set">
                                        <label>Last Name:<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" placeholder="Input your last name"
                                               id="last_name" name="last_name" required>
                                        @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="field-set">
                                        <label for="no_hp_wa">Mobile Number
                                            (Whatsapp):<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('no_hp_wa') is-invalid @enderror" required placeholder="eg +6283213123221"
                                               id="no_hp_wa" name="no_hp_wa">
                                        @error('no_hp_wa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="field-set">
                                        <label>Email Address:<span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Input your email address"
                                               id="email" name="email" required>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="field-set">
                                        <label>Instagram Username:</label>
                                        <input type="text" class="form-control @error('instagram') is-invalid @enderror" placeholder="Input your instagram username"
                                               id="instagram" name="instagram">
                                        @error('instagram')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="field-set">
                                        <label>Facebook Username:</label>
                                        <input type="text" class="form-control @error('facebook') is-invalid @enderror" placeholder="Input your facebook username"
                                               id="facebook" name="facebook">
                                        @error('facebook')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="field-set">
                                        <label>Telegram Username:</label>
                                        <input type="text" class="form-control @error('telegram') is-invalid @enderror" placeholder="Input your telegram username"
                                               id="telegram" name="telegram">
                                        @error('telegram')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="field-set">
                                        <label>Country:<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('country') is-invalid @enderror" placeholder="Input your country of origin"
                                               id="country" name="country" required>
                                        @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="field-set d-none">
                                        <input type="text" class="form-control" id="country_code" name="country_code" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="field-set">
                                        <label>Home Address:<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('home_address') is-invalid @enderror" placeholder="Input your home address"
                                               id="home_address" name="home_address" required>
                                        @error('home_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                @if($booking->pickup_location_type == 'hotel_villa' || $booking->return_location_type == 'hotel_villa')
                                    <div class="col-md-6">
                                        <div class="field-set">
                                            <label>Name on Hotel Reservation (optional):</label>
                                            <input type="text" class="form-control @error('hotel_booking_name') is-invalid @enderror" placeholder="Input your name on hotel booking"
                                                   id="hotel_booking_name" name="hotel_booking_name">
                                            @error('hotel_booking_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="field-set">
                                            <label>Room Number (optional):</label>
                                            <input type="text" class="form-control @error('room_number') is-invalid @enderror" placeholder="Input your room number"
                                                   id="room_number" name="room_number">
                                            @error('room_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                                <label>Booking Note (optional):</label>
                                <div class="col-12">
                                    <div class="field-set">
                                    <textarea class="form-control w-100 @error('note') is-invalid @enderror"
                                              id="note" name="note" rows="3"></textarea>
                                        @error('note')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h2 class="border-bottom-padding border-top pt-3 mb-2">Booking Summary</h2>
                            <div class="text-muted">
                                <h3 class="font-size-16 mt-3 mb-2">Delivery :</h3>
                                @php $pick_up_date = strtotime($booking->pick_up_datetime) @endphp
                                @php $pick_up_time = strtotime($booking->pick_up_time) @endphp
                                <p class="mb-0">{{ date('D, M d, Y',$pick_up_date) }}
                                    @ {{ date('g:i A',$pick_up_time) }}</p>
                                <p class="mb-0">{{ $booking->pick_up_loc }}</p>
                                <h3 class="font-size-16 mt-3 mb-2">Return :</h3>
                                @php $return_date = strtotime($booking->return_datetime) @endphp
                                @php $return_time = strtotime($booking->return_time) @endphp
                                <p class="mb-0">{{ date('D, M d, Y',$return_date) }}
                                    @ {{ date('g:i A',$return_time) }}</p>
                                <p class="mb-0">{{ $booking->return_loc }}</p>
                            </div>
                            <h3 class="text-truncate font-size-14 mt-3 mb-0">{{ $booking->vehicle->vehicle_name }}</h3>
                            <p class="text-muted mb-0">{{ $booking->vehicle->color }}, {{ $booking->vehicle->year }}</p>
                            <div class="col-6">
                                <h5 class="font-size-15 mt-3 mb-1">Total Days Rent:</h5>
                                <p class="text-muted mb-0">{{ $booking->total_days_rent }} Days</p>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap table-centered my-0">
                                    <thead>
                                    <tr>
                                        <th class="fw-bold p-0">Rate</th>
                                        <th class="fw-bold p-0">Price</th>
                                        <th class="fw-bold p-0">Total Rent</th>
                                        <th class="fw-bold p-0">Total</th>
                                    </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                    <tr>
                                        <td class="p-0">
                                            <div>
                                                <p class="text-muted mb-0">Daily</p>
                                            </div>
                                        </td>
                                        <td class="p-0">
                                            Rp. {{ number_format($booking->vehicle->daily_price ?? 0) }}</td>
                                        <td class="p-0">{{ $booking->day_rent }} Day</td>
                                        <td class="p-0">Rp. {{ number_format($booking->daily_rent_price ?? 0) }}</td>
                                    </tr>
                                    @if($booking->monthly_rent_price > 0)
                                        <tr>
                                            <td class="p-0">
                                                <div>
                                                    <p class="text-muted mb-0">Monthly</p>
                                                </div>
                                            </td>
                                            <td class="p-0">
                                                Rp. {{ number_format($booking->vehicle->monthly_price ?? 0) }}</td>
                                            <td class="p-0">{{ $booking->month_rent }} Month</td>
                                            <td class="text-end p-0">
                                                Rp. {{ number_format($booking->monthly_rent_price ?? 0) }}</td>
                                        </tr>
                                    @endif
                                    <tr class="py-0">
                                        <th scope="row" colspan="3" class="fw-bold p-0">Sub Total :</th>
                                        <td class="p-0"> Rp. {{ number_format($booking->booking_price ?? 0) }}</td>
                                    </tr>
                                    <!-- end tr -->
                                    @if($booking->insurance == 'include')
                                        <tr class="py-0">
                                            <th scope="row" colspan="3" class="border-0 text-end p-0 fw-bold">
                                                Insurance (25%) :
                                            </th>
                                            <td class="border-0 p-0">
                                                Rp. {{ number_format($booking->insurance_price) }}</td>
                                        </tr>
                                    @endif
                                    <!-- end tr -->
                                    @if($booking->first_aid_kit == 'include')
                                        <tr class="py-0">
                                            <th scope="row" colspan="3" class="border-0 text-end p-0 fw-bold">
                                                Accessory - First Aid Kit :
                                            </th>
                                            <td class="border-0 p-0"> Rp. 0</td>
                                        </tr>
                                    @endif
                                    <!-- end tr -->
                                    @if($booking->phone_holder == 'include')
                                        <tr>
                                            <th scope="row" colspan="3" class="border-0 text-end p-0 fw-bold">
                                                Accessory - Phone Holder :
                                            </th>
                                            <td class="border-0 p-0"> Rp. 0</td>
                                        </tr>
                                    @endif

                                    @if($booking->raincoat == 'include')
                                        <tr>
                                            <th scope="row" colspan="3" class="border-0 text-end p-0 fw-bold">
                                                Accessory - Raincoat :
                                            </th>
                                            <td class="border-0 p-0"> Rp. 0</td>
                                        </tr>
                                    @endif

                                    @if($booking->helmet > 0)
                                        <tr>
                                            <th scope="row" colspan="3" class="border-0 text-end p-0 fw-bold">
                                                Accessory - Helmet ({{ $booking->helmet }}pcs) :
                                            </th>
                                            <td class="border-0 p-0"> Rp. 0</td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <th scope="row" colspan="3" class="border-0 text-end p-0 fw-bold">
                                            Delivery Charge ({{ $booking->rounded_distance_pickup }} KM x Rp. 10.000) :
                                        </th>
                                        <td class="border-0 p-0"> Rp. {{ number_format($booking->shipping_price) }}</td>
                                    </tr>

                                    @if($booking->discount_price > 0)
                                        <tr class="py-0">
                                            <th scope="row" colspan="3" class="border-0 text-end p-0 fw-bold">
                                                Discount ({{ $booking->discount }}%) :
                                            </th>
                                            <td class="border-0 p-0"> -
                                                Rp. {{ number_format($booking->discount_price) }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th scope="row" colspan="3" class="border-0 p-0 fw-bold">
                                            <h4 class="m-0 text-end fw-semibold">Total :</h4></th>
                                        <td class="border-0 p-0">
                                            <h4 class="m-0 fw-semibold">
                                                Rp. {{ number_format($booking->total_price ?? 0) }}</h4>
                                        </td>
                                    </tr>
                                    <!-- end tr -->
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                            <h3 class="border-bottom-padding border-top pt-3 my-4">Please Select your Payment
                                Method<span class="text-danger">*</span></h3>
                            <div class="form-check mb-3 d-flex align-items-center">
                                <input class="form-check-input" value="COD" type="radio" name="transaction_type" id="COD" required>
                                {{--                                <div class="rounded border d-flex w-100 mx-2 px-2">--}}
                                <div class="row rounded border d-flex w-100 mx-2 p-3">
                                    <div class="col-6">
                                        <p class="mb-0">Cash on Delivery</p>
                                    </div>
                                    <div class="col-6">
                                        <img class="float-end" width="25px" src="/images/icons/cash.png">
                                    </div>
                                </div>
                                {{--                                    <div class="py-2"><p class="mb-0">Cash on Delivery  <img class="float-end" width="25px" src="/images/icons/cash.png"></p></div>--}}
                            </div>
                            <div class="form-check mb-3 d-flex align-items-center">
                                <input class="form-check-input" value="Transfer" type="radio" name="transaction_type" id="Transfer" required>
                                <div class="row rounded border d-flex align-items-center w-100 mx-2 p-3">
                                    <div class="col-6">
                                        <p class="mb-0">Bank Transfer</p>
                                    </div>
                                    <div class="col-6">
                                        <img class="float-end" width="170px" src="/images/icons/bank-logo2.png">
                                    </div>
                                </div>
                            </div>
                            @error('transaction_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="mt-5 d-flex justify-content-center">
                                <a class="btn-main color-2 mx-2" href="{{ url()->previous() }}">Back</a>
                                <input
                                    type="submit"
                                    id="send_message"
                                    value="Pay Now"
                                    class="btn-main"
                                />
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
        const input = document.querySelector("#no_hp_wa");
        const countryData = window.intlTelInputGlobals.getCountryData();
        const addressDropdown = document.querySelector("#country");
        const countryCodeInput = document.querySelector("#country_code");
        const output = document.querySelector("#output");

        const iti = window.intlTelInput(input, {
            nationalMode: true,
            initialCountry: "auto",
            geoIpLookup: callback => {
                fetch("https://ipapi.co/json")
                    .then(res => res.json())
                    .then(data => callback(data.country_code))
                    .catch(() => callback("id"));
            },
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@19.2.16/build/js/utils.js",
        });

        for (let i = 0; i < countryData.length; i++) {
            const country = countryData[i];
            const optionNode = document.createElement("option");
            optionNode.value = country.iso2;
            const textNode = document.createTextNode(country.name);
            optionNode.appendChild(textNode);
            addressDropdown.appendChild(optionNode);
        }

        const handleChange = () => {
            let text;
            if (input.value) {
                text = iti.isValidNumber()
                    ? "Valid number! Full international format: " + iti.getNumber()
                    : "Invalid number - please try again";
                input.value = iti.getNumber();
            } else {
                text = "Please enter a valid number below";
            }
            const textNode = document.createTextNode(text);
            output.innerHTML = "";
            output.appendChild(textNode);
        };
        // listen to "keyup", but also "change" to update when the user selects a country
        input.addEventListener('change', handleChange);
        input.addEventListener('keyup', handleChange);

        // set it's initial value
        addressDropdown.value = iti.getSelectedCountryData().name;
        countryCodeInput.value = iti.getSelectedCountryData().iso2;


        // listen to the telephone input for changes
        input.addEventListener('countrychange', () => {
            addressDropdown.value = iti.getSelectedCountryData().name;
            countryCodeInput.value = iti.getSelectedCountryData().iso2;
        });

        // listen to the address dropdown for changes
        addressDropdown.addEventListener('change', () => {
            iti.setCountry(this.value);
        });
        countryCodeInput.addEventListener('change', () => {
            iti.setCountry(this.value);
        });
    </script>

@endpush
