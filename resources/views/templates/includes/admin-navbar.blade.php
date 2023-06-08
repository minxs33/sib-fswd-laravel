

<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <div class="dropdown">
                <a class="dropdown-toggle d-flex align-items-center hidden-arrow text-black text-decoration-none" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                    <img class="img rounded-circle object-fit-cover" style="width:35px; height:35px;" src="{{asset('storage/images/avatar')}}/{{Auth::user()->avatar}}"> &nbsp; {{Auth::user()->name}} &nbsp; <i class="fas fa-chevron-down fa-sm"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                    <li>
                        <form action="{{ url('logout') }}" method="post">
                            @csrf
                            <button class="dropdown-item" type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>

        </ul>

    </nav>
</div>
<!-- End of Topbar -->