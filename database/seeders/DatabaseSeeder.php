<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Node;
use App\Models\Role;
use App\Models\Site;
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
        $provinces = config('custom.form.provinces');
        $branchManagerRole = Role::where('name', Role::ROLE_BRANCH_MANAGER)->first();

        foreach ($provinces as $prov)
        {
            $branchManager = User::factory()->create(['role_id' => $branchManagerRole->id]);

            Branch::factory()->createMany([
                [
                    'name' => $prov . "-1",
                    'province' => $prov,
                    'manager_id' => $branchManager->id
                ],
                [
                    'name' => $prov . "-2",
                    'province' => $prov,
                    'manager_id' => $branchManager->id
                ]
            ]);
        }

        $roleTechnician = Role::where('name', ROLE::ROLE_TECHNICIAN)->first();
        Branch::all()->each(function (Branch $branch) use ($roleTechnician) {
            User::factory(mt_rand(3, 8))->create([
                'role_id' => $roleTechnician->id,
                'branch_id' => $branch->id
            ]);

            Site::factory(mt_rand(50, 100))->create([
                'branch_id' => $branch->id,
                'province' => $branch->province
            ]);
        });

        Site::all()->each(function (Site $site) {
            $devices = ['MODEM', 'ROUTER', 'ONT', 'OLT', 'ACCESS_POINT'];
            $temp = [];
            $ip = fake()->ipv4();
            foreach ($devices as $device)
            {
                $temp[] = [
                    'name' => sprintf("%s-%s-1", $site->name, $device),
                    'ip_address' => $ip,
                    'type' => $device,
                    'site_id' => $site->id
                ];
            }

            Node::factory()->createMany($temp);
        });
    }
}
