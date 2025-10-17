<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('raw_material_inspections', function (Blueprint $table) {
            $table->id(); // Primary Key auto-increment
            $table->uuid()->unique(); // UUID terpisah, unik dan di-index

            // Kolom lainnya tetap sama
            $table->dateTime('setup_kedatangan');
            $table->string('bahan_baku');
            $table->string('supplier');
            $table->boolean('mobil_check_warna')->default(false);
            $table->boolean('mobil_check_kotoran')->default(false);
            $table->boolean('mobil_check_aroma')->default(false);
            $table->boolean('mobil_check_kemasan')->default(false);
            $table->string('nopol_mobil');
            $table->string('suhu_mobil');
            $table->enum('kondisi_mobil', ['Bersih', 'Kotor', 'Bau', 'Bocor', 'Basah', 'Kering', 'Bebas Hama']);
            $table->string('do_po');
            $table->string('no_segel');
            $table->decimal('suhu_daging', 5, 2);
            $table->text('keterangan')->nullable();
            $table->boolean('analisa_ka_ffa')->default(false);
            $table->boolean('analisa_logo_halal')->default(false);
            $table->string('analisa_negara_asal');
            $table->string('analisa_produsen');
            $table->boolean('dokumen_halal_berlaku')->default(false);
            $table->string('dokumen_halal_file')->nullable();
            $table->string('dokumen_coa_file')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('raw_material_inspections');
    }
};