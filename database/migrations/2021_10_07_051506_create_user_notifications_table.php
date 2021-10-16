<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_notifications', function (Blueprint $table) {

            $table->id();
            $table->unsignedInteger('notify_from')->nullable();
            $table->unsignedInteger('notify_to')->nullable();
            $table->unsignedInteger('notification_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('blood_request_id')->nullable();
            $table->string('title')->nullable();
            $table->string('type')->nullable();
            $table->tinyInteger('seen_or_unseen')->default(0)->comment('0=unseen,1=seen');
            $table->integer('needed_blood')->default(0);
            $table->integer('collected_blood')->default(0);
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
        Schema::dropIfExists('user_notifications');
    }
}
