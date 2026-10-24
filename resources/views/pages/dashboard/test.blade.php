<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-900">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
     @vite('resources/css/app.css')
</head>

<body class="h-full">

    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                alt="Your Company" class="mx-auto h-10 w-auto" />

            <h2 class="mt-10 text-center text-2xl leading-9 font-bold tracking-tight text-white">
                Sign in to your account
            </h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form action="#" method="POST" class="space-y-6">

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm leading-6 font-medium text-gray-100">
                        Email address
                    </label>

                    <div class="mt-2">
                        <input id="email" type="email" name="email" required autocomplete="email"
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white 
                            outline outline-1 -outline-offset-1 outline-white/10 
                            placeholder:text-gray-500 
                            focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 
                            sm:text-sm leading-6" />
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm leading-6 font-medium text-gray-100">
                            Password
                        </label>

                        <div class="text-sm">
                            <a href="#" class="font-semibold text-indigo-400 hover:text-indigo-300">
                                Forgot password?
                            </a>
                        </div>
                    </div>

                    <div class="mt-2">
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white 
                            outline outline-1 -outline-offset-1 outline-white/10 
                            placeholder:text-gray-500 
                            focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 
                            sm:text-sm leading-6" />
                    </div>
                </div>

                <!-- Button -->
                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 
                        text-sm leading-6 font-semibold text-white 
                        hover:bg-indigo-400 
                        focus-visible:outline focus-visible:outline-2 
                        focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                        Sign in
                    </button>
                </div>

            </form>

            <!-- Footer -->
            <p class="mt-10 text-center text-sm leading-6 text-gray-400">
                Not a member?
                <a href="#" class="font-semibold text-indigo-400 hover:text-indigo-300">
                    Start a 14 day free trial
                </a>
            </p>
        </div>
    </div>

</body>

</html>









USER DASHBOARD

LUMA
@extends('layouts.apps')

@section('content')
  <div class="container px-6 mx-auto grid">

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
      User Dashboard
    </h2>

    <!-- Cards -->
    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">

      <!-- Card 1 -->
      <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path
              d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
            </path>
          </svg>
        </div>
        <div>
          <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
            Total Maintenance Requests
          </p>
          <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
            {{ $total ?? 0 }}
          </p>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
              d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-9V5a1 1 0 10-2 0v5a1 1 0 00.293.707l3 3a1 1 0 101.414-1.414L11 9z"
              clip-rule="evenodd" />
          </svg>
        </div>
        <div>
          <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
            Pending Maintenance Requests
          </p>
          <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
            {{ $pending ?? 0 }}
          </p>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
              clip-rule="evenodd" />
          </svg>
        </div>
        <div>
          <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
            Completed Maintenance Requests
          </p>
          <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
            {{ $completed ?? 0 }}
          </p>
        </div>
      </div>

      <!-- Card 4 -->
      <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path
              d="M13.828 10.172a4 4 0 10-5.656-5.656l-5.657 5.657a2 2 0 102.828 2.828l5.657-5.657a2 2 0 112.828 2.828l-5.657 5.657a4 4 0 01-5.656-5.656l1.414-1.414" />
          </svg>
        </div>
        <div>
          <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
            In Progress Maintenance Requests
          </p>
          <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
            {{ $inProgress ?? 0 }}
          </p>
        </div>
      </div>

    </div>

    <!-- New Table -->

  </div>
@endsection