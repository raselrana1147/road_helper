<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodDonnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_donners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('notification_id');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('quantity');
            $table->timestamps();

            $table->foreign('notification_id')
            ->references('id')
            ->on('push_notifications')
            ->onDelete('cascade');

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blood_donners');
    }
}
