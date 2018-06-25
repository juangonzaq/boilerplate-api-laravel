<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigurationTable extends Migration
{
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('min_travelers');
            $table->integer('max_travelers');
            $table->double('price_per_person');
            $table->double('price_limit_flight');
            $table->double('price_insurance');
            $table->double('price_delete_destination');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('configurations');
    }
}
