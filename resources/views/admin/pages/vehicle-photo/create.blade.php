@extends('admin.layouts.master')
@section('title')
    Tambah Foto Kendaraan
@endsection
@section('page-title')
    Tambah Foto Kendaraan
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <form action="{{ route('foto-kendaraan.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Data Foto Kendaraan</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Nama Kendaraan</label>
                                <div class="col-md-10">
                                    <select class="form-select" name="vehicle_id">
                                        <option selected>Pilih Kendaraan</option>
                                        @foreach($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="photo_url" class="form-label">Input File Foto Kendaraan</label>
                                <input class="form-control" type="file" name="photo_url" id="photo_url" multiple>
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
        <script src="{{ URL::asset('build/libs/dropzone/min/dropzone.min.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
