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
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->string("id_pelanggan", 6)->nullable(false)->unique("pelanggan_id_unique");
            $table->string("nama", 30)->nullable(false);
            $table->string("no_telp", 20)->nullable(false)->unique("pelanggan_telp_unique");
            $table->string("email", 50)->nullable(false)->unique("pelanggan_email_unique");
            $table->longText("alamat")->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan');

    }
};
