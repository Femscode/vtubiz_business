<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiveAwayContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('give_away_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->integer('giveaway_id');
            $table->string('name');
            $table->string('phone');
            $table->integer('is_win')->default(0);
            $table->integer('lucky_number')->nullable();
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
        Schema::dropIfExists('give_away_contacts');
    }
}
