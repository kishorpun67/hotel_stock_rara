<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('customer_id')->default(0);
            $table->unsignedBigInteger('room_id')->default(0);
            $table->string('arrival_date');
            $table->string('arrival_time');
            $table->string('depature_date');
            $table->string('depature_time');
            $table->string('name');
            $table->string('address');
            $table->string('contact');
            $table->string('pax');
            $table->string('room_no');
            $table->string('travel_agent');
            $table->string('agent_name');
            $table->string('aditional_charge');
            $table->string('discount');
            $table->string('amount');
            $table->string('total');
            $table->string('paid');
            $table->string('due');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_rooms');
    }
}
