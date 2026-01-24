<?php

// database/migrations/2025_10_17_095500_create_inspection_product_details_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inspection_product_details', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique(); 

            $table->foreignId('raw_material_inspection_id')->constrained()->onDelete('cascade');
            
            $table->string('kode_batch');
            $table->date('tanggal_produksi');
            $table->date('exp');
            $table->decimal('jumlah', 10, 2);
            
            // KOLOM BARU YANG DIMINTA
            $table->decimal('jumlah_sampel', 10, 2)->default(0);
            $table->decimal('jumlah_reject', 10, 2)->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inspection_product_details');
    }
};