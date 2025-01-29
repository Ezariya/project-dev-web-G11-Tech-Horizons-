<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Insérer les données dans la table 'roles'
        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'blocked',
                'created_at' => '2025-01-15 17:36:14',
                'updated_at' => '2025-01-15 17:36:14',
            ],
            [
                'id' => 2,
                'name' => 'abonne',
                'created_at' => '2025-01-15 17:36:14',
                'updated_at' => '2025-01-15 17:36:14',
            ],
            [
                'id' => 3,
                'name' => 'responsable',
                'created_at' => '2025-01-15 17:36:14',
                'updated_at' => '2025-01-15 17:36:14',
            ],
            [
                'id' => 4,
                'name' => 'editeur',
                'created_at' => '2025-01-15 17:36:14',
                'updated_at' => '2025-01-15 17:36:14',
            ],
        ]);
    }
}
