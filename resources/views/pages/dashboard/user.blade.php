{{-- resources/views/pages/dashboard/user.blade.php --}}

@extends('layouts.apps')

@section('content')

@if (session('success'))
    <div id="success-popup"
         class="fixed top-5 right-5 z-[99999] w-[calc(100%-2rem)] max-w-md
                rounded-xl border border-green-200 bg-white p-5 shadow-xl
                dark:border-green-700 dark:bg-gray-800"
         role="alert"
         aria-live="polite">

        <div class="flex items-start gap-3">
            <div class="flex h-10 w-10 shrink-0 items-center justify-center
                        rounded-full bg-green-100 text-green-600">
                <svg class="h-6 w-6" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>

            <div class="flex-1">
                <h3 class="font-semibold text-gray-900 dark:text-white">
                    Request Submitted Successfully!
                </h3>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                    {{ session('success') }}
                </p>
            </div>

            <button type="button"
                    onclick="document.getElementById('success-popup').remove()"
                    class="text-gray-400 hover:text-gray-700"
                    aria-label="Close notification">
                &times;
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const popup = document.getElementById('success-popup');

            if (popup) {
                setTimeout(() => {
                    popup.style.transition = 'opacity 0.4s ease';
                    popup.style.opacity = '0';

                    setTimeout(() => popup.remove(), 400);
                }, 5000);
            }
        });
    </script>
@endif

