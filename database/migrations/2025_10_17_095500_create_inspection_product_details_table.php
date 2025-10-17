<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_inspection_product_details_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inspection_product_details', function (Blueprint $table) {
            $table->id(); // Primary Key auto-increment
            $table->uuid()->unique(); // UUID terpisah

            // Relasi menggunakan foreign key `id` (integer)
            $table->foreignId('raw_material_inspection_id')->constrained()->onDelete('cascade');
            
            $table->string('kode_batch');
            $table->date('tanggal_produksi');
            $table->date('exp');
            $table->decimal('jumlah', 10, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inspection_product_details');
    }
};