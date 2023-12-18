<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8"/>
    <title> @yield('title') | Batur Sari Rental Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Bali Batur Sari Rental Admin" name="description"/>
    <meta content="Bali Batur Sari Rental" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('favicon.ico') }}">
    <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon" />
    <!-- include head css -->
    @stack('prepend-style')
    @include('admin.includes.head-css')
{{--    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/datatables.min.css" rel="stylesheet">--}}
{{--    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>--}}
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"/>--}}
    @stack('addon-style')

    @vite([
        'resources/assets/admin/css/app.css',
        'resources/assets/admin/css/bootstrap.min.css',
        'resources/assets/admin/js/app.js',
        ])
</head>

<body>
    <div id="layout-wrapper">
        @include('admin.layouts.topbar')
        @include('admin.layouts.sidebar')

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

            @include('admin.layouts.footer')
        </div>
    </div>

    @stack('prepend-script')
    @include('sweetalert::alert')
    @include('admin.includes.vendor-scripts')
{{--    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>--}}
    @stack('addon-script')
</body>

</html>
