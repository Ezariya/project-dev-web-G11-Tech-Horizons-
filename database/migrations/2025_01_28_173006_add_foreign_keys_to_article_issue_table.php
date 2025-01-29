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
        Schema::table('article_issue', function (Blueprint $table) {
            $table->foreign(['article_id'], 'fk_article_issue_article')->references(['id'])->on('articles')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['issue_id'], 'fk_article_issue_issue')->references(['id'])->on('issues')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('article_issue', function (Blueprint $table) {
            $table->dropForeign('fk_article_issue_article');
            $table->dropForeign('fk_article_issue_issue');
        });
    }
};
