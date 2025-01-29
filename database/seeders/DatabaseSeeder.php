<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // First, insert roles so users can reference them
        $this->call(RoleSeeder::class);

        // Insert users after roles are available
        $this->call(\Database\Seeders\Tables\UsersSeeder::class);

        // Insert themes before articles (since articles depend on themes)
        $this->call(\Database\Seeders\Tables\ThemesSeeder::class);

        // Insert issues before article_issue (because article_issue depends on issues)
        $this->call(\Database\Seeders\Tables\IssuesSeeder::class);

        // Insert articles after themes and users exist
        $this->call(\Database\Seeders\Tables\ArticlesSeeder::class);

        // Insert relationships now that articles, issues, and themes exist
        $this->call(\Database\Seeders\Tables\ThemeUserSeeder::class);
        $this->call(\Database\Seeders\Tables\ArticleIssueSeeder::class);

        // Insert posts after articles exist
        $this->call(\Database\Seeders\Tables\PostsSeeder::class);

        // Insert chats, history, and ratings after articles and users exist
        $this->call(\Database\Seeders\Tables\ChatsSeeder::class);
        $this->call(\Database\Seeders\Tables\HistorySeeder::class);
        $this->call(\Database\Seeders\Tables\RatingsSeeder::class);

        // Insert access and password reset tokens at the end
        $this->call(\Database\Seeders\Tables\PersonalAccessTokensSeeder::class);
        $this->call(\Database\Seeders\Tables\PasswordResetTokensSeeder::class);
    }
}
