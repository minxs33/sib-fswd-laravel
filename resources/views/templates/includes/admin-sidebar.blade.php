
    <ul class="navbar-nav sidebar sidebar-success accordion toggled" id="accordionSidebar">

    <a class="sidebar-brand align-items-center justify-content-center mb-1 text-success-emphasis" href="{{ url('/') }}"><img src="{{ asset('images/logo-light.png') }}" alt="A Logo" style="width: 45px; height:auto;"></a>

        <hr class="sidebar-divider mb-4">
        <li class="nav-item">
            <a class="nav-link collapsed text-muted" href="{{ url('/dashboard') }}">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <hr class="sidebar-divider mb-4">

        <div class="sidebar-heading">
            Product
        </div>

        <li class="nav-item">
            <a class="nav-link collapsed text-muted" href="{{ url('/dashboard') }}">
                <i class="fas fa-boxes-stacked"></i>
                <span>Product Lists</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed text-muted" href="{{ url('/dashboard') }}">
                <i class="fas fa-book"></i>
                <span>Product Categories</span>
            </a>
        </li>

        <hr class="sidebar-divider text-success-emphasis d-none d-md-block">

        <div class="sidebar-heading">
            User
        </div>

        <li class="nav-item">
            <a class="nav-link collapsed text-muted" href="{{ url('/dashboard') }}">
                <i class="fas fa-users"></i>
                <span>User Groups</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed text-muted" href="{{ url('/dashboard') }}">
                <i class="fas fa-user-alt"></i>
                <span>User Lists</span>
            </a>
        </li>


        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0 shadow-sm bg-success text-white" id="sidebarToggle"></button>
        </div>

    </ul>