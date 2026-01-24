<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('magnet_traps', function (Blueprint $table) {
            // GANTI foreignId() MENJADI uuid()
            $table->uuid('created_by')->nullable()->after('engineer_id');
            
            // (Opsional) Jika 'id' di tabel 'users' Anda juga UUID, 
            // Anda bisa membuat foreign key-nya seperti ini:
            // $table->foreignUuid('created_by')->nullable()->constrained('users');
            
            // Tapi jika 'id' di users adalah INT dan 'uuid' adalah kolom terpisah,
            // Cukup $table->uuid('created_by') saja sudah benar.
        });
    }

    public function down()
    {
        Schema::table('magnet_traps', function (Blueprint $table) {
            // Sesuaikan bagian down
            $table->dropColumn('created_by');
            
            // Jika Anda menggunakan foreignUuid() di atas:
            // $table->dropForeign(['created_by']);
            // $table->dropColumn('created_by');
        });
    }
};