<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\InventoryCategory;
use App\Models\InventoryItem;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'Admin',
        ]);

        // Create regular users
        $users = User::factory(5)->create();

        // Create employees
        $employees = Employee::factory(20)->create();

        // Create inventory categories
        $laptopsCategory = InventoryCategory::create([
            'name' => 'Laptops',
            'description' => 'Portable computers for employees',
        ]);

        $desktopsCategory = InventoryCategory::create([
            'name' => 'Desktops',
            'description' => 'Desktop computers for office use',
        ]);

        $monitorsCategory = InventoryCategory::create([
            'name' => 'Monitors',
            'description' => 'Display monitors and screens',
        ]);

        $printersCategory = InventoryCategory::create([
            'name' => 'Printers',
            'description' => 'Printing devices and equipment',
        ]);

        $networkCategory = InventoryCategory::create([
            'name' => 'Network Equipment',
            'description' => 'Routers, switches, and network hardware',
        ]);

        // Create inventory items
        InventoryItem::factory(15)->create([
            'category_id' => $laptopsCategory->id,
            'assigned_to' => $employees->random()->id,
            'status' => 'Assigned',
        ]);

        InventoryItem::factory(10)->create([
            'category_id' => $desktopsCategory->id,
            'assigned_to' => $employees->random()->id,
            'status' => 'Assigned',
        ]);

        InventoryItem::factory(8)->create([
            'category_id' => $monitorsCategory->id,
        ]);

        InventoryItem::factory(5)->create([
            'category_id' => $printersCategory->id,
        ]);

        InventoryItem::factory(3)->create([
            'category_id' => $networkCategory->id,
        ]);

        // Create tickets
        Ticket::factory(15)->create([
            'created_by' => $users->random()->id,
            'assigned_to' => $admin->id,
        ]);

        Ticket::factory(10)->create([
            'created_by' => $users->random()->id,
        ]);
    }
}