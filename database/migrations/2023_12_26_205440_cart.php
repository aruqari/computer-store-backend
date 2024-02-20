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
        Schema::create('cart', function (Blueprint $table) {
            $table->increments("id")->nullable(false)->unique("cart_id_unique");
            $table->string("id_user", 6)->nullable(false);
            $table->string("id_katalog", 6)->nullable(false);
            $table->integer("qty")->nullable(false);
            $table->integer("subtotal")->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');

    }
};
