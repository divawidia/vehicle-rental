 @extends('layouts.admin.master')
@section('title')
    Edit Promo Voucher
@endsection
@section('page-title')
    Edit Promo Voucher
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <form action="{{ route('vouchers.update', $promo->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Promo Voucher</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="code" class="col-md-2 col-form-label">Kode Voucher</label>
                                <div class="col-md-10">
                                    <input class="form-control @error('code') is-invalid @enderror" type="text" autocomplete="off" name="code" id="code" placeholder="Isikan kode voucher" value=" {{ $promo->code }} ">
                                    @error('code')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="name" class="col-md-2 col-form-label">Nama Voucher</label>
                                <div class="col-md-10">
                                    <input class="form-control @error('name') is-invalid @enderror" type="text" autocomplete="off" name="name" id="name" placeholder="Isikan nama voucher" value="{{ $promo->name }}">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="description" class="col-md-2 col-form-label">Deskripsi Voucher</label>
                                <div class="col-md-10">
                                    <input class="form-control @error('description') is-invalid @enderror" type="text" autocomplete="off" name="description" id="description" placeholder="Isikan deskripsi voucher" value="{{ $promo->description }}">
                                    @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="max_uses" class="col-md-2 col-form-label">Maksimal Dipakai</label>
                                <div class="col-md-10">
                                    <input class="form-control @error('max_uses') is-invalid @enderror" type="number" autocomplete="off" name="max_uses" id="max_uses" placeholder="Isikan maksimal voucher dipakai" value="{{ $promo->max_uses }}">
                                    @error('max_uses')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
{{--                            @php(dd($promo->starts_at))--}}
                            <div class="mb-3 row">
                                <label for="discount_amount" class="col-md-2 col-form-label">Diskon Voucher</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <input class="form-control @error('discount_amount') is-invalid @enderror" type="number" autocomplete="off" name="discount_amount" id="discount_amount" placeholder="Isikan diskon voucher" value="{{ $promo->discount_amount }}">
                                        <div class="input-group-text">%</div>
                                        @error('discount_amount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="starts_at" class="col-md-2 col-form-label">Mulai Berlaku</label>
                                <div class="col-md-10">
                                    <input class="form-control @error('starts_at') is-invalid @enderror" type="date" autocomplete="off" name="starts_at" id="starts_at" value="{{ \Carbon\Carbon::parse($promo->starts_at)->format('Y-m-d') }}">
                                    @error('starts_at')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="expires_at" class="col-md-2 col-form-label">Akhir Berlaku</label>
                                <div class="col-md-10">
                                    <input class="form-control @error('expires_at') is-invalid @enderror" type="date" autocomplete="off" name="expires_at" id="expires_at" value="{{ \Carbon\Carbon::parse($promo->expires_at)->format('Y-m-d') }}">
                                    @error('expires_at')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="btn-toolbar float-end" role="toolbar" aria-label="Basic example">
                                    <a href="{{ route('promo-index') }}" class="btn btn-danger w-md mx-3">Batal</a>
                                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                                </div>
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
