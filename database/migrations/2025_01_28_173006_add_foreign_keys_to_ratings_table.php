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
        Schema::table('ratings', function (Blueprint $table) {
            $table->foreign(['article_id'], 'fk_ratings_article')->references(['id'])->on('articles')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['user_id'], 'fk_ratings_user')->references(['id'])->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ratings', function (Blueprint $table) {
            $table->dropForeign('fk_ratings_article');
            $table->dropForeign('fk_ratings_user');
        });
    }
};
