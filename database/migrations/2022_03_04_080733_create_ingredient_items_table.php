<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id');
            $table->string('name');
            $table->string('purchase_price');
            $table->foreignId('category_id');
            $table->string('alert_qty');
            $table->foreignId('ingredient_id');
            $table->string('code');
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
        Schema::dropIfExists('ingredient_items');
    }
}
