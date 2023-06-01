<!-- Navbar -->
<nav class="shadow-sm bg-white">
        <div class="container">
            <div class="row">
            <div class="col-lg-3 d-lg-flex d-flex justify-content-lg-center justify-content-between mt-2 mt-lg-0 align-items-center">
                
            <a class="navbar-brand logo-title text-success-emphasis d-flex align-items-center gap-1" href="{{ url('/') }}">
                <img src="{{ asset('images/logo-merch-light.png') }}" alt="A Logo" style="width: 65px; height:auto;"> 
                Naufal<span class="text-success">Alwan</span> <span class="text-dark">Merch</span></a>

                <div class="d-flex justify-content-center align-items-center g-1 d-block d-lg-none">
                        <a href="#" class="p-2 rounded-circle text-success"><i class="fas fa-bag-shopping fs-5"></i></a>
                        <a href="{{url('login')}}" class="p-2 rounded-circle text-success"><i class="far fa-user fs-5"></i></a>
                </div>
            </div>
                <div class="col-lg-6 py-2">
                    <div class="d-flex flex-column">
                        <form class="col-12 mb-3 mb-lg-0">
                            <div class="input-group">
                                <input class="form-control border-end-0 rounded-pill" type="search" placeholder="Books, tools, and more..">
                                <span class="input-group-append">
                                    <button class="btn btn-outline-success border-bottom-0 border rounded-pill search-button" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                        <nav class="d-flex">
                            <ul class="nav">
                                <li class="nav-item"><a href="{{ url('/') }}" class="nav-link px-2 text-success fw-medium small">Home</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-3 py-3 d-lg-flex justify-content-center align-items-center d-sm-none">
                    <div class="d-flex justify-content-center align-items-center gap-2">
                        <a href="#" class="text-success"><i class="fas fa-cart-shopping fs-6"></i></a>
                        <span class="text-success">|</span>
                        <div>
                        <a href="{{url('login')}}" class="btn py-1 btn-sm btn-success text-decoration-none">Login</a>
                        <a href="{{url('register')}}" class="btn py-1 btn-sm btn-outline-success text-decoration-none">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
<!-- End of navbar -->