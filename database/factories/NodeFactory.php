<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Node>
 */
class NodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ip_address' => fake()->ipv4(),
            'network_address' => '24',
            'type' => array_rand(['MODEM', 'ROUTER', 'ONT', 'OLT', 'ACCESS_POINT']),
            'description' => fake()->realText()
        ];
    }
}
