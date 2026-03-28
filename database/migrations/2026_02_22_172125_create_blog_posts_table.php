<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title_ar');
            $table->text('excerpt_ar')->nullable();
            $table->longText('content_ar');
            $table->foreignId('cover_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->foreignId('blog_category_id')->nullable()->constrained('blog_categories')->nullOnDelete();
            $table->enum('status', ['draft', 'published', 'scheduled'])->default('draft');
            $table->dateTime('published_at')->nullable();
            $table->integer('reading_time')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->foreignId('created_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
