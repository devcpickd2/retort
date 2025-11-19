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
    $masterActive = request()->routeIs('departemen.*') || request()->routeIs('plant.*') || request()->routeIs('produk.*') || request()->routeIs('produksi.*') || request()->routeIs('user.*') || request()->routeIs('operator.*') || request()->routeIs('engineer.*') || request()->routeIs('mesin.*') || request()->routeIs('supplier.*') || request()->routeIs('supplier_rm.*') || request()->routeIs('koordinator.*') || request()->routeIs('list_chamber.*') || request()->routeIs('area_hygiene.*') || request()->routeIs('area_suhu.*') || request()->routeIs('area_sanitasi.*');
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
            <!-- <a class="collapse-item {{ request()->routeIs('list_chamber.*') ? 'active' : '' }}" href="{{ route('list_chamber.index') }}">List Chamber</a> -->
            <a class="collapse-item {{ request()->routeIs('supplier.*') ? 'active' : '' }}" href="{{ route('supplier.index') }}">List Supplier</a>
            <!-- <a class="collapse-item {{ request()->routeIs('supplier_rm.*') ? 'active' : '' }}" href="{{ route('supplier_rm.index') }}">List Supplier RM</a> -->
            <a class="collapse-item {{ request()->routeIs('area_hygiene.*') ? 'active' : '' }}" href="{{ route('area_hygiene.index') }}">Area GMP</a>
            <a class="collapse-item {{ request()->routeIs('area_suhu.*') ? 'active' : '' }}" href="{{ route('area_suhu.index') }}">Area Suhu</a>
            <a class="collapse-item {{ request()->routeIs('area_sanitasi.*') ? 'active' : '' }}" href="{{ route('area_sanitasi.index') }}">Area Sanitasi</a>
            <a class="collapse-item {{ request()->routeIs('produksi.*') ? 'active' : '' }}" href="{{ route('produksi.index') }}">Karyawan Produksi</a>
            <a class="collapse-item {{ request()->routeIs('operator.*') ? 'active' : '' }}" href="{{ route('operator.index') }}">Karyawan Pendukung</a>
           <!--  <a class="collapse-item {{ request()->routeIs('engineer.*') ? 'active' : '' }}" href="{{ route('engineer.index') }}">Engineer</a>
            <a class="collapse-item {{ request()->routeIs('koordinator.*') ? 'active' : '' }}" href="{{ route('koordinator.index') }}">Koordinator</a> -->
        </div>
    </div>
</li>
@endif

<!-- Form QC -->
@if(in_array($type_user, [0,1,4,8]))
<div class="sidebar-heading">Form QC</div>
@php
$formGmpActive = request()->routeIs('gmp.index') || request()->routeIs('gmp.create') || request()->routeIs('gmp.edit');
$formSuhuActive = request()->routeIs('suhu.index') || request()->routeIs('suhu.create') || request()->routeIs('suhu.update');
$formSanitasiActive = request()->routeIs('sanitasi.index') || request()->routeIs('sanitasi.create') || request()->routeIs('sanitasi.update');

$formActive = $formGmpActive || $formSuhuActive || $formSanitasiActive ;
@endphp

<li class="nav-item">
    <a class="nav-link {{ $formActive ? '' : 'collapsed' }}" href="#"
    data-bs-toggle="collapse" data-bs-target="#collapseFormQC" aria-expanded="{{ $formActive ? 'true' : 'false' }}" aria-controls="collapseFormQC">
    <i class="fas fa-clipboard-list"></i>
    <span>Suhu & Kebersihan</span>
</a>
<div id="collapseFormQC" class="collapse {{ $formActive ? 'show' : '' }}" data-bs-parent="#accordionSidebar">
    <div class="bg-dark py-2 collapse-inner rounded">
        <a class="collapse-item {{ $formGmpActive ? 'active' : '' }}" href="{{ route('gmp.index') }}">Pemeriksaan Personal Hygiene dan Kesehatan Karyawan</a>
        <a class="collapse-item {{ $formSuhuActive ? 'active' : '' }}" href="{{ route('suhu.index') }}">Pemeriksaan Suhu dan RH</a>
        <a class="collapse-item {{ $formSanitasiActive ? 'active' : '' }}" href="{{ route('sanitasi.index') }}">Kontrol Sanitasi</a>
    </div>
