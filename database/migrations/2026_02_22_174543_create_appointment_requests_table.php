<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointment_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('governorate');
            $table->enum('gender', ['male', 'female']);
            $table->unsignedInteger('age');
            $table->enum('patient_relation', ['self', 'proxy']);
            $table->string('problem_type');
            $table->string('problem_specialty');
            $table->text('notes')->nullable();
            $table->enum('status', ['new', 'in_progress', 'done', 'spam'])->default('new');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointment_requests');
    }
};
