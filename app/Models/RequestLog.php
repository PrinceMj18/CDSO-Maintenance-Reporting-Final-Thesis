<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\MaintenanceRequest;
use App\Models\User;

class RequestLog extends Model
{
    protected $fillable = [
    'request_id',
    'status',
    'action',
    'remarks',
    'updated_by',
];

 public function maintenanceRequest()
    {
        return $this->belongsTo(MaintenanceRequest::class, 'request_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

        public function request()
    {
        return $this->belongsTo(MaintenanceRequest::class, 'request_id');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
