<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->boolean('is_featured')->default(false)->after('is_active');
        });

        $featuredIds = DB::table('faqs')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->limit(3)
            ->pluck('id');

        if ($featuredIds->isNotEmpty()) {
            DB::table('faqs')
                ->whereIn('id', $featuredIds->all())
                ->update(['is_featured' => true]);
        }
    }

    public function down(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn('is_featured');
        });
    }
};
