<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('bookings', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('kamar_id')->constrained()->onDelete('cascade');
    $table->string('nama_lengkap');
    $table->text('alamat_asal');
    $table->string('no_telp');
    $table->date('tanggal_masuk');
    $table->decimal('total_biaya', 12, 2);
    $table->enum('status_pembayaran', ['Pending', 'Lunas', 'Ditolak'])->default('Pending');
    $table->string('bukti_transfer')->nullable();
    $table->timestamps();
});
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
