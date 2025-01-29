<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;

class RolesAndUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer les rôles
        $roles = [
            ['name' => 'blocked'],
            ['name' => 'abonne'],
            ['name' => 'responsable'],
            ['name' => 'editeur'],
        ];

        foreach ($roles as $roleData) {
            // Assign an ID explicitly if it doesn't already exist
            if (!isset($roleData['id'])) {
                $roleData['id'] = Role::max('id') + 1; // Calculate the next available ID
            }
        
            // Vérifie si le rôle existe déjà pour éviter les doublons
            Role::firstOrCreate(
                ['name' => $roleData['name']], // Search criteria
                $roleData // Additional attributes, including the explicit ID
            );
        }
        

        // Récupérer les rôles fraîchement insérés
        $inviteRole = Role::where('name', 'invite')->first();
        $abonneRole = Role::where('name', 'abonne')->first();
        $responsableRole = Role::where('name', 'responsable')->first();
        $editeurRole = Role::where('name', 'editeur')->first();

        // Créer un utilisateur pour chaque rôle
        $users = [
            [
                'id'       => 1,
                'name'     => 'Utilisateur Invité',
                'email'    => 'invite@example.com',
                'password' => Hash::make('password'),
                'role_id'  => $inviteRole->id,
            ],
            [
                'id'       => 2,
                'name'     => 'Utilisateur Abonné',
                'email'    => 'abonne@example.com',
                'password' => Hash::make('password'),
                'role_id'  => $abonneRole->id,
            ],
            [
                'id'       => 3,
                'name'     => 'Responsable Thème',
                'email'    => 'responsable@example.com',
                'password' => Hash::make('password'),
                'role_id'  => $responsableRole->id,
            ],
            [
                'id'       => 4,
                'name'     => 'Éditeur Tech Horizons',
                'email'    => 'editeur@example.com',
                'password' => Hash::make('password'),
                'role_id'  => $editeurRole->id,
            ],
        ];

        foreach ($users as $userData) {
            // Vérifie si l'utilisateur existe déjà pour éviter les doublons
            User::firstOrCreate(['email' => $userData['email']], $userData);
        }
    }
}
