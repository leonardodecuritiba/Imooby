<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNegociationAssignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negociation_assigns', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idnegociation');
            $table->foreign('idnegociation')->references('id')->on('negociations')->onDelete('cascade');

            $table->boolean('owner');
            $table->string('name', 100);
            $table->string('email', 60);
            $table->string('cpf', 16);

            $table->date('birthday');

            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('negociation_assigns');
    }
}
