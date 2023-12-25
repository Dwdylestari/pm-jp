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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('product_uuid')->primary()->nullable(false)->autoIncrement(false);
            $table->uuid('product_product_category_uuid')->nullable(false);
            $table->string('product_name', 150)->nullable(false);
            $table->float('product_weight')->nullable(false);
            $table->integer('product_price')->nullable(false);
            $table->integer('product_stock')->nullable(false);
            $table->string('product_img', 255)->nullable(false);
            $table->timestamps();

            $table->foreign('product_product_category_uuid', 'fk_product_product_category_uuid')->references('product_category_uuid')->on('product_categories')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
