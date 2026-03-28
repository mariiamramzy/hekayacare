<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('title_ar')->nullable();
            $table->string('specialty_ar')->nullable();
            $table->longText('bio_ar')->nullable();
            $table->foreignId('photo_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
