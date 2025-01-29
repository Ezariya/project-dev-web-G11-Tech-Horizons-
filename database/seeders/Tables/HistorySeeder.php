<?php
namespace Database\Seeders\Tables;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistorySeeder extends Seeder
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
         * artisan seed:generate --table-mode --tables=history
         *
         */

        $dataTables = [
            [
                'id' => 83,
                'user_id' => 12,
                'article_id' => 17,
                'created_at' => '2025-01-28 20:19:56',
            ],
            [
                'id' => 85,
                'user_id' => 25,
                'article_id' => 17,
                'created_at' => '2025-01-28 20:55:39',
            ],
            [
                'id' => 86,
                'user_id' => 25,
                'article_id' => 18,
                'created_at' => '2025-01-28 20:55:54',
            ],
            [
                'id' => 87,
                'user_id' => 25,
                'article_id' => 21,
                'created_at' => '2025-01-28 21:05:40',
            ],
            [
                'id' => 88,
                'user_id' => 25,
                'article_id' => 21,
                'created_at' => '2025-01-28 21:10:41',
            ],
            [
                'id' => 89,
                'user_id' => 25,
                'article_id' => 21,
                'created_at' => '2025-01-28 21:13:25',
            ],
            [
                'id' => 90,
                'user_id' => 25,
                'article_id' => 21,
                'created_at' => '2025-01-28 21:13:37',
            ],
            [
                'id' => 91,
                'user_id' => 25,
                'article_id' => 21,
                'created_at' => '2025-01-28 21:13:49',
            ],
            [
                'id' => 121,
                'user_id' => 13,
                'article_id' => 19,
                'created_at' => '2025-01-28 23:30:04',
            ],
            [
                'id' => 122,
                'user_id' => 13,
                'article_id' => 19,
                'created_at' => '2025-01-28 23:30:11',
            ],
            [
                'id' => 123,
                'user_id' => 25,
                'article_id' => 18,
                'created_at' => '2025-01-28 23:44:52',
            ],
            [
                'id' => 124,
                'user_id' => 25,
                'article_id' => 21,
                'created_at' => '2025-01-29 00:37:21',
            ],
            [
                'id' => 125,
                'user_id' => 25,
                'article_id' => 21,
                'created_at' => '2025-01-29 00:37:28',
            ],
            [
                'id' => 126,
                'user_id' => 29,
                'article_id' => 17,
                'created_at' => '2025-01-29 00:38:42',
            ],
            [
                'id' => 127,
                'user_id' => 29,
                'article_id' => 17,
                'created_at' => '2025-01-29 00:42:07',
            ],
            [
                'id' => 128,
                'user_id' => 29,
                'article_id' => 17,
                'created_at' => '2025-01-29 00:42:12',
            ],
            [
                'id' => 129,
                'user_id' => 29,
                'article_id' => 17,
                'created_at' => '2025-01-29 00:42:15',
            ],
            [
                'id' => 130,
                'user_id' => 29,
                'article_id' => 17,
                'created_at' => '2025-01-29 00:42:20',
            ],
            [
                'id' => 131,
                'user_id' => 25,
                'article_id' => 17,
                'created_at' => '2025-01-29 00:44:00',
            ],
            [
                'id' => 132,
                'user_id' => 25,
                'article_id' => 18,
                'created_at' => '2025-01-29 00:44:56',
            ],
            [
                'id' => 133,
                'user_id' => 25,
                'article_id' => 19,
                'created_at' => '2025-01-29 00:45:04',
            ],
            [
                'id' => 134,
                'user_id' => 10,
                'article_id' => 17,
                'created_at' => '2025-01-29 14:19:11',
            ]
        ];
        
        DB::table("history")->insert($dataTables);
    }
}