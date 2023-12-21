<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiveAwaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('give_aways', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('slug')->unique();
            $table->string('type');
            $table->string('giveaway_type');
            $table->string('name');
            $table->integer('part_no')->nullable();
            $table->integer('no_of_winners')->nullable();
            $table->json('max_winners')->nullable();
            $table->json('lucky_numbers')->nullable();
            $table->json('lucky_numbers_confirm')->nullable();
            $table->json('all_numbers')->nullable();
            $table->string('data_price')->nullable();
            $table->string('airtime_price')->nullable();
            $table->decimal('estimated_amount');
            $table->integer('time')->nullable();
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
        Schema::dropIfExists('give_aways');
    }
}
