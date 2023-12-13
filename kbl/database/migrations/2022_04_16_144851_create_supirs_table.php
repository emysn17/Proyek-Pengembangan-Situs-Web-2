<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('supirs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_supir');
            $table->string('alamat');
            $table->string('province_id');
            $table->string('city_id');
            $table->string('subdistrict_id');
            $table->string('no_hp');
            $table->string('gambar');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('supirs');
    }
};
