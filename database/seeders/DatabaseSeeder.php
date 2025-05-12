<?php

namespace Database\Seeders;

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
        User::factory(100)->create();

        User::factory()->createMany([
            [
                'name' => 'administrator',
                'email' => 'administrator@local.test',
                'password' => Hash::make('12345678'),
                'role' => User::ROLE_ADMINISTRATOR
            ],
            [
                'name' => 'noc',
                'email' => 'noc@local.test',
                'password' => Hash::make('12345678'),
                'role' => User::ROLE_NOC
            ],
            [
                'name' => 'technician',
                'email' => 'technician@local.test',
                'password' => Hash::make('12345678'),
                'role' => User::ROLE_TECHNICIAN
            ]
        ]);

        // branches
        $this->call(BranchSeeder::class);
    }
}
