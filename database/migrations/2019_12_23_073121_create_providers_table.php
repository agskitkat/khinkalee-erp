<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('email');
            $table->text('name');
            $table->text('excel_rules');
            $table->timestamps();
        });

        Schema::create('provider_goods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('providers_id')->unsigned();
            $table->foreign('providers_id')->references('id')->on('providers')->onDelete('cascade');
            $table->string('article', 255)->unique();
            $table->text('name');
            $table->string('measure', 255);
            $table->integer('divider');
            $table->bigInteger('mass');
            $table->float('price');
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
        Schema::dropIfExists('providers');
    }
}
