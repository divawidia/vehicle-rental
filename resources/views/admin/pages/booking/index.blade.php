@extends('admin.layouts.master')
@section('title')
    Booking Management
@endsection
@section('page-title')
    @yield('title')
@endsection

@section('content')
    <x-admin.alerts.basic/>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">@yield('title')</h4>
                    <div>
                        <a class="btn btn-secondary btn-sm w-100 mb-2" data-bs-toggle="collapse" href="#collapseFilter" role="button" aria-expanded="false" aria-controls="collapseFilter">
                            <i class="bx bx-filter align-middle"></i> Filter
                        </a>
                        <x-admin.buttons.link-button color="primary" icon="plus" text="Create Booking" :route="route('admin.bookings.create')" size="sm w-100"/>
                    </div>
                </div>
                <div class="card-body">
                    <x-admin.tables.main :headers="[
                        '#', 'Invoice', 'Vehicles', 'License Plate', 'Rent Duration', 'Customer Name', 'Pickup Date', 'Created Date', 'Last Updated', 'Rent Status', 'Action',
                    ]"/>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@push('addon-script')
    <script>
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            order: [[0, 'desc']],
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'transaction_code', name: 'transaction_code'},
                {data: 'vehicle.vehicle_name', name: 'vehicle.vehicle_name'},
                {data: 'vehicle_license_plate', name: 'vehicle_license_plate'},
                {data: 'total_days_rent', name: 'total_days_rent'},
                {data: 'name', name: 'name'},
                {data: 'pick_up_datetime', name: 'pick_up_datetime'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'rent_status', name: 'rent_status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    </script>
@endpush
