<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idvisits_status');
            $table->foreign('idvisits_status')->references('id')->on('visits_statuses')->onDelete('cascade');
            $table->unsignedInteger('idvisitor');
            $table->foreign('idvisitor')->references('id')->on('clients')->onDelete('cascade');
            $table->unsignedInteger('idproperty');
            $table->foreign('idproperty')->references('id')->on('properties')->onDelete('cascade');
            $table->unsignedInteger('idcanceler')->nullable();
            $table->foreign('idcanceler')->references('id')->on('clients')->onDelete('cascade');
            $table->unsignedInteger('idparent')->nullable();
            $table->foreign('idparent')->references('id')->on('visits')->onDelete('cascade');

            $table->dateTime('date_time')->nullable();
            $table->string('visitor_message', 200)->nullable();
            $table->dateTime('visitor_confirmation')->nullable();
            $table->string('visited_message', 200)->nullable();
            $table->dateTime('visited_confirmation')->nullable();
            $table->string('cancelation_reason', 200)->nullable();
            $table->dateTime('cancelation')->nullable();
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
        Schema::dropIfExists('visits');
    }
}
