<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailpaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailpays', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->decimal('amount',20,2);
            $table->string('narration');
            $table->string('phone');
            $table->string('sender_name');
            $table->integer('status')->default(0);
            $table->string('date');
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
        Schema::dropIfExists('mailpays');
    }
}
