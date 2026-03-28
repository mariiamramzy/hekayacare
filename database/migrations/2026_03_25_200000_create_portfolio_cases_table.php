<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolio_cases', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title_ar');
            $table->string('card_sub_title')->nullable();
            $table->text('excerpt_ar')->nullable();
            $table->foreignId('cover_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->foreignId('main_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->string('intro_heading')->nullable();
            $table->longText('intro_text')->nullable();
            $table->foreignId('secondary_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->string('points_heading')->nullable();
            $table->text('points_text')->nullable();
            $table->text('point_one_ar')->nullable();
            $table->text('point_two_ar')->nullable();
            $table->text('point_three_ar')->nullable();
            $table->longText('closing_text')->nullable();
            $table->string('case_label')->nullable();
            $table->date('started_at')->nullable();
            $table->string('location_ar')->nullable();
            $table->string('client_name_ar')->nullable();
            $table->string('duration_ar')->nullable();
            $table->foreignId('sidebar_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_cases');
    }
};
