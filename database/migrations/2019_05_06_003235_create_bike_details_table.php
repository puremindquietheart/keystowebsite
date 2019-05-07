<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBikeDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('bike_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bike_name');
            $table->float('bike_price', 13, 2);
            $table->bigInteger('bike_quantity');
            $table->integer('bike_discount');
            $table->integer('bike_rating');
            $table->integer('bike_available');
            $table->dateTime('date_added');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bike_details');
    }
}
