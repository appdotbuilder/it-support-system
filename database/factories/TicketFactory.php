<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Ticket>
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->randomElement([
                'Computer won\'t start',
                'Printer not working',
                'Slow internet connection',
                'Software installation needed',
                'Email not working',
                'Monitor flickering',
                'Keyboard keys not working',
                'Password reset request',
                'VPN connection issues',
                'File access problems',
            ]),
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement(['Open', 'In Progress', 'Resolved', 'Closed']),
            'priority' => fake()->randomElement(['Low', 'Medium', 'High']),
            'created_by' => User::factory(),
            'assigned_to' => fake()->boolean(60) ? User::factory()->state(['role' => 'Admin']) : null,
        ];
    }
}