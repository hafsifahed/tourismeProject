<div class="container position-sticky z-index-sticky top-0">
    <div class="row">
        <div class="col-12">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
                <div class="container-fluid">
                    <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3" href="{{ route('home') }}">
                        Tourisme
                    </a>
                    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon mt-2">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </span>
                    </button>
                    <div class="collapse navbar-collapse" id="navigation">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page"
                                    href="{{ route('activites.activities') }}">
                                    <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                                    Activites
                                    
                                </a>
                            </li>

                            @if(auth()->check())
                                <!-- Display user email and role if authenticated -->
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="#">
                                        <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                                        {{ auth()->user()->email }} ({{ auth()->user()->role }})
                                    </a>
                                </li>
                                <li class="nav-item d-flex align-items-center">
                            <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="nav-link text-white font-weight-bold px-0">
                                    <i class="fa fa-user me-sm-1"></i>
                                    <span class="d-sm-inline d-none">Log out</span>
                                </a>
                            </form>
                </li>
                            @else
                                <!-- Show Sign Up and Sign In links if not authenticated -->
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="{{ route('register') }}">
                                        <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                                        Sign Up
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="{{ route('login') }}">
                                        <i class="fas fa-key opacity-6 text-dark me-1"></i>
                                        Sign In
                                    </a>
                                </li>
                            @endif
                        </ul>

                        <ul class="navbar-nav d-lg-block d-none">
                            
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>
        <p style="margin-top: 100px;"></p>
    </div>
</div>