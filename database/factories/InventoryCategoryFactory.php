<?php

namespace Database\Factories;

use App\Models\InventoryCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InventoryCategory>
 */
class InventoryCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\InventoryCategory>
     */
    protected $model = InventoryCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Laptops',
                'Desktops',
                'Monitors',
                'Printers',
                'Network Equipment',
                'Servers',
                'Mobile Devices',
                'Peripherals',
                'Software Licenses',
                'Audio/Video Equipment',
            ]),
            'description' => fake()->sentence(),
        ];
    }
}