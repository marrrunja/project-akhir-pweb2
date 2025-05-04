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
            // $table->foreignId('kecamatan_id');
            // $table->foreign('kecamatan_id', 'kecamatan_id_FK')->references('id')->on('table_kecamatans');
            $table->foreignId("produk_id");
            $table->foreign('produk_id', 'produk_id_fk')->references('id')->on('products');
            $table->timestamps();
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
