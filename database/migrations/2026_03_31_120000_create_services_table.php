<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title_ar');
            $table->string('page_title_ar')->nullable();
            $table->text('short_description')->nullable();
            $table->text('meta_description_ar')->nullable();
            $table->string('icon_class')->nullable();
            $table->string('service_type')->nullable();
            $table->foreignId('image_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->foreignId('gallery_image_one_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->foreignId('gallery_image_two_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->foreignId('gallery_image_three_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->text('highlights_intro')->nullable();
            $table->json('card_points')->nullable();
            $table->json('highlights')->nullable();
            $table->json('tabs')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
