<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUlasansTable extends Migration
{
    public function up()
    {
        Schema::create('ulasans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // ID Penyewa
            $table->foreignId('kamar_id')->constrained()->cascadeOnDelete(); // ID Kamar
            $table->integer('rating'); // Bintang 1-5
            $table->text('komentar');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ulasans');
    }
}