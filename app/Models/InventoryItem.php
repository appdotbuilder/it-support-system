<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\InventoryItem
 *
 * @property int $id
 * @property string $name
 * @property int $category_id
 * @property string $serial_number
 * @property string $brand
 * @property string $model
 * @property \Illuminate\Support\Carbon $purchase_date
 * @property \Illuminate\Support\Carbon|null $warranty_end_date
 * @property string $status
 * @property string $location
 * @property string|null $description
 * @property int|null $assigned_to
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Employee|null $assignedEmployee
 * @property-read \App\Models\InventoryCategory $category
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereAssignedTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem wherePurchaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereSerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereWarrantyEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem available()
 * @method static \Database\Factories\InventoryItemFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class InventoryItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'category_id',
        'serial_number',
        'brand',
        'model',
        'purchase_date',
        'warranty_end_date',
        'status',
        'location',
        'description',
        'assigned_to',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'purchase_date' => 'date',
        'warranty_end_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the category that the inventory item belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(InventoryCategory::class);
    }

    /**
     * Get the employee that the inventory item is assigned to.
     */
    public function assignedEmployee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'assigned_to');
    }

    /**
     * Scope a query to only include available items.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'Available');
    }
}