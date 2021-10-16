<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTouringPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('touring_places', function (Blueprint $table) {
           $table->id();
           $table->string('place_name');
           $table->string('email');
           $table->string('help_number');
           $table->unsignedInteger('division_id');
           $table->unsignedInteger('district_id');
           $table->string('image')->nullable();
           $table->text('address');
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
        Schema::dropIfExists('touring_places');
    }
}
