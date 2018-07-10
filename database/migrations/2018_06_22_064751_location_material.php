<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LocationMaterial extends Migration
{
    
    public function up()
    {
       Schema::create('location_material', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('material_id');
            $table->integer('location_id');
            $table->integer('stocks');

        });
    }

    public function down()
    {
            Schema::dropIfExists('location_material');
    }
}
