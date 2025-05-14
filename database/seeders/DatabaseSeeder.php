<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(RoleSeeder::class);

        $administrator = Role::where('name', Role::ROLE_ADMINISTRATOR)->first();
        $administrator->users()->create([
            'name' => 'administrator',
            'email' => 'administrator@local.test',
            'password' => Hash::make('12345678')
        ]);

        // branches
        $this->call(BranchSeeder::class);
    }
}
