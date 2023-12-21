<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiveawaySchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giveaway_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->nullable();    
            $table->integer('user_id')->nullable();    
            $table->string('uid')->nullable();
            $table->integer('giveaway_id');
            $table->string('name');
            $table->string('participant_id')->nullable();
            $table->string('phone')->nullable();
            $table->integer('network')->nullable();
            $table->longText('plan_name')->nullable();        
            $table->integer('plan_id')->nullable();
            $table->string('type');
            $table->string('account_name')->nullable();
            $table->string('account_no')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_code')->nullable();
            $table->decimal('amount')->nullable();
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
        Schema::dropIfExists('giveaway_schedules');
    }
}
