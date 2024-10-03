<div class="container-fluid fixed-top">
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="{{ route('user') }}" class="navbar-brand"><img src="{{ url('web/img/logo/logo.png') }}" alt="Logo Sata Harum" width="100"></a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="{{ route('user') }}" class="nav-item nav-link {{ Request::routeIs('user') ? 'active' : '' }}">Home</a>
                    <a href="{{ route('user.contact') }}" class="nav-item nav-link {{ Request::routeIs('user.contact') ? 'active' : '' }}">Contact</a>
                </div>
                
                <div class="d-flex m-3 me-0">
                    @auth
                    <!-- Dropdown for authenticated users -->
                    <div class="dropdown d-inline-block">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user fa-2x"></i>
                            <span class="ms-2">{{ Auth::user()->name }}</span>
                        </a>
                
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('dashboard.user') }}">Dashboard</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </div>
                @else
                    <!-- Display login button if not authenticated -->
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                @endauth
                
                </div>
            </div>
        </nav>
    </div>
</div>

  <!-- Modal Search Start -->
  <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <div class="input-group w-75 mx-auto d-flex">
                    <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                    <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Search End -->