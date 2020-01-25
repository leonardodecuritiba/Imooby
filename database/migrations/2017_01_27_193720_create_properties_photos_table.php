<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idproperty');
            $table->foreign('idproperty')->references('id')->on('properties')->onDelete('cascade');
            $table->unsignedInteger('idphoto');
            $table->foreign('idphoto')->references('id')->on('photos')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties_photos');
    }
}
