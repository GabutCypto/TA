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
        Schema::create('bayar_sumbangans', function (Blueprint $table) {
            $table->id();
            $table->string('bukti');
            $table->foreignId('santri_id')->constrained()->onDelete('cascade');
            $table->foreignId('sumbangan_id')->constrained()->onDelete('cascade');
            $table->boolean('dibayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bayar_sumbangans');
    }
};