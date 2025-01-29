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
        Schema::create('article_issue', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('article_id')->index('fk_article_issue_article');
            $table->integer('issue_id')->index('fk_article_issue_issue');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_issue');
    }
};
