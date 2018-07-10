<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LocationSpareParts extends Migration
{
   
    public function up()
    {
        Schema::create('location_spare_parts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('spare_parts_id');
            $table->integer('location_id');
            $table->integer('stocks');

        });
    }

    public function down()
    {
            Schema::dropIfExists('location_spare_parts');
    }
}
