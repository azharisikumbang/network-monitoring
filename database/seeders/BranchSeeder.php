<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = config('custom.form.provinces');

        foreach ($provinces as $prov)
        {
            Branch::factory()->createMany([
                [
                    'name' => $prov . "-1",
                    'province' => $prov
                ],
                [
                    'name' => $prov . "-2",
                    'province' => $prov
                ]
            ]);
        }
    }
}
