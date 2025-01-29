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
        Schema::table('theme_user', function (Blueprint $table) {
            $table->foreign(['theme_id'], 'fk_theme_user_theme')->references(['id'])->on('themes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['user_id'], 'fk_theme_user_user')->references(['id'])->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('theme_user', function (Blueprint $table) {
            $table->dropForeign('fk_theme_user_theme');
            $table->dropForeign('fk_theme_user_user');
        });
    }
};
