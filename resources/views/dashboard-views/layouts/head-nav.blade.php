<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row navbar-success">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="/admin-dashboard"><img src="{{ asset('images/first.png')}}" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="/admin-dashboard"><img src="{{ asset('images/second.png')}}" alt="logo"/></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-profile" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/faces/face1.jpg" alt="image">
                    <span class="d-none d-lg-inline">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu navbar-dropdown w-100" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="#">
                        <i class="mdi mdi-cached mr-2 text-success"></i>
                        Activity Log
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/user-logout">
                        <i class="mdi mdi-logout mr-2 text-primary"></i>
                        Signout
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>