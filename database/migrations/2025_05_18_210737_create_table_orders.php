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
        Schema::create('table_orders', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_transaksi');
            $table->foreignId("pembeli_id", "pembeli_id_order_fk")->references('id')->on('pembelis'); 
            $table->boolean('is_dibayar')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_orders');
    }
};
