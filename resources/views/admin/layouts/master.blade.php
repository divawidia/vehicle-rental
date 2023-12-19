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
    @stack('addon-script')
</body>

</html>
