<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedInteger('destination_origin_id')->nullable();
            $table->foreign('destination_origin_id')->references('id')->on('destinations');

            $table->string('code')->unique()->nullable();
            $table->string('payment_method')->nullable();
            $table->double('price_insurance')->nullable();
            $table->double('total_insurance')->nullable();
            $table->datetime('date_expiration')->nullable();
            $table->double('price_delete_destination')->nullable();
            $table->double('total_delete_destination')->nullable();
            $table->double('price_per_person')->nullable();
            $table->integer('qty_travelers')->nullable();
            $table->integer('qty_days')->nullable();
            $table->double('price_limit_schedule_flight')->nullable();
            $table->double('flag_limit_flight')->nullable();
            $table->datetime('date_start')->nullable();
            $table->datetime('date_end')->nullable();
            $table->char('season_type', 1)->nullable();
            $table->enum('flight_schedule_start', ['morning', 'night'])->nullable();
            $table->enum('flight_schedule_back', ['morning', 'night'])->nullable();
            $table->integer('qty_unwanted_destinations')->nullable();
            $table->double('total_unwanted_destinations')->nullable();
            $table->string('subject')->nullable()->default('Viaje KANGOO');
            $table->double('price_coupon')->nullable();
            $table->string('value_coupon')->nullable();
            $table->enum('type_passage', ['normal', 'premium'])->default('normal');
            $table->double('price_passage')->nullable();
            $table->enum('status', [0, 1, 2])->comment('0: incomplete, 1:complete, 2: terminado, 3: asignado')->default(0);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
