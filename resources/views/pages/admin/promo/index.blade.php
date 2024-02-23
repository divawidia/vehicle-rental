@extends('layouts.admin.master')
@section('title')
    Promo
@endsection
@section('page-title')
    Promo
@endsection
@section('body')
    <body>
    @endsection
    @section('content')
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('status') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Promo Voucher</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{  route('vouchers.create') }}" class="btn btn-primary mb-3">
                            + Tambah Voucher Baru
                        </a>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="voucherTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kode Voucher</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Terpakai</th>
                                    <th>Maksimal Dipakai</th>
                                    <th>Diskon</th>
                                    <th>Mulai Berlaku</th>
                                    <th>Akhir Berlaku</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Promo Diskon Kendaraan</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{  route('sales.create') }}" class="btn btn-primary mb-3">
                            + Tambah Sale
                        </a>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="saleTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Terpakai</th>
                                    <th>Diskon</th>
                                    <th>Mulai Berlaku</th>
                                    <th>Akhir Berlaku</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    @endsection
    @push('addon-script')
        <script>
            // AJAX DataTable
            var datatable = $('#voucherTable').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: '{!! url()->route('vouchers.index') !!}',
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'code', name: 'code' },
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'uses', name: 'uses' },
                    { data: 'max_uses', name: 'max_uses' },
                    { data: 'discount_amount', name: 'discount_amount' },
                    { data: 'starts_at', name: 'starts_at' },
                    { data: 'expires_at', name: 'expires_at' },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '15%'
                    },
                ]
            });
        </script>
        <script>
            // AJAX DataTable
            var datatable = $('#saleTable').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: '{!! url()->route('sales.index') !!}',
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'uses', name: 'uses' },
                    { data: 'discount_amount', name: 'discount_amount' },
                    { data: 'starts_at', name: 'starts_at' },
                    { data: 'expires_at', name: 'expires_at' },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '15%'
                    },
                ]
            });
        </script>
    @endpush
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
