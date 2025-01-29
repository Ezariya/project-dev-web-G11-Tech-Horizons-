<?php
namespace Database\Seeders\Tables;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleIssueSeeder extends Seeder
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
         * artisan seed:generate --table-mode --tables=article_issue
         *
         */

        $dataTables = [
            [
                'id' => 7,
                'article_id' => 19,
                'issue_id' => 4,
                'created_at' => '2025-01-28 20:38:36',
                'updated_at' => '2025-01-28 20:38:36',
            ],
            [
                'id' => 8,
                'article_id' => 20,
                'issue_id' => 4,
                'created_at' => '2025-01-28 20:38:36',
                'updated_at' => '2025-01-28 20:38:36',
            ],
            [
                'id' => 9,
                'article_id' => 21,
                'issue_id' => 4,
                'created_at' => '2025-01-28 20:38:36',
                'updated_at' => '2025-01-28 20:38:36',
            ],
            [
                'id' => 10,
                'article_id' => 25,
                'issue_id' => 5,
                'created_at' => '2025-01-28 22:53:38',
                'updated_at' => '2025-01-28 22:53:38',
            ],
            [
                'id' => 11,
                'article_id' => 19,
                'issue_id' => 5,
                'created_at' => '2025-01-28 22:53:38',
                'updated_at' => '2025-01-28 22:53:38',
            ],
            [
                'id' => 12,
                'article_id' => 18,
                'issue_id' => 5,
                'created_at' => '2025-01-28 22:53:38',
                'updated_at' => '2025-01-28 22:53:38',
            ],
            [
                'id' => 13,
                'article_id' => 22,
                'issue_id' => 4,
                'created_at' => '2025-01-29 12:52:59',
                'updated_at' => '2025-01-29 12:52:59',
            ],
            [
                'id' => 14,
                'article_id' => 17,
                'issue_id' => 4,
                'created_at' => '2025-01-29 12:52:59',
                'updated_at' => '2025-01-29 12:52:59',
            ]
        ];
        
        DB::table("article_issue")->insert($dataTables);
    }
}