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
        Schema::create('armadas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_supir');
            $table->integer('kapasitas');
            $table->integer('no_pintu');
            $table->string('no_polisi',10);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('armadas');
    }
};
