<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTransactionsTable extends Migration
{
    
    public function up()
    {
        Schema::create('product_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('from');
            $table->string('to');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->date('exp_date');
            $table->string('lot_no');
            $table->string('remarks');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('product_transactions');
    }
}
