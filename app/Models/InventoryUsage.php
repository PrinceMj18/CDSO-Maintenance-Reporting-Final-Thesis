<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MaintenanceRequest;
use App\Models\InventoryItem;
use App\Models\User;
class InventoryUsage extends Model
{
        protected $fillable = [
        'request_id',
        'item_id',
        'quantity_used',
        'used_by',
        'used_at',
    ];

    protected $casts = [
        'used_at' => 'datetime',
    ];

    public function request()
    {
        return $this->belongsTo(MaintenanceRequest::class, 'request_id');
    }

    public function item()
    {
        return $this->belongsTo(InventoryItem::class, 'item_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'used_by');
    }
    
}
