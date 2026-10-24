<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceImage;
use Illuminate\Support\Facades\Storage;

class MaintenanceImageController extends Controller
{
    public function show(MaintenanceImage $image)
    {
        $image->load('maintenanceRequest');
        $user = auth()->user();
        $role = $user->role?->name;
        $request = $image->maintenanceRequest;

        $canView = in_array($role, ['admin', 'superadmin'], true)
            || (int) $request->user_id === (int) $user->id
            || (int) $request->assigned_to === (int) $user->id;

        abort_unless($canView, 403);
        abort_unless(Storage::disk('local')->exists($image->image_path), 404);

        return Storage::disk('local')->response($image->image_path);
    }
}
