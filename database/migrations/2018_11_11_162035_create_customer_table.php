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
            $table->string('PhoneNumber')->nullable();
            $table->string('postcode')->nullable()->comment('郵便番号');
            $table->string('address')->nullable()->comment('住所');
            $table->string('userAgent')->nullable()->comment('ユーザーエージェント');
            $table->string('creditCardType')->nullable()->comment('カードの種類');
            $table->string('creditCardNumber')->nullable();
            $table->string('creditCardExpirationDate')->nullable();
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
