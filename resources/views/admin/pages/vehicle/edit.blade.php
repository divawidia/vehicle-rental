@extends('admin.layouts.master')
@section('title')
    Edit Kendaraan
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.0/dropzone.min.css">
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
                <form action="{{ route('kendaraan.update', ['kendaraan'=>$kendaraan]) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit {{ $kendaraan->vehicle_name }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="vehicle_name" class="col-md-2 col-form-label">Nama Kendaraan</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" autocomplete="off" name="vehicle_name" value="{{ $kendaraan->vehicle_name }}" id="vehicle_name" required>
                                    @error('vehicle_name')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Thumbnail Kendaraan</label>
                                <div class="col-md-10">
                                    <input type="file" id="thumbnail" name="thumbnail" class="form-control" accept="image/*"/>
                                    <img id="preview" class="rounded img-thumbnail mt-3" alt="image thumbnail" src="{{ Storage::url($kendaraan->thumbnail) }}" style="display:block;"/>
                                    @error('thumbnail')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="description" class="col-md-2 col-form-label">Deskripsi Kendaraan</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" id="description" name="description" required>{{ $kendaraan->description }}</textarea>
                                    @error('description')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Jenis Kendaraan</label>
                                <div class="col-md-10">
                                    <select class="form-select" name="vehicle_type_id" required>
                                        @foreach($vehicleTypes as $vehicleType)
                                            <option value="{{ $vehicleType->id }}" {{ $vehicleType->id == $kendaraan->vehicle_type_id ? 'selected' : '' }}>{{ $vehicleType->vehicle_type_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('vehicle_type_id')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Transmisi Kendaraan</label>
                                <div class="col-md-10">
                                    <select class="form-select" name="transmission_id" required>
                                        @foreach($transmissions as $transmission)
                                            <option value="{{ $transmission->id }}" {{ $transmission->id == $kendaraan->transmission_id ? 'selected' : '' }}>{{ $transmission->transmission_type }}</option>
                                        @endforeach
                                    </select>
                                    @error('transmission_id')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Merk Kendaraan</label>
                                <div class="col-md-10">
                                    <select class="form-select" required name="brand_id" required>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ $brand->id == $kendaraan->brand_id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="body" class="col-md-2 col-form-label">Bodi Kendaraan</label>
                                <div class="col-md-10">
                                    <input class="form-control" autocomplete="off" name="body" id="body" value="{{ $kendaraan->body }}" required>
                                    @error('body')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="passenger" class="col-md-2 col-form-label">Jumlah Penumpang</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="number" autocomplete="off" name="passenger" id="passenger" value="{{ $kendaraan->passenger }}" required>
                                    @error('passenger')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="fuel_capacity" class="col-md-2 col-form-label">Kapasitas Bensin</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <input class="form-control" type="number" autocomplete="off" name="fuel_capacity" id="fuel_capacity" value="{{ $kendaraan->fuel_capacity }}" required>
                                        <div class="input-group-text">Liter</div>
                                        @error('vehicle_name')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="fuel_type" class="col-md-2 col-form-label">Jenis Bahan Bakar</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" autocomplete="off" name="fuel_type" id="fuel_type" value="{{ $kendaraan->fuel_type }}" required>
                                    @error('vehicle_name')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="engine_capacity" class="col-md-2 col-form-label">Kapasitas Mesin</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <input class="form-control" type="number" autocomplete="off" name="engine_capacity" id="engine_capacity" value="{{ $kendaraan->engine_capacity }}" required>
                                        <div class="input-group-text">cc</div>
                                        @error('vehicle_name')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="fuel_economy" class="col-md-2 col-form-label">Keiritan Bahan Bakar</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <input class="form-control" type="number" autocomplete="off" name="fuel_economy" id="fuel_economy" value="{{ $kendaraan->fuel_economy }}" required>
                                        <div class="input-group-text">Km/L</div>
                                        @error('vehicle_name')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="year" class="col-md-2 col-form-label">Tahun Kendaraan</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="number" autocomplete="off" name="year" id="year" value="{{ $kendaraan->year }}" required>
                                    @error('vehicle_name')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="color" class="col-md-2 col-form-label">Warna Kendaraan</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" autocomplete="off" name="color" id="color" value="{{ $kendaraan->color }}" required>
                                    @error('vehicle_name')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="daily_price" class="col-md-2 col-form-label">Harga Harian</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <div class="input-group-text">Rp.</div>
                                        <input class="form-control" type="number" autocomplete="off" name="daily_price" id="daily_price" value="{{ $kendaraan->daily_price }}" required>
                                        @error('vehicle_name')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="monthly_price" class="col-md-2 col-form-label">Harga Bulanan</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <div class="input-group-text">Rp.</div>
                                        <input class="form-control" type="number" autocomplete="off" name="monthly_price" id="monthly_price" value="{{ $kendaraan->monthly_price }}" required>
                                        @error('vehicle_name')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="unit_quantity" class="col-md-2 col-form-label">Jumlah Unit Tersedia</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="number" autocomplete="off" name="unit_quantity" id="unit_quantity" value="{{ $kendaraan->unit_quantity }}" required>
                                    @error('vehicle_name')
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
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Fitur {{ $kendaraan->vehicle_name }}</h4>
                    </div>
                    <div class="card-body">
                        @foreach($kendaraan->features as $feature)
                            <div class="row mb-3">
                                <div class="col-10">
                                    <input type="text" name="features" placeholder="Masukan fitur" class="form-control features_list" value="{{ $feature->feature }}" disabled/>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('hapus-fitur', $feature->id) }}" class="btn btn-danger btn_remove"><i class="bx bx-x"></i></a>
                                </div>
                            </div>
                        @endforeach
                        <form action="{{ route('tambah-fitur') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-10">
                                    <input type="text" name="features" placeholder="Masukan fitur" class="form-control features_list"/>
                                </div>
                                <div class="col-auto">
                                    <input type="hidden" value="{{ $kendaraan->id }}" name="vehicle_id">
                                    <button type="submit" name="add" id="add" class="btn btn-success">
                                        <i class="bx bx-plus"></i></button>
                                </div>
                                @error('features')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Foto {{ $kendaraan->vehicle_name }}</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        @foreach ($kendaraan->photos as $photo)
                            <div class="col-md-4">
                                <div class="gallery-container">
                                    <img
                                            src="{{ Storage::url($photo->photo_url ?? '') }}"
                                            alt=""
                                            class="w-100"
                                    />
                                    <a href="{{ route('vehicle-photo-delete', $photo->id) }}" class="delete-gallery">
                                        <img src="/images/icon-delete.svg" alt=""/>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <form action="{{ route('vehicle-photo-upload') }}" method="post" enctype="multipart/form-data" class="dropzone" id="dropzone">
                        @csrf
                        <input type="hidden" value="{{ $kendaraan->id }}" name="vehicle_id">
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
        </div>
        <!-- end row -->
    @endsection
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor.create(document.querySelector('#description'), {
                ckfinder: {
                    uploadUrl: '{{route('vehicle-desc-photo-upload', ['_token' => csrf_token()])}}'
                }
            })
                .catch(error => {
                    console.error(error);
                });
        </script>
        <script>
            thumbnail.onchange = evt => {
                preview = document.getElementById('preview');
                preview.style.display = 'block';
                const [file] = thumbnail.files
                if (file) {
                    preview.src = URL.createObjectURL(file)
                }
            }
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                var i = 1;
                $('#add').click(function () {
                    i++;
                    $('#dynamic_field').append('<div class="row pt-3" id="row' + i + '"><div class="col-10"><input type="text" name="features[]" placeholder="Masukan fitur" class="form-control features_list" /></div><div class="col-auto"><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove"><i class="bx bx-x"></i></button></div></div>');
                });

                $(document).on('click', '.btn_remove', function () {
                    var button_id = $(this).attr("id");
                    $('#row' + button_id + '').remove();
                });
            });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.0/dropzone.js"></script>
        <script type="text/javascript">
            Dropzone.options.dropzone =
                {
                    maxFilesize: 12,
                    renameFile: function (file) {
                        var dt = new Date();
                        var time = dt.getTime();
                        return time + file.name;
                    },
                    acceptedFiles: ".jpeg,.jpg,.png",
                    addRemoveLinks: true,
                    timeout: 5000,
                    success: function (file, response) {
                        console.log(response);
                    },
                    error: function (file, response) {
                        return false;
                    }
                };
        </script>
@endsection
