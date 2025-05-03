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
        //heheehe
        Schema::create('pembelis', function (Blueprint $table) {
            $table->id();
            $table->string("username",50)->unique();
            $table->string("password",255);
            $table->string('kode_desa');
            $table->string('jalan');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('pembelis');
    }
};
