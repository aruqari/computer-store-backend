<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_service', function (Blueprint $table) {
            $table->string("id_detail_service", 6)->nullable(false)->unique("detail_service_id_unique");
            $table->string("id_user", 6)->nullable(false);
            $table->string("nama_perangkat", 200)->nullable(false);
            $table->LongText("keluhan")->nullable(false);
            $table->LongText("catatan_teknisi")->nullable(false);
            $table->integer("harga", )->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_service');
    }
};
