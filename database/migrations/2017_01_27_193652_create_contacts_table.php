<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone', 11)->nullable();
            $table->string('cellphone', 11)->nullable();
            $table->string('skype', 100)->nullable();
            $table->string('facebook', 100)->nullable();
            $table->string('google_plus', 100)->nullable();
            $table->string('pinterest', 100)->nullable();
            $table->string('twitter', 100)->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
