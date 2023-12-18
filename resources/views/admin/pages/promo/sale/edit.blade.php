@extends('admin.layouts.master')
@section('title')
    Edit Promo Diskon Kendaraan
@endsection
@section('page-title')
    Edit Promo Diskon Kendaraan
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <form action="{{ route('sales.update', $promo->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Promo Diskon Kendaraan</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="name" class="col-md-2 col-form-label">Nama Diskon</label>
                                <div class="col-md-10">
                                    <input class="form-control @error('name') is-invalid @enderror" type="text" autocomplete="off" name="name" id="name" placeholder="Isikan nama diskon" value="{{ $promo->name }}">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="description" class="col-md-2 col-form-label">Deskripsi Diskon</label>
                                <div class="col-md-10">
                                    <input class="form-control @error('description') is-invalid @enderror" type="text" autocomplete="off" name="description" id="description" placeholder="Isikan deskripsi diskon" value="{{ $promo->description }}">
                                    @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="discount_amount" class="col-md-2 col-form-label">Diskon Kendaraan</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <input class="form-control @error('discount_amount') is-invalid @enderror" type="number" autocomplete="off" name="discount_amount" id="discount_amount" placeholder="Isikan persentase diskon kendaraan" value="{{ $promo->discount_amount }}">
                                        <div class="input-group-text">%</div>
                                        @error('discount_amount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" for="tag">Kendaraan yang Didiskon</label>
                                <div class="col-md-10">
                                    <select class="form-select" name="vehicle_id[]" multiple="multiple" data-placeholder="Pilih kendaraan yang ingin diberikan diskon" id="tag" required>
                                        @php
                                            $vehicle_id = [];
                                        @endphp
                                        @foreach($promo->vehicles as $vehicle)
                                            @php(array_push($vehicle_id, $vehicle->id))
                                        @endforeach
                                        @foreach($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('vehicles')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="starts_at" class="col-md-2 col-form-label">Mulai Berlaku</label>
                                <div class="col-md-10">
                                    <input class="form-control @error('starts_at') is-invalid @enderror" type="date" autocomplete="off" name="starts_at" id="starts_at" value="{{ $promo->starts_at }}">
                                    @error('starts_at')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="expires_at" class="col-md-2 col-form-label">Akhir Berlaku</label>
                                <div class="col-md-10">
                                    <input class="form-control @error('expires_at') is-invalid @enderror" type="date" autocomplete="off" name="expires_at" id="expires_at" value="{{ $promo->expires_at }}">
                                    @error('expires_at')
                                    <div class="alert alert-danger">{{ $message }}</div>
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
        <script>
            $("input[name='starts_at']").change(function () {
                let date = new Date($(this).val());
                date = date.setDate(date.getDate() + 1);
                date = new Date(date).toISOString().slice(0, new Date(date).toISOString().lastIndexOf("T"));
                $("input[name='expires_at']").attr({
                    "min": date,
                    "value": date
                });
            })
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.form-select').select2({
                    width: '100%',
                    theme: 'bootstrap-5'
                });
            });
        </script>
@endsection
