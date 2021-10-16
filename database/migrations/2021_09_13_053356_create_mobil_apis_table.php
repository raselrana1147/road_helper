<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobilApisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobil_apis', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->string('sender');
            $table->string("api_url");
            $table->string('country_code');
            $table->string("country_name");
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
        Schema::dropIfExists('mobil_apis');
    }
}
