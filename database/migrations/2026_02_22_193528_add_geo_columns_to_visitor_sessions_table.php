<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('visitor_sessions', function (Blueprint $table) {
            $table->string('country_code', 10)->nullable()->after('ip_address')->index();
            $table->string('country_name')->nullable()->after('country_code')->index();
            $table->string('city')->nullable()->after('country_name');
        });
    }

    public function down(): void
    {
        Schema::table('visitor_sessions', function (Blueprint $table) {
            $table->dropColumn(['country_code', 'country_name', 'city']);
        });
    }
};
