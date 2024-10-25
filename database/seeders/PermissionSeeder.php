<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionsData = [
            ["name" => "user:index", "display_name" => "List Users", "feature" => "User"],
            ["name" => "user:create", "display_name" => "Create User", "feature" => "User"],
            ["name" => "user:store", "display_name" => "Save User", "feature" => "User"],
            ["name" => "user:show", "display_name" => "Show User", "feature" => "User"],
            ["name" => "user:edit", "display_name" => "Edit User", "feature" => "User"],
            ["name" => "user:update", "display_name" => "Update User", "feature" => "User"],
            ["name" => "user:destroy", "display_name" => "Delete User", "feature" => "User"],
            ["name" => "role:index", "display_name" => "List Roles", "feature" => "Role"],
            ["name" => "role:create", "display_name" => "Create Role", "feature" => "Role"],
            ["name" => "role:store", "display_name" => "Save Role", "feature" => "Role"],
            ["name" => "role:show", "display_name" => "Show Role", "feature" => "Role"],
            ["name" => "role:edit", "display_name" => "Edit Role", "feature" => "Role"],
            ["name" => "role:update", "display_name" => "Update Role", "feature" => "Role"],
            ["name" => "role:destroy", "display_name" => "Delete Role", "feature" => "Role"],
            ["name" => "role:edit-permissions", "display_name" => "Edit Permissions", "feature" => "Role"],
            ["name" => "role:update-permissions", "display_name" => "Update Permissions", "feature" => "Role"],
        ];

        Permission::insert($permissionsData);
    }
}
