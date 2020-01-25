<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoritePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorite_properties', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idowner');
            $table->foreign('idowner')->references('id')->on('clients')->onDelete('cascade');
            $table->unsignedInteger('idproperty');
            $table->foreign('idproperty')->references('id')->on('properties')->onDelete('cascade');
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
        Schema::dropIfExists('favorite_properties');
    }
}
