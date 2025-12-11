<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('berita_acaras', function (Blueprint $table) {
            // Gunakan string agar aman dari error mismatch tipe data
            $table->string('plant_uuid')->nullable()->after('uuid'); 
            $table->string('updated_by')->nullable()->after('created_by');
        });
    }

    public function down()
    {
        Schema::table('berita_acaras', function (Blueprint $table) {
            $table->dropColumn(['plant_uuid', 'updated_by']);
        });
    }
};
