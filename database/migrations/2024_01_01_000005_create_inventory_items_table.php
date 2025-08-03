<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('category_id')->constrained('inventory_categories')->onDelete('cascade');
            $table->string('serial_number')->unique();
            $table->string('brand');
            $table->string('model');
            $table->date('purchase_date');
            $table->date('warranty_end_date')->nullable();
            $table->enum('status', ['Available', 'Assigned', 'In Repair', 'Retired'])->default('Available');
            $table->string('location');
            $table->text('description')->nullable();
            $table->foreignId('assigned_to')->nullable()->constrained('employees')->onDelete('set null');
            $table->timestamps();
            
            // Indexes for performance
            $table->index('name');
            $table->index('serial_number');
            $table->index('brand');
            $table->index('status');
            $table->index('location');
            $table->index(['status', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};