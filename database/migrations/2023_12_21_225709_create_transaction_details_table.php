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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->uuid('transaction_detail_uuid')->primary()->nullable(false)->autoIncrement(false);
            $table->uuid('transaction_detail_transaction_uuid')->nullable(false);
            $table->uuid('transaction_detail_product_uuid')->nullable(false);
            $table->integer('transaction_detail_quantity')->nullable(false);
            $table->integer('transaction_detail_totalprice')->nullable(false);
            $table->timestamps();

            $table->foreign('transaction_detail_transaction_uuid', 'fk_transcation_detail_transaction_uuid')->references('transaction_uuid')->on('transactions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('transaction_detail_product_uuid', 'fk_transaction_detail_product_uuid')->references('product_uuid')->on('products')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
