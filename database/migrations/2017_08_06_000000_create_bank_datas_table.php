<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->integer('bank_id')->nullable();
            $table->string('agency')->nullable();
            $table->tinyInteger('account_type')->nullable();
            $table->string('account_number')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('cpf')->nullable();
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
        Schema::dropIfExists('bank_datas');
    }
}
