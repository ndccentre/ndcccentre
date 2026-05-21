<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sermons', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_sw');
            $table->string('speaker')->nullable();
            $table->string('scripture')->nullable();
            $table->string('series')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_sw')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('audio_url')->nullable();
            $table->string('duration')->nullable();
            $table->string('language')->default('both');
            $table->date('preached_at')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sermons');
    }
};
