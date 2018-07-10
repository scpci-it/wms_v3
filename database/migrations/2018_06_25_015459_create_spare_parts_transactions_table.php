<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSparePartsTransactionsTable extends Migration
{
    
    public function up()
    {
        Schema::create('spare_parts_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from');
            $table->integer('to');
            $table->integer('spare_parts_id');
            $table->integer('quantity');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('spare_parts_transactions');
    }
}