</div>
</li>

@php
// aktif untuk form rte
$formRetainrteActive = request()->routeIs('retain_rte.index') || request()->routeIs('retain_rte.create') || request()->routeIs('retain_rte.update');
$formReleasepackingRTEActive = request()->routeIs('release_packing_rte.index') || request()->routeIs('release_packing_rte.create') || request()->routeIs('release_packing_rte.update');
$formPemasakanrteActive = request()->routeIs('pemasakan_rte.index') || request()->routeIs('pemasakan_rte.create') || request()->routeIs('pemasakan_rte.update');

$formActiveRTE = $formRetainrteActive || $formReleasepackingRTEActive || $formPemasakanrteActive ;
@endphp

<li class="nav-item">
    <a class="nav-link {{ $formActiveRTE ? '' : 'collapsed' }}" href="#"
    data-bs-toggle="collapse" data-bs-target="#collapseRTE"
    aria-expanded="{{ $formActiveRTE ? 'true' : 'false' }}">
    <i class="fas fa-utensils"></i>
    <span>RTE</span>
</a>
<div id="collapseRTE" class="collapse {{ $formActiveRTE ? 'show' : '' }}">
    <div class="bg-dark py-2 collapse-inner rounded">  
        <a class="collapse-item {{ $formRetainrteActive ? 'active' : '' }}" href="{{ route('retain_rte.index') }}">Pemeriksaan Sampel Retain RTE</a>
        <a class="collapse-item {{ $formReleasepackingRTEActive ? 'active' : '' }}" href="{{ route('release_packing_rte.index') }}">Data Release Packing RTE</a>
        <a class="collapse-item {{ $formPemasakanrteActive ? 'active' : '' }}" href="{{ route('pemasakan_rte.index') }}">Pengecekan Pemasakan RTE</a>
    </div>
</div>
</li>

<!-- Stuffing -->
@php
// aktif untuk form stuffing
$formStuffingActive = request()->routeIs('stuffing.index') || request()->routeIs('stuffing.create') || request()->routeIs('stuffing.update');
$formSamplingfgActive = request()->routeIs('sampling_fg.index') || request()->routeIs('sampling_fg.create') || request()->routeIs('sampling_fg.update');
$formWireActive = request()->routeIs('wire.index') || request()->routeIs('wire.create') || request()->routeIs('wire.update');
$formChamberActive = request()->routeIs('chamber.index') || request()->routeIs('chamber.create') || request()->routeIs('chamber.update');
$formThermometerActive = request()->routeIs('thermometer.index') || request()->routeIs('thermometer.create') || request()->routeIs('thermometer.update');
$formTimbanganActive = request()->routeIs('timbangan.index') || request()->routeIs('timbangan.create') || request()->routeIs('timbangan.update');
$formKartonActive = request()->routeIs('karton.index') || request()->routeIs('karton.create') || request()->routeIs('karton.update');
$formSamplingActive = request()->routeIs('sampling.index') || request()->routeIs('sampling.create') || request()->routeIs('sampling.update');
$formPackingActive = request()->routeIs('packing.index') || request()->routeIs('packing.create') || request()->routeIs('packing.update');
$formKlorinActive = request()->routeIs('klorin.index') || request()->routeIs('klorin.create') || request()->routeIs('klorin.update');
$formOrganoleptikActive = request()->routeIs('organoleptik.index') || request()->routeIs('organoleptik.create') || request()->routeIs('organoleptik.update');
$formSampelActive = request()->routeIs('sampel.index') || request()->routeIs('sampel.create') || request()->routeIs('sampel.update');
$formPvdcActive = request()->routeIs('pvdc.index') || request()->routeIs('pvdc.create') || request()->routeIs('pvdc.update');
$formLabelpvdcActive = request()->routeIs('labelisasi_pvdc.index') || request()->routeIs('labelisasi_pvdc.create') || request()->routeIs('labelisasi_pvdc.update');
$formMincingActive = request()->routeIs('mincing.index') || request()->routeIs('mincing.create') || request()->routeIs('mincing.update');
$formMetalActive = request()->routeIs('metal.index') || request()->routeIs('metal.create') || request()->routeIs('metal.update');
$formPemasakanActive = request()->routeIs('pemasakan.index') || request()->routeIs('pemasakan.create') || request()->routeIs('pemasakan.update');
$formPrepackingActive = request()->routeIs('prepacking.index') || request()->routeIs('prepacking.create') || request()->routeIs('prepacking.update');
$formWashingActive = request()->routeIs('washing.index') || request()->routeIs('washing.create') || request()->routeIs('washing.update');
$formPemusnahanActive = request()->routeIs('pemusnahan.index') || request()->routeIs('pemusnahan.create') || request()->routeIs('pemusnahan.update');
$formReleasepackingActive = request()->routeIs('release_packing.index') || request()->routeIs('release_packing.create') || request()->routeIs('release_packing.update');

