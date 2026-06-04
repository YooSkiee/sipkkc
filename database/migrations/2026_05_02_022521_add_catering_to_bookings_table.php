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
    Schema::table('bookings', function (Blueprint $table) {
        // Gunakan nama kolom 'total_biaya' sesuai database kamu
        // Jika kolom belum ada, gunakan ->after('kolom_sebelumnya')
        $table->decimal('total_biaya', 15, 2)->change(); 
        
        // Tambahkan kolom catering jika memang ingin menambahkannya di sini
        $table->string('paket_catering')->nullable()->after('total_biaya');
        $table->integer('durasi_catering')->nullable()->after('paket_catering');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            //
        });
    }
};
