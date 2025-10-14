<nav class="navbar navbar-expand navbar-light topbar mb-4 shadow-sm" style="background: rgba(180,30,30,0.6); backdrop-filter: blur(5px);">
    <div class="d-flex w-100 justify-content-between align-items-center px-3">

        <!-- Greeting kiri -->
        <span class="navbar-text fw-medium text-white">
            <h5 class="mb-0">
                @if(auth()->check())
                Hallo, {{ auth()->user()->name }}
                @else
                Hallo, Guest
                @endif
            </h5>
        </span>

        <!-- Profil kanan -->
        @if(auth()->check())
        <div class="dropdown" style="position: relative;">
            <a href="#" class="d-flex align-items-center" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="img-profile rounded-circle shadow-sm"
                src="{{ auth()->user()->photo ? asset('assets/' . auth()->user()->photo) : asset('assets/profil.jpg') }}"
                width="40" height="40">
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow-lg mt-2" aria-labelledby="userDropdown" style="min-width: 180px;">
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item d-flex align-items-center" type="submit">
                            <i class="fas fa-sign-out-alt fa-fw me-2 text-gray-200"></i>
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        @else
        <a class="nav-link d-flex align-items-center text-white" href="{{ route('login') }}">
            <i class="fas fa-sign-in-alt me-1"></i> Login
        </a>
        @endif

    </div>
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

/* Dropdown item hover */
.dropdown-menu .dropdown-item:hover {
    background-color: rgba(255,255,255,0.2);
    color: #fff;
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

</style>
