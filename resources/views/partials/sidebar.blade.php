@php
$type_user = auth()->user()->type_user;
@endphp

<ul class="navbar-nav sidebar sidebar-dark" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
        <div class="sidebar-brand-text mx-3">E-Retort</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    @if($type_user == 0)
    <div class="sidebar-heading">Master Data</div>
    @php
    $masterActive = request()->routeIs('departemen.*') || request()->routeIs('plant.*') ||
    request()->routeIs('produk.*') || request()->routeIs('produksi.*') || request()->routeIs('user.*') ||
    request()->routeIs('mesin.*');
    $masterActive = request()->routeIs('departemen.*') || request()->routeIs('plant.*') ||
    request()->routeIs('produk.*') || request()->routeIs('produksi.*') || request()->routeIs('user.*') ||
    request()->routeIs('operator.*') || request()->routeIs('engineer.*') || request()->routeIs('mesin.*') ||
    request()->routeIs('supplier.*') || request()->routeIs('supplier_rm.*') || request()->routeIs('koordinator.*') ||
    request()->routeIs('list_chamber.*') || request()->routeIs('area_hygiene.*') || request()->routeIs('area_suhu.*') ||
    request()->routeIs('area_sanitasi.*');
    @endphp
    <li class="nav-item">
        <a class="nav-link {{ $masterActive ? '' : 'collapsed' }}" href="#" data-bs-toggle="collapse"
            data-bs-target="#collapseMasterData" aria-expanded="{{ $masterActive ? 'true' : 'false' }}"
            aria-controls="collapseMasterData">
            <i class="fas fa-database"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseMasterData" class="collapse {{ $masterActive ? 'show' : '' }}"
            data-bs-parent="#accordionSidebar">
            <div class="collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('user.*') ? 'active' : '' }}"
                    href="{{ route('user.index') }}">User</a>
                <a class="collapse-item {{ request()->routeIs('departemen.*') ? 'active' : '' }}"
                    href="{{ route('departemen.index') }}">Departemen</a>
                <a class="collapse-item {{ request()->routeIs('plant.*') ? 'active' : '' }}"
                    href="{{ route('plant.index') }}">Plant</a>
                <a class="collapse-item {{ request()->routeIs('produk.*') ? 'active' : '' }}"
                    href="{{ route('produk.index') }}">List Produk</a>
                <a class="collapse-item {{ request()->routeIs('mesin.*') ? 'active' : '' }}"
                    href="{{ route('mesin.index') }}">List Mesin</a>
                <!-- <a class="collapse-item {{ request()->routeIs('list_chamber.*') ? 'active' : '' }}" href="{{ route('list_chamber.index') }}">List Chamber</a> -->
                <a class="collapse-item {{ request()->routeIs('supplier.*') ? 'active' : '' }}"
                    href="{{ route('supplier.index') }}">List Supplier</a>
                <!-- <a class="collapse-item {{ request()->routeIs('supplier_rm.*') ? 'active' : '' }}" href="{{ route('supplier_rm.index') }}">List Supplier RM</a> -->
                <a class="collapse-item {{ request()->routeIs('area_hygiene.*') ? 'active' : '' }}"
                    href="{{ route('area_hygiene.index') }}">Area GMP</a>
                <a class="collapse-item {{ request()->routeIs('area_suhu.*') ? 'active' : '' }}"
                    href="{{ route('area_suhu.index') }}">Area Suhu</a>
                <a class="collapse-item {{ request()->routeIs('area_sanitasi.*') ? 'active' : '' }}"
                    href="{{ route('area_sanitasi.index') }}">Area Sanitasi</a>
                <a class="collapse-item {{ request()->routeIs('produksi.*') ? 'active' : '' }}"
                    href="{{ route('produksi.index') }}">Karyawan Produksi</a>
                <a class="collapse-item {{ request()->routeIs('operator.*') ? 'active' : '' }}"
                    href="{{ route('operator.index') }}">Karyawan Pendukung</a>
                <!--  <a class="collapse-item {{ request()->routeIs('engineer.*') ? 'active' : '' }}" href="{{ route('engineer.index') }}">Engineer</a>
            <a class="collapse-item {{ request()->routeIs('koordinator.*') ? 'active' : '' }}" href="{{ route('koordinator.index') }}">Koordinator</a> -->
            </div>
        </div>
    </li>
    @endif

    @php
    $typeAllowed = in_array($type_user, [0,1,4,8]);

    // jika ada perubahan form, bisa ditambahkan disini
    $meatRoutes = ['checklistmagnettrap.*', 'mincing.*', 'metal.*'];
    $stuffingRoutes = ['pvdc.*', 'labelisasi_pvdc.*', 'stuffing.*', 'wire.*'];
    $retortRoutes = ['pemasakan.*', 'washing.*', 'chamber.*', 'pemusnahan.*'];
    $packingRoutes = [ 'organoleptik.*','packing.*', 'prepacking.*', 'release_packing.*', 'sampling.*', 'karton.*',
    'sampling_fg.*'];
    $warehouseRoutes = ['inspections.*', 'packaging-inspections.*', 'loading-produks.*', 'klorin.*'];
    $cikandeRoutes = ['pemeriksaan_retain.*', 'dispositions.*', 'berita-acara.*', 'pemeriksaan-kekuatan-magnet-trap.*',
    'penyimpangan-kualitas.*'];
    $rteRoutes = ['retain_rte.*', 'release_packing_rte.*', 'pemasakan_rte.*'];
    $kebersihanRoutes = ['gmp.*', 'suhu.*', 'sanitasi.*'];
    $umumRoutes = ['sampel.*', 'timbangan.*', 'thermometer.*'];

    // Aktivasi dropdown
    $meatPrepActive = request()->routeIs($meatRoutes);
    $stuffingActive = request()->routeIs($stuffingRoutes);
    $retortActive = request()->routeIs($retortRoutes);
    $packingActive = request()->routeIs($packingRoutes);
    $warehouseActive = request()->routeIs($warehouseRoutes);
    $cikandeActive = request()->routeIs($cikandeRoutes);
    $rteActive = request()->routeIs($rteRoutes);
    $kebersihanActive = request()->routeIs($kebersihanRoutes);
    $umumActive = request()->routeIs($umumRoutes);

    @endphp

    @if($typeAllowed)

    <!-- Heading -->
    <div class="sidebar-heading">Form QC</div>

    {{-- MEAT PREPARATION --}}
    <li class="nav-item">
        <a class="nav-link {{ $meatPrepActive ? '' : 'collapsed' }}" href="#" data-bs-toggle="collapse"
            data-bs-target="#collapseMeatPrep" aria-expanded="{{ $meatPrepActive ? 'true' : 'false' }}"
            aria-controls="collapseMeatPrep">
            <i class="fas fa-drumstick-bite"></i>
            <span>Meat Preparation</span>
        </a>
        <div id="collapseMeatPrep" class="collapse {{ $meatPrepActive ? 'show' : '' }}"
            data-bs-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('mincing.*') ? 'active' : '' }}"
                    href="{{ route('mincing.index') }}">Pemeriksaan Mincing - Emulsifying - Aging
                </a>
                <a class="collapse-item {{ request()->routeIs('checklistmagnettrap.*') ? 'active' : '' }}"
                    href="{{ route('checklistmagnettrap.index') }}">
                    Checklist Cleaning Magnet Trap
                </a>
                <a class="collapse-item {{ request()->routeIs('metal.*') ? 'active' : '' }}"
                    href="{{ route('metal.index') }}">
                    Pengecekan Metal Detector
                </a>
            </div>
        </div>
    </li>

    {{-- Stuffing --}}
    <li class="nav-item">
        <a class="nav-link {{ $stuffingActive ? '' : 'collapsed' }}" href="#" data-bs-toggle="collapse"
            data-bs-target="#UollapseStuffing" aria-expanded="{{ $stuffingActive ? 'true' : 'false' }}"
            aria-controls="UollapseStuffing">

            <i class="fas fa-dolly"></i>
            <span>Stuffing</span>
        </a>
        <div id="UollapseStuffing" class="collapse {{ $stuffingActive ? 'show' : '' }}"
            data-bs-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('pvdc.*') ? 'active' : '' }}"
                    href="{{ route('pvdc.index') }}">
                    Data No. Lot PVDC
                </a>
                <a class="collapse-item {{ request()->routeIs('labelisasi_pvdc.*') ? 'active' : '' }}"
                    href="{{ route('labelisasi_pvdc.index') }}">
                    Kontrol Labelisasi PVDC
                </a>
                <a class="collapse-item {{ request()->routeIs('stuffing.*') ? 'active' : '' }}"
                    href="{{ route('stuffing.index') }}">
                    Pemeriksaan Stuffing Sosis Retort
                </a>
                <a class="collapse-item {{ request()->routeIs('wire.*') ? 'active' : '' }}"
                    href="{{ route('wire.index') }}">
                    Data No. Lot Wire
                </a>
                <a class="collapse-item {{ request()->routeIs('sampling_fg.*') ? 'active' : '' }}"
                    href="{{ route('sampling_fg.index') }}">
                    Pemeriksaan Proses Sampling Finish Good
                </a>
            </div>
        </div>
    </li>

    {{-- Retort --}}
    <li class="nav-item">
        <a class="nav-link {{ $retortActive ? '' : 'collapsed' }}" href="#" data-bs-toggle="collapse"
            data-bs-target="#rollapseRetort" aria-expanded="{{ $retortActive ? 'true' : 'false' }}"
            aria-controls="rollapseRetort">

            <i class="fas fa-industry"></i>
            <span>retort</span>
        </a>
        <div id="rollapseRetort" class="collapse {{ $retortActive ? 'show' : '' }}" data-bs-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('pemasakan.*') ? 'active' : '' }}"
                    href="{{ route('pemasakan.index') }}">Pengecekan Pemasakan</a>
                <a class="collapse-item {{ request()->routeIs('washing.*') ? 'active' : '' }}"
                    href="{{ route('washing.index') }}">Pemeriksaan Washing - Drying</a>
                <a class="collapse-item {{ request()->routeIs('chamber.*') ? 'active' : '' }}"
                    href="{{ route('chamber.index') }}">Verifikasi Timer Chamber</a>
                <a class="collapse-item {{ request()->routeIs('pemusnahan.*') ? 'active' : '' }}"
                    href="{{ route('pemusnahan.index') }}">Pemusnahan Barang</a>
            </div>
        </div>
    </li>

    {{-- Packing --}}
    <li class="nav-item">
        <a class="nav-link {{ $packingActive ? '' : 'collapsed' }}" href="#" data-bs-toggle="collapse"
            data-bs-target="#collapsePacking" aria-expanded="{{ $packingActive ? 'true' : 'false' }}"
            aria-controls="collapsePacking">
            <i class="fas fa-box-open"></i>
            <span>Packing</span>
        </a>
        <div id="collapsePacking" class="collapse {{ $packingActive ? 'show' : '' }}"
            data-bs-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('organoleptik.*') ? 'active' : '' }}"
                    href="{{ route('organoleptik.index') }}">Pemeriksaan Organoleptik</a>
                <a class="collapse-item {{ request()->routeIs('packing.*') ? 'active' : '' }}"
                    href="{{ route('packing.index') }}">Pemeriksaan Proses Packing</a>
                <a class="collapse-item {{ request()->routeIs('packing.*') ? 'active' : '' }}"
                    href="{{ route('packing.index') }}">Pemeriksaan Proses Packing</a>
                <a class="collapse-item {{ request()->routeIs('sampling.*') ? 'active' : '' }}"
                    href="{{ route('sampling.index') }}">Data Sampling Produk</a>
                <a class="collapse-item {{ request()->routeIs('karton.*') ? 'active' : '' }}"
                    href="{{ route('karton.index') }}">Kontrol Labelisasi Karton</a>
                <a class="collapse-item {{ request()->routeIs('prepacking.*') ? 'active' : '' }}"
                    href="{{ route('prepacking.index') }}">Pengecekan Pre Packing</a>
                <a class="collapse-item {{ request()->routeIs('release_packing.*') ? 'active' : '' }}"
                    href="{{ route('release_packing.index') }}">Data Release Packing</a>
            </div>
        </div>
    </li>

    {{-- Warehouse --}}
    <li class="nav-item">
        <a class="nav-link {{ $warehouseActive ? '' : 'collapsed' }}" href="#" data-bs-toggle="collapse"
            data-bs-target="#collapseWarehouse" aria-expanded="{{ $warehouseActive ? 'true' : 'false' }}"
            aria-controls="collapseWarehouse">
            <i class="fas fa-warehouse"></i>
            <span>Warehouse</span>
        </a>
        <div id="collapseWarehouse" class="collapse {{ $warehouseActive ? 'show' : '' }}"
            data-bs-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('inspections.*') ? 'active' : '' }}"
                    href="{{ route('inspections.index') }}">
                    Pemeriksaan Input Bahan Baku
                </a>
                <a class="collapse-item {{ request()->routeIs('packaging-inspections.*') ? 'active' : '' }}"
                    href="{{ route('packaging-inspections.index') }}">
                    Pemeriksaan Packaging
                </a>
                <a class="collapse-item {{ request()->routeIs('loading-produks.*') ? 'active' : '' }}"
                    href="{{ route('loading-produks.index') }}">
                    Pemeriksaan Loading Produk
                </a>
                <a class="collapse-item {{ request()->routeIs('klorin.*') ? 'active' : '' }}"
                    href="{{ route('klorin.index') }}">
                    Pengecekan Klorin
                </a>
            </div>
        </div>
    </li>

    {{-- Cikande Form --}}
    <li class="nav-item">
        <a class="nav-link {{ $cikandeActive ? '' : 'collapsed' }}" href="#" data-bs-toggle="collapse"
            data-bs-target="#collapseCikande" aria-expanded="{{ $cikandeActive ? 'true' : 'false' }}"
            aria-controls="collapseCikande">
            <i class="fas fa-clipboard-list"></i>
            <span>Cikande Form</span>
        </a>

        <div id="collapseCikande" class="collapse {{ $cikandeActive ? 'show' : '' }}"
            data-bs-parent="#accordionSidebar">

            <div class="bg-dark py-2 collapse-inner rounded">

                <a class="collapse-item {{ request()->routeIs('pemeriksaan_retain.*') ? 'active' : '' }}"
                    href="{{ route('pemeriksaan_retain.index') }}">
                    Pemeriksaan Retain Sampel
                </a>

                <a class="collapse-item {{ request()->routeIs('dispositions.*') ? 'active' : '' }}"
                    href="{{ route('dispositions.index') }}">
                    Disposisi Produk & Prosedur
                </a>

                <a class="collapse-item {{ request()->routeIs('berita-acara.*') ? 'active' : '' }}"
                    href="{{ route('berita-acara.index') }}">
                    Berita Acara
                </a>

                <a class="collapse-item {{ request()->routeIs('pemeriksaan-kekuatan-magnet-trap.*') ? 'active' : '' }}"
                    href="{{ route('pemeriksaan-kekuatan-magnet-trap.index') }}">
                    Pemeriksaan Kekuatan Magnet Trap
                </a>

                <a class="collapse-item {{ request()->routeIs('penyimpangan-kualitas.*') ? 'active' : '' }}"
                    href="{{ route('penyimpangan-kualitas.index') }}">
                    Penyimpangan Kualitas Internal
                </a>

            </div>
        </div>
    </li>

    {{-- RTE --}}
    <li class="nav-item">
        <a class="nav-link {{ $rteActive ? '' : 'collapsed' }}" href="#" data-bs-toggle="collapse"
            data-bs-target="#collapseRTE" aria-expanded="{{ $rteActive ? 'true' : 'false' }}"
            aria-controls="collapseRTE">
            <i class="fas fa-clipboard-check"></i>
            <span>RTE</span>
        </a>
        <div id="collapseRTE" class="collapse {{ $rteActive ? 'show' : '' }}" data-bs-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('retain_rte.*') ? 'active' : '' }}"
                    href="{{ route('retain_rte.index') }}">Pemeriksaan Sampel Retain RTE
                </a>
                <a class="collapse-item {{ request()->routeIs('release_packing_rte.*') ? 'active' : '' }}"
                    href="{{ route('release_packing_rte.index') }}">
                    Data Release Packing RTE
                </a>
                <a class="collapse-item {{ request()->routeIs('pemasakan_rte.*') ? 'active' : '' }}"
                    href="{{ route('pemasakan_rte.index') }}">
                    Pengecekan Pemasakan RTE
                </a>
            </div>
        </div>
    </li>

    {{-- Suhu & Kebersihan --}}
    <li class="nav-item">
        <a class="nav-link {{ $kebersihanActive ? '' : 'collapsed' }}" href="#" data-bs-toggle="collapse"
            data-bs-target="#collapseFormQC" aria-expanded="{{ $kebersihanActive ? 'true' : 'false' }}"
            aria-controls="collapseFormQC">

            <i class="fas fa-clipboard-list"></i>
            <span>Suhu & Kebersihan</span>
        </a>

        <div id="collapseFormQC" class="collapse {{ $kebersihanActive ? 'show' : '' }}"
            data-bs-parent="#accordionSidebar">

            <div class="bg-dark py-2 collapse-inner rounded">

                <a class="collapse-item {{ request()->routeIs('gmp.*') ? 'active' : '' }}"
                    href="{{ route('gmp.index') }}">
                    Pemeriksaan Personal Hygiene & Kesehatan
                </a>

                <a class="collapse-item {{ request()->routeIs('suhu.*') ? 'active' : '' }}"
                    href="{{ route('suhu.index') }}">
                    Pemeriksaan Suhu & RH
                </a>

                <a class="collapse-item {{ request()->routeIs('sanitasi.*') ? 'active' : '' }}"
                    href="{{ route('sanitasi.index') }}">
                    Kontrol Sanitasi
                </a>
            </div>
        </div>
    </li>

    {{-- Umum --}}
    <li class="nav-item">
        <a class="nav-link {{ $umumActive ? '' : 'collapsed' }}" href="#" data-bs-toggle="collapse"
            data-bs-target="#Uollapseumum" aria-expanded="{{ $umumActive ? 'true' : 'false' }}"
            aria-controls="Uollapseumum">

            <i class="fas fa-cogs"></i>
            <span>Umum</span>
        </a>
        <div id="Uollapseumum" class="collapse {{ $umumActive ? 'show' : '' }}" data-bs-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('sampel.*') ? 'active' : '' }}"
                    href="{{ route('sampel.index') }}">Pengambilan Sampel</a>
                <a class="collapse-item {{ request()->routeIs('timbangan.*') ? 'active' : '' }}"
                    href="{{ route('timbangan.index') }}">Peneraan Timbangan</a>
                <a class="collapse-item {{ request()->routeIs('thermometer.*') ? 'active' : '' }}"
                    href="{{ route('thermometer.index') }}">Peneraan Thermometer</a>

            </div>
        </div>
    </li>

    @endif

    {{-- @if(in_array($type_user, [0,2]))
    <div class="sidebar-heading">Verification SPV</div>
    @php
    // Logika active untuk Verif Suhu & GMP
    $suhuActive = request()->routeIs('suhu.verification');
    $gmpActive = request()->routeIs('gmp.verification');
    $collapseVerifShow = $suhuActive || $gmpActive ;

    // Logika active untuk Verif Meat Prep
    $verifMeatPrepActive = request()->routeIs('checklistmagnettrap.verification');

    // Logika active untuk Verif Warehouse
    $verifWarehouseActive = request()->routeIs('inspections.verification') ||
    request()->routeIs('packaging-inspections.verification');

    // ==========================================================
    // == PERUBAHAN 1: Menambahkan logika 'active' untuk Verif Cikande ==
    // ==========================================================
    $verifCikandeActive = request()->routeIs('pemeriksaan_retain.verification');

    // Logika active untuk Verif Stuffing
    $PvdcActive = request()->routeIs('pvdc.verification');
    $collapseVerifStuffing = $PvdcActive ;
    $gmpActive = request()->routeIs('gmp.verification');
    $SuhuActive = request()->routeIs('suhu.verification') || request()->routeIs('suhu.edit');
    $SanitasiActive = request()->routeIs('sanitasi.verification') || request()->routeIs('sanitasi.edit');

    $collapseVerifShow = $gmpActive || $SuhuActive || $SanitasiActive ;
    @endphp --}}

    {{-- 1. Verif Suhu & Kebersihan --}}
    {{-- <li class="nav-item">
        <a class="nav-link {{ $collapseVerifShow ? '' : 'collapsed' }}" href="#" data-bs-toggle="collapse"
            data-bs-target="#collapseVerif" aria-expanded="{{ $collapseVerifShow ? 'true' : 'false' }}"
            aria-controls="collapseVerif">
            <i class="fas fa-clipboard-list"></i>
            <span>Suhu & Kebersihan</span>
        </a>
        <div id="collapseVerif" class="collapse {{ $collapseVerifShow ? 'show' : '' }}"
            data-bs-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item {{ $gmpActive ? 'active' : '' }}" href="{{ route('gmp.verification') }}">
                    GMP Karyawan
                    Pemeriksaan Personal Hygiene dan Kesehatan Karyawan
                </a>
                <a class="collapse-item {{ $SuhuActive ? 'active' : '' }}" href="{{ route('suhu.verification') }}">
                    Pemeriksaan Suhu dan RH
                </a>
                <a class="collapse-item {{ $SanitasiActive ? 'active' : '' }}"
                    href="{{ route('sanitasi.verification') }}">
                    Kontrol Sanitasi
                </a>
            </div>
        </div>
    </li> --}}

    {{-- 2. Verif MEAT PREPARATION --}}
    {{-- <li class="nav-item">
        <a class="nav-link {{ $verifMeatPrepActive ? '' : 'collapsed' }}" href="#" data-bs-toggle="collapse"
            data-bs-target="#collapseVerifMeatPrep" aria-expanded="{{ $verifMeatPrepActive ? 'true' : 'false' }}"
            aria-controls="collapseVerifMeatPrep">
            <i class="fas fa-clipboard-list"></i>
            <span>MEAT PREPARATION</span>
        </a>
        <div id="collapseVerifMeatPrep" class="collapse {{ $verifMeatPrepActive ? 'show' : '' }}"
            data-bs-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item {{ $verifMeatPrepActive ? 'active' : '' }}"
                    href="{{ route('checklistmagnettrap.verification') }}">
                    Checklist Cleaning Magnet Trap
                </a>
            </div>
        </div>
    </li> --}}

    {{-- 3. Verif Warehouse --}}
    {{-- <li class="nav-item">
        <a class="nav-link {{ $verifWarehouseActive ? '' : 'collapsed' }}" href="#" data-bs-toggle="collapse"
            data-bs-target="#collapseVerifWarehouse" aria-expanded="{{ $verifWarehouseActive ? 'true' : 'false' }}"
            aria-controls="collapseVerifWarehouse">
            <i class="fas fa-clipboard-list"></i>
            <span>Warehouse</span>
        </a>
        <div id="collapseVerifWarehouse" class="collapse {{ $verifWarehouseActive ? 'show' : '' }}"
            data-bs-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('inspections.verification') ? 'active' : '' }}"
                    href="{{ route('inspections.verification') }}">Pemeriksaan Input Bahan Baku</a>
            </div>
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('packaging-inspections.verification') ? 'active' : '' }}"
                    href="{{ route('packaging-inspections.verification') }}">Pemeriksaan Packaging</a>
            </div>
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('packaging-inspections.verification') ? 'active' : '' }}"
                    href="{{ route('loading-produks.verification') }}">Pemeriksaan Loading-Unloading Produk</a>
                @php
                $RetainrteActive = request()->routeIs('retain_rte.verification') ||
                request()->routeIs('retain_rte.edit');
                $ReleasepackingRTEActive = request()->routeIs('release_packing_rte.verification') ||
                request()->routeIs('release_packing_rte.edit');
                $PemasakanRTEActive = request()->routeIs('pemasakan_rte.verification') ||
                request()->routeIs('pemasakan_rte.edit');

                $collapseVerifRTE = $RetainrteActive || $ReleasepackingRTEActive || $PemasakanRTEActive ;
                @endphp
    <li class="nav-item">
        <a class="nav-link {{ $collapseVerifRTE ? '' : 'collapsed' }}" href="#" data-bs-toggle="collapse"
            data-bs-target="#collapseVerifRTEY" aria-expanded="{{ $collapseVerifRTE ? 'true' : 'false' }}"
            aria-controls="collapseVerifRTEY">
            <i class="fas fa-utensils"></i>
            <span>RTE</span>
        </a>
        <div id="collapseVerifRTEY" class="collapse {{ $collapseVerifRTE ? 'show' : '' }}"
            data-bs-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item {{ $RetainrteActive ? 'active' : '' }}"
                    href="{{ route('retain_rte.verification') }}">Pemeriksaan Sample Retain RTE</a>
                <a class="collapse-item {{ $ReleasepackingRTEActive ? 'active' : '' }}"
                    href="{{ route('release_packing_rte.verification') }}">Data Release Packing RTE</a>
                <a class="collapse-item {{ $PemasakanRTEActive ? 'active' : '' }}"
                    href="{{ route('pemasakan_rte.verification') }}">Pengecekan Pemasakan RTE</a>
            </div>
        </div>
    </li> --}}

    {{-- ========================================================== --}}
    {{-- == PERUBAHAN 2: Menambahkan Blok Menu Verif Cikande == --}}
    {{-- ========================================================== --}}
    {{-- <li class="nav-item">
        <a class="nav-link {{ $verifCikandeActive ? '' : 'collapsed' }}" href="#" data-bs-toggle="collapse"
            data-bs-target="#collapseVerifCikande" aria-expanded="{{ $verifCikandeActive ? 'true' : 'false' }}"
            aria-controls="collapseVerifCikande">
            <i class="fas fa-clipboard-list"></i>
            <span>Cikande</span>
        </a>
        <div id="collapseVerifCikande" class="collapse {{ $verifCikandeActive ? 'show' : '' }}"
            data-bs-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('pemeriksaan_retain.verification') ? 'active' : '' }}"
                    href="{{ route('pemeriksaan_retain.verification') }}">Verifikasi Retain Sampel</a>
            </div>
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('dispositions-verification') ? 'active' : '' }}"
                    href="{{ route('dispositions.verification') }}">Verifikasi Disposisi Produk dan Prosedur</a>
            </div>
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('berita-acara.verification.spv') ? 'active' : '' }}"
                    href="{{ route('berita-acara.verification.spv') }}">
                    Verifikasi Berita Acara
                </a>
            </div>
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('pemeriksaan-kekuatan-magnet-trap.verification.spv') ? 'active' : '' }}"
                    href="{{ route('pemeriksaan-kekuatan-magnet-trap.verification.spv') }}">
                    Verifikasi Pemeriksaan Kekuatan Magnet Trap
                </a>
            </div>
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('penyimpangan-kualitas.verification.diketahui') ? 'active' : '' }}"
                    href="{{ route('penyimpangan-kualitas.verification.diketahui') }}">
                    Verifikasi Penyimpangan (Diketahui)
                </a>
            </div>
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('penyimpangan-kualitas.verification.disetujui') ? 'active' : '' }}"
                    href="{{ route('penyimpangan-kualitas.verification.disetujui') }}">
                    Verifikasi Penyimpangan (Disetujui)
                </a>
            </div>
        </div>
    </li> --}}
    {{-- ========================================================== --}}
    {{-- == AKHIR PERUBAHAN == --}}
    {{-- ========================================================== --}}


    {{-- 4. Verif Stuffing (Sekarang menjadi #5) --}}
    {{-- @php
    $StuffingActive = request()->routeIs('stuffing.verification') || request()->routeIs('stuffing.edit');
    $SamplingfgActive = request()->routeIs('sampling_fg.verification') || request()->routeIs('sampling_fg.edit');
    $WireActive = request()->routeIs('wire.verification') || request()->routeIs('wire.edit');
    $ChamberActive = request()->routeIs('chamber.verification') || request()->routeIs('chamber.edit');
    $ThermometerActive = request()->routeIs('thermometer.verification') || request()->routeIs('thermometer.edit');
    $TimbanganActive = request()->routeIs('timbangan.verification') || request()->routeIs('timbangan.edit');
    $KartonActive = request()->routeIs('karton.verification') || request()->routeIs('karton.edit');
    $SamplingActive = request()->routeIs('sampling.verification') || request()->routeIs('sampling.edit');
    $PackingActive = request()->routeIs('packing.verification') || request()->routeIs('packing.edit');
    $KlorinActive = request()->routeIs('klorin.verification') || request()->routeIs('klorin.edit');
    $OrganoleptikActive = request()->routeIs('organoleptik.verification') || request()->routeIs('organoleptik.edit');
    $SampelActive = request()->routeIs('sampel.verification') || request()->routeIs('sampel.edit');
    $PvdcActive = request()->routeIs('pvdc.verification') || request()->routeIs('pvdc.edit');
    $LabelpvdcActive = request()->routeIs('labelisasi_pvdc.verification') || request()->routeIs('labelisasi_pvdc.edit');
    $MincingActive = request()->routeIs('mincing.verification') || request()->routeIs('mincing.edit');
    $MetalActive = request()->routeIs('metal.verification') || request()->routeIs('metal.edit');
    $PemasakanActive = request()->routeIs('pemasakan.verification') || request()->routeIs('pemasakan.edit');
    $PrepackingActive = request()->routeIs('prepacking.verification') || request()->routeIs('prepacking.edit');
    $WashingActive = request()->routeIs('washing.verification') || request()->routeIs('washing.edit');
    $PemusnahanActive = request()->routeIs('pemusnahan.verification') || request()->routeIs('pemusnahan.edit');
    $ReleasepackingActive = request()->routeIs('release_packing.verification') ||
    request()->routeIs('release_packing.edit');

    $collapseVerifStuffing = $PvdcActive || $LabelpvdcActive || $MincingActive || $MetalActive || $StuffingActive ||
    $SampelActive || $OrganoleptikActive || $KlorinActive || $PackingActive || $SamplingActive || $KartonActive ||
    $TimbanganActive || $ThermometerActive || $ChamberActive || $WireActive || $SamplingfgActive || $PemasakanActive ||
    $PrepackingActive || $WashingActive || $PemusnahanActive || $ReleasepackingActive ;
    @endphp --}}
    {{-- <li class="nav-item">
        <a class="nav-link {{ $collapseVerifStuffing ? '' : 'collapsed' }}" href="#" data-bs-toggle="collapse"
            data-bs-target="#collapseVerifStuff" aria-expanded="{{ $collapseVerifStuffing ? 'true' : 'false' }}"
            aria-controls="collapseVerifStuff">
            <i class="fas fa-utensils"></i>
            <span>Stuffing</span>
        </a>
        <div id="collapseVerifStuff" class="collapse {{ $collapseVerifStuffing ? 'show' : '' }}"
            data-bs-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item {{ $PvdcActive ? 'active' : '' }}" href="{{ route('pvdc.verification') }}"> Data
                    No. Lot PVDC </a>
                <a class="collapse-item {{ $LabelpvdcActive ? 'active' : '' }}"
                    href="{{ route('labelisasi_pvdc.verification') }}"> Kontrol Labelisasi PVDC </a>
                <a class="collapse-item {{ $MincingActive ? 'active' : '' }}"
                    href="{{ route('mincing.verification') }}"> Pemeriksaan Mincing - Emulsifying - Aging </a>
                <a class="collapse-item {{ $MetalActive ? 'active' : '' }}"
                    href="{{ route('metal.verification') }}">Pengecekan Metal Detektor</a>
                <a class="collapse-item {{ $StuffingActive ? 'active' : '' }}"
                    href="{{ route('stuffing.verification') }}">Pemeriksaan Stuffing Sosis Retort</a>
                <a class="collapse-item {{ $SampelActive ? 'active' : '' }}"
                    href="{{ route('sampel.verification') }}">Pengambilan Sampel</a>
                <a class="collapse-item {{ $OrganoleptikActive ? 'active' : '' }}"
                    href="{{ route('organoleptik.verification') }}">Pemeriksaan Organoleptik</a>
                <a class="collapse-item {{ $KlorinActive ? 'active' : '' }}"
                    href="{{ route('klorin.verification') }}">Pengecekan Klorin</a>
                <a class="collapse-item {{ $PackingActive ? 'active' : '' }}"
                    href="{{ route('packing.verification') }}">Pemeriksaan Proses Packing</a>
                <a class="collapse-item {{ $SamplingActive ? 'active' : '' }}"
                    href="{{ route('sampling.verification') }}">Data Sampling Produk</a>
                <a class="collapse-item {{ $KartonActive ? 'active' : '' }}"
                    href="{{ route('karton.verification') }}">Kontrol Labelisasi Karton</a>
                <a class="collapse-item {{ $TimbanganActive ? 'active' : '' }}"
                    href="{{ route('timbangan.verification') }}">Peneraan Timbangan</a>
                <a class="collapse-item {{ $ThermometerActive ? 'active' : '' }}"
                    href="{{ route('thermometer.verification') }}">Peneraan Thermometer</a>
                <a class="collapse-item {{ $ChamberActive ? 'active' : '' }}"
                    href="{{ route('chamber.verification') }}">Verifikasi Timer Chamber</a>
                <a class="collapse-item {{ $WireActive ? 'active' : '' }}" href="{{ route('wire.verification') }}">Data
                    No. Lot PVDC</a>
                <a class="collapse-item {{ $SamplingfgActive ? 'active' : '' }}"
                    href="{{ route('sampling_fg.verification') }}">Pemeriksaan Proses Sampling Finish Good</a>
                <a class="collapse-item {{ $PemasakanActive ? 'active' : '' }}"
                    href="{{ route('pemasakan.verification') }}">Pengecekan Pemasakan</a>
                <a class="collapse-item {{ $PrepackingActive ? 'active' : '' }}"
                    href="{{ route('prepacking.verification') }}">Pengecekan Pre Packing</a>
                <a class="collapse-item {{ $WashingActive ? 'active' : '' }}"
                    href="{{ route('washing.verification') }}">Pemeriksaan Washing - Drying</a>
                <a class="collapse-item {{ $PemusnahanActive ? 'active' : '' }}"
                    href="{{ route('pemusnahan.verification') }}">Pemusnahan Barang / Produk</a>
                <a class="collapse-item {{ $ReleasepackingActive ? 'active' : '' }}"
                    href="{{ route('release_packing.verification') }}">Data Release Packing</a>
            </div>
        </div>
    </li> --}}

    {{-- @endif --}}

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>


<style>
    /* --- Sidebar Base --- */
    #accordionSidebar {
        width: 240px;
        transition: width 0.3s ease-in-out;
        min-height: 100vh;
        overflow-x: hidden;
        background: linear-gradient(180deg, #b30000, #660000);
        font-family: "Segoe UI", sans-serif;
    }

    /* Minimized */
    #accordionSidebar.minimized {
        width: 80px;
    }

    /* Icons */
    #accordionSidebar .nav-link i {
        width: 30px;
        text-align: center;
        color: #fff;
    }

    /* Text on normal view */
    #accordionSidebar .nav-link span {
        color: #fff;
        font-size: 14px;
        transition: opacity 0.3s;
    }

    /* Hide text when minimized */
    #accordionSidebar.minimized .nav-link span {
        opacity: 0;
        pointer-events: none;
    }

    /* Collapse Container */
    #accordionSidebar .collapse-inner {
        background: rgba(255, 255, 255, 0.08);
        border-left: 3px solid #ffb3b3;
        padding-left: 0;
    }

    /* Collapse Items */
    #accordionSidebar .collapse-inner .collapse-item {
        display: block;
        white-space: normal;
        color: #ffecec !important;
        padding: 8px 20px;
        font-size: 13px;
        border-radius: 3px;
        transition: background 0.25s, padding-left 0.25s;
    }

    #accordionSidebar .collapse-inner .collapse-item:hover {
        background: rgba(255, 255, 255, 0.15);
    }

    /* Active Item */
    .collapse-item.active {
        background: linear-gradient(90deg, #ff4d4d, #cc0000);
        color: white !important;
        font-weight: bold;
        border-radius: 4px;
    }

    /* Dropdown tooltip on minimized mode */
    #accordionSidebar.minimized .collapse-inner {
        position: absolute;
        left: 80px;
        top: 0;
        background: #800000;
        min-width: 200px;
        z-index: 999;
        display: none;
        border-radius: 6px;
    }

    #accordionSidebar.minimized .collapse.show .collapse-inner {
        display: block;
    }

    /* Sidebar toggle button */
    #sidebarToggle {
        width: 40px;
        height: 40px;
        background: #ffffff;
        border-radius: 8px;
        cursor: pointer;
        transition: transform 0.3s;
    }

    /* Hover effect for toggle */
    #sidebarToggle:hover {
        transform: scale(1.1);
    }

    /* Section heading */
    .sidebar-heading {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 15px 15px 5px;
        color: #ffd6d6;
        font-weight: 600;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Toggle sidebar
    const sidebar = document.getElementById('accordionSidebar');
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        sidebar.classList.toggle('minimized');
    });

    // Collapse dropdown fix saat minimized
    document.querySelectorAll('#accordionSidebar .nav-link[data-bs-toggle="collapse"]').forEach(function(link) {
        link.addEventListener('click', function(e) {
            if (sidebar.classList.contains('minimized')) {
                const targetId = link.getAttribute('data-bs-target');
                const collapseEl = document.querySelector(targetId);
                collapseEl.classList.toggle('show');
            }
        });
    });
</script>