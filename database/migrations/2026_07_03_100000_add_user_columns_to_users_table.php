<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username', 50)->unique()->after('name');
            }
            if (!Schema::hasColumn('users', 'no_hp')) {
                $table->string('no_hp', 20)->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role', 20)->default('pegawai')->after('no_hp');
            }
            if (!Schema::hasColumn('users', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('role');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'no_hp', 'role', 'is_active']);
        });
    }
};
