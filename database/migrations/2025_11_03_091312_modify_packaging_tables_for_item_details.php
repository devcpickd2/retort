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
        // 1. Tambahkan kolom ke 'items' HANYA JIKA BELUM ADA
        Schema::table('packaging_inspection_items', function (Blueprint $table) {
            if (!Schema::hasColumn('packaging_inspection_items', 'no_pol')) {
                $table->string('no_pol')->comment('Nomor Polisi Kendaraan');
            }
            if (!Schema::hasColumn('packaging_inspection_items', 'vehicle_condition')) {
                $table->string('vehicle_condition')->comment('Kondisi Kendaraan');
            }
            if (!Schema::hasColumn('packaging_inspection_items', 'pbb_op')) {
                $table->string('pbb_op')->nullable();
            }
        });

        // 2. Hapus kolom dari 'header' HANYA JIKA MASIH ADA
        Schema::table('packaging_inspections', function (Blueprint $table) {
            if (Schema::hasColumn('packaging_inspections', 'no_pol')) {
                $table->dropColumn('no_pol');
            }
            if (Schema::hasColumn('packaging_inspections', 'vehicle_condition')) {
                $table->dropColumn('vehicle_condition');
            }
            if (Schema::hasColumn('packaging_inspections', 'pbb_op')) {
                $table->dropColumn('pbb_op');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Kembalikan kolom ke 'header' HANYA JIKA BELUM ADA
        Schema::table('packaging_inspections', function (Blueprint $table) {
            if (!Schema::hasColumn('packaging_inspections', 'no_pol')) {
                $table->string('no_pol')->comment('Nomor Polisi Kendaraan');
            }
            if (!Schema::hasColumn('packaging_inspections', 'vehicle_condition')) {
                $table->string('vehicle_condition')->comment('Kondisi Kendaraan');
            }
            if (!Schema::hasColumn('packaging_inspections', 'pbb_op')) {
                $table->string('pbb_op')->nullable();
            }
        });

        // 2. Hapus kolom dari 'items' HANYA JIKA ADA
        Schema::table('packaging_inspection_items', function (Blueprint $table) {
            if (Schema::hasColumn('packaging_inspection_items', 'no_pol')) {
                $table->dropColumn('no_pol');
            }
            if (Schema::hasColumn('packaging_inspection_items', 'vehicle_condition')) {
                $table->dropColumn('vehicle_condition');
            }
            if (Schema::hasColumn('packaging_inspection_items', 'pbb_op')) {
                $table->dropColumn('pbb_op');
            }
        });
    }
};