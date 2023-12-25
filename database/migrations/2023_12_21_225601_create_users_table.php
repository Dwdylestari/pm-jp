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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('user_uuid')->primary()->nullable(false)->autoIncrement(false);
            $table->string('user_name', 100)->nullable(false);
            $table->string('user_username', 50)->nullable(false)->unique();
            $table->char('user_phonenumber', 13)->nullable(false)->unique();
            $table->string('user_email', 150)->nullable(false)->unique();
            $table->string('user_password', 255)->nullable(false);
            $table->boolean('user_isadmin')->nullable(false)->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
