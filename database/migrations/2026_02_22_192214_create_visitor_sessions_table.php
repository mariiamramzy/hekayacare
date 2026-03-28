<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitor_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->unique();
            $table->string('ip_address', 45)->nullable()->index();
            $table->text('user_agent')->nullable();
            $table->string('accept_language')->nullable();
            $table->boolean('is_bot')->default(false);
            $table->string('device_type', 20)->default('unknown');

            $table->text('entry_url')->nullable();
            $table->string('entry_path')->nullable();
            $table->text('entry_referrer')->nullable();
            $table->string('referrer_domain')->nullable()->index();
            $table->string('landing_route')->nullable();

            $table->string('utm_source')->nullable()->index();
            $table->string('utm_medium')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->string('utm_term')->nullable();
            $table->string('utm_content')->nullable();

            $table->unsignedInteger('visit_count')->default(0);
            $table->unsignedInteger('page_views')->default(0);
            $table->timestamp('first_visit_at')->nullable()->index();
            $table->timestamp('last_visit_at')->nullable()->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitor_sessions');
    }
};
