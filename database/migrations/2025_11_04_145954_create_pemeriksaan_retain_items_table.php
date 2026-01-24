<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel detail
        Schema::create('pemeriksaan_retain_items', function (Blueprint $table) {
            $table->id(); // <-- DIUBAH: Menjadi auto-increment BIGINT Primary Key
            $table->uuid('uuid')->unique(); // <-- DITAMBAH: Kolom UUID terpisah
            
            // DIUBAH: dari foreignUuid ke foreignId
            // Ini akan merujuk ke kolom 'id' (angka) di tabel 'pemeriksaan_retains'
            $table->foreignId('pemeriksaan_retain_id')
                  ->constrained('pemeriksaan_retains')
                  ->cascadeOnDelete();

            // Inputan Dinamis (tetap sama)
            $table->string('kode_produksi')->nullable();
            $table->string('varian')->nullable();
            $table->decimal('panjang', 8, 2)->nullable();
            $table->decimal('diameter', 8, 2)->nullable();

            // Sensori (tetap sama)
            $table->string('sensori_rasa')->nullable();
            $table->string('sensori_warna')->nullable();
            $table->string('sensori_aroma')->nullable();
            $table->string('sensori_texture')->nullable();

            // Temuan (tetap sama)
            $table->boolean('temuan_jamur')->default(false);
            $table->boolean('temuan_lendir')->default(false);
            $table->boolean('temuan_pinehole')->default(false);
            $table->boolean('temuan_kejepit')->default(false);
            $table->boolean('temuan_seal')->default(false);

            // Parameter Lab (tetap sama)
            $table->string('lab_garam')->nullable();
            $table->string('lab_air')->nullable();
            $table->string('lab_mikro')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_retain_items');
    }
};