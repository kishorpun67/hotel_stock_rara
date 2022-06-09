<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->string('name');
            $table->string('address');
            $table->string('contact');
            $table->string('pax');
            $table->string('room_type');
            $table->string('room_no');
            $table->string('travel_agent');
            $table->string('id_card');
            $table->string('additional_charge');
            $table->string('discount');
            $table->string('advance');
            $table->string('arrival_date');
            $table->string('arrival_time');
            $table->string('department')->unique();
            $table->string('department_time');
            $table->timestamps();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkouts');
    }
}