$formActiveStuffing = $formPvdcActive || $formLabelpvdcActive || $formMincingActive || $formMetalActive || $formStuffingActive || $formSampelActive || $formOrganoleptikActive || $formKlorinActive || $formPackingActive || $formSamplingActive || $formKartonActive || $formTimbanganActive || $formThermometerActive || $formChamberActive || $formWireActive || $formSamplingfgActive || $formPemasakanActive || $formPrepackingActive || $formWashingActive || $formPemusnahanActive || $formReleasepackingActive ;
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
        <a class="collapse-item {{ $formLabelpvdcActive ? 'active' : '' }}" href="{{ route('labelisasi_pvdc.index') }}">Kontrol Labelisasi PVDC</a>
        <a class="collapse-item {{ $formMincingActive ? 'active' : '' }}" href="{{ route('mincing.index') }}">Pemeriksaan Mincing - Emulsifying - Aging</a>
        <a class="collapse-item {{ $formMetalActive ? 'active' : '' }}" href="{{ route('metal.index') }}">Pengecekan Metal Detektor</a>
        <a class="collapse-item {{ $formStuffingActive ? 'active' : '' }}" href="{{ route('stuffing.index') }}">Pemeriksaan Stuffing Sosis Retort</a>
        <a class="collapse-item {{ $formSampelActive ? 'active' : '' }}" href="{{ route('sampel.index') }}">Pengambilan Sampel</a>
        <a class="collapse-item {{ $formOrganoleptikActive ? 'active' : '' }}" href="{{ route('organoleptik.index') }}">Pemeriksaan Organoleptik</a>
        <a class="collapse-item {{ $formKlorinActive ? 'active' : '' }}" href="{{ route('klorin.index') }}">Pengecekan Klorin</a>
        <a class="collapse-item {{ $formPackingActive ? 'active' : '' }}" href="{{ route('packing.index') }}">Pemeriksaan Proses Packing</a>
        <a class="collapse-item {{ $formSamplingActive ? 'active' : '' }}" href="{{ route('sampling.index') }}">Data Sampling Produk</a>
        <a class="collapse-item {{ $formKartonActive ? 'active' : '' }}" href="{{ route('karton.index') }}">Kontrol Labelisasi Karton</a>
        <a class="collapse-item {{ $formTimbanganActive ? 'active' : '' }}" href="{{ route('timbangan.index') }}">Peneraan Timbangan</a>
        <a class="collapse-item {{ $formThermometerActive ? 'active' : '' }}" href="{{ route('thermometer.index') }}">Peneraan Thermometer</a>
        <a class="collapse-item {{ $formChamberActive ? 'active' : '' }}" href="{{ route('chamber.index') }}">Verifikasi Timer Chamber</a>
        <a class="collapse-item {{ $formWireActive ? 'active' : '' }}" href="{{ route('wire.index') }}">Data No. Lot Wire</a>
        <a class="collapse-item {{ $formSamplingfgActive ? 'active' : '' }}" href="{{ route('sampling_fg.index') }}">Pemeriksaan Proses Sampling Finish Good
        </a>
        <a class="collapse-item {{ $formPemasakanActive ? 'active' : '' }}" href="{{ route('pemasakan.index') }}">Pengecekan Pemasakan</a>
        <a class="collapse-item {{ $formPrepackingActive ? 'active' : '' }}" href="{{ route('prepacking.index') }}">Pengecekan Pre Packing</a>
        <a class="collapse-item {{ $formWashingActive ? 'active' : '' }}" href="{{ route('washing.index') }}">Pemeriksaan Washing - Drying</a>
        <a class="collapse-item {{ $formPemusnahanActive ? 'active' : '' }}" href="{{ route('pemusnahan.index') }}">Pemusnahan Barang</a>
        <a class="collapse-item {{ $formReleasepackingActive ? 'active' : '' }}" href="{{ route('release_packing.index') }}">Data Release Packing</a>
    </div>
