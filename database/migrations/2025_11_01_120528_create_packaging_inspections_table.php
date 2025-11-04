<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabel ini untuk data "header" atau induk dari form
        // Seperti Tanggal, Shift, No. Pol, dll.
        Schema::create('packaging_inspections', function (Blueprint $table) {
            $table->id(); // Kunci primer auto-increment
            $table->uuid()->unique(); // UUID seperti yang diminta
            
            $table->date('inspection_date');
            $table->string('shift');
            $table->string('no_pol')->comment('Nomor Polisi Kendaraan');
            $table->string('vehicle_condition')->comment('Kondisi Kendaraan: Bersih, Kotor, Bau, dll.');
            $table->string('pbb_op')->nullable();
            
            $table->timestamps(); // created_at dan updated_at
            $table->softDeletes(); // deleted_at for soft delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packaging_inspections');
    }
};