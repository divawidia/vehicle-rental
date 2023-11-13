@extends('layouts.admin.master')
@section('title')
    Edit Kendaraan
@endsection
@section('page-title')
    Edit Kendaraan
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <form action="{{ route('kendaraan.update', $vehicle->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Data Kendaraan {{ $vehicle->vehicle_name }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="vehicle_name" class="col-md-2 col-form-label">Nama Kendaraan</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" autocomplete="off" name="vehicle_name" id="vehicle_name" value="{{ $vehicle->vehicle_name }}" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="description" class="col-md-2 col-form-label">Deskripsi Kendaraan</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" id="description" name="description" rows="4" required>{{ $vehicle->description }}</textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Jenis Kendaraan</label>
                                <div class="col-md-10">
                                    <select class="form-select" name="vehicle_type_id" required>
                                        <option value="{{ $vehicle->vehicle_type_id }}">{{ $vehicle->vehicle_type->vehicle_type_name }}</option>
                                        @foreach($vehicleTypes as $vehicleType)
                                            <option value="{{ $vehicleType->id }}">{{ $vehicleType->vehicle_type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Transmisi Kendaraan</label>
                                <div class="col-md-10">
                                    <select class="form-select" name="transmission_id" required>
                                        <option value="{{ $vehicle->transmission_id }}">{{ $vehicle->transmission->transmission_type }}</option>
                                        @foreach($transmissions as $transmission)
                                            <option value="{{ $transmission->id }}">{{ $transmission->transmission_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Merk Kendaraan</label>
                                <div class="col-md-10">
                                    <select class="form-select" name="brand_id" required>
                                        <option value="{{ $vehicle->brand_id }}">{{ $vehicle->brand->brand_name }}</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="features" class="col-md-2 col-form-label">Fitur Kendaraan</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" id="features" name="features" rows="4" required>{{ $vehicle->features }}</textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="body" class="col-md-2 col-form-label">Bodi Kendaraan</label>
                                <div class="col-md-10">
                                    <input class="form-control" autocomplete="off" name="body" id="body" value="{{ $vehicle->body }}" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="passenger" class="col-md-2 col-form-label">Jumlah Penumpang</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="number" autocomplete="off" name="passenger" id="passenger" value="{{ $vehicle->passenger }}" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="fuel_capacity" class="col-md-2 col-form-label">Kapasitas Bensin</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <input class="form-control" type="number" autocomplete="off" name="fuel_capacity" id="fuel_capacity" value="{{ $vehicle->fuel_capacity }}" required>
                                        <div class="input-group-text">Liter</div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="fuel_type" class="col-md-2 col-form-label">Jenis Bahan Bakar</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" autocomplete="off" name="fuel_type" id="fuel_type" value="{{ $vehicle->fuel_type }}" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="engine_capacity" class="col-md-2 col-form-label">Kapasitas Mesin</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <input class="form-control" type="number" autocomplete="off" name="engine_capacity" id="engine_capacity" value="{{ $vehicle->engine_capacity }}" required>
                                        <div class="input-group-text">cc</div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="fuel_economy" class="col-md-2 col-form-label">Keiritan Bahan Bakar</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <input class="form-control" type="number" autocomplete="off" name="fuel_economy" id="fuel_economy" value="{{ $vehicle->fuel_economy }}" required>
                                        <div class="input-group-text">Km/L</div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="year" class="col-md-2 col-form-label">Tahun Kendaraan</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="number" autocomplete="off" name="year" id="year" value="{{ $vehicle->year }}" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="color" class="col-md-2 col-form-label">Warna Kendaraan</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" autocomplete="off" name="color" id="color" value="{{ $vehicle->color }}" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="daily_price" class="col-md-2 col-form-label">Harga Harian</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <div class="input-group-text">Rp.</div>
                                        <input class="form-control" type="number" autocomplete="off" name="daily_price" id="daily_price" value="{{ $vehicle->daily_price }}" required>
                                    </div>
                                </div>
                            </div>
{{--                            <div class="mb-3 row">--}}
{{--                                <label for="weekly_price" class="col-md-2 col-form-label">Harga Mingguan</label>--}}
{{--                                <div class="col-md-10">--}}
{{--                                    <div class="input-group">--}}
{{--                                        <div class="input-group-text">Rp.</div>--}}
{{--                                        <input class="form-control" type="number" autocomplete="off" name="weekly_price" id="weekly_price" value="{{ $vehicle->weekly_price }}">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="mb-3 row">
                                <label for="monthly_price" class="col-md-2 col-form-label">Harga Bulanan</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <div class="input-group-text">Rp.</div>
                                        <input class="form-control" type="number" autocomplete="off" name="monthly_price" id="monthly_price" value="{{ $vehicle->monthly_price }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="unit_quantity" class="col-md-2 col-form-label">Jumlah Unit Tersedia</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="number" autocomplete="off" name="unit_quantity" id="unit_quantity" value="{{ $vehicle->unit_quantity }}" required>
                                </div>
                            </div>
                            <div class="mt-4 float-end">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary w-auto"><i class="fa fa-arrow-left"></i>  Kembali</a>
                                <button type="submit" class="btn btn-primary w-md">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($vehicle->photos as $photo)
                                <div class="col-md-4">
                                    <div class="gallery-container">
                                        <img
                                            src="{{ Storage::url($photo->photo_url ?? '') }}"
                                            alt=""
                                            class="w-100"
                                        />
                                        <a href="{{ route('vehicle-photo-delete', $photo->id) }}" class="delete-gallery">
                                            <img src="/images/icon-delete.svg" alt="" />
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-12">
                                <form action="{{ route('vehicle-photo-upload') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $vehicle->id }}" name="vehicle_id">
                                    <input
                                        type="file"
                                        name="photo_url"
                                        id="file"
                                        style="display: none;"
                                        multiple
                                        onchange="form.submit()"
                                    />
                                    <button
                                        type="button"
                                        class="btn btn-success btn-block mt-3 w-100"
                                        onclick="thisFileUpload()"
                                    >
                                        Tambah Foto Kendaraan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script>
            function thisFileUpload() {
                document.getElementById("file").click();
            }
        </script>
        <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('description');
        </script>
        <script>
            CKEDITOR.replace('features');
        </script>
@endsection
