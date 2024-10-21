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
        ];

        Permission::insert($permissionsData);
    }
}
