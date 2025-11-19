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
        Schema::create('area_sanitasis', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique(); 
            $table->string('username');
            $table->string('area');
            $table->longText('bagian')->nullable();
            $table->string('plant');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('area_sanitasis');
    }
};
