<?php
namespace Database\Seeders\Tables;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
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
         * artisan seed:generate --table-mode --tables=users
         *
         */

        $dataTables = [
            [
                'id' => 10,
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$eCL48aw2Ex8DwxgAtv89QeE/r00K8q/G8TGFhQ/11ReZMduSa/Leq',
                'remember_token' => 'mwmq28Ms5rDS26UBgOrXSxsKhXhibsgyPp36GYjumdt5dwAjesRBn8EPCBfF',
                'created_at' => '2025-01-15 17:40:34',
                'updated_at' => '2025-01-15 17:40:34',
                'role_id' => 4,
                'blocked' => 0,
            ],
            [
                'id' => 11,
                'name' => 'responsable',
                'email' => 'responsable@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$4DpWYUhLZEaJdzMgkPefNuDWBERLGrqN10SNzkJF5VMJi6QFA.vFW',
                'remember_token' => NULL,
                'created_at' => '2025-01-15 17:49:53',
                'updated_at' => '2025-01-25 14:25:05',
                'role_id' => 3,
                'blocked' => 0,
            ],
            [
                'id' => 12,
                'name' => 'abdeslam ezaria',
                'email' => 'ezariafroond@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$eCL48aw2Ex8DwxgAtv89QeE/r00K8q/G8TGFhQ/11ReZMduSa/Leq',
                'remember_token' => NULL,
                'created_at' => '2025-01-28 15:09:55',
                'updated_at' => '2025-01-28 15:09:55',
                'role_id' => 4,
                'blocked' => 0,
            ],
            [
                'id' => 13,
                'name' => 'Ahmed',
                'email' => 'ahmed@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$4BT8Mm9Dt8gnTGodMaOHrOqi.pxdirrggEm6mw8vvaeW.4ao4ZBSO',
                'remember_token' => NULL,
                'created_at' => '2025-01-15 18:15:50',
                'updated_at' => '2025-01-15 18:15:50',
                'role_id' => 2,
                'blocked' => 0,
            ],
            [
                'id' => 14,
                'name' => 'AI_responsble',
                'email' => 'airsponsable@example.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$pbN8Gk9aNuju9JyN2.U2cObhaHmZr5PWR3p2KlTIw7Os1UC6fwO72',
                'remember_token' => NULL,
                'created_at' => '2025-01-17 12:33:17',
                'updated_at' => '2025-01-17 12:33:17',
                'role_id' => 3,
                'blocked' => 0,
            ],
            [
                'id' => 25,
                'name' => 'zaza',
                'email' => 'zaza@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$Agohg24hz8Xha9wiYKXn1.MOJYCeCE/2KF70n8krT73HdZzQHk2ce',
                'remember_token' => NULL,
                'created_at' => '2025-01-28 19:39:16',
                'updated_at' => '2025-01-29 13:35:25',
                'role_id' => 4,
                'blocked' => 0,
            ],
            [
                'id' => 27,
                'name' => 'Jane Smith',
                'email' => 'janesmith@example.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$cYoRrhg8McyQI5aY2Mjnnu6XhBGFPbcrXu5lJojY7lm/Gr3p9AJ06',
                'remember_token' => NULL,
                'created_at' => '2025-01-28 23:29:48',
                'updated_at' => '2025-01-28 23:29:48',
                'role_id' => 2,
                'blocked' => 0,
            ],
            [
                'id' => 28,
                'name' => 'Bob Brown',
                'email' => 'bobbrown@example.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$lOdgyN..c5J3ybIvIXp3WOxHNe20lmeralhi.ZJ/qBeXnsSELretK',
                'remember_token' => NULL,
                'created_at' => '2025-01-28 23:30:46',
                'updated_at' => '2025-01-28 23:30:46',
                'role_id' => 2,
                'blocked' => 0,
            ],
            [
                'id' => 29,
                'name' => 'Emily Davis',
                'email' => 'emilydavis@example.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$lXioct4oAYt0Iw08QB0vueCJ3xQqvrDrgPDOFcRNyJSfJOWJ2s4Ca',
                'remember_token' => NULL,
                'created_at' => '2025-01-28 23:31:36',
                'updated_at' => '2025-01-28 23:31:36',
                'role_id' => 2,
                'blocked' => 0,
            ]
        ];
        
        DB::table("users")->insert($dataTables);
    }
}