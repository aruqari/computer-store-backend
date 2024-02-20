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
        Schema::create('detail_pembelian', function (Blueprint $table) {
            $table->increments("id_detail_pembelian")->nullable(false)->unique("detail_pembelian_id_unique");
            $table->integer("id_pembelian")->nullable(false);
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
        Schema::dropIfExists('detail_pembelian');
    }
};
