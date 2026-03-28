<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('section_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_section_id')->constrained('page_sections')->cascadeOnDelete();
            $table->string('title_ar')->nullable();
            $table->text('body_ar')->nullable();
            $table->string('icon')->nullable();
            $table->foreignId('media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->enum('link_type', ['internal', 'external', 'service', 'post', 'none'])->nullable();
            $table->string('link_value')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('section_items');
    }
};
