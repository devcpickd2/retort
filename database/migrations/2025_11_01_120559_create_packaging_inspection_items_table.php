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
        // Tabel ini untuk baris-baris item yang bisa ditambah (+)
        // Setiap baris terhubung ke satu inspeksi induk
        Schema::create('packaging_inspection_items', function (Blueprint $table) {
            $table->id(); // Kunci primer auto-increment
            $table->uuid()->unique(); // UUID seperti yang diminta
            
            // Foreign key ke tabel induk
            $table->foreignId('packaging_inspection_id')
                  ->constrained('packaging_inspections')
                  ->onDelete('cascade'); // Jika induk dihapus, item ikut terhapus

            // Detail item dari gambar
            $table->string('packaging_type')->comment('Jenis Packaging');
            $table->string('supplier');
            $table->string('lot_batch');
            
            // Kondisi Packaging (v/x)
            $table->string('condition_design', 10)->default('OK')->comment('OK / NG / v / x');
            $table->string('condition_sealing', 10)->default('OK')->comment('OK / NG / v / x');
            $table->string('condition_color', 10)->default('OK')->comment('OK / NG / v / x');
            $table->string('condition_dimension')->nullable()->comment('Panjang, Lebar, Tinggi, Tebal');
            $table->string('condition_weight_pcs')->nullable()->comment('Range berat');
            
            // Jumlah
            $table->integer('quantity_goods')->default(0)->comment('Jumlah Barang');
            $table->integer('quantity_sample')->default(0)->comment('Jumlah Sampel');
            $table->integer('quantity_reject')->default(0)->comment('Jumlah Reject');
            
            // Penerimaan
            $table->enum('acceptance_status', ['OK', 'Tolak']);
            
            $table->text('notes')->nullable()->comment('Keterangan');

            $table->timestamps();
            $table->softDeletes(); // Soft delete untuk item juga
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packaging_inspection_items');
    }
};