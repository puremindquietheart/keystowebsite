<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link d-flex">
                <div class="profile-image">
                <img src="{{ asset('images/faces/face1.jpg') }}" alt="image"/>
                <span class="online-status online"></span>
                </div>
                <div class="profile-name">
                    <p class="name">
                        {{ Auth::user()->name }}
                        <i class="flag-icon flag-icon-ph" title="ph" id="ph"></i>
                    </p>
                    <p class="designation">
                        System Administrator
                    </p>
                </div>
            </div>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">Main</span>
        </li>
        <li class="nav-item">
            <router-link to="/keysto-admin-dashboard" class="nav-link">
                <i class="icon-layout menu-icon"></i> <span class="menu-title">Dashboard</span>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link to="/keysto-add-product" class="nav-link">
                <i class="fa fa-plus-circle menu-icon"></i><span class="menu-title">Add Product</span>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link to="/keysto-product-list" class="nav-link">
                <i class="fa fa-cubes menu-icon"></i> <span class="menu-title"> Product List Preview</span>
            </router-link>
        </li>
    </ul>
</nav>