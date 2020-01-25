<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNegociationDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negociation_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idnegociation');
            $table->foreign('idnegociation')->references('id')->on('negociations')->onDelete('cascade');

            $table->boolean('owner')->default(0);
            $table->string('name', 100);
            $table->string('email', 60);
            $table->string('cpf', 16);

            //documentation only for renter
            $table->string('phone', 11)->nullable();
            $table->string('cellphone', 11)->nullable();
            $table->string('income_nature', 50)->nullable(); //Natureza da Renda
            $table->decimal('gross_income', 11, 2)->default(0); //Rendimento Bruto Mensal
            $table->string('reason', 50)->nullable(); //Motivo da Locação
            $table->string('civil_status', 50)->nullable(); //Estado Cívil

            //documentation
            $table->string('doc_link', 100);
            $table->string('cpf_link', 100);
            $table->string('address_proof_link', 100);
            $table->string('income_proof_link', 100)->nullable();

            $table->boolean('status')->default(0);
            
            $table->string('iptu_code', 128)->nullable();
            $table->string('iptu_registration', 128)->nullable();

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
        Schema::dropIfExists('negociation_documents');
    }
}
