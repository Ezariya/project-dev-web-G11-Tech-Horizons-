<?php
namespace Database\Seeders\Tables;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IssuesSeeder extends Seeder
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
         * artisan seed:generate --table-mode --tables=issues
         *
         */

        $dataTables = [
            [
                'id' => 4,
                'title' => 'AI related',
                'is_public' => 0,
                'status' => 'published',
                'created_at' => '2025-01-28 20:38:36',
                'updated_at' => '2025-01-29 12:52:59',
            ],
            [
                'id' => 5,
                'title' => 'web dev',
                'is_public' => 0,
                'status' => 'draft',
                'created_at' => '2025-01-28 22:53:38',
                'updated_at' => '2025-01-28 22:53:38',
            ]
        ];
        
        DB::table("issues")->insert($dataTables);
    }
}