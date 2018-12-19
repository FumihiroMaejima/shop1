<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnNamePhonenumber extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer', function (Blueprint $table) {
            $table->renameColumn('PhoneNumber', 'phone_number');
            $table->renameColumn('userAgent', 'user_agent');
            $table->renameColumn('creditCardType', 'credit_card_type');
            $table->renameColumn('creditCardNumber', 'credit_card_number');
            $table->renameColumn('creditCardExpirationDate', 'credit_card_expiration_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer', function (Blueprint $table) {
            Schema::dropIfExists('customer');
        });
    }
}
