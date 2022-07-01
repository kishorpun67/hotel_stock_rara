<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('waiter_id')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('book_room_id')->nullable();
            $table->unsignedBigInteger('swimming_id')->nullable();
            $table->unsignedBigInteger('rafting_id')->nullable();
            $table->unsignedBigInteger('camping_id')->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->integer('total');
            $table->integer('subt_total');
            $table->integer('service_charge');
            $table->integer('tax');
            $table->integer('discount');
            $table->integer('paid');
            $table->integer('due');
            $table->string('status');
            // $table->foreign('admin_id')->references('id')->on('admins')->onDelete(null);
            // $table->foreign('customer_id')->references('id')->on('customers')->onDelete(null);
            // $table->foreign('waiter_id')->references('id')->on('admins')->onDelete(null);
            // $table->foreign('order_id')->references('id')->on('orders')->onDelete(null);
            // $table->foreign('book_room_id')->references('id')->on('book_rooms')->onDelete(null);
            // $table->foreign('swimming_id')->references('id')->on('swimming_pools')->onDelete(null);
            // $table->foreign('rafting_id')->references('id')->on('raftings')->onDelete(null);
            // $table->foreign('payment_id')->references('id')->on('payment_methods')->onDelete(null);
            // $table->foreign('camping_id')->references('id')->on('rent_tents')->onDelete(null);

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
        Schema::dropIfExists('all_activities');
    }
}
