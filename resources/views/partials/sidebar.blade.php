@php
$type_user = auth()->user()->type_user;
@endphp

<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark" id="accordionSidebar">

    <!-- Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
        <div class="sidebar-brand-text mx-3">E-Retort</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Master Data -->
    @if($type_user == 0)
    <div class="sidebar-heading">Master Data</div>
    @php
    $masterActive = request()->routeIs('departemen.*') || request()->routeIs('plant.*') || request()->routeIs('produk.*') || request()->routeIs('produksi.*') || request()->routeIs('user.*');
    @endphp
    <li class="nav-item">
        <a class="nav-link {{ $masterActive ? '' : 'collapsed' }}" href="#"
        data-bs-toggle="collapse" data-bs-target="#collapseMasterData" aria-expanded="{{ $masterActive ? 'true' : 'false' }}" aria-controls="collapseMasterData">
        <i class="fas fa-database"></i>
        <span>Master Data</span>
    </a>
    <div id="collapseMasterData" class="collapse {{ $masterActive ? 'show' : '' }}" data-bs-parent="#accordionSidebar">
        <div class="collapse-inner rounded">
            <a class="collapse-item {{ request()->routeIs('user.*') ? 'active' : '' }}" href="{{ route('user.index') }}">User</a>
            <a class="collapse-item {{ request()->routeIs('departemen.*') ? 'active' : '' }}" href="{{ route('departemen.index') }}">Departemen</a>
            <a class="collapse-item {{ request()->routeIs('plant.*') ? 'active' : '' }}" href="{{ route('plant.index') }}">Plant</a>
            <a class="collapse-item {{ request()->routeIs('produk.*') ? 'active' : '' }}" href="{{ route('produk.index') }}">List Produk</a>
            <a class="collapse-item {{ request()->routeIs('mesin.*') ? 'active' : '' }}" href="{{ route('mesin.index') }}">List Mesin</a>
            <a class="collapse-item {{ request()->routeIs('produksi.*') ? 'active' : '' }}" href="{{ route('produksi.index') }}">Karyawan Produksi</a>
        </div>
    </div>
</li>
@endif

<!-- Form QC -->
@if(in_array($type_user, [0,1,4,8]))
<div class="sidebar-heading">Form QC</div>
@php
$formSuhuActive = request()->routeIs('suhu.index') || request()->routeIs('suhu.create') || request()->routeIs('suhu.edit');
$formGmpActive = request()->routeIs('gmp.index') || request()->routeIs('gmp.create') || request()->routeIs('gmp.edit');

$formActive = $formSuhuActive || $formGmpActive;
@endphp

<li class="nav-item">
    <a class="nav-link {{ $formActive ? '' : 'collapsed' }}" href="#"
    data-bs-toggle="collapse" data-bs-target="#collapseFormQC" aria-expanded="{{ $formActive ? 'true' : 'false' }}" aria-controls="collapseFormQC">
    <i class="fas fa-clipboard-list"></i>
    <span>Suhu & Kebersihan</span>
</a>
<div id="collapseFormQC" class="collapse {{ $formActive ? 'show' : '' }}" data-bs-parent="#accordionSidebar">
    <div class="bg-dark py-2 collapse-inner rounded">
        <!-- <a class="collapse-item {{ $formSuhuActive ? 'active' : '' }}" href="{{ route('suhu.index') }}">Pemeriksaan Suhu Ruang</a> -->
        <a class="collapse-item {{ $formGmpActive ? 'active' : '' }}" href="{{ route('gmp.index') }}">GMP Karyawan</a>
    </div>
</div>
</li>
<li class="nav-item">
    <a class="nav-link {{ $formActive ? '' : 'collapsed' }}" href="#"
    data-bs-toggle="collapse" data-bs-target="#collapseFormQC" aria-expanded="{{ $formActive ? 'true' : 'false' }}" aria-controls="collapseFormQC">
    <i class="fas fa-clipboard-list"></i>
    <span>MEAT PREPARATION</span>
</a>
<div id="collapseFormQC" class="collapse {{ $formActive ? 'show' : '' }}" data-bs-parent="#accordionSidebar">
    <div class="bg-dark py-2 collapse-inner rounded">
        <!-- <a class="collapse-item {{ $formSuhuActive ? 'active' : '' }}" href="{{ route('suhu.index') }}">Pemeriksaan Suhu Ruang</a> -->
        <a class="collapse-item {{ $formGmpActive ? 'active' : '' }}" href="{{ route('checklistmagnettrap.index') }}">Checklist Cleaning Magnet Trap</a>
    </div>
