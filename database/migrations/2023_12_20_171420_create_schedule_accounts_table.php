<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('giveaway_id');
            $table->string('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('account_name');
            $table->string('account_no');
            $table->string('bank_name');
            $table->string('bank_code');
            $table->decimal('amount');
            $table->string('receipt')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('schedule_accounts');
    }
}
