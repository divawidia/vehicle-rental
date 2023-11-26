@extends('layouts.admin.master')
@section('title')
    Tambah Kendaraan
@endsection
@section('page-title')
    Tambah Kendaraan
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <form action="{{ route('kendaraan.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Kendaraan</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="vehicle_name" class="col-md-2 col-form-label">Nama Kendaraan</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" autocomplete="off" name="vehicle_name" id="vehicle_name" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Thumbnail Kendaraan</label>
                                <div class="col-md-10">
                                    <input type="file" id="thumbnail" name="thumbnail" class="form-control" accept="image/*" required value="{{ old('thumbnail_photo') }}"/>
                                    <img id="preview" class="rounded img-thumbnail mt-3" src="{{ old('thumbnail') }}" alt="image thumbnail" style="display:none;"/>
                                    @error('thumbnail')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="description" class="col-md-2 col-form-label">Deskripsi Kendaraan</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" id="description" name="description" required></textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Jenis Kendaraan</label>
                                <div class="col-md-10">
                                    <select class="form-select" name="vehicle_type_id">
                                        <option selected>Pilih Jenis Kendaraan</option>
                                        @foreach($vehicleTypes as $vehicleType)
                                            <option value="{{ $vehicleType->id }}">{{ $vehicleType->vehicle_type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Transmisi Kendaraan</label>
                                <div class="col-md-10">
                                    <select class="form-select" name="transmission_id">
                                        <option selected>Pilih Transmisi Kendaraan</option>
                                        @foreach($transmissions as $transmission)
                                            <option value="{{ $transmission->id }}">{{ $transmission->transmission_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Merk Kendaraan</label>
                                <div class="col-md-10">
                                    <select class="form-select" name="brand_id">
                                        <option selected>Pilih Merk Kendaraan</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="features" class="col-md-2 col-form-label">Fitur Kendaraan</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" id="features" name="features"></textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="body" class="col-md-2 col-form-label">Bodi Kendaraan</label>
                                <div class="col-md-10">
                                    <input class="form-control" autocomplete="off" name="body" id="body">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="passenger" class="col-md-2 col-form-label">Jumlah Penumpang</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="number" autocomplete="off" name="passenger" id="passenger">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="fuel_capacity" class="col-md-2 col-form-label">Kapasitas Bensin</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <input class="form-control" type="number" autocomplete="off" name="fuel_capacity" id="fuel_capacity">
                                        <div class="input-group-text">Liter</div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="fuel_type" class="col-md-2 col-form-label">Jenis Bahan Bakar</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" autocomplete="off" name="fuel_type" id="fuel_type">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="engine_capacity" class="col-md-2 col-form-label">Kapasitas Mesin</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <input class="form-control" type="number" autocomplete="off" name="engine_capacity" id="engine_capacity">
                                        <div class="input-group-text">cc</div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="fuel_economy" class="col-md-2 col-form-label">Keiritan Bahan Bakar</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <input class="form-control" type="number" autocomplete="off" name="fuel_economy" id="fuel_economy">
                                        <div class="input-group-text">Km/L</div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="year" class="col-md-2 col-form-label">Tahun Kendaraan</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="number" autocomplete="off" name="year" id="year">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="color" class="col-md-2 col-form-label">Warna Kendaraan</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" autocomplete="off" name="color" id="color">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="daily_price" class="col-md-2 col-form-label">Harga Harian</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <div class="input-group-text">Rp.</div>
                                        <input class="form-control" type="number" autocomplete="off" name="daily_price" id="daily_price">
                                    </div>
                                </div>
                            </div>
{{--                            <div class="mb-3 row">--}}
{{--                                <label for="weekly_price" class="col-md-2 col-form-label">Harga Mingguan</label>--}}
{{--                                <div class="col-md-10">--}}
{{--                                    <div class="input-group">--}}
{{--                                        <div class="input-group-text">Rp.</div>--}}
{{--                                        <input class="form-control" type="number" autocomplete="off" name="weekly_price" id="weekly_price">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="mb-3 row">
                                <label for="monthly_price" class="col-md-2 col-form-label">Harga Bulanan</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <div class="input-group-text">Rp.</div>
                                        <input class="form-control" type="number" autocomplete="off" name="monthly_price" id="monthly_price">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="unit_quantity" class="col-md-2 col-form-label">Jumlah Unit Tersedia</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="number" autocomplete="off" name="unit_quantity" id="unit_quantity">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Thumbnail Kendaraan</label>
                                <div class="col-md-10">
                                    <input type="file" id="thumbnail" name="thumbnail" class="form-control" accept="image/*" required value="{{ old('thumbnail') }}"/>
                                    <img id="preview" class="rounded img-thumbnail mt-3" src="{{ old('thumbnail') }}" alt="image thumbnail" style="display:none;"/>
                                    @error('thumbnail')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
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
        <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor.create( document.querySelector( '#description' ),{
                ckfinder: {
                    uploadUrl: '{{route('blog-photo-upload', ['_token' => csrf_token()])}}'
                }
            })
                .catch( error => {
                    console.error( error );
                } );
        </script>
        <script>
            ClassicEditor.create( document.querySelector( '#features' ),{
                ckfinder: {
                    uploadUrl: '{{route('blog-photo-upload', ['_token' => csrf_token()])}}'
                }
            })
                .catch( error => {
                    console.error( error );
                } );
        </script>
@endsection
