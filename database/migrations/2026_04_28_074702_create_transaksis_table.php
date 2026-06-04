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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('kamar_id')->constrained('kamars');
            $table->foreignId('catering_id')->nullable()->constrained('caterings');
            $table->date('tanggal');
            $table->integer('lama_sewa');
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->decimal('total_bayar', 15, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
