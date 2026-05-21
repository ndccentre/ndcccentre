<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sermons', function (Blueprint $table) {
            $table->string('youtube_video_id')->nullable()->unique()->after('youtube_url');
            $table->string('video_type', 20)->default('manual')->after('youtube_video_id'); // sermon, short, live, manual
            $table->string('video_source', 20)->default('manual')->after('video_type'); // youtube, manual
            $table->unsignedBigInteger('view_count')->default(0)->after('video_source');
            $table->boolean('is_live_now')->default(false)->after('view_count');
            $table->string('thumbnail_url')->nullable()->after('is_live_now');
        });
    }

    public function down(): void
    {
        Schema::table('sermons', function (Blueprint $table) {
            $table->dropColumn([
                'youtube_video_id',
                'video_type',
                'video_source',
                'view_count',
                'is_live_now',
                'thumbnail_url',
            ]);
        });
    }
};
