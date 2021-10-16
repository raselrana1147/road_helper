<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmbulancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambulances', function (Blueprint $table) {
           $table->id();
           $table->string('compapny_name');
           $table->string('ambulance_number');
           $table->string('email');
           $table->string('driver_name');
           $table->unsignedInteger('division_id');
           $table->unsignedInteger('district_id');
           $table->string('help_number');
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
        Schema::dropIfExists('ambulances');
    }
}
