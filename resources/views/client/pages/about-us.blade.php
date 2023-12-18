@extends('client.layouts.app')

@section('title')
    About Us | Batur Sari Rental Bali
@endsection

@section('content')
    <!-- content begin -->
    <div class="no-bottom space-top zebra" id="content">
        <div id="top"></div>

        <!-- section begin -->
        <section id="subheader" class="jarallax text-light">
            <img src="images/background/16.jpg" class="jarallax-img" alt="">
            <div class="center-y relative text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>About Us</h1>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->

        <section>
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-6 wow fadeInRight">
                        <h2>We offer customers a wide range of <span class="id-color">scooters, motorbike</span> and
                            <span class="id-color">cars</span> for any occasion.</h2>
                    </div>
                    <div class="col-lg-6 wow fadeInRight" data-wow-delay=".25s">
                        Welcome to Bali Batur Rental, your one-stop destination for scooter and car rental in Bali. We
                        provide a best car and scooter rental in Bali with a wide selection of well-maintained scooters
                        and cars to suit your needs.
                        Whether you’re cruising down the coastal highways on a scooter or exploring Bali’s lush green
                        forests in a car, we’ve got you covered. We offer affordable scooter rental price, and flexible
                        rental periods to fit your schedule. Our team is dedicated to ensuring your safety and comfort
                        throughout your rental period. So, what are you waiting for? Book your bike or car rental with
                        Taman Sari Batur Rental today and experience the freedom of exploring Bali on your terms.
                    </div>
                </div>
                <div class="spacer-double"></div>
                {{--                <div class="row text-center">--}}
                {{--                    <div class="col-md-3 col-sm-6 mb-sm-30">--}}
                {{--                        <div class="de_count wow fadeInUp" data-bgcolor="#f5f5f5">--}}
                {{--                            <h3 class="timer" data-to="12000" data-speed="3000">0</h3>--}}
                {{--                            Completed Orders--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    <div class="col-md-3 col-sm-6 mb-sm-30">--}}
                {{--                        <div class="de_count wow fadeInUp" data-bgcolor="#f5f5f5">--}}
                {{--                            <h3 class="timer" data-to="10000" data-speed="3000">0</h3>--}}
                {{--                            Happy Customers--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    <div class="col-md-3 col-sm-6 mb-sm-30">--}}
                {{--                        <div class="de_count wow fadeInUp" data-bgcolor="#f5f5f5">--}}
                {{--                            <h3 class="timer" data-to="120" data-speed="3000">0</h3>--}}
                {{--                            Vehicles Fleet--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    <div class="col-md-3 col-sm-6 mb-sm-30">--}}
                {{--                        <div class="de_count wow fadeInUp" data-bgcolor="#f5f5f5">--}}
                {{--                            <h3 class="timer" data-to="23" data-speed="3000">0</h3>--}}
                {{--                            Years Experience--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
        </section>

        <section aria-label="section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 offset-lg-3 text-center">
                        <h2>Features Hilight</h2>
                        <div class="spacer-20"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-3">
                        <div class="box-icon s2 p-small mb20 wow fadeInRight" data-wow-delay=".5s">
                            <i class="fa bg-color fa-trophy"></i>
                            <div class="d-inner">
                                <h4>First class services</h4>
                                Where luxury meets exceptional care, creating unforgettable moments and exceeding your
                                every expectation.
                            </div>
                        </div>
                        <div class="box-icon s2 p-small mb20 wow fadeInL fadeInRight" data-wow-delay=".75s">
                            <i class="fa bg-color fa-road"></i>
                            <div class="d-inner">
                                <h4>24/7 road assistance</h4>
                                Reliable support when you need it most, keeping you on the move with confidence and
                                peace of mind.
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <img src="images/cars/nmax-no-bg.png" alt="" class="img-fluid wow fadeInUp">
                    </div>

                    <div class="col-lg-3">
                        <div class="box-icon s2 d-invert p-small mb20 wow fadeInL fadeInLeft" data-wow-delay="1s">
                            <i class="fa bg-color fa-tag"></i>
                            <div class="d-inner">
                                <h4>Quality at Minimum Expense</h4>
                                Unlocking affordable brilliance with elevating quality while minimizing costs for
                                maximum value.
                            </div>
                        </div>
                        <div class="box-icon s2 d-invert p-small mb20 wow fadeInL fadeInLeft" data-wow-delay="1.25s">
                            <i class="fa bg-color fa-map-pin"></i>
                            <div class="d-inner">
                                <h4>Free Pick-Up & Drop-Off</h4>
                                Enjoy free pickup and drop-off services within 10km delivery, adding an extra layer of
                                ease to your car rental experience.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-call-to-action" class="bg-color-2 pt60 pb60 text-light">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h2 class="s2">Call us for further information. Batur Sari Rental customer care is here to help
                            you anytime.</h2>
                    </div>

                    <div class="col-lg-4 text-lg-center text-sm-center">
                        <div class="phone-num-big">
                            <i class="fa fa-whatsapp"></i>
                            <span class="pnb-text">
                                    Call Us Now
                                </span>
                            <span class="pnb-num">
                                    +62 822-3659-2085
                                </span>
                        </div>
                        <a href="https://6282236592085" class="btn-main">Contact Us</a>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!-- content close -->
@endsection
