<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitor_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitor_session_id')->constrained('visitor_sessions')->cascadeOnDelete();
            $table->string('method', 10)->nullable();
            $table->text('url');
            $table->string('path');
            $table->text('query_string')->nullable();
            $table->string('route_name')->nullable()->index();
            $table->string('controller_action')->nullable();
            $table->unsignedSmallInteger('http_status')->nullable();
            $table->unsignedInteger('duration_ms')->nullable();
            $table->text('referrer')->nullable();
            $table->string('ip_address', 45)->nullable()->index();
            $table->boolean('is_ajax')->default(false);
            $table->json('payload')->nullable();
            $table->timestamp('visited_at')->nullable()->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitor_events');
    }
};
