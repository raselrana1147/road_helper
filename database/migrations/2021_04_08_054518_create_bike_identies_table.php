<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBikeIdentiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bike_identies', function (Blueprint $table) {
            $table->id();
            $table->string('bike_number')->unique();
            $table->string('driver_name');
            $table->string('license_number')->unique();
            $table->string('emergency_number_1')->nullable();
            $table->string('emergency_number_2')->nullable();
            $table->string('emergency_number_3')->nullable();
            $table->string('address')->nullable();
            $table->unsignedInteger('user_id')->nullable();
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
        Schema::dropIfExists('bike_identies');
    }
}
