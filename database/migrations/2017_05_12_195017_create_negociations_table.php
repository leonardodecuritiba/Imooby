<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNegociationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negociations', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('idstatus_negociation');
            $table->foreign('idstatus_negociation')->references('id')->on('status_negociations')->onDelete('cascade');
            $table->unsignedInteger('idrenter');
            $table->foreign('idrenter')->references('id')->on('clients')->onDelete('cascade');
            $table->unsignedInteger('idproperty');
            $table->foreign('idproperty')->references('id')->on('properties')->onDelete('cascade');

            $table->decimal('rental', 11, 2)->default(0);
            $table->decimal('fee', 11, 2)->default(0);
            $table->decimal('condominium', 11, 2)->default(0);
            $table->decimal('iptu', 11, 2)->default(0);

            $table->boolean('income_proof')->default(0);
            $table->string('residents', 500)->nullable();
            $table->date('date_change')->nullable();
            $table->boolean('animals')->default(0);
            $table->string('renter_conditions', 500)->nullable();

            $table->boolean('owner_accept_conditions')->default(0);
            $table->boolean('renter_accept_conditions')->default(0);

            $table->string('signature_document_uuid', 128)->nullable();
            
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
        Schema::dropIfExists('negociations');
    }
}
