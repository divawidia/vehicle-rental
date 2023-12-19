<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ route('admin-dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('images/logo.png') }}" alt="" height="30">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('images/logo.png') }}" alt="" height="60">
            </span>
        </a>

        <a href="{{ route('admin-dashboard') }}" class="logo logo-light">
            <span class="logo-lg">
                <img src="{{ URL::asset('images/logo.png') }}" alt="" height="75">
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
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Dashboard</li>
                <li>
                    <a href="{{ route('admin-dashboard') }}">
                        <i class="bx bx-home-alt icon nav-icon"></i>
                        <span class="menu-item" data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li class="menu-title" data-key="t-applications">Booking</li>
                <li>
                    <a href="{{ route('bookings.index') }}">
                        <i class='bx bx-list-check icon nav-icon'></i>
                        <span class="menu-item" data-key="t-booking">Booking Rental</span>
                    </a>
                    <a href="{{ route('bookings.index') }}">
                        <i class='bx bx-calendar icon nav-icon'></i>
                        <span class="menu-item" data-key="t-booking">Kalender Booking</span>
                    </a>
                </li>

                <li class="menu-title" data-key="t-applications">Kendaraan</li>
                <li>
                    <a href="{{ route('kendaraan.index') }}">
                        <i class="bx bx-car icon nav-icon"></i>
                        <span class="menu-item" data-key="t-vehicle">Kendaraan Rental</span>
                    </a>
                    <a href="{{ route('vehicle-category-index') }}">
                        <i class="bx bx-category icon nav-icon"></i>
                        <span class="menu-item" data-key="t-vehicle">Kategori Kendaraan</span>
                    </a>
                    <a href="{{ route('vehicle-category-index') }}">
                        <i class="bx bx-cog icon nav-icon"></i>
                        <span class="menu-item" data-key="t-vehicle">Transmisi Kendaraan</span>
                    </a>
                    <a href="{{ route('vehicle-category-index') }}">
                        <i class="bx bx-purchase-tag icon nav-icon"></i>
                        <span class="menu-item" data-key="t-vehicle">Merk Kendaraan</span>
                    </a>
                </li>

                <li class="menu-title" data-key="t-applications">Promo</li>
                <li>
                    <a href="{{ route('promo-index') }}">
                        <i class="bx bxs-discount icon nav-icon"></i>
                        <span class="menu-item" data-key="t-vehicle">Voucher Kupon</span>
                    </a>
                    <a href="{{ route('promo-index') }}">
                        <i class="bx bxs-discount icon nav-icon"></i>
                        <span class="menu-item" data-key="t-vehicle">Diskon Kendaraan</span>
                    </a>
                </li>

                <li class="menu-title" data-key="t-applications">Blog</li>
                <li>
                    <a href="{{ route('artikel.index') }}">
                        <i class="bx bx-text icon nav-icon"></i>
                        <span class="menu-item" data-key="t-blog">Artikel</span>
                    </a>
                    <a href="{{ route('tags.index') }}">
                        <i class="bx bx-tag icon nav-icon"></i>
                        <span class="menu-item" data-key="t-blog">Tag Artikel</span>
                    </a>
                    <a href="{{ route('galleries.index') }}">
                        <i class="bx bx-photo-album icon nav-icon"></i>
                        <span class="menu-item" data-key="t-gallery">Gallery</span>
                    </a>
                </li>

                <li class="menu-title" data-key="t-gallery">Pengaturan</li>
                <li>
                    <a href="{{ route('users.index') }}">
                        <i class="bx bx-user icon nav-icon"></i>
                        <span class="menu-item" data-key="t-gallery">Manajemen Pengguna</span>
                    </a>
                    <a href="{{ route('users.index') }}">
                        <i class="bx bxs-cog icon nav-icon"></i>
                        <span class="menu-item" data-key="t-gallery">Pengaturan Website</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
