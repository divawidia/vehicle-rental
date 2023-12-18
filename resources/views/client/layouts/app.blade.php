<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <meta name="facebook-domain-verification" content="mdmpe6vvsqk7chu3lbj3xeu4aa6p7b"/>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-5337SZ8686"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-5337SZ8686');
    </script>

    <title>@yield('title') | Batur Sari Rental Bali</title>

    {{-- style --}}
    @stack('prepend-style')
    @include('client.includes.style')
    @stack('addon-style')
    @vite(['resources/assets/client/css/app.css', 'resources/assets/client/js/app.js'])
</head>

<body>
    <div class="wrapper">
        @include('client.layouts.navbar')

        @yield('content')

        <a href="#" id="back-to-top"></a>

        @include('client.layouts.footer')
    </div>

    @stack('prepend-script')
    @include('client.includes.script')
    @stack('addon-script')
</body>
</html>
