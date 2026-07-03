<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aduans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_tiket', 30)->unique();
            $table->foreignId('pelapor_id')->constrained('users');
            $table->foreignId('petugas_id')->nullable()->constrained('users');
            $table->foreignId('bidang_id')->constrained('bidangs');
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('priority_id')->nullable()->constrained('priorities');
            $table->foreignId('status_id')->constrained('statuses');
            $table->string('judul', 150);
            $table->text('deskripsi');
            $table->string('lokasi', 150)->nullable();
            $table->string('no_kontak', 20)->nullable();
            $table->timestamp('tanggal_aduan');
            $table->timestamp('tanggal_diterima')->nullable();
            $table->timestamp('tanggal_diproses')->nullable();
            $table->timestamp('tanggal_selesai')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aduans');
    }
};
