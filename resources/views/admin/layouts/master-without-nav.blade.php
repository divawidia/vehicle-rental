<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title> @yield('title') | Webadmin - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="Themesdesign" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('img/favicon.ico') }}">

    <!-- include head css -->

    @include('admin.includes.head-css')
    @vite(['resources/assets/admin/css/app.css', 'resources/assets/admin/css/bootstrap.min.css', 'resources/assets/admin/js/app.js', ])
</head>

<body>

    @yield('content')

    <!-- vendor-scripts -->

    @include('admin.includes.vendor-scripts')

</body>

</html>
