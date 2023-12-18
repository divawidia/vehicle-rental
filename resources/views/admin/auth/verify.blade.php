@extends('admin.layouts.master-without-nav')
@section('title')
    Waiting for Admin Approval
@endsection
@section('page-title')
    Waiting for Admin Approval
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="authentication-bg min-vh-100">
            <div class="bg-overlay bg-light"></div>
            <div class="container">
                <div class="d-flex flex-column min-vh-100 px-3 pt-4">
                    <div class="row justify-content-center my-auto">
                        <div class="col-md-8 col-lg-6 col-xl-5">

                            <div class="mb-4 pb-2">
                                <a href="{{ route('admin-dashboard') }}" class="d-block auth-logo">
                                    <img src="{{ URL::asset('images/logo.png') }}" alt="" height="80"
                                         class="auth-logo-dark me-start">
                                    <img src="{{ URL::asset('images/logo.png') }}" alt="" height="80"
                                         class="auth-logo-light me-start">
                                </a>
                            </div>

                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="text-center mt-2">
                                        <h5>Waiting for Admin Approval !</h5>
                                        <p class="text-muted">Please wait for your account approval by admin</p>
                                    </div>
                                    <div class="p-2 mt-4">
                                        <div class="mt-4">
                                            <a class="btn btn-primary w-100" href="{{ route('login') }}">
                                                Go To Sign In Page
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div><!-- end col -->
                    </div><!-- end row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center p-4">
                                <p>©
                                    <script>
                                        document.write(new Date().getFullYear())
                                    </script>
                                    Batur Sari Rental.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- end container -->
        </div>
        <!-- end authentication section -->
    @endsection
    @section('scripts')
        <script src="{{ URL::asset('build/js/pages/pass-addon.init.js') }}"></script>
@endsection
