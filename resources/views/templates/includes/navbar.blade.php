<!-- Navbar -->
<nav class="shadow-sm bg-white">
    <div class="container">
        <div class="row">
        <div class="col-lg-3 d-lg-flex d-flex justify-content-lg-center justify-content-between mt-2 mt-lg-0 align-items-center">
            
        <a class="navbar-brand logo-title text-success-emphasis d-flex align-items-center gap-1" href="{{ url('/') }}">
            <img src="{{ asset('images/logo-merch-light.png') }}" alt="A Logo" style="width: 65px; height:auto;"> 
            Naufal<span class="text-success">Alwan</span> <span class="text-dark">Merch</span></a>

            <div class="d-flex justify-content-center align-items-center g-1 d-block d-lg-none">
                    <a href="#" class="p-2 rounded-circle text-success"><i class="fas fa-cart-shopping fs-6"></i></a>
                    @if(Auth::check())
                    <div class="dropdown" style="margin-bottom:3px;">
                        <a class="text-black text-decoration-none" id="dropdownMenuButton1" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="img rounded-circle object-fit-cover" style="width:20px; height:20px;" src="{{asset('storage/images/avatar')}}/{{Auth::user()->avatar}}">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                                <form action="{{ url('logout') }}" method="post">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @else
                    <a href="{{url('login')}}" class="p-2 rounded-circle text-success"><i class="far fa-user fs-5"></i></a>
                    @endif
            </div>
        </div>
            <div class="col-lg-6 py-2">
                <div class="d-flex flex-column">
                    <form action="{{url('search')}}" class="col-12 mb-3 mb-lg-0">
                        @csrf
                        <div class="input-group">
                            <input name="keyword" class="form-control border-end-0 rounded-pill" type="search" placeholder="T-Shirt, Jacket, Hoodie, and more..">
                            <span class="input-group-append">
                                <button class="btn btn-outline-success border-bottom-0 border rounded-pill search-button" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                    <nav class="d-flex">
                        <!-- <ul class="nav">
                            <li class="nav-item"><a href="{{ url('/') }}" class="nav-link px-2 text-success fw-medium small">Home</a></li>
                        </ul> -->
                        @if(Auth::check() && Auth::user()->role == 1)
                        <ul class="nav">
                            <li class="nav-item"><a href="{{ url('admin/dashboard') }}" class="nav-link px-2 text-success fw-medium small">Dashboard</a></li>
                        </ul>
                        @endif
                    </nav>
                </div>
            </div>
            <div class="col-lg-3 py-3 d-lg-flex justify-content-center align-items-center d-none">
                <div class="d-flex justify-content-center align-items-center gap-2">
                    <a href="#" class="text-success"><i class="fas fa-cart-shopping fs-6"></i></a>
                    <span class="text-success">|</span>
                    @if(Auth::check())
                    <div class="dropdown dropdown-user">
                        <a class="dropdown d-flex align-items-center hidden-arrow text-black text-decoration-none" href="#" role="button">
                            <img class="img rounded-circle object-fit-cover" style="width:25px; height:25px;" src="{{asset('storage/images/avatar')}}/{{Auth::user()->avatar}}">
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <form action="{{ url('logout') }}" method="post">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @else
                    <div>
                        <a href="{{url('login')}}" class="btn py-1 btn-sm btn-success text-decoration-none">Login</a>
                        <a href="{{url('register')}}" class="btn py-1 btn-sm btn-outline-success text-decoration-none">Sign Up</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>
<!-- End of navbar -->