@extends('admin.layouts.master')
@section('title')
    Tambah Invoice Booking
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@19.2.16/build/css/intlTelInput.css">
@endsection
@section('page-title')
    Tambah Invoice Booking
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <form action="{{ route('bookings.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Tambah Invoice Booking Baru</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i>
                                    Booking Information</h5>
                                <div class="col-lg-6">
                                    <div class="mt-4 mt-xl-0">
                                        <div class="mb-3">
                                            <label class="form-label" for="autocomplete_pickup">Lokasi
                                                Pengambilan</label>
                                            <input type="text" class="form-control" placeholder="Masukan Lokasi Pengambilan"
                                                   id="autocomplete_pickup" name="pick_up_loc" required>
                                            @error('pick_up_loc')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="pick_up_datetime">Tanggal dan Waktu
                                                Pengambilan</label>
                                            <input type="datetime-local" class="form-control" required placeholder="Masukan Lokasi Pengambilan"
                                                   id="pick_up_datetime" name="pick_up_datetime">
                                            @error('pick_up_datetime')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group d-none" id="pickupLatitudeArea">
                                            <label>Latitude</label>
                                            <input type="text" id="latitude_pickup" name="latitude_pickup" class="form-control">
                                        </div>
                                        <div class="form-group d-none" id="pickupLongtitudeArea">
                                            <label>Longitude</label>
                                            <input type="text" name="longitude_pickup" id="longitude_pickup" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 ms-lg-auto">
                                    <div class="mt-5 mt-lg-4 mt-xl-0">
                                        <div class="mb-3">
                                            <label class="form-label" for="autocomplete_return">Lokasi
                                                Pengembalian</label>
                                            <input type="text" class="form-control" required placeholder="Masukan Lokasi Pengembalian"
                                                   id="autocomplete_return" name="return_loc">
                                            @error('return_loc')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="return_datetime">Tanggal dan Waktu
                                                Pengembalian</label>
                                            <input type="datetime-local" class="form-control" required placeholder="Masukan Tanggal dan Waktu Pengambilan"
                                                   id="return_datetime" name="return_datetime">
                                            @error('return_datetime')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
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
                            </div>

                            <div class="mt-4">
                                <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i>
                                    Customer Information</h5>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mt-4 mt-xl-0">
                                            <div class="mb-3">
                                                <label class="form-label" for="first_name">Nama Depan</label>
                                                <input type="text" class="form-control" required placeholder="Masukan Nama Depan"
                                                       id="first_name" name="first_name">
                                                @error('first_name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label" for="no_hp_wa">No. HP/Whatsapp</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="tel" class="form-control" required placeholder="Masukan No. HP/WA"
                                                               id="no_hp_wa" name="no_hp_wa">
                                                        @error('no_hp_wa')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="instagram">Akun Instagram</label>
                                                <input type="text" class="form-control" required placeholder="Masukan Instagram"
                                                       id="instagram" name="instagram">
                                                @error('instagram')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="country">Asal Negara</label>
                                                <select class="form-control" required data-placeholder="Masukan Asal Negara"
                                                        id="country" name="country"></select>
                                                @error('country')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="hotel_booking_name">Nama di Booking
                                                    Hotel</label>
                                                <input type="text" class="form-control" placeholder="Masukan Nama di Booking Hotel"
                                                       id="hotel_booking_name" name="hotel_booking_name">
                                                @error('hotel_booking_name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 ms-lg-auto">
                                        <div class="mt-5 mt-lg-4 mt-xl-0">
                                            <div class="mb-3">
                                                <label class="form-label" for="last_name">Nama Belakang</label>
                                                <input type="text" class="form-control" required placeholder="Masukan Nama Belakang"
                                                       id="last_name" name="last_name">
                                                @error('last_name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="email" class="form-control" required placeholder="Masukan Email"
                                                       id="email" name="email">
                                                @error('email')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="facebook">Akun Facebook</label>
                                                <input type="text" class="form-control" required placeholder="Masukan Akun Facebook"
                                                       id="facebook" name="facebook">
                                                @error('facebook')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="home_address">Alamat Asal</label>
                                                <input type="text" class="form-control" required placeholder="Masukan Alamat Asal"
                                                       id="home_address" name="home_address">
                                                @error('home_address')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="room_number">Nomor Kamar</label>
                                                <input type="text" class="form-control" placeholder="Masukan Nomor Kamar"
                                                       id="room_number" name="room_number">
                                                @error('room_number')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="note">Booking Note (Opsional)</label>
                                        <textarea class="form-control"
                                                  id="note" name="note"></textarea>
                                        @error('note')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i>
                                    Kendaraan Booking</h5>
                                <div class="mt-4 mb-3">
                                    <label class="form-label" for="vehicle_id">Pilih Kendaraan yang Dibooking</label>
                                    <select class="form-select" required name="vehicle_id" id="vehicle_id">
                                        <option>Pilih Kendaraan</option>
                                        @foreach($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('vehicle_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-4 mb-3">
                                    <label class="form-label" for="vehicle_detail_id">Pilih Plat Nomor Kendaraan</label>
                                    <select class="form-select" required name="vehicle_detail_id" id="vehicle_detail_id">
                                        <option>Pilih Plat Nomor Kendaraan</option>
                                    </select>
                                    @error('vehicle_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mt-4 mt-xl-0">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label">Fitur Booking</label>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check form-check-inline mb-3">
                                                        <input class="form-check-input" type="checkbox" value="include" id="insurance" name="insurance">
                                                        <label class="form-check-label" for="insurance">
                                                            Asuransi
                                                        </label>
                                                        @error('insurance')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" value="include" id="first_aid_kit" name="first_aid_kit">
                                                        <label class="form-check-label" for="first_aid_kit">
                                                            First Aid Kit
                                                        </label>
                                                        @error('first_aid_kit')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" value="include" id="phone_holder" name="phone_holder">
                                                        <label class="form-check-label" for="phone_holder">
                                                            Phone Holder
                                                        </label>
                                                        @error('phone_holder')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" value="include" id="raincoat" name="raincoat">
                                                        <label class="form-check-label" for="raincoat">
                                                            Jas Hujan
                                                        </label>
                                                        @error('raincoat')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <h5 class="font-size-14 mb-4">Metode Pembayaran</h5>
                                                <div class="form-check mb-3 form-check-inline">
                                                    <input class="form-check-input" value="COD" type="radio" name="transaction_type"
                                                           id="COD">
                                                    <label class="form-check-label" for="COD">
                                                        Cash
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" value="Transfer" type="radio" name="transaction_type"
                                                           id="Transfer">
                                                    <label class="form-check-label" for="Transfer">
                                                        Transfer
                                                    </label>
                                                </div>
                                                @error('transaction_type')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 ms-lg-auto">
                                        <div class="mt-5 mt-lg-4 mt-xl-0">
                                            <div class="mb-3">
                                                <label class="form-label" for="start_km_vehicle">Start KM
                                                    Kendaraan</label>
                                                <input type="number" class="form-control" placeholder="Masukan Jumlah Awal KM Kendaraan"
                                                       id="start_km_vehicle" name="start_km_vehicle">
                                                @error('start_km_vehicle')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="helmet">Helm</label>
                                                <input type="number" class="form-control" value="1"
                                                       id="helmet" name="helmet" min="1" max="2" required>
                                                @error('helmet')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary w-md">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    @endsection

    @section('scripts')
        <script>
            $("input[name='pick_up_datetime']").change(function () {
                var date = new Date($(this).val());
                var date = date.setDate(date.getDate() + 1);
                var date = new Date(date).toISOString().slice(0, new Date(date).toISOString().lastIndexOf(":"));
                $("input[name='return_datetime']").attr({
                    "min": date
                });
            })
        </script>
        <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@19.2.16/build/js/intlTelInput.min.js"></script>
        <script>
            const input = document.querySelector("#no_hp_wa");
            const countryData = window.intlTelInputGlobals.getCountryData();
            const addressDropdown = document.querySelector("#country");
            const output = document.querySelector("#output");

            const iti = window.intlTelInput(input, {
                initialCountry: "auto",
                geoIpLookup: callback => {
                    fetch("https://ipapi.co/json")
                        .then(res => res.json())
                        .then(data => callback(data.country_code))
                        .catch(() => callback("id"));
                },
                nationalMode: true,
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

            // listen to the telephone input for changes
            input.addEventListener('countrychange', () => {
                addressDropdown.value = iti.getSelectedCountryData().name;
            });

            // listen to the address dropdown for changes
            addressDropdown.addEventListener('change', () => {
                iti.setCountry(this.value);
            });
        </script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
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
            $(document).ready(function () {
                $('#vehicle_id').on('change', function () {
                    var vehicleId = this.value;
                    $("#vehicle_detail_id").html('');
                    $.ajax({
                        url: "{{ url()->route('fetch-vehicle-detail')}}",
                        type: "POST",
                        data: {
                            vehicle_id: vehicleId,
                            _token: '{{csrf_token()}}'
                        },
                        dataType: 'json',
                        success: function (result) {
                            $('#vehicle_detail_id').html('<option>Pilih plat nomor kendaraan</option>');
                            $.each(result.vehicleDetails, function (key, value) {
                                $("#vehicle_detail_id").append('<option value="' + value.id + '">' + value.plate_number + '</option>');
                            });
                        }
                    });
                });
            });
        </script>
@endsection
