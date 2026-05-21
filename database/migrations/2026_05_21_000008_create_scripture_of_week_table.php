<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scripture_of_week', function (Blueprint $table) {
            $table->id();
            $table->text('verse_en');
            $table->text('verse_sw');
            $table->string('reference');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scripture_of_week');
    }
};
