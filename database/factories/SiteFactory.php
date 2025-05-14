<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Site>
 */
class SiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $city = fake()->city();

        return [
            'name' => $this->generateName($city),
            'terminal_id' => strtoupper(fake()->bothify("AO2025###########??#")),
            'city' => $city,
            'address' => fake()->address(),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'is_active' => true
        ];
    }

    private function generateName(string $city): string
    {
        $temp = [
            "KANTOR CAMAT ",
            "KANTOR DESA ",
            "KANTOR LURAH ",
            "KANTOR KEJAKSAAN "
        ];

        for ($i = 1; $i < 10; $i++)
        {
            $temp[] = "SMA NEGERI " . $i;
            $temp[] = "SMP NEGERI " . $i;
            $temp[] = "SMK NEGERI " . $i;
        }

        $string = $temp[array_rand($temp)] . $city;

        return strtoupper($string);
    }
}
