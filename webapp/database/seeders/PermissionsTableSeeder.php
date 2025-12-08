<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Users
            [
                'id' => 1,
                'code' => 'users_create',
                'title' => 'permissions.users_create',
                'description' => 'Allows creating new users in the system',
            ],
            [
                'id' => 2,
                'code' => 'users_edit',
                'title' => 'permissions.users_edit',
                'description' => 'Allows editing existing users',
            ],
            [
                'id' => 3,
                'code' => 'users_destroy',
                'title' => 'permissions.users_destroy',
                'description' => 'Allows deleting users',
            ],
            [
                'id' => 4,
                'code' => 'users_show',
                'title' => 'permissions.users_show',
                'description' => 'Allows viewing user details',
            ],
            [
                'id' => 5,
                'code' => 'users_list',
                'title' => 'permissions.users_list',
                'description' => 'Allows listing all users',
            ],

            // Roles
            [
                'id' => 6,
                'code' => 'roles_create',
                'title' => 'permissions.roles_create',
                'description' => 'Allows creating new roles',
            ],
            [
                'id' => 7,
                'code' => 'roles_edit',
                'title' => 'permissions.roles_edit',
                'description' => 'Allows editing existing roles',
            ],
            [
                'id' => 8,
                'code' => 'roles_destroy',
                'title' => 'permissions.roles_destroy',
                'description' => 'Allows deleting roles',
            ],
            [
                'id' => 9,
                'code' => 'roles_show',
                'title' => 'permissions.roles_show',
                'description' => 'Allows viewing role details',
            ],
            [
                'id' => 10,
                'code' => 'roles_list',
                'title' => 'permissions.roles_list',
                'description' => 'Allows listing all roles',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['id' => $permission['id']],
                [
                    'code' => $permission['code'],
                    'title' => $permission['title'],
                    'description' => $permission['description'],
                ]
            );
        }
    }
}
