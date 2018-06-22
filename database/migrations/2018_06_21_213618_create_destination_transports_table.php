<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDestinationTransportsTable extends Migration
{
    public function up()
    {
        Schema::create('destination_transports', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('destination_id')->nullable();
            $table->foreign('destination_id')->references('id')->on('destinations');

            $table->unsignedInteger('transport_id')->nullable();
            $table->foreign('transport_id')->references('id')->on('transports');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('destination_transports');
    }
}
