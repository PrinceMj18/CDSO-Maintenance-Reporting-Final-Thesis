<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    public function superadminDashboard()
{
    $total = User::count();

    $supe_admin = User::whereHas('role', function ($query) {
        $query->where('name', 'superadmin');
    })->count();

    $total -= $supe_admin;

    $admin = User::whereHas('role', function ($query) {
        $query->where('name', 'admin');
    })->count();

    $personnel = User::whereHas('role', function ($query) {
        $query->where('name', 'personnel');
    })->count();

    $user = User::whereHas('role', function ($query) {
        $query->where('name', 'user');
    })->count();

    return view('pages.dashboard.index', compact(
        'total',
        'admin',
        'personnel',
        'user',
        'supe_admin'
    ));
}

    public function accManagement()
{
    $users = User::with('role')
        ->whereHas('role', function ($query) {
            $query->where('name', '!=', 'superadmin');
        })
        ->latest()
        ->get();

    return view('superadmin.accounts', compact('users'));
}

    public function createAccount()
    {
        $roles = Role::whereIn('name', ['user', 'personnel', 'admin'])->orderBy('name')->get();
        return view('admin.create-account', compact('roles'));
    }

    public function edit_account(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('superadmin.edit-accounts', compact('user', 'roles'));
    }

    public function update_account(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'fname' => 'required|string|max:50',
            'lname' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . $id,
            'role_id' => 'required|exists:roles,id',
            'password' => 'nullable|min:6'
        ]);

        $user->fname = $validated['fname'];
        $user->lname = $validated['lname'];
        $user->email = $validated['email'];
        $user->role_id = $validated['role_id'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();
        return redirect()->route('acc_superadmin');
    }
    public function delete_account($id)
{
    $user = User::findOrFail($id);

    // Prevent deleting yourself
    if (auth()->id() == $user->id) {
        return redirect()->route('acc_superadmin')
            ->with('error', 'You cannot archive your own account.');
    }

    $user->delete();

    return redirect()->route('acc_superadmin')
        ->with('success', 'Account archived successfully.');
}
}
