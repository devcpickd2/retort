<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('penyimpangan_kualitas', function (Blueprint $table) {
            $table->unique('nomor', 'penyimpangan_kualitas_nomor_unique');
        });
    }

    public function down()
    {
        Schema::table('penyimpangan_kualitas', function (Blueprint $table) {
            $table->dropUnique('penyimpangan_kualitas_nomor_unique');
        });
    }
};
