<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement('ALTER TABLE users MODIFY username VARCHAR(255) UNIQUE');
        DB::statement('ALTER TABLE users MODIFY type_user VARCHAR(255) NULL');
        DB::statement('ALTER TABLE users MODIFY photo VARCHAR(255) NULL');
    }

    public function down()
    {
        DB::statement('ALTER TABLE users MODIFY username VARCHAR(255)');
        DB::statement('ALTER TABLE users MODIFY type_user VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE users MODIFY photo VARCHAR(255) NOT NULL');
    }
};
