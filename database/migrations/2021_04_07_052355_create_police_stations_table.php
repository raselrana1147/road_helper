<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoliceStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('police_stations', function (Blueprint $table) {
            $table->id();
            $table->string('station_name');
            $table->unsignedInteger('division_id');
            $table->unsignedInteger('district_id');
            $table->string('help_number');
            $table->string('fax');
            $table->string('email');
            $table->string('latitute');
            $table->string('logitute');
            $table->string('address');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('police_stations');
    }
}
