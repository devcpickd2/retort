<nav class="navbar navbar-expand navbar-light topbar mb-4 shadow-sm static-top" style="background: linear-gradient(90deg, #b30000, #660000); backdrop-filter: blur(5px);">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3 text-white">
        <i class="fa fa-bars"></i>
    </button>

    <ul class="navbar-nav ml-auto">


        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-white small">
                    @if(auth()->check())
                        Hallo, {{ auth()->user()->name }}
                    @else
                        Hallo, Guest
                    @endif
                </span>
                <img class="img-profile rounded-circle"
                    src="{{ auth()->user()->photo ? asset('assets/' . auth()->user()->photo) : asset('assets/profil.jpg') }}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="bg-white dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item d-flex align-items-center" type="submit">
                            <i class="fas fa-sign-out-alt fa-fw me-2 text-dark"></i>&nbsp;
                            Logout
                        </button>
                    </form>
            </div>
        </li>

    </ul>
</nav>

<style>
/* Gunakan font modern Poppins */
body, .navbar, .dropdown-menu, .navbar-text {
    font-family: 'Poppins', sans-serif;
}

/* Navbar text */
.navbar-text h5 {
    margin: 0;
    font-weight: 600;
}

/* Profile image hover */
.img-profile {
    transition: transform 0.2s, box-shadow 0.2s;
}
.img-profile:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
}


/* Dropdown style */
.dropdown-menu {
    top: calc(100% + 0.25rem);
    right: 0;
    left: auto !important;
    background: rgba(180,30,30,0.3); /* merah transparan */
    backdrop-filter: blur(5px);
    border: none;
    color: #fff;
    z-index: 5000 !important; /* tetap di atas elemen lain */
}

/* Dropdown icons */
.dropdown-menu .dropdown-item i {
    color: #fff;
}

/* Hover effect for logout button */
.dropdown-menu .dropdown-item:hover i {
    color: #ffd1d1;
}

/* Pastikan navbar tidak memotong dropdown */
.navbar, .topbar {
    overflow: visible !important;
    position: relative;
    z-index: 1000;
}

@media(max-width:768px){
    .sidebar-dark .nav-item .nav-link{
        width: 100%;
    }
}

</style>
