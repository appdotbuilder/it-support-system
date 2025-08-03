<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Employee>
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'position' => fake()->randomElement([
                'Software Developer',
                'System Administrator',
                'Network Engineer',
                'Database Administrator',
                'Security Analyst',
                'IT Manager',
                'Help Desk Technician',
            ]),
            'department' => fake()->randomElement([
                'Information Technology',
                'Engineering',
                'Human Resources',
                'Finance',
                'Marketing',
                'Operations',
                'Sales',
            ]),
        ];
    }
}