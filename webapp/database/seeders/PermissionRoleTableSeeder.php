<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Administrator Role's Permissions
         */
        $ids_to_admin = Permission::all()->pluck('id');

        /*
        * User Role's Permissions
        */
        Role::findOrFail(1)->permissions()->sync($ids_to_admin);

        $ids_to_user = Permission::whereIn('title', [
            'users_create',
            'users_edit',
            'users_destroy',
            'users_show',
            'users_list',
            'roles_create',
            'roles_edit',
            'roles_destroy',
            'roles_show',
            'roles_list',
        ])->pluck('id');

        Role::findOrFail(2)->permissions()->sync($ids_to_user);
    }
}
