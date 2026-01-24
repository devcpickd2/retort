<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('magnet_traps', function (Blueprint $table) {
            // Menambahkan kolom UUID setelah kolom 'id'
            $table->uuid('uuid')->after('id')->unique()->nullable();
            
            // Menambahkan kolom untuk soft deletes
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('magnet_traps', function (Blueprint $table) {
            // Menghapus kolom jika migrasi di-rollback
            $table->dropColumn('uuid');
            $table->dropSoftDeletes();
        });
    }
};
