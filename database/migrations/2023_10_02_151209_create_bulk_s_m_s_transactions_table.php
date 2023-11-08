<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBulkSMSTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bulk_s_m_s_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('company_id');
            $table->string('title');
            $table->string('description');
            $table->string('sender');
            $table->longText('message');
            $table->longText('recipient');
            $table->decimal('amount');
            $table->integer('status');
            $table->string('status_code');
            $table->string('scheduled_for')->nullable();
            $table->string('before');
            $table->string('after')->nullable();
            $table->string('admin_before')->nullable();
            $table->string('admin_after')->nullable();
            $table->string('message_type');
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
        Schema::dropIfExists('bulk_s_m_s_transactions');
    }
}
