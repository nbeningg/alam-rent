<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('category');
            $table->unsignedBigInteger('product_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('return_date')->nullable();
            $table->string('return_proof')->nullable();
            $table->timestamps();
            $table->integer('total_price');
            $table->string('status');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
