<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file_number')->nullable()->unique();

            $table->string('case_manager_name')->nullable();
            $table->string('case_manager_phone')->nullable();
            $table->string('center_name')->nullable();
            $table->string('supervisor_name')->nullable();

            $table->string('addiction_type')->nullable();
            $table->text('psychiatric_diagnosis')->nullable();

            $table->date('admission_date')->nullable()->index();
            $table->date('discharge_date')->nullable()->index();
            $table->enum('status', ['active', 'discharged', 'follow_up', 'archived'])->default('active')->index();

            $table->enum('gender', ['male', 'female'])->nullable();
            $table->unsignedSmallInteger('age')->nullable();
            $table->string('phone')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->text('notes')->nullable();

            $table->foreignId('created_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
