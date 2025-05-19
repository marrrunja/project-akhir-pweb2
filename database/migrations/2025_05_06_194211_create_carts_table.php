<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pembeli_id');
            $table->unsignedBigInteger('variant_id');
            $table->integer('qty')->default(1);
            $table->timestamps();
            $table->foreign('pembeli_id')->references('id')->on('pembelis')->onDelete('cascade');
            $table->foreign('variant_id')->references('id')->on('produk_variants')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
