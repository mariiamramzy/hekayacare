<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seo_meta', function (Blueprint $table) {
            $table->id();
            $table->string('metaable_type');
            $table->unsignedBigInteger('metaable_id');
            $table->string('meta_title_ar')->nullable();
            $table->string('meta_description_ar')->nullable();
            $table->string('meta_keywords_ar')->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('robots')->nullable();
            $table->string('og_title_ar')->nullable();
            $table->string('og_description_ar')->nullable();
            $table->string('og_type')->nullable();
            $table->string('og_url')->nullable();
            $table->string('og_site_name')->nullable();
            $table->foreignId('og_image_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->string('twitter_card')->nullable();
            $table->string('twitter_title_ar')->nullable();
            $table->string('twitter_description_ar')->nullable();
            $table->foreignId('twitter_image_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->json('schema_json')->nullable();
            $table->timestamps();

            $table->unique(['metaable_type', 'metaable_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo_meta');
    }
};
