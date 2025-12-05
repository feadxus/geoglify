<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@geoglify.com',
                'password' => bcrypt('jJ2u9YCWH6H5UrS'),
                'remember_token' => null,
            ],
            [
                'id' => 2,
                'name' => 'User',
                'email' => 'user@geoglify.com',
                'password' => bcrypt('jJ2u9YCWH6H5UrS'),
                'remember_token' => null,
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['id' => $user['id']],
                [
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => $user['password'],
                    'remember_token' => $user['remember_token'],
                ]
            );
        }
    }
}
