<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tutor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unsignedTinyInteger('rating')->comment('1–5');
            $table->string('mata_kuliah');
            $table->text('comment')->nullable();
            $table->string('nilai_sebelum', 10)->nullable()->comment('Nilai sebelum bimbingan');
            $table->string('nilai_sesudah', 10)->nullable()->comment('Nilai sesudah bimbingan');
            $table->text('reply')->nullable()->comment('Balasan dari tutor');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
