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
        Schema::create('theme_user', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->index('fk_theme_user_user');
            $table->integer('theme_id')->index('fk_theme_user_theme');
            $table->timestamps();
            $table->boolean('is_blocked')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theme_user');
    }
};
