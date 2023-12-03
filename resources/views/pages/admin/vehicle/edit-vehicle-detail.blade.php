@extends('layouts.admin.master')
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
                <form action="{{ route('update-detail-kendaraan', $vehicleDetail->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit {{ $vehicleDetail->plate_number }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="plate_number" class="col-md-2 col-form-label">Plat Nomor</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" autocomplete="off" name="plate_number" value="{{ $vehicleDetail->plate_number }}" id="plate_number" required>
                                    @error('plate_number')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Odometer</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" autocomplete="off" name="odometer" value="{{ $vehicleDetail->odometer }}" id="odometer" required>
                                    @error('odometer')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="description" class="col-md-2 col-form-label">Status</label>
                                <div class="col-md-10">
                                    @foreach(["tersedia" => "Tersedia", "disewa" => "Disewa", "rusak" => "Rusak"] AS $status => $status_label)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="{{ $status }}" value="{{ $status }}" {{ $vehicleDetail->status == $status ? "checked" : "" }}>
                                            <label class="form-check-label" for="{{ $status }}">{{ $status_label }}</label>
                                        </div>
                                    @endforeach
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
@endsection
