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
        Schema::create('transaction_payments', function (Blueprint $table) {
            $table->uuid('transaction_payment_uuid')->primary()->nullable(false)->autoIncrement(false);
            $table->uuid('transaction_payment_transaction_uuid')->nullable(false);
            $table->uuid('transaction_payment_payment_method_uuid')->nullable(false);
            $table->enum('transaction_payment_status', ['Unpaid', 'Pending', 'Paid'])->nullable(false)->default('Unpaid');
            $table->timestamps();

            $table->foreign('transaction_payment_transaction_uuid', 'fk_transaction_payment_transaction_uuid')->references('transaction_uuid')->on('transactions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('transaction_payment_payment_method_uuid', 'fk_transaction_payment_payment_method_uuid')->references('paymentmethod_uuid')->on('paymentmethods')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_payments');
    }
};
