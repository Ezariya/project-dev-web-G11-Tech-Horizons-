<?php
namespace Database\Seeders\Tables;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PasswordResetTokensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Command :
         * artisan seed:generate --table-mode --tables=password_reset_tokens
         *
         */

        $dataTables = [
            [
                'email' => 'ezariafroond@gmail.com',
                'token' => '$2y$12$0C8iMnDj/WJs5bJWFumHQuYHLQ5lnS8PZK2oRT0HfW/DNvIfDnNvi',
                'created_at' => '2025-01-29 13:33:12',
            ]
        ];
        
        DB::table("password_reset_tokens")->insert($dataTables);
    }
}