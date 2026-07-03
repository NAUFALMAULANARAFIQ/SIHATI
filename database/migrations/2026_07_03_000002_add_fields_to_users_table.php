<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('bidang_id')->nullable()->constrained('bidangs')->nullOnDelete();
            $table->string('username', 50)->unique()->after('name');
            $table->string('no_hp', 20)->nullable()->after('email');
            $table->string('role', 20)->default('pegawai')->after('no_hp');
            $table->boolean('is_active')->default(true)->after('role');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['bidang_id']);
            $table->dropColumn(['bidang_id', 'username', 'no_hp', 'role', 'is_active']);
        });
    }
};
