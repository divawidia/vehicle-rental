@yield('css')
<!-- Favicons - Place favicon.ico in the root directory -->
<link
    rel="shortcut icon"
    href="/images/favicon.ico"
    type="image/x-icon"
/>
<link rel="icon" href="/images/favicon.ico" type="image/x-icon" />
<!-- Bootstrap Css -->
<link href="{{ URL::asset('build/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ URL::asset('build/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ URL::asset('build/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
