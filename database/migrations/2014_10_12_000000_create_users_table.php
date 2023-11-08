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
            $table->string('brand_name');
            $table->integer('company_id')->nullable();
            $table->string('logo')->nullable();
            $table->string('description')->nullable();
            $table->string('uuid');
            $table->string('type')->default(0);
            $table->integer('selected_theme')->default(1);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('pin')->nullable();
            $table->string('phone')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_no')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('balance')->default(0);
            $table->string('total_spent')->default(0);
            $table->string('user_type')->default('user');
            $table->string('brand_color')->nullable();
            $table->string('font_family')->nullable();
            $table->string('heading_1')->nullable();
            $table->string('heading_2')->nullable();
            $table->string('sub_heading_1')->nullable();
            $table->string('sub_heading_2')->nullable();
            $table->string('about_us')->nullable();
            $table->string('address')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
           
         
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
