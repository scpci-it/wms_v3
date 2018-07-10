<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialTransactionsTable extends Migration
{
    
    public function up()
    {
        Schema::create('material_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from');
            $table->integer('to');
            $table->integer('material_id');
            $table->integer('quantity');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('material_transactions');
    }
}
