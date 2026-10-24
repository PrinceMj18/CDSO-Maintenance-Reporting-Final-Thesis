<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceRequest;
use App\Models\RequestLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArchiveController extends Controller
{
    public function accounts(Request $request)
    {
        $accounts = User::onlyTrashed()->with('role')
            ->when($request->filled('search'), function ($query) use ($request) {
                $term = trim($request->string('search')->toString());
                $query->where(function ($q) use ($term) {
                    $q->where('fname', 'like', "%{$term}%")
                      ->orWhere('lname', 'like', "%{$term}%")
                      ->orWhere('email', 'like', "%{$term}%");
                });
            })->latest('deleted_at')->paginate(15)->withQueryString();

        return view('archives.accounts', compact('accounts'));
    }

    public function restoreAccount($id)
    {
        $account = User::onlyTrashed()->with('role')->findOrFail($id);
        if (auth()->user()->role->name === 'admin' && !in_array($account->role->name ?? '', ['user', 'personnel'], true)) {
            abort(403);
        }
        $account->restore();
        return back()->with('success', 'Account restored successfully.');
    }

    public function archiveRequest(Request $request, $id)
    {
        $maintenance = MaintenanceRequest::findOrFail($id);
        abort_unless(in_array($maintenance->status, ['completed', 'rejected'], true), 422,
            'Only completed or rejected maintenance requests can be archived.');

        DB::transaction(function () use ($maintenance) {
            RequestLog::create([
                'request_id' => $maintenance->id,
                'status' => $maintenance->status,
                'action' => 'archived',
                'remarks' => 'Maintenance request archived by an administrator.',
                'updated_by' => Auth::id(),
            ]);
            $maintenance->delete();
        });

        if ($request->routeIs('admin.requests.archive')) {
    return redirect()->route('maintenanceRequest.admin')
        ->with('success', 'Maintenance request archived successfully.');
}
    }

    public function requests(Request $request)
    {
        $requests = MaintenanceRequest::onlyTrashed()->with(['user', 'assignedPersonnel'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $term = trim($request->string('search')->toString());
                $query->where(function ($q) use ($term) {
                    $q->where('ticket_number', 'like', "%{$term}%")
                      ->orWhere('title', 'like', "%{$term}%")
                      ->orWhere('location', 'like', "%{$term}%");
                });
            })->latest('deleted_at')->paginate(15)->withQueryString();

        return view('archives.requests', compact('requests'));
    }

    public function restoreRequest($id)
    {
        $maintenance = MaintenanceRequest::onlyTrashed()->findOrFail($id);
        abort_unless(in_array($maintenance->status, ['completed', 'rejected'], true), 422,
            'Only completed or rejected requests can be restored from the archive.');

        DB::transaction(function () use ($maintenance) {
            $maintenance->restore();
            RequestLog::create([
                'request_id' => $maintenance->id,
                'status' => $maintenance->status,
                'action' => 'restored',
                'remarks' => 'Maintenance request restored from archive.',
                'updated_by' => Auth::id(),
            ]);
        });

        return back()->with('success', 'Maintenance request restored successfully.');
    }
}
