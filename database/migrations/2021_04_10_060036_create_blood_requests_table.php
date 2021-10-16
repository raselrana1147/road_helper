<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('requester_id');
            $table->string('hospital_name');
            $table->text('address');
            $table->string('phone');
            $table->string('blood_group');
            $table->integer('needed_blood')->default(0);
            $table->integer('collected_blood')->default(0);
            $table->text('when_needed');
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
        Schema::dropIfExists('blood_requests');
    }
}
