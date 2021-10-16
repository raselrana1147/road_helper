<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePushNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('push_notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('notify_from')->nullable();
            $table->unsignedInteger('notify_to')->nullable();
            $table->unsignedInteger('blood_request_id')->nullable();
            $table->string('title')->nullable();
            $table->string('type')->nullable();
            $table->tinyInteger('status')->default(1)->comment("1=pending,2=accept,3=cancel");
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
        Schema::dropIfExists('push_notifications');
    }
}
