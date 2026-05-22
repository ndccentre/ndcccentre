<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->string('title_sw')->nullable()->after('title');
            $table->text('excerpt_sw')->nullable()->after('excerpt');
            $table->longText('body_sw')->nullable()->after('body');
        });
    }

    public function down(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn(['title_sw', 'excerpt_sw', 'body_sw']);
        });
    }
};
