<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\InventoryCategory
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InventoryItem> $inventoryItems
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryCategory whereUpdatedAt($value)
 * @method static \Database\Factories\InventoryCategoryFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class InventoryCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the inventory items for the category.
     */
    public function inventoryItems(): HasMany
    {
        return $this->hasMany(InventoryItem::class, 'category_id');
    }
}