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
        Schema::table('users', function (Blueprint $table) {
           $table->string('username')->unique()->after('uuid');
           $table->string('plant')->nullable()->after('username');
           $table->string('department')->nullable()->after('plant');
           $table->string('type_user')->nullable()->after('department'); 
           $table->string('photo')->nullable()->after('type_user'); 
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
           $table->dropColumn(['username', 'plant', 'department', 'type_user', 'photo']);
       });
    }
};
