<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idowner');
            $table->foreign('idowner')->references('id')->on('clients')->onDelete('cascade');
            $table->unsignedInteger('idproperties_type');
            $table->foreign('idproperties_type')->references('id')->on('properties_types')->onDelete('cascade');
            $table->unsignedInteger('idaddress');
            $table->foreign('idaddress')->references('id')->on('addresses')->onDelete('cascade');

            $table->string('title', 100);
            $table->string('description', 1000);

            $table->decimal('price_rental', 11, 2)->default(0);
            $table->decimal('price_condominium', 11, 2)->default(0);
            $table->decimal('price_iptu', 11, 2)->default(0);
            $table->decimal('price_fee', 11, 2)->default(0);
            $table->decimal('price_total', 11, 2)->default(0);

            $table->tinyInteger('bedroom_n');
            $table->tinyInteger('bathroom_n')->nullable();
            $table->tinyInteger('garage_n')->nullable();
            $table->decimal('internal_area', 11, 2);
            $table->decimal('external_area', 11, 2)->default(0);
            $table->boolean('reception')->default(0);
            $table->boolean('air_conditioning')->default(0);
            $table->boolean('outdoor_pool')->default(0);
            $table->boolean('garden')->default(0);
            $table->boolean('fireplace')->default(0);
            $table->boolean('animals')->default(0);
            $table->boolean('playground')->default(0);
            $table->boolean('hydro')->default(0);
            $table->boolean('grill')->default(0);
            $table->boolean('laundry')->default(0);
            $table->boolean('furnished')->default(0);
            $table->boolean('suite')->default(0);
            $table->boolean('status')->default(0);
            $table->timestamp('validated_at')->nullable();
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
        Schema::dropIfExists('properties');
    }
}
