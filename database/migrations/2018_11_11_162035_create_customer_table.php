<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->increments('customer_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('phone_number')->nullable();
            $table->string('postcode')->nullable()->comment('郵便番号');
            $table->string('address')->nullable()->comment('住所');
            $table->string('user_agent')->nullable()->comment('ユーザーエージェント');
            $table->string('credit_card_type')->nullable()->comment('カードの種類');
            $table->string('credit_card_number')->nullable();
            $table->string('credit_card_expiration_date')->nullable();
            $table->timestamp('last_login_at')->nullable()->comment('最終ログイン日時');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer');
    }
}
