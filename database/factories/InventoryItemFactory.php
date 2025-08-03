<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\InventoryCategory;
use App\Models\InventoryItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InventoryItem>
 */
class InventoryItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\InventoryItem>
     */
    protected $model = InventoryItem::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Dell Laptop',
                'HP Desktop',
                'Samsung Monitor',
                'Canon Printer',
                'Cisco Router',
                'Dell Server',
                'iPhone',
                'Wireless Mouse',
                'Microsoft Office License',
                'Webcam',
            ]) . ' ' . fake()->numberBetween(1000, 9999),
            'category_id' => InventoryCategory::factory(),
            'serial_number' => fake()->unique()->bothify('??########'),
            'brand' => fake()->randomElement(['Dell', 'HP', 'Apple', 'Samsung', 'Cisco', 'Canon', 'Lenovo', 'Microsoft']),
            'model' => fake()->bothify('Model-###??'),
            'purchase_date' => fake()->dateTimeBetween('-2 years', 'now'),
            'warranty_end_date' => fake()->dateTimeBetween('now', '+3 years'),
            'status' => fake()->randomElement(['Available', 'Assigned', 'In Repair', 'Retired']),
            'location' => fake()->randomElement([
                'Office Floor 1',
                'Office Floor 2',
                'Office Floor 3',
                'Server Room',
                'Storage Room',
                'IT Department',
                'HR Department',
                'Finance Department',
            ]),
            'description' => fake()->sentence(),
            'assigned_to' => fake()->boolean(30) ? Employee::factory() : null,
        ];
    }
}