</div>
</li>
<li class="nav-item">
    <a class="nav-link {{ $formActive ? '' : 'collapsed' }}" href="#"
    data-bs-toggle="collapse" data-bs-target="#collapseFormQC" aria-expanded="{{ $formActive ? 'true' : 'false' }}" aria-controls="collapseFormQC">
    <i class="fas fa-clipboard-list"></i>
    <span>Warehouse</span>
</a>
<div id="collapseFormQC" class="collapse {{ $formActive ? 'show' : '' }}" data-bs-parent="#accordionSidebar">
    <div class="bg-dark py-2 collapse-inner rounded">
        <!-- <a class="collapse-item {{ $formSuhuActive ? 'active' : '' }}" href="{{ route('suhu.index') }}">Pemeriksaan Suhu Ruang</a> -->
        <a class="collapse-item {{ $formGmpActive ? 'active' : '' }}" href="{{ route('inspections.index') }}">Pemeriksaan Input Bahan Baku</a>
    </div>
    <div class="bg-dark py-2 collapse-inner rounded">
        <!-- <a class="collapse-item {{ $formSuhuActive ? 'active' : '' }}" href="{{ route('suhu.index') }}">Pemeriksaan Suhu Ruang</a> -->
        <a class="collapse-item {{ $formGmpActive ? 'active' : '' }}" href="{{ route('packaging-inspections.index') }}">Pemeriksaan Packaging</a>
    </div>
</div>
</li>


<!-- Cooking -->
@php
// aktif untuk form cooking
$formPvdcActive = request()->routeIs('pvdc.index') || request()->routeIs('pvdc.create') || request()->routeIs('pvdc.edit');

$formActiveStuffing = $formPvdcActive ;
@endphp

<li class="nav-item">
    <a class="nav-link {{ $formActiveStuffing ? '' : 'collapsed' }}" href="#"
    data-bs-toggle="collapse" data-bs-target="#collapseStuffing"
    aria-expanded="{{ $formActiveStuffing ? 'true' : 'false' }}">
    <i class="fas fa-utensils"></i>
    <span>Stuffing</span>
</a>
<div id="collapseStuffing" class="collapse {{ $formActiveStuffing ? 'show' : '' }}">
    <div class="bg-dark py-2 collapse-inner rounded">
        <a class="collapse-item {{ $formPvdcActive ? 'active' : '' }}" href="{{ route('pvdc.index') }}">Data No. Lot PVDC</a>
    </div>
</div>
</li>

@endif

<!-- Verif SPV -->
@if(in_array($type_user, [0,2]))
<div class="sidebar-heading">Verification SPV</div>
@php
$suhuActive = request()->routeIs('suhu.verification');
$gmpActive = request()->routeIs('gmp.verification');
$collapseVerifShow = $suhuActive || $gmpActive ;
@endphp
<li class="nav-item">
    <a class="nav-link {{ $collapseVerifShow ? '' : 'collapsed' }}" href="#"
    data-bs-toggle="collapse" data-bs-target="#collapseVerif"
    aria-expanded="{{ $collapseVerifShow ? 'true' : 'false' }}" aria-controls="collapseVerif">
    <i class="fas fa-clipboard-list"></i>
    <span>Suhu & Kebersihan</span>
</a>
<div id="collapseVerif" class="collapse {{ $collapseVerifShow ? 'show' : '' }}" data-bs-parent="#accordionSidebar">
    <div class="bg-dark py-2 collapse-inner rounded">
        <!-- <a class="collapse-item {{ $suhuActive ? 'active' : '' }}" href="{{ route('suhu.verification') }}">
            Pemeriksaan Suhu Ruang
        </a> -->
        <a class="collapse-item {{ $gmpActive ? 'active' : '' }}" href="{{ route('gmp.verification') }}">
            GMP Karyawan
        </a>
    </div>
</div>
</li>
<li class="nav-item">
    <a class="nav-link {{ $collapseVerifShow ? '' : 'collapsed' }}" href="#"
    data-bs-toggle="collapse" data-bs-target="#collapseVerif"
    aria-expanded="{{ $collapseVerifShow ? 'true' : 'false' }}" aria-controls="collapseVerif">
    <i class="fas fa-clipboard-list"></i>
    <span>MEAT PREPARATION</span>
</a>
<div id="collapseVerif" class="collapse {{ $collapseVerifShow ? 'show' : '' }}" data-bs-parent="#accordionSidebar">
    <div class="bg-dark py-2 collapse-inner rounded">
        <!-- <a class="collapse-item {{ $suhuActive ? 'active' : '' }}" href="{{ route('suhu.verification') }}">
            Pemeriksaan Suhu Ruang
        </a> -->
        <a class="collapse-item {{ $gmpActive ? 'active' : '' }}" href="{{ route('checklistmagnettrap.verification') }}">
            Checklist Cleaning Magnet Trap
        </a>
    </div>
