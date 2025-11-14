
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    UserController,
    DashboardController,
    HaloController,
    ProdukController,
    MesinController,
    SuhuController,
    DepartemenController,
    PlantController,
    ProduksiController,
    GmpController,
    PvdcController,
    MagnetTrapController,
    RawMaterialInspectionController,
    PackagingInspectionController,
    PemeriksaanRetainController,
    LoadingProdukController,
    DispositionController,
    BeritaAcaraController,
    PemeriksaanKekuatanMagnetTrapController,
    PenyimpanganKualitasController,
};

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::resource('user', UserController::class);
});

use Spatie\LaravelPdf\Facades\Pdf;
Route::get('pdf/steamer', function () {
    return Pdf::view('pdf.pemeriksaan-steamer2', ['data' => 'contoh data'])
    ->format('a4')
    ->name('invoice.pdf');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/set-produksi', [DashboardController::class, 'setProduksi'])->name('set.produksi');

// Route::get('/', fn() => view('dashboard'))->name('dashboard');

// Halo test
Route::get('/halo', [HaloController::class, 'index']);

// Departemen
Route::resource('departemen', DepartemenController::class)->parameters([
    'departemen' => 'uuid'
]);
Route::get('/departemen-delete-test/{id}', function ($id) {
    \App\Models\Departemen::find($id)?->delete();
    return redirect()->route('departemen.index')->with('success', 'Data Berhasil dihapus!');
});

// Plant
Route::resource('plant', PlantController::class)->parameters([
    'plant' => 'uuid'
]);

// Produk
Route::resource('produk', ProdukController::class)->parameters([
    'produk' => 'uuid'
]);

// Mesin
Route::resource('mesin', MesinController::class)->parameters([
    'mesin' => 'uuid'
]);

// Produksi (Karyawan Produksi)
Route::resource('produksi', ProduksiController::class)->parameters([
    'produksi' => 'uuid'
]);

// Suhu
Route::get('suhu/verification', [SuhuController::class, 'verification'])->name('suhu.verification');
Route::put('suhu/verification/{uuid}', [SuhuController::class, 'updateVerification'])->name('suhu.verification.update');
Route::get('/suhu/export', [SuhuController::class, 'export'])->name('suhu.export');
Route::get('/suhu/export-pdf', [SuhuController::class, 'exportPdf'])->name('suhu.exportPdf');
Route::resource('suhu', SuhuController::class)->parameters([
    'suhu' => 'uuid'
]);

// GMP
Route::get('gmp/verification', [GmpController::class, 'verification'])->name('gmp.verification');
Route::put('gmp/verification/{uuid}', [GmpController::class, 'updateVerification'])->name('gmp.verification.update');
Route::get('/gmp/export', [GmpController::class, 'export'])->name('gmp.export');
Route::resource('gmp', GmpController::class)->parameters([
    'gmp' => 'uuid'
]);

// Pvdc
Route::get('pvdc/verification', [PvdcController::class, 'verification'])->name('pvdc.verification');
Route::put('pvdc/verification/{uuid}', [PvdcController::class, 'updateVerification'])->name('pvdc.verification.update');
Route::get('/pvdc/export-pdf', [PvdcController::class, 'exportPdf'])->name('pvdc.exportPdf');
Route::resource('pvdc', PvdcController::class)->parameters([
    'pvdc' => 'uuid'
]);

Route::get('checklistmagnettrap/verification', [MagnetTrapController::class, 'showVerificationPage'])->name('checklistmagnettrap.verification');
Route::put('checklistmagnettrap/{uuid}/verify', [MagnetTrapController::class, 'verify'])->name('checklistmagnettrap.verify');
Route::resource('checklistmagnettrap', MagnetTrapController::class);
Route::get('/inspections/verification', [RawMaterialInspectionController::class, 'showVerificationPage'])
     ->name('inspections.verification');
     
Route::put('/inspections/verify/{uuid}', [RawMaterialInspectionController::class, 'verify'])
     ->name('inspections.verify');
Route::resource('inspections', RawMaterialInspectionController::class);
// RUTE BARU: Menampilkan halaman daftar verifikasi Packaging
Route::get('packaging-inspections/verification', [PackagingInspectionController::class, 'showVerificationList'])
         ->name('packaging-inspections.verification');
         
// RUTE BARU: Memproses modal verifikasi Packaging
Route::put('packaging-inspections/verify/{inspection}', [PackagingInspectionController::class, 'verify'])->name('packaging-inspections.verify');
Route::resource('packaging-inspections', PackagingInspectionController::class);

Route::get('pemeriksaan-retain/verification', [PemeriksaanRetainController::class, 'showVerificationPage'])
     ->name('pemeriksaan_retain.verification');
Route::put('pemeriksaan-retain/{pemeriksaanRetain}/verify', [PemeriksaanRetainController::class, 'submitVerification'])
     ->name('pemeriksaan_retain.verify');
Route::resource('pemeriksaan-retain', PemeriksaanRetainController::class)
     ->names('pemeriksaan_retain');
Route::get('loading-produks/verification', [LoadingProdukController::class, 'showVerification'])
     ->name('loading-produks.verification');
Route::put('loading-produks/{uuid}/verify', [LoadingProdukController::class, 'verify'])
     ->name('loading-produks.verify');
Route::resource('loading-produks', LoadingProdukController::class);
Route::get('dispositions-verification', [DispositionController::class, 'verification'])
         ->name('dispositions.verification');
         
    Route::put('dispositions-verify/{disposition:uuid}', [DispositionController::class, 'verify'])
         ->name('dispositions.verify');
Route::resource('dispositions', DispositionController::class); 

Route::prefix('berita-acara-verification')->name('berita-acara.')->group(function () {
    Route::get('qc-supervisor', [BeritaAcaraController::class, 'verificationSpv'])
         ->name('verification.spv');
    Route::post('{beritaAcara}/verify-spv', [BeritaAcaraController::class, 'verifySpv'])
         ->name('verify.spv'); });
Route::resource('berita-acara', BeritaAcaraController::class);
Route::prefix('pemeriksaan-kekuatan-magnet-trap-verification')->name('pemeriksaan-kekuatan-magnet-trap.')->group(function () {
    Route::get('spv', [PemeriksaanKekuatanMagnetTrapController::class, 'verificationSpv'])
    ->name('verification.spv');
    
    // {pemeriksaanKekuatanMagnetTrap} harus cocok dengan variabel di method controller
    Route::post('{pemeriksaanKekuatanMagnetTrap}/verify-spv', [PemeriksaanKekuatanMagnetTrapController::class, 'verifySpv'])
    ->name('verify.spv');
});
Route::resource('pemeriksaan-kekuatan-magnet-trap', PemeriksaanKekuatanMagnetTrapController::class);
Route::prefix('penyimpangan-kualitas-verification')->name('penyimpangan-kualitas.')->group(function () {
    
    // Rute untuk "Diketahui Oleh"
    Route::get('diketahui', [PenyimpanganKualitasController::class, 'verificationDiketahui'])
         ->name('verification.diketahui');
    Route::post('{penyimpanganKualitas}/verify-diketahui', [PenyimpanganKualitasController::class, 'verifyDiketahui'])
         ->name('verify.diketahui');

    // Rute untuk "Disetujui Oleh"
    Route::get('disetujui', [PenyimpanganKualitasController::class, 'verificationDisetujui'])
         ->name('verification.disetujui');
    Route::post('{penyimpanganKualitas}/verify-disetujui', [PenyimpanganKualitasController::class, 'verifyDisetujui'])
         ->name('verify.disetujui');
});
Route::resource('penyimpangan-kualitas', PenyimpanganKualitasController::class)->parameters(['penyimpangan-kualitas' => 'penyimpanganKualitas']);