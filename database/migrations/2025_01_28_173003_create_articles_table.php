<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('title');
            $table->longText('content');
            $table->string('image_path')->nullable();
            $table->integer('theme_id')->index('fk_articles_theme');
            $table->integer('author_id')->index('fk_articles_author');
            $table->enum('status', ['refus', 'en_cours', 'retenu', 'publie'])->nullable()->default('en_cours');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
