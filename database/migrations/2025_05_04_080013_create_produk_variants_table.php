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
        Schema::create('produk_variants', function (Blueprint $table) {
            $table->id();
            $table->string('variant');
            $table->foreignId("produk_id");
            $table->integer('harga');
            $table->foreign('produk_id', 'produk_id_fk')->references('id')->on('products')->onDelete('cascade');
            $table->string('foto');
            $table->timestamps();
            $table->index(['variant', 'id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_variants');
    }
};
