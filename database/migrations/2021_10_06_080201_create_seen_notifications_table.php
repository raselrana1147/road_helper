<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeenNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seen_notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('notification_id');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('seen_or_unseen')->nullable();
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
        Schema::dropIfExists('seen_notifications');
    }
}
