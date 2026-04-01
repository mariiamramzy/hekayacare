<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_leads', function (Blueprint $table) {
            $table->string('address')->nullable()->after('mobile');
            $table->string('gender', 50)->nullable()->after('address');
            $table->string('is_patient', 10)->nullable()->after('gender');
            $table->string('service_type', 100)->nullable()->after('is_patient');
        });
    }

    public function down(): void
    {
        Schema::table('contact_leads', function (Blueprint $table) {
            $table->dropColumn([
                'address',
                'gender',
                'is_patient',
                'service_type',
            ]);
        });
    }
};
