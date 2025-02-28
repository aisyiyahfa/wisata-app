<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('surat', function (Blueprint $table) {
            $table->dropUnique(['nomor_surat']);
        });
    }

    public function down()
    {
        Schema::table('surat', function (Blueprint $table) {
            $table->unique('nomor_surat');
        });
    }
};
