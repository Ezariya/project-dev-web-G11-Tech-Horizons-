<?php
namespace Database\Seeders\Tables;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingsSeeder extends Seeder
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
         * artisan seed:generate --table-mode --tables=ratings
         *
         */

        $dataTables = [
            [
                'id' => 12,
                'user_id' => 13,
                'article_id' => 19,
                'rating' => 3,
                'created_at' => '2025-01-28 22:30:10',
                'updated_at' => '2025-01-28 22:30:10',
            ],
            [
                'id' => 13,
                'user_id' => 25,
                'article_id' => 21,
                'rating' => 5,
                'created_at' => '2025-01-28 23:37:28',
                'updated_at' => '2025-01-28 23:37:28',
            ],
            [
                'id' => 14,
                'user_id' => 29,
                'article_id' => 17,
                'rating' => 3,
                'created_at' => '2025-01-28 23:42:06',
                'updated_at' => '2025-01-28 23:42:06',
            ]
        ];
        
        DB::table("ratings")->insert($dataTables);
    }
}