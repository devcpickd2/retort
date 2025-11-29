<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('raw_material_inspections', function (Blueprint $table) {
            $table->string('plant_uuid')->nullable()->after('created_by_uuid');
            $table->string('updated_by')->nullable()->after('plant_uuid');
        });
    }

    public function down()
    {
        Schema::table('raw_material_inspections', function (Blueprint $table) {
            $table->dropColumn(['plant_uuid', 'updated_by']);
        });
    }
};
