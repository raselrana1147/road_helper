<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('password');
            $table->string('blood_group');
            $table->string('nid')->nullable()->unique();
            $table->string('passport')->nullable()->unique();
            $table->text('address')->nullable();
            $table->string('dob')->nullable();
            $table->string('avatar')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('mobile_otp')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->tinyInteger('is_paid')->default('1')->comment('1=Unpaid,2=Paid');
            $table->tinyInteger('is_active')->default('1')->comment('1=Inactive,2=Active');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
