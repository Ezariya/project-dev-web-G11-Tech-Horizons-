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
        Schema::table('articles', function (Blueprint $table) {
            $table->foreign(['author_id'], 'fk_articles_author')->references(['id'])->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['theme_id'], 'fk_articles_theme')->references(['id'])->on('themes')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign('fk_articles_author');
            $table->dropForeign('fk_articles_theme');
        });
    }
};