</div>
</li>

@endif

<!-- Verif SPV -->
@if(in_array($type_user, [0,2]))
<div class="sidebar-heading">Verification SPV</div>
@php
$gmpActive = request()->routeIs('gmp.verification');
$SuhuActive = request()->routeIs('suhu.verification') || request()->routeIs('suhu.edit');
$SanitasiActive = request()->routeIs('sanitasi.verification') || request()->routeIs('sanitasi.edit');

$collapseVerifShow = $gmpActive || $SuhuActive || $SanitasiActive ;
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
        <a class="collapse-item {{ $gmpActive ? 'active' : '' }}" href="{{ route('gmp.verification') }}">
            Pemeriksaan Personal Hygiene dan Kesehatan Karyawan
        </a>
        <a class="collapse-item {{ $SuhuActive ? 'active' : '' }}" href="{{ route('suhu.verification') }}">
            Pemeriksaan Suhu dan RH
        </a>
        <a class="collapse-item {{ $SanitasiActive ? 'active' : '' }}" href="{{ route('sanitasi.verification') }}">
            Kontrol Sanitasi
        </a>
    </div>
</div>
</li>

@php
$RetainrteActive = request()->routeIs('retain_rte.verification') || request()->routeIs('retain_rte.edit');
$ReleasepackingRTEActive = request()->routeIs('release_packing_rte.verification') || request()->routeIs('release_packing_rte.edit');
$PemasakanRTEActive = request()->routeIs('pemasakan_rte.verification') || request()->routeIs('pemasakan_rte.edit');

$collapseVerifRTE = $RetainrteActive || $ReleasepackingRTEActive || $PemasakanRTEActive ;
@endphp
<li class="nav-item">
    <a class="nav-link {{ $collapseVerifRTE ? '' : 'collapsed' }}" href="#"
    data-bs-toggle="collapse" data-bs-target="#collapseVerifRTEY"
    aria-expanded="{{ $collapseVerifRTE ? 'true' : 'false' }}" aria-controls="collapseVerifRTEY">
    <i class="fas fa-utensils"></i>
    <span>RTE</span>
</a>
<div id="collapseVerifRTEY" class="collapse {{ $collapseVerifRTE ? 'show' : '' }}" data-bs-parent="#accordionSidebar">
    <div class="bg-dark py-2 collapse-inner rounded">
        <a class="collapse-item {{ $RetainrteActive ? 'active' : '' }}" href="{{ route('retain_rte.verification') }}">Pemeriksaan Sample Retain RTE</a>
        <a class="collapse-item {{ $ReleasepackingRTEActive ? 'active' : '' }}" href="{{ route('release_packing_rte.verification') }}">Data Release Packing RTE</a>
        <a class="collapse-item {{ $PemasakanRTEActive ? 'active' : '' }}" href="{{ route('pemasakan_rte.verification') }}">Pengecekan Pemasakan RTE</a>
    </div>
</div>
</li>

@php
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
$ReleasepackingActive = request()->routeIs('release_packing.verification') || request()->routeIs('release_packing.edit');

