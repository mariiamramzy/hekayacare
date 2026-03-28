<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faq_category_faq', function (Blueprint $table) {
            $table->foreignId('faq_category_id')->constrained('faq_categories')->cascadeOnDelete();
            $table->foreignId('faq_id')->constrained('faqs')->cascadeOnDelete();
            $table->unique(['faq_category_id', 'faq_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faq_category_faq');
    }
};
