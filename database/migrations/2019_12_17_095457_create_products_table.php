<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->string('sort');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_product_group')->unsigned()->nullable();
            $table->foreign('id_product_group')->references('id')->on('product_groups')->onDelete('set null');
            $table->string('name');
            $table->string("strong_rel")->nullable();
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
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_groups');
    }
}
