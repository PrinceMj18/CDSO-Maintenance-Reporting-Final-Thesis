<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    protected $fillable = [
        'name',
        'category',
        'unit',
        'quantity',
        'minimum_stock',
        'unit_cost',
        'location',
        'description',
    ];
    public function getStatusAttribute()
    {
        if ($this->quantity == 0) {
            return 'Out of Stock';
        }

        if ($this->quantity <= $this->minimum_stock) {
            return 'Low Stock';
        }

        return 'Available';
    }

    public function getStatusColorAttribute()
    {
        return match ($this->status) { 'Out of Stock' => 'bg-red-600', 'Low Stock' => 'bg-amber-600', 'In Stock' => 'bg-emerald-600', default => 'bg-gray-500', };
    }
}