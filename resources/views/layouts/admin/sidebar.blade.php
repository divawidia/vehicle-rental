<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ route('admin-dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('images/logo.png') }}" alt="" height="30">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('images/logo-with-text.png') }}" alt="" height="60">
            </span>
        </a>

        <a href="{{ route('admin-dashboard') }}" class="logo logo-light">
            <span class="logo-lg">
                <img src="{{ URL::asset('images/logo-with-text.png') }}" alt="" height="75">
            </span>
            <span class="logo-sm">
                <img src="{{ URL::asset('images/logo.png') }}" alt="" height="75">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn">
        <i class="bx bx-menu align-middle"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Dashboard</li>

               <li>
                    <a href="{{ route('admin-dashboard') }}">
                        <i class="bx bx-home-alt icon nav-icon"></i>
                        <span class="menu-item" data-key="t-dashboard">Dashboard</span>
{{--                        <span class="badge rounded-pill bg-primary">2</span>--}}
                    </a>
                </li>

                <li class="menu-title" data-key="t-applications">Booking</li>
                    <li>
                        <a href="{{ route('bookings.index') }}">
                            <i class='bx bx-calendar icon nav-icon'></i>
                            <span class="menu-item" data-key="t-booking">List Booking</span>
                        </a>
                    </li>

                <li class="menu-title" data-key="t-applications">Kendaraan</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-car icon nav-icon"></i>
                        <span class="menu-item" data-key="t-vehicle">Kendaraan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('vehicle-category-index') }}">Kategori Kendaraan</a></li>
                        <li><a href="{{ route('kendaraan.index') }}">List Kendaraan</a></li>
                    </ul>
                </li>

                <li class="menu-title" data-key="t-applications">Blog</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-text icon nav-icon"></i>
                        <span class="menu-item" data-key="t-blog">Blog</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('tags.index') }}">Tag Blog</a></li>
                        <li><a href="{{ route('artikel-blog.index') }}">Artikel Blog</a></li>
                    </ul>
                </li>

                <li class="menu-title" data-key="t-applications">Gallery</li>

                <li>
                    <a href="">
                        <i class="bx bx-photo-album icon nav-icon"></i>
                        <span class="menu-item" data-key="t-email">Galeri Foto</span>
                    </a>
                </li>



            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
