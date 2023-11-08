<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_recipients', function (Blueprint $table) {
            $table->id();
            $table->string('uid');
            $table->integer('group_id');
            $table->string('name');
            $table->string('phone');
            $table->string('network');
            $table->integer('plan_id');
            $table->longText('plan_name');
            $table->decimal('amount')->nullable();
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
        Schema::dropIfExists('data_recipients');
    }
}
