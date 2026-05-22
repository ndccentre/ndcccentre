<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gallery_items', function (Blueprint $table) {
            $table->string('title')->nullable()->after('id');
            $table->string('image_path')->nullable()->after('category');
            $table->text('description')->nullable()->after('image_path');
            $table->boolean('is_active')->default(true)->after('is_published');
        });
    }

    public function down(): void
    {
        Schema::table('gallery_items', function (Blueprint $table) {
            $table->dropColumn(['title', 'image_path', 'description', 'is_active']);
        });
    }
};
