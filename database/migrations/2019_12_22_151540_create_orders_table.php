<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('status');

            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            $table->text('comment')->nullable();
            $table->timestamps();
        });

        Schema::create('orders_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_order')->unsigned()->nullable();
            $table->foreign('id_order')->references('id')->on('orders')->onDelete('set null');

            $table->bigInteger('id_product')->unsigned()->nullable();
            $table->foreign('id_product')->references('id')->on('products')->onDelete('set null');

            $table->string('measure');
            $table->float('count');

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
        Schema::dropIfExists('orders_products');
        Schema::dropIfExists('orders');
    }
}
