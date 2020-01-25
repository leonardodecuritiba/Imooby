<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('iduser');
            $table->foreign('iduser')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('idaddress');
            $table->foreign('idaddress')->references('id')->on('addresses')->onDelete('cascade');
            $table->unsignedInteger('idcontact');
            $table->foreign('idcontact')->references('id')->on('contacts')->onDelete('cascade');
            $table->unsignedInteger('idphoto')->nullable();
            $table->foreign('idphoto')->references('id')->on('photos')->onDelete('cascade');

            $table->string('name', 100);
            $table->string('about', 500)->nullable();
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
        Schema::dropIfExists('clients');
    }
}
