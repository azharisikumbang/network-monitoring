<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::factory()->createMany([
            [
                'name' => Role::ROLE_ADMINISTRATOR,
                'as' => ucfirst(Role::ROLE_ADMINISTRATOR),
            ],
            [
                'name' => Role::ROLE_BRANCH_MANAGER,
                'as' => ucfirst(Role::ROLE_BRANCH_MANAGER),
            ],
            [
                'name' => Role::ROLE_TECHNICIAN,
                'as' => ucfirst(Role::ROLE_TECHNICIAN),
            ]
        ]);
    }
}
