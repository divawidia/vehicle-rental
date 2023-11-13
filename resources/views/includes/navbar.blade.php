<header class="header-light scroll-light has-topbar">
    <div id="topbar" class="topbar-dark text-light">
        <div class="container">
            <div class="topbar-left xs-hide">
                <div class="topbar-widget">
                    <div class="topbar-widget">
                        <a href="https://wa.me/6282236592085"><i class="fa fa-phone top"></i>+62 822-3659-2085</a>
                    </div>
                    <div class="topbar-widget">
                        <a href="#"
                        ><i class="fa fa-envelope"></i>batursarirental@gmail.com</a
                        >
                    </div>
                    <div class="topbar-widget">
                        <a href="#"
                        ><i class="fa fa-clock-o"></i>Everyday 8AM - 7PM</a
                        >
                    </div>
                </div>
            </div>

            <div class="topbar-right">
                <div class="social-icons">
                    <a href="#"><i class="fa fa-facebook fa-lg"></i></a>
                    <a href="#"><i class="fa fa-instagram fa-lg"></i></a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="de-flex sm-pt10">
                    <div class="de-flex-col">
                        <div class="de-flex-col">
                            <!-- logo begin -->
                            <div id="logo">
                                <a href="{{ route('home') }}">
                                    <img
                                        class="logo-1"
                                        src="/images/Logo - white.png"
                                        alt=""
                                        height="60px"
                                    />
                                    <img class="logo-2" src="/images/logo.png" alt="" height="60px"/>
                                </a>
                            </div>
                            <!-- logo close -->
                        </div>
                    </div>
                    <div class="de-flex-col header-col-mid">
                        <ul id="mainmenu">
                            <li>
                                <a class="menu-item" href="{{ route('home') }}">Home</a>
                            </li>
                            <li>
                                <a class="menu-item" href="{{ route('about-us') }}">About Us</a>
                            </li>
                            <li>
                                <a class="menu-item" href="{{ route('vehicle-list') }}">Our Vehicles</a>
                            </li>
                            <li>
                                <a class="menu-item" href="{{ route('blog') }}">Blog</a>
                            </li>
                            <li>
                                <a class="menu-item" href="{{ route('contact-us') }}">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                    <div class="de-flex-col">
                        <div class="menu_side_area">
                            <a href="{{ route('booking') }}" class="btn-main">Book Now</a>
                            <span id="menu-btn"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
