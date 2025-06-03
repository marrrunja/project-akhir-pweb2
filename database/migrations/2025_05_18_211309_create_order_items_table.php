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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
              $table->foreignId("variant_id", "variant_order_item_fk")
                ->references('id')
                ->on('produk_variants')->onDelete('cascade');
            $table->foreignId("order_id", "order_order_item_fk")
                ->references('id')
                ->on('table_orders')->onDelete('cascade');
            $table->integer('jumlah');
            $table->double('total_harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
