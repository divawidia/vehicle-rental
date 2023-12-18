@extends('admin.layouts.master')
@section('title')
    Edit Data Jenis Kendaraan
@endsection
@section('page-title')
    Edit Data Jenis Kendaraan
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <form action="{{ route('tipe.update', $item->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Data Jenis Kendaraan</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Nama Jenis
                                    Kendaraan</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" autocomplete="off" name="vehicle_type_name" id="vehicle_type_name" value="{{ $item->vehicle_type_name }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="icon" class="form-label">Icon Jenis Kendaraan</label>
                                <img class="rounded col-2 me-2" alt="200x200" src="{{ Storage::url($item->icon) }}"
                                     data-holder-rendered="true">
                                <input class="form-control" type="file" id="icon" name="icon">
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