</div>
</li>
<li class="nav-item">
    <a class="nav-link {{ $formActive ? '' : 'collapsed' }}" href="#"
    data-bs-toggle="collapse" data-bs-target="#collapseFormQC" aria-expanded="{{ $formActive ? 'true' : 'false' }}" aria-controls="collapseFormQC">
    <i class="fas fa-clipboard-list"></i>
    <span>Warehouse</span>
</a>
<div id="collapseFormQC" class="collapse {{ $formActive ? 'show' : '' }}" data-bs-parent="#accordionSidebar">
    <div class="bg-dark py-2 collapse-inner rounded">
        <!-- <a class="collapse-item {{ $formSuhuActive ? 'active' : '' }}" href="{{ route('suhu.index') }}">Pemeriksaan Suhu Ruang</a> -->
        <a class="collapse-item {{ $formGmpActive ? 'active' : '' }}" href="{{ route('inspections.verification') }}">Pemeriksaan Input Bahan Baku</a>
    </div>
    <div class="bg-dark py-2 collapse-inner rounded">
        <!-- <a class="collapse-item {{ $formSuhuActive ? 'active' : '' }}" href="{{ route('suhu.index') }}">Pemeriksaan Suhu Ruang</a> -->
        <a class="collapse-item {{ $formGmpActive ? 'active' : '' }}" href="{{ route('packaging-inspections.verification') }}">Pemeriksaan Packaging</a>
    </div>
</div>
</li>

@php
$PvdcActive = request()->routeIs('pvdc.verification');

$collapseVerifStuffing = $PvdcActive ;
@endphp
<li class="nav-item">
    <a class="nav-link {{ $collapseVerifStuffing ? '' : 'collapsed' }}" href="#"
    data-bs-toggle="collapse" data-bs-target="#collapseVerifStuff"
    aria-expanded="{{ $collapseVerifStuffing ? 'true' : 'false' }}" aria-controls="collapseVerifStuff">
    <i class="fas fa-utensils"></i>
    <span>Stuffing</span>
</a>
<div id="collapseVerifStuff" class="collapse {{ $collapseVerifStuffing ? 'show' : '' }}" data-bs-parent="#accordionSidebar">
    <div class="bg-dark py-2 collapse-inner rounded">
        <a class="collapse-item {{ $PvdcActive ? 'active' : '' }}" href="{{ route('pvdc.verification') }}">
            Data No. Lot PVDC
        </a>
    </div>
</div>
</li>

@endif

<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggle -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>


</ul>

<!-- Sidebar CSS Merah -->
<style>
    #accordionSidebar {
        width: 220px;
        transition: width 0.3s;
        min-height: 100vh;
        overflow-x: hidden;
        /* Gradasi merah */
        background: linear-gradient(180deg, #b41e1e, #8b0000);
    }

    #accordionSidebar.minimized {
        width: 150px;
    }

    #accordionSidebar .nav-link i {
        min-width: 25px;
        text-align: center;
        color: #fff;
    }

    #accordionSidebar .nav-link span {
        transition: all 0.3s;
        color: #fff;
    }

    #accordionSidebar .collapse-inner a {
        display: block;
        white-space: normal;
        overflow-wrap: break-word;
        color: #fff !important;
        padding: 0.5rem 1rem;
        transition: background 0.2s;
    }

    #accordionSidebar .collapse-inner a:hover {
        background-color: rgba(255,255,255,0.1);
    }

    .collapse-item.active {
        background-color: rgba(255,255,255,0.2);
        font-weight: bold;
    }

/* Dropdown saat sidebar minimized */
#accordionSidebar.minimized .collapse-inner {
    position: absolute;
    left: 150px;
    top: 0;
    background: #8b0000;
    min-width: 200px;
    z-index: 9999;
    display: none;
}

#accordionSidebar.minimized .collapse.show .collapse-inner {
    display: block;
}

/* Sidebar toggle button */
#sidebarToggle {
    width: 35px;
    height: 35px;
    cursor: pointer;
    background-color: #fff;
    transition: transform 0.3s;
}
</style>
<!-- Sidebar JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Toggle sidebar
    const sidebar = document.getElementById('accordionSidebar');
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        sidebar.classList.toggle('minimized');
    });

// Collapse dropdown fix saat minimized
    document.querySelectorAll('#accordionSidebar .nav-link[data-bs-toggle="collapse"]').forEach(function(link){
        link.addEventListener('click', function(e){
            if(sidebar.classList.contains('minimized')){
                const targetId = link.getAttribute('data-bs-target');
                const collapseEl = document.querySelector(targetId);
                collapseEl.classList.toggle('show');
            }
        });
    });
</script>