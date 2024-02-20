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
        Schema::create('katalog', function (Blueprint $table) {
            $table->string("id_katalog", 6)->nullable(false)->unique("katalog_id_unique");
            $table->string("nama", 100)->nullable(false);
            $table->string("image", 200)->nullable();
            $table->longText("desc")->nullable(false);
            $table->integer("harga")->nullable(false);
            $table->integer("stok")->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('katalog');

    }
};
