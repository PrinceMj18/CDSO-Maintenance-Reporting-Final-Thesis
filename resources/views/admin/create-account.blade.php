@extends('layouts.apps')
@section('content')
<div class="mx-auto max-w-3xl px-4 py-6 sm:px-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Create New Account</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Create an account for an authorized system role.</p>
    </div>
    @if($errors->any())
        <div class="mb-4 rounded-lg bg-red-50 p-4 text-sm text-red-700">@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>
    @endif
    <form method="POST" action="{{ route('superadmin.accounts.store') }}" class="space-y-5 rounded-xl bg-white p-5 shadow-sm dark:bg-gray-800 sm:p-7">
        @csrf
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div><label class="mb-1 block text-sm font-medium">First name</label><input name="fname" value="{{ old('fname') }}" required maxlength="50" class="w-full rounded-lg border border-gray-300 px-3 py-2 dark:border-gray-600 dark:bg-gray-900 dark:text-white"></div>
            <div><label class="mb-1 block text-sm font-medium">Last name</label><input name="lname" value="{{ old('lname') }}" required maxlength="50" class="w-full rounded-lg border border-gray-300 px-3 py-2 dark:border-gray-600 dark:bg-gray-900 dark:text-white"></div>
            <div class="sm:col-span-2"><label class="mb-1 block text-sm font-medium">CCA email address</label><input type="email" name="email" value="{{ old('email') }}" required pattern="^[a-zA-Z0-9._%+-]+@cca\.edu\.ph$" class="w-full rounded-lg border border-gray-300 px-3 py-2 dark:border-gray-600 dark:bg-gray-900 dark:text-white"><p class="mt-1 text-xs text-gray-500">Use an @cca.edu.ph email address.</p></div>
            <div><label class="mb-1 block text-sm font-medium">Role</label><select name="role_id" required class="w-full rounded-lg border border-gray-300 px-3 py-2 dark:border-gray-600 dark:bg-gray-900 dark:text-white"><option value="">Select role</option>@foreach($roles as $role)<option value="{{ $role->id }}" @selected(old('role_id') == $role->id)>{{ ucfirst($role->name) }}</option>@endforeach</select></div>
            <div><label class="mb-1 block text-sm font-medium">Password</label><input type="password" name="password" required minlength="8" autocomplete="new-password" class="w-full rounded-lg border border-gray-300 px-3 py-2 dark:border-gray-600 dark:bg-gray-900 dark:text-white"></div>
            <div class="sm:col-span-2"><label class="mb-1 block text-sm font-medium">Confirm password</label><input type="password" name="password_confirmation" required minlength="8" autocomplete="new-password" class="w-full rounded-lg border border-gray-300 px-3 py-2 dark:border-gray-600 dark:bg-gray-900 dark:text-white"></div>
        </div>
        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end"><a href="{{ auth()->user()->role->name === 'superadmin' ? route('acc_superadmin') : route('accountsmanagement') }}" class="inline-flex justify-center rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold">Cancel</a><button type="submit" class="inline-flex w-full justify-center rounded-lg bg-green-700 px-5 py-2 text-sm font-semibold text-white hover:bg-green-800 sm:w-auto">Create Account</button></div>
    </form>
</div>
@endsection
