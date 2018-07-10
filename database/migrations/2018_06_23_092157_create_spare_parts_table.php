<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSparePartsTable extends Migration
{
   
    public function up()
    {
        Schema::create('spare_parts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->string('description')->nullable();
            $table->integer('total_stocks')->default(0);
            $table->integer('reorder_point')->default(0);
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('spare_parts');
    }
}