$collapseVerifStuffing = $PvdcActive || $LabelpvdcActive || $MincingActive || $MetalActive || $StuffingActive || $SampelActive || $OrganoleptikActive || $KlorinActive || $PackingActive || $SamplingActive || $KartonActive || $TimbanganActive || $ThermometerActive || $ChamberActive || $WireActive || $SamplingfgActive || $PemasakanActive || $PrepackingActive || $WashingActive || $PemusnahanActive || $ReleasepackingActive ;
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
        <a class="collapse-item {{ $PvdcActive ? 'active' : '' }}" href="{{ route('pvdc.verification') }}"> Data No. Lot PVDC </a>
        <a class="collapse-item {{ $LabelpvdcActive ? 'active' : '' }}" href="{{ route('labelisasi_pvdc.verification') }}"> Kontrol Labelisasi PVDC </a>
        <a class="collapse-item {{ $MincingActive ? 'active' : '' }}" href="{{ route('mincing.verification') }}"> Pemeriksaan Mincing - Emulsifying - Aging </a>
        <a class="collapse-item {{ $MetalActive ? 'active' : '' }}" href="{{ route('metal.verification') }}">Pengecekan Metal Detektor</a>
        <a class="collapse-item {{ $StuffingActive ? 'active' : '' }}" href="{{ route('stuffing.verification') }}">Pemeriksaan Stuffing Sosis Retort</a>
        <a class="collapse-item {{ $SampelActive ? 'active' : '' }}" href="{{ route('sampel.verification') }}">Pengambilan Sampel</a>
        <a class="collapse-item {{ $OrganoleptikActive ? 'active' : '' }}" href="{{ route('organoleptik.verification') }}">Pemeriksaan Organoleptik</a>
        <a class="collapse-item {{ $KlorinActive ? 'active' : '' }}" href="{{ route('klorin.verification') }}">Pengecekan Klorin</a>
        <a class="collapse-item {{ $PackingActive ? 'active' : '' }}" href="{{ route('packing.verification') }}">Pemeriksaan Proses Packing</a>
        <a class="collapse-item {{ $SamplingActive ? 'active' : '' }}" href="{{ route('sampling.verification') }}">Data Sampling Produk</a>
        <a class="collapse-item {{ $KartonActive ? 'active' : '' }}" href="{{ route('karton.verification') }}">Kontrol Labelisasi Karton</a>
        <a class="collapse-item {{ $TimbanganActive ? 'active' : '' }}" href="{{ route('timbangan.verification') }}">Peneraan Timbangan</a>
        <a class="collapse-item {{ $ThermometerActive ? 'active' : '' }}" href="{{ route('thermometer.verification') }}">Peneraan Thermometer</a>
        <a class="collapse-item {{ $ChamberActive ? 'active' : '' }}" href="{{ route('chamber.verification') }}">Verifikasi Timer Chamber</a>
        <a class="collapse-item {{ $WireActive ? 'active' : '' }}" href="{{ route('wire.verification') }}">Data No. Lot PVDC</a>
        <a class="collapse-item {{ $SamplingfgActive ? 'active' : '' }}" href="{{ route('sampling_fg.verification') }}">Pemeriksaan Proses Sampling Finish Good</a>
        <a class="collapse-item {{ $PemasakanActive ? 'active' : '' }}" href="{{ route('pemasakan.verification') }}">Pengecekan Pemasakan</a>
        <a class="collapse-item {{ $PrepackingActive ? 'active' : '' }}" href="{{ route('prepacking.verification') }}">Pengecekan Pre Packing</a>
        <a class="collapse-item {{ $WashingActive ? 'active' : '' }}" href="{{ route('washing.verification') }}">Pemeriksaan Washing - Drying</a>
        <a class="collapse-item {{ $PemusnahanActive ? 'active' : '' }}" href="{{ route('pemusnahan.verification') }}">Pemusnahan Barang / Produk</a>
        <a class="collapse-item {{ $ReleasepackingActive ? 'active' : '' }}" href="{{ route('release_packing.verification') }}">Data Release Packing</a>
    </div>
</div>
</li>

@endif

<hr class="sidebar-divider d-none d-md-block">
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
</ul>

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