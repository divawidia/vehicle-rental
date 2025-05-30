<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('images/logo.png') }}" alt="" height="30">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('images/logo.png') }}" alt="" height="60">
            </span>
        </a>

        <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
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
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="bx bx-home-alt icon nav-icon"></i>
                        <span class="menu-item" data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li class="menu-title" data-key="t-applications">Bookings</li>
                <li>
                    <a href="{{ route('admin.bookings.index') }}">
                        <i class='bx bx-list-check icon nav-icon'></i>
                        <span class="menu-item" data-key="t-booking">Booking Management</span>
                    </a>
                    <a href="#">
                        <i class='bx bx-calendar icon nav-icon'></i>
                        <span class="menu-item" data-key="t-booking">Booking Calendar</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bx bx-user icon nav-icon"></i>
                        <span class="menu-item" data-key="t-gallery">Customer Management</span>
                    </a>
                </li>
                <li class="menu-title" data-key="t-applications">Vehicles</li>
                <li>
                    <a href="{{ route('admin.vehicle-types.index') }}">
                        <i class="bx bx-category icon nav-icon"></i>
                        <span class="menu-item" data-key="t-vehicle">Vehicle Types</span>
                    </a>
                    <a href="{{ route('admin.vehicle-transmissions.index') }}">
                        <i class="bx bx-cog icon nav-icon"></i>
                        <span class="menu-item" data-key="t-vehicle">Vehicle Transmissions</span>
                    </a>
                    <a href="{{ route('admin.vehicle-brands.index') }}">
                        <i class="bx bx-purchase-tag icon nav-icon"></i>
                        <span class="menu-item" data-key="t-vehicle">Vehicle Brands</span>
                    </a>
                    <a href="{{ route('admin.vehicles.index') }}">
                        <i class="bx bx-car icon nav-icon"></i>
                        <span class="menu-item" data-key="t-vehicle">Vehicle Management</span>
                    </a>
                </li>

                <li class="menu-title" data-key="t-applications">Promos</li>
                <li>
                    <a href="{{ route('admin.vouchers.index') }}">
                        <i class="bx bxs-discount icon nav-icon"></i>
                        <span class="menu-item" data-key="t-vehicle">Vouchers</span>
                    </a>
                    <a href="{{ route('admin.discounts.index') }}">
                        <i class="bx bxs-discount icon nav-icon"></i>
                        <span class="menu-item" data-key="t-vehicle">Discounts</span>
                    </a>
                </li>

                <li class="menu-title" data-key="t-applications">Blogs</li>
                <li>
                    <a href="{{ route('admin.tags.index') }}">
                        <i class="bx bx-tag icon nav-icon"></i>
                        <span class="menu-item" data-key="t-blog">Tags</span>
                    </a>
                    <a href="{{ route('admin.articles.index') }}">
                        <i class="bx bx-text icon nav-icon"></i>
                        <span class="menu-item" data-key="t-blog">Articles</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.galleries.index') }}">
                        <i class="bx bx-photo-album icon nav-icon"></i>
                        <span class="menu-item" data-key="t-gallery">Photo Galleries</span>
                    </a>
                </li>
                <li class="menu-title" data-key="t-applications">Admin Users</li>
                <li>
                    <a href="{{ route('admin.users.index') }}">
                        <i class="bx bx-user icon nav-icon"></i>
                        <span class="menu-item" data-key="t-gallery">User Management</span>
                    </a>
                </li>
                <li class="menu-title" data-key="t-applications">Settings</li>
                <li>
                    <a href="#">
                        <i class="bx bx-user icon nav-icon"></i>
                        <span class="menu-item" data-key="t-gallery">General Settings</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
