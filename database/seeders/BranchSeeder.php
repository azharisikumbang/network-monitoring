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

        foreach ($provinces as $index => $prov)
        {
            Branch::factory()->create([
                'name' => $prov . " - " . ($index + 1),
                'province' => $prov
            ]);
        }
    }
}
