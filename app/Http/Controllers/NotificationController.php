<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function read(Request $request, string $id)
    {
        $notification = $request->user()->notifications()->whereKey($id)->firstOrFail();
        $notification->markAsRead();

        $url = $notification->data['url'] ?? null;

        return $url ? redirect($url) : redirect()->back();
    }

    public function readAll(Request $request)
    {
        $request->user()->unreadNotifications()->update(['read_at' => now()]);

        if ($request->expectsJson()) {
            return response()->noContent();
        }

        return redirect()->back();
    }
}
