<?php
namespace Database\Seeders\Tables;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatsSeeder extends Seeder
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
         * artisan seed:generate --table-mode --tables=chats
         *
         */

        $dataTables = [
            [
                'id' => 2,
                'user_id' => 29,
                'article_id' => 17,
                'message' => 'Great article! I’m really excited about the move towards more Python, it should make debugging so much easier. And the prospect of wrapping the entire training loop? That’s a game-changer! PyTorch 2.0 can’t come soon enough',
                'created_at' => '2025-01-28 23:42:11',
                'updated_at' => '2025-01-28 23:42:11',
            ],
            [
                'id' => 3,
                'user_id' => 29,
                'article_id' => 17,
                'message' => 'Great article! I’m really excited about the move towards more Python, it should make debugging so much easier. And the prospect of wrapping the entire training loop? That’s a game-changer! PyTorch 2.0 can’t come soon enough',
                'created_at' => '2025-01-28 23:42:14',
                'updated_at' => '2025-01-28 23:42:14',
            ]
        ];
        
        DB::table("chats")->insert($dataTables);
    }
}