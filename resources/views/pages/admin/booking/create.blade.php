@extends('layouts.admin.master')
@section('title')
    Tambah Invoice Booking
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
                                        <label class="form-label" for="autocomplete_pickup">Lokasi Pengambilan</label>
                                        <input type="text" class="form-control" placeholder="Masukan Lokasi Pengambilan"
                                               id="autocomplete_pickup" name="pick_up_loc">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="pick_up_datetime">Tanggal dan Waktu Pengambilan</label>
                                        <input type="datetime-local" class="form-control" placeholder="Masukan Lokasi Pengambilan"
                                               id="pick_up_datetime" name="pick_up_datetime">
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
                                        <label class="form-label" for="autocomplete_return">Lokasi Pengembalian</label>
                                        <input type="text" class="form-control" placeholder="Masukan Lokasi Pengembalian"
                                               id="autocomplete_return" name="return_loc">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="return_datetime">Tanggal dan Waktu Pengembalian</label>
                                        <input type="datetime-local" class="form-control" placeholder="Masukan Lokasi Pengambilan"
                                               id="return_datetime" name="return_datetime">
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
                                            <input type="text" class="form-control" placeholder="Masukan Nama Depan"
                                                   id="first_name" name="first_name">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="no_hp_wa">No. HP/WA</label>
                                            <input type="tel" class="form-control" placeholder="Masukan No. HP/WA"
                                                   id="no_hp_wa" name="no_hp_wa">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="instagram">Akun Instagram</label>
                                            <input type="text" class="form-control" placeholder="Masukan Instagram"
                                                   id="instagram" name="instagram">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="country">Asal Negara</label>
                                            <input type="text" class="form-control" placeholder="Masukan Asal Negara"
                                                   id="country" name="country">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="hotel_booking_name">Nama di Booking Hotel</label>
                                            <input type="text" class="form-control" placeholder="Masukan Nama di Booking Hotel"
                                                   id="hotel_booking_name" name="hotel_booking_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 ms-lg-auto">
                                    <div class="mt-5 mt-lg-4 mt-xl-0">
                                        <div class="mb-3">
                                            <label class="form-label" for="last_name">Nama Belakang</label>
                                            <input type="text" class="form-control" placeholder="Masukan Nama Belakang"
                                                   id="last_name" name="last_name">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" class="form-control" placeholder="Masukan Email"
                                                   id="email" name="email">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="facebook">Akun Facebook</label>
                                            <input type="text" class="form-control" placeholder="Masukan Akun Facebook"
                                                   id="facebook" name="facebook">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="home_address">Alamat Asal</label>
                                            <input type="text" class="form-control" placeholder="Masukan Alamat Asal"
                                                   id="home_address" name="home_address">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="room_number">Nomor Kamar</label>
                                            <input type="text" class="form-control" placeholder="Masukan Nomor Kamar"
                                                   id="room_number" name="room_number">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="note">Booking Note</label>
                                    <textarea class="form-control"
                                              id="note" name="note"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i>
                                Kendaraan Booking</h5>
                            <div class="mt-4 mb-3">
                                <label class="form-label" for="vehicle_id">Pilih Kendaraan yang Dibooking</label>
                                <select class="form-select" name="vehicle_id" id="vehicle_id">
                                    <option>Pilih Kendaraan</option>
                                    @foreach($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mt-4 mt-xl-0">
                                        <div class="mb-3">
                                            <label class="form-label" for="vehicle_license_plate">Plat Kendaraan</label>
                                            <input type="text" class="form-control" placeholder="Masukan PLat Kendaraan"
                                                   id="vehicle_license_plate" name="vehicle_license_plate">
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label" >Fitur Booking</label>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check form-check-inline mb-3">
                                                    <input class="form-check-input" type="checkbox" value="include" id="insurance" name="insurance">
                                                    <label class="form-check-label" for="insurance">
                                                        Asuransi
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" value="include" id="first_aid_kit" name="first_aid_kit">
                                                    <label class="form-check-label" for="first_aid_kit">
                                                        First Aid Kit
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" value="include" id="phone_holder" name="phone_holder">
                                                    <label class="form-check-label" for="phone_holder">
                                                        Phone Holder
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" value="include" id="raincoat" name="raincoat">
                                                    <label class="form-check-label" for="raincoat">
                                                        Jas Hujan
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 ms-lg-auto">
                                    <div class="mt-5 mt-lg-4 mt-xl-0">
                                        <div class="mb-3">
                                            <label class="form-label" for="start_km_vehicle">Start KM Kendaraan</label>
                                            <input type="number" class="form-control" placeholder="Masukan Jumlah Awal KM Kendaraan"
                                                   id="start_km_vehicle" name="start_km_vehicle">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="helmet">Helm</label>
                                            <input type="number" class="form-control" placeholder="Masukan Jumlah Helm"
                                                   id="helmet" name="helmet" min="1" max="2">
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
@endsection
