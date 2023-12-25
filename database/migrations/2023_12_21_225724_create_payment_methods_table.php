<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('paymentmethods', function (Blueprint $table) {
            $table->uuid('paymentmethod_uuid')->primary()->nullable(false)->autoIncrement(false);
            $table->uuid('paymentmethod_user_uuid')->nullable(false);
            $table->uuid('paymentmethod_bank_uuid')->nullable(false);
            $table->char('paymentmethod_accountnumber',16)->nullable(false);
            $table->timestamps();

            $table->foreign('paymentmethod_user_uuid', 'fk_paymentmethod_user_uuid')->references('user_uuid')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('paymentmethod_bank_uuid', 'fk_paymentmethod_bank_uuid')->references('bank_uuid')->on('banks')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
