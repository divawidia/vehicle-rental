<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    {{-- style --}}
    @stack('prepend-style')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@19.2.16/build/css/intlTelInput.css">
    @include('includes.style')
    @stack('addon-style')

</head>

<body>
    <div class="wrapper">
        <!-- page preloader begin -->
        <div id="de-preloader"></div>
        <!-- page preloader close -->

        {{-- navbar --}}
        @include('includes.navbar')

        <!-- Page Content -->
        @yield('content')

        <!-- content close -->
        <a href="#" id="back-to-top"></a>

        {{-- footer --}}
        @include('includes.footer')
    </div>

<!-- Bootstrap core JavaScript -->
{{-- script --}}
@stack('prepend-script')
@include('includes.script')
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@19.2.16/build/js/intlTelInput.min.js"></script>
@stack('addon-script')

</body>
</html>
