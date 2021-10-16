<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaidUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paid_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedinteger('user_id');
            $table->unsignedinteger('payment_id');
            $table->string('transaction_number');
            $table->float('amount',11,2)->nullable();
            $table->timestamp('paided_at')->nullable();
            $table->timestamp('expired_at')->nullable();
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
        Schema::dropIfExists('paid_users');
    }
}
