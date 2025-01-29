<?php
namespace Database\Seeders\Tables;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemeUserSeeder extends Seeder
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
         * artisan seed:generate --table-mode --tables=theme_user
         *
         */

        $dataTables = [
            [
                'id' => 13,
                'user_id' => 25,
                'theme_id' => 7,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_blocked' => 0,
            ],
            [
                'id' => 14,
                'user_id' => 13,
                'theme_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_blocked' => 0,
            ],
            [
                'id' => 15,
                'user_id' => 13,
                'theme_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_blocked' => 0,
            ],
            [
                'id' => 16,
                'user_id' => 13,
                'theme_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_blocked' => 0,
            ],
            [
                'id' => 17,
                'user_id' => 13,
                'theme_id' => 5,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_blocked' => 0,
            ]
        ];
        
        DB::table("theme_user")->insert($dataTables);
    }
}