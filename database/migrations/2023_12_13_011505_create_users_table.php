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
            $table->string("id_user", 6)->nullable(false)->unique("users_id_unique");
            $table->string("id_pelanggan", 6)->nullable();
            $table->string("role", 6)->nullable(false);
            $table->string("username", 20)->nullable(false)->unique("users_username_unique");
            $table->string("password", 255)->nullable(false);
            $table->string("token", 100)->nullable()->unique("users_token_unique");
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
