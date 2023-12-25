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
        Schema::create('transaction_deliveries', function (Blueprint $table) {
            $table->uuid('transaction_delivery_uuid')->primary()->nullable(false)->autoIncrement(false);
            $table->uuid('transaction_delivery_transaction_uuid')->nullable(false);
            $table->string('transaction_delivery_province', 50)->nullable(false);
            $table->string('transaction_delivery_city', 50)->nullable(false);
            $table->string('transaction_delivery_address', 255)->nullable(false);
            $table->float('transaction_delivery_weight')->nullable(false);
            $table->string('transaction_delivery_service', 50)->nullable(false);
            $table->integer('transaction_delivery_shippingcost')->nullable(false);
            $table->timestamps();

            $table->foreign('transaction_delivery_transaction_uuid', 'fk_transaction_delivery_transaction_uuid')->references('transaction_uuid')->on('transactions')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_deliveries');
    }
};
