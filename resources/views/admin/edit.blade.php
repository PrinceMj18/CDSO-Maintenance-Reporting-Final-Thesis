@extends('layouts.apps')

@section('content')
    <section class="bg-gray-50 dark:bg-gray-900 min-h-screen py-10">
        <div class="max-w-3xl mx-auto px-4">

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md">

                <!-- Header -->
                <div class="px-6 py-4 border-b dark:border-gray-700">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                        Update User
                    </h2>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <form action="{{ route('update-account.admin', $user->id) }}" class="space-y-5" method="POST">
                    @csrf
                    @method('PUT')
                        <!-- Product Name -->
                        <div class="mb-2">
                            <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">
                                First Name
                            </label>
                            <input name="fname" type="text" value="{{ $user->fname }}"
                                class="w-full rounded-lg border-gray-300 bg-gray-50 p-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>

                        <!-- Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-2">

                            <div class="mb-2">
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">
                                    Last Name
                                </label>
                                <input name="lname" type="text" value="{{ $user->lname }}"
                                    class="w-full rounded-lg border-gray-300 bg-gray-50 p-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            </div>

                            <div class="mb-2">
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">
                                    Email
                                </label>
                                <input name="email" type="text" value="{{ $user->email }}"
                                    class="w-full rounded-lg border-gray-300 bg-gray-50 p-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            </div>

                            <div class="mb-2">
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">
                                    Password
                                </label>
                                <input name="password" type="text" placeholder="Leave blank to keep current password"
                                    class="w-full rounded-lg border-gray-300 bg-gray-50 p-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            </div>

                            <div class="mb-2">
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">
                                    Role
                                </label>
                                <select name="role_id" class="w-full rounded-lg border-gray-300 bg-gray-50 p-3 
    dark:bg-gray-700 dark:border-gray-600 dark:text-white">

                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                        </div>
                        <!-- Buttons -->
                        <div class="flex justify-between items-center pt-4 border-t dark:border-gray-700">


                            <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg shadow-sm transition">
                                Save Changes
                            </button>

                        </div>

                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection