<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rolesData = [
            ["name" => "admin", "display_name" => "Admin"],
            ["name" => "user", "display_name" => "User"]
        ];

        Role::insert($rolesData);
    }
}