<style>
    .dashboard-card {
        transition: all 0.35s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-10px) scale(1.02);
    }

    .dashboard-card:hover .card-icon {
        transform: rotate(-8deg) scale(1.12);
    }

    .dashboard-card:hover .card-glow {
        opacity: 1;
    }

    .card-icon {
        transition: all 0.35s ease;
    }

    .card-glow {
        opacity: 0;
        transition: all 0.35s ease;
    }

    .workflow-card {
        transition: all 0.35s ease;
    }

    .workflow-card:hover {
        transform: translateY(-8px);
    }

    .workflow-card:hover .workflow-number {
        transform: scale(1.15) rotate(8deg);
    }

    .workflow-number {
        transition: all 0.35s ease;
    }

    .hero-banner {
        transition: all 0.4s ease;
    }

    .hero-banner:hover {
        transform: scale(1.01);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    .action-btn {
        transition: all 0.3s ease;
    }

    .action-btn:hover {
        transform: translateY(-3px);
    }

    .floating-pattern {
        animation: floatPattern 18s linear infinite;
    }

    @keyframes floatPattern {
        from {
            transform: translateX(0);
        }

        to {
            transform: translateX(-120px);
        }
    }
</style>

<div class="container px-4 py-6 mx-auto lg:px-6 overflow-hidden">

    <!-- Header -->
    <div class="flex flex-col gap-4 mb-8 md:flex-row md:items-center md:justify-between">

        <div>
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">
                User Dashboard
            </h1>

            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                Monitor and track all your maintenance requests in real time.
            </p>
        </div>

        <div>
            <a href="{{ route('showForm') }}"
                class="action-btn inline-flex items-center px-5 py-3 text-sm font-medium text-white transition duration-200 bg-purple-600 border border-transparent rounded-xl hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 shadow-lg hover:shadow-purple-500/40">

                <svg class="w-5 h-5 mr-2"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 4v16m8-8H4">
                    </path>
                </svg>

                Submit New Request
            </a>
        </div>
    </div>

    <!-- HERO -->
    <div class="mb-8">

        <div
            class="hero-banner relative overflow-hidden bg-gradient-to-r from-purple-600 via-indigo-600 to-blue-600 rounded-3xl shadow-2xl">

            <div class="absolute inset-0 opacity-10 floating-pattern">

                <svg class="w-[200%] h-full"
                    xmlns="http://www.w3.org/2000/svg">

                    <defs>
                        <pattern id="pattern"
                            width="40"
                            height="40"
                            patternUnits="userSpaceOnUse">

                            <path d="M0 39L39 0H40V1L1 40H0V39Z"
                                fill="white" />
                        </pattern>
                    </defs>

                    <rect width="100%"
                        height="100%"
                        fill="url(#pattern)" />
                </svg>
            </div>

            <div class="relative p-6 md:p-8 lg:p-10">

                <div class="max-w-2xl">

                    <h2 class="text-2xl font-bold text-white md:text-3xl mb-3">
                        Welcome Back 
                    </h2>

                    <p class="text-sm leading-relaxed text-purple-100 md:text-base">
                        Stay updated with the progress of your submitted
                        maintenance concerns. You can track approvals,
                        ongoing work, and completed repairs here.
                    </p>

                    <div class="flex flex-wrap gap-3 mt-6">

                        <span
                            class="px-4 py-2 text-sm text-white rounded-full bg-white/20 backdrop-blur-sm">
                            Total Requests: {{ $total ?? 0 }}
                        </span>

                        <span
                            class="px-4 py-2 text-sm text-white rounded-full bg-white/20 backdrop-blur-sm">
                            Active Requests:
                            {{ ($pending ?? 0) + ($approved ?? 0) + ($inProgress ?? 0) }}
                        </span>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid gap-6 mb-10 sm:grid-cols-2 xl:grid-cols-5">

        <!-- Total -->
        <div onclick="window.location='{{ route('trackReq', ['status' => 'all']) }}'"
            class="dashboard-card cursor-pointer group relative bg-white dark:bg-gray-800 rounded-2xl shadow-md hover:shadow-2xl transition duration-300 border border-gray-100 dark:border-gray-700 overflow-hidden">

            <div
                class="card-glow absolute inset-0 bg-gradient-to-br from-purple-500/5 to-indigo-500/10 pointer-events-none">
            </div>

            <div class="p-6 relative">

                <div class="flex items-center justify-between gap-4">

                    <div class="min-w-0">

                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Total Requests
                        </p>

                        <h3 class="mt-2 text-3xl font-bold text-gray-800 dark:text-white">
                            {{ $total ?? 0 }}
                        </h3>
                    </div>

                    <div
                        class="card-icon flex items-center justify-center flex-shrink-0 w-14 h-14 rounded-2xl bg-purple-100 text-purple-600 dark:bg-purple-600 dark:text-white">

                        <svg class="w-7 h-7"
                            fill="currentColor"
                            viewBox="0 0 20 20">

                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending -->
        <div onclick="window.location='{{ route('trackReq', ['status' => 'pending']) }}'"
            class="dashboard-card cursor-pointer group relative bg-white dark:bg-gray-800 rounded-2xl shadow-md hover:shadow-2xl transition duration-300 border border-gray-100 dark:border-gray-700 overflow-hidden">

            <div class="card-glow absolute inset-0 bg-gradient-to-br from-orange-500/5 to-orange-500/10"></div>

            <div class="p-6 relative">

                <div class="flex items-center justify-between gap-4">

                    <div class="min-w-0">

                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Pending
                        </p>

                        <h3 class="mt-2 text-3xl font-bold text-orange-500">
                            {{ $pending ?? 0 }}
                        </h3>
                    </div>

                     <div
                        class="card-icon flex items-center justify-center w-14 h-14 rounded-2xl bg-orange-100 text-orange-500 dark:bg-orange-500 dark:text-white">

                        <svg class="w-7 h-7" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-9V5a1 1 0 10-2 0v5a1 1 0 00.293.707l3 3a1 1 0 101.414-1.414L11 9z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>

                </div>
            </div>
        </div>

        <!-- Approved -->
        <div onclick="window.location='{{ route('trackReq', ['status' => 'approved']) }}'"
            class="dashboard-card cursor-pointer group relative bg-white dark:bg-gray-800 rounded-2xl shadow-md hover:shadow-2xl transition duration-300 border border-gray-100 dark:border-gray-700 overflow-hidden">

            <div class="card-glow absolute inset-0 bg-gradient-to-br from-yellow-500/5 to-yellow-500/10"></div>

            <div class="p-6 relative">

                <div class="flex items-center justify-between gap-4">

                    <div class="min-w-0">

                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Approved
                        </p>

                        <h3 class="mt-2 text-3xl font-bold text-yellow-500">
                            {{ $approved ?? 0 }}
                        </h3>
                    </div>

                      <div
                        class="card-icon flex items-center justify-center w-14 h-14 rounded-2xl bg-yellow-100 text-yellow-500 dark:bg-yellow-500 dark:text-white">

                        <svg class="w-7 h-7" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>

                </div>
            </div>
        </div>

        <!-- In Progress -->
        <div onclick="window.location='{{ route('trackReq', ['status' => 'in_progress']) }}'"
            class="dashboard-card cursor-pointer group relative bg-white dark:bg-gray-800 rounded-2xl shadow-md hover:shadow-2xl transition duration-300 border border-gray-100 dark:border-gray-700 overflow-hidden">

            <div class="card-glow absolute inset-0 bg-gradient-to-br from-blue-500/5 to-blue-500/10"></div>

            <div class="p-6 relative">

                <div class="flex items-center justify-between gap-4">

                    <div class="min-w-0">

                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            In Progress
                        </p>

                        <h3 class="mt-2 text-3xl font-bold text-blue-500">
                            {{ $inProgress ?? 0 }}
                        </h3>
                    </div>

 <div
                        class="card-icon flex items-center justify-center w-14 h-14 rounded-2xl bg-blue-100 text-blue-500 dark:bg-blue-500 dark:text-white">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-7 h-7" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M13.828 10.172a4 4 0 10-5.656-5.656l-5.657 5.657a2 2 0 102.828 2.828l5.657-5.657a2 2 0 112.828 2.828l-5.657 5.657a4 4 0 01-5.656-5.656l1.414-1.414" />
                        </svg>
                    </div>

                </div>
            </div>
        </div>

        <!-- Completed -->
        <div onclick="window.location='{{ route('trackReq', ['status' => 'completed']) }}'"
            class="dashboard-card cursor-pointer group relative bg-white dark:bg-gray-800 rounded-2xl shadow-md hover:shadow-2xl transition duration-300 border border-gray-100 dark:border-gray-700 overflow-hidden">

            <div class="card-glow absolute inset-0 bg-gradient-to-br from-green-500/5 to-green-500/10"></div>

            <div class="p-6 relative">

                <div class="flex items-center justify-between gap-4">

                    <div class="min-w-0">

                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Completed
                        </p>

                        <h3 class="mt-2 text-3xl font-bold text-green-500">
                            {{ $completed ?? 0 }}
                        </h3>
                    </div>


                    <div
                        class="card-icon flex items-center justify-center w-14 h-14 rounded-2xl bg-green-100 text-green-500 dark:bg-green-500 dark:text-white">

                        <svg class="w-7 h-7" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <!-- Request Workflow -->
    <div
        class="bg-white dark:bg-gray-800 rounded-3xl shadow-md border border-gray-100 dark:border-gray-700 p-8 mb-10">

        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-xl font-bold text-gray-800 dark:text-white">
                    Maintenance Request Workflow
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Understand how your request progresses through the system.
                </p>
            </div>
        </div>

        <div class="grid gap-6 md:grid-cols-4">

            <div
                class="workflow-card p-5 rounded-2xl bg-orange-50 dark:bg-orange-900/20 border border-orange-100 dark:border-orange-800 hover:shadow-lg">
                <div
                    class="workflow-number w-12 h-12 flex items-center justify-center rounded-xl bg-orange-500 text-white font-bold text-lg mb-4 shadow-lg">
                    1
                </div>

                <h3 class="font-semibold text-orange-600 mb-2">
                    Pending
                </h3>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Your request is waiting for administrator review.
                </p>
            </div>

            <div
                class="workflow-card p-5 rounded-2xl bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-100 dark:border-yellow-800 hover:shadow-lg">
                <div
                    class="workflow-number w-12 h-12 flex items-center justify-center rounded-xl bg-yellow-500 text-white font-bold text-lg mb-4 shadow-lg">
                    2
                </div>

                <h3 class="font-semibold text-yellow-600 mb-2">
                    Approved
                </h3>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Your request has been accepted and scheduled.
                </p>
            </div>

            <div
                class="workflow-card p-5 rounded-2xl bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-800 hover:shadow-lg">
                <div
                    class="workflow-number w-12 h-12 flex items-center justify-center rounded-xl bg-blue-500 text-white font-bold text-lg mb-4 shadow-lg">
                    3
                </div>

                <h3 class="font-semibold text-blue-600 mb-2">
                    In Progress
                </h3>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Assigned personnel are currently working on it.
                </p>
            </div>

            <div
                class="workflow-card p-5 rounded-2xl bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800 hover:shadow-lg">
                <div
                    class="workflow-number w-12 h-12 flex items-center justify-center rounded-xl bg-green-500 text-white font-bold text-lg mb-4 shadow-lg">
                    4
                </div>

                <h3 class="font-semibold text-green-600 mb-2">
                    Completed
                </h3>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    The maintenance request has been successfully completed.
                </p>
            </div>
        </div>
    </div>

</div>

@endsection