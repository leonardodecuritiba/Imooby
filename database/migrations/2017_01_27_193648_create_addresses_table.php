<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //lat DECIMAL(10, 8) NOT NULL, lng DECIMAL(11, 8) NOT NULL
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('lat', 10, 8)->nullable();
            $table->decimal('lng', 11, 8)->nullable();
            $table->string('zip', 16)->nullable();
            $table->string('state', 72)->nullable();
            $table->string('city', 60)->nullable();
            $table->string('district', 72)->nullable();
            $table->string('street', 125)->nullable();
            $table->string('number', 7)->nullable();
            $table->string('complement', 50)->nullable();
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
        Schema::dropIfExists('addresses');
    }
}
