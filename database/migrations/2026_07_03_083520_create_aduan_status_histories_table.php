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
        Schema::create('aduan_status_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aduan_id')->constrained('aduans')->cascadeOnDelete();
            $table->foreignId('status_sebelumnya_id')->nullable()->constrained('statuses')->nullOnDelete();
            $table->foreignId('status_baru_id')->constrained('statuses');
            $table->foreignId('changed_by')->constrained('users')->cascadeOnDelete();
            $table->text('keterangan')->nullable();
            $table->timestamps();
            
            $table->index(['aduan_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aduan_status_histories');
    }
};
