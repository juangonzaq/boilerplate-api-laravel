<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionDestinationsTable extends Migration
{
    public function up()
    {
        Schema::create('transaction_destinations', function (Blueprint $table) {
            $table->increments('id');

            $table->string('transaction_code');

            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedInteger('destination_id');
            $table->foreign('destination_id')->references('id')->on('destinations');

            $table->enum('status', [0, 1])->comment('0: eliminado, 1: seleccionado')->default(0);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaction_destinations');
    }
}
