<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('caterings', function (Blueprint $table) {
        $table->id();
        $table->string('nama_menu'); // PASTIKAN KOLOM INI ADA
        $table->integer('harga');
        $table->text('deskripsi')->nullable();
        $table->string('hari');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caterings');
    }
};
