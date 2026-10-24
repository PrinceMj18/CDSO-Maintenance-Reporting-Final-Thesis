@extends('layouts.apps')

@section('content')

    <div class="w-full mt-6 mb-8 px-4">


        <!-- Back -->
        <div class="mb-4">
            <a href="{{ route('logsRequest') }}"
                class="inline-flex items-center text-sm text-gray-500 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-400">

                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />

                </svg>

                Back to Requests
            </a>
        </div>

        <!-- REQUEST SUMMARY -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xs
                                border border-gray-200 dark:border-gray-700">

            <!-- Header -->
            <div class="px-6 py-5 border-b
                                    border-gray-200 dark:border-gray-700">

                <div class="flex flex-col sm:flex-row
                                        sm:items-center sm:justify-between gap-3">

                    <div>
<!-- Section Label -->
<p class="text-xs font-medium uppercase tracking-wide text-gray-400">
    Maintenance Request
</p>

<!-- Ticket Number -->
<div class="mt-2 flex items-center gap-2">
    <span class="text-xs font-medium uppercase tracking-wide text-gray-400">
        Ticket No.
    </span>

    <span class="inline-flex items-center px-2.5 py-1
                 text-sm font-semibold
                 text-indigo-700 bg-indigo-50
                 border border-indigo-100
                 rounded-md
                 dark:bg-indigo-900/30
                 dark:text-indigo-300
                 dark:border-indigo-800">
        {{ $requestData->ticket_number ?? 'Not assigned' }}
    </span>
</div>

<!-- Request Title -->
<h2 class="mt-2 text-xl font-semibold
           text-gray-800 dark:text-gray-100">
    {{ $requestData->title }}
</h2>

</div>



                    <!-- Current Status -->

                    @php
                        $statusClasses = [
                            'pending' => 'bg-yellow-100 text-yellow-700',
                            'approved' => 'bg-blue-100 text-blue-700',
                            'in_progress' => 'bg-purple-100 text-purple-700',
                            'completed' => 'bg-green-100 text-green-700',
                            'rejected' => 'bg-red-100 text-red-700',
                        ];

                        $statusLabels = [
                            'pending' => 'Pending',
                            'approved' => 'Approved',
                            'in_progress' => 'In Progress',
                            'completed' => 'Completed',
                            'rejected' => 'Rejected',
                        ];

                        $statusClass =
                            $statusClasses[$requestData->status]
                            ?? 'bg-gray-100 text-gray-700';

                        $statusLabel =
                            $statusLabels[$requestData->status]
                            ?? ucfirst($requestData->status);
                    @endphp

                    <span class="self-start sm:self-auto
                                             px-3 py-1.5 rounded-full
                                             text-xs font-semibold
                                             {{ $statusClass }}">

                        {{ $statusLabel }}

                    </span>

                </div>

            </div>


            <!-- Request Information -->

            <div class="px-6 py-5">

                <div class="grid grid-cols-1 sm:grid-cols-2
                                        lg:grid-cols-4 gap-5">

                    <!-- Requester -->
                    <div>

                        <p class="text-xs font-medium uppercase
                                              tracking-wide text-gray-400">

                            Requester

                        </p>

                        <p class="mt-1 text-sm font-medium
                                              text-gray-700 dark:text-gray-200">

                            {{ $requestData->user->email ?? 'N/A' }}

                        </p>

                    </div>


                    <!-- Category -->
                    <div>

                        <p class="text-xs font-medium uppercase
                                              tracking-wide text-gray-400">

                            Category

                        </p>

                        <p class="mt-1 text-sm font-medium
                                              text-gray-700 dark:text-gray-200">

                            {{ $requestData->category }}

                        </p>

                    </div>


                    <!-- Location -->
                    <div>

                        <p class="text-xs font-medium uppercase
                                              tracking-wide text-gray-400">

                            Location

                        </p>

                        <p class="mt-1 text-sm font-medium
                                              text-gray-700 dark:text-gray-200">

                            {{ $requestData->location }}

                        </p>

                    </div>


                    <!-- Submitted -->
                    <div>

                        <p class="text-xs font-medium uppercase
                                              tracking-wide text-gray-400">

                            Submitted

                        </p>

                        <p class="mt-1 text-sm font-medium
                                              text-gray-700 dark:text-gray-200">

                            {{ $requestData->created_at->format('M d, Y') }}

                        </p>

                    </div>

                </div>

            </div>

        </div>
        <!-- ================================================= -->
        <!-- MATERIALS USED -->
        <!-- ================================================= -->

        <div class="mt-6 bg-white dark:bg-gray-800
                    rounded-lg shadow-xs
                    border border-gray-200 dark:border-gray-700">

            <!-- Header -->
            <div class="px-6 py-5 border-b
                        border-gray-200 dark:border-gray-700">

                <h3 class="text-base font-semibold
                           text-gray-800 dark:text-gray-100">

                    Materials Used

                </h3>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">

                    Materials and quantities used for this maintenance request.

                </p>

            </div>

            <!-- Materials Table -->
            <div class="px-6 py-6">

                @if($requestData->inventoryUsages->count())

                    <div class="overflow-x-auto">

                        <table class="w-full text-sm">

                            <thead>

                                <tr class="border-b
                                                   border-gray-200
                                                   dark:border-gray-700">

                                    <th class="px-4 py-3 text-left
                                                       text-xs font-semibold
                                                       uppercase tracking-wide
                                                       text-gray-400">

                                        Material

                                    </th>

                                    <th class="px-4 py-3 text-left
                                                       text-xs font-semibold
                                                       uppercase tracking-wide
                                                       text-gray-400">

                                        Quantity Used

                                    </th>

                                    <th class="px-4 py-3 text-left
                                                       text-xs font-semibold
                                                       uppercase tracking-wide
                                                       text-gray-400">

                                        Used By

                                    </th>

                                    <th class="px-4 py-3 text-left
                                                       text-xs font-semibold
                                                       uppercase tracking-wide
                                                       text-gray-400">

                                        Date

                                    </th>

                                </tr>

                            </thead>

                            <tbody class="divide-y
                                                  divide-gray-200
                                                  dark:divide-gray-700">

                                @foreach($requestData->inventoryUsages as $usage)

                                                <tr>

                                                    <!-- Material -->
                                                    <td class="px-4 py-3
                                                                                           text-gray-700
                                                                                           dark:text-gray-200">

                                                        {{ $usage->item->name ?? 'Unknown Item' }}

                                                    </td>

                                                    <!-- Quantity -->
                                                    <td class="px-4 py-3
                                                                                           text-gray-700
                                                                                           dark:text-gray-200">

                                                        {{ $usage->quantity_used }}

                                                        {{ $usage->item->unit ?? '' }}

                                                    </td>

                                                    <!-- Used By -->
                                                    <td class="px-4 py-3
                                                                                           text-gray-700
                                                                                           dark:text-gray-200">

                                                        @if($usage->user)

                                                            {{ $usage->user->fname }}
                                                            {{ $usage->user->lname }}

                                                        @else

                                                            Unknown User

                                                        @endif

                                                    </td>

                                                    <!-- Date -->
                                                    <td class="px-4 py-3
                                                                                           text-gray-500
                                                                                           dark:text-gray-400">

                                                        {{ $usage->used_at
                                    ? $usage->used_at->format('M d, Y • h:i A')
                                    : $usage->created_at->format('M d, Y • h:i A') }}

                                                    </td>

                                                </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="py-6 text-center">

                        <p class="text-sm text-gray-500
                                          dark:text-gray-400">

                            No materials were used for this request.

                        </p>

                    </div>

                @endif

            </div>

        </div>


        <!-- ================================================= -->
        <!-- ACTIVITY HISTORY -->
        <!-- ================================================= -->

        <div class="mt-6 bg-white dark:bg-gray-800
                                rounded-lg shadow-xs
                                border border-gray-200 dark:border-gray-700">

            <!-- Header -->

            <div class="px-6 py-5 border-b
                                    border-gray-200 dark:border-gray-700">

                <h3 class="text-base font-semibold
                                       text-gray-800 dark:text-gray-100">

                    Activity History

                </h3>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">

                    Timeline of actions and status changes for this request.

                </p>

            </div>


            <!-- Timeline -->

            <div class="px-6 py-6">

                @forelse($requestData->logs as $log)

                    <div class="relative flex gap-4 pb-7 last:pb-0">

                        <!-- Vertical Line -->

                        @if(!$loop->last)

                            <div class="absolute left-[7px] top-4
                                                                                            w-px h-full
                                                                                            bg-gray-200
                                                                                            dark:bg-gray-700">
                            </div>

                        @endif


                        <!-- Dot -->

                        <div class="relative z-10 mt-1
                                                                    w-4 h-4 rounded-full
                                                                    bg-indigo-100
                                                                    border-2 border-indigo-500
                                                                    dark:bg-indigo-900
                                                                    dark:border-indigo-400
                                                                    flex-shrink-0">
                        </div>


                        <!-- Log Content -->

                        <div class="min-w-0 flex-1">

                            <div class="flex flex-col sm:flex-row
                                                                        sm:items-center
                                                                        sm:justify-between gap-1">

                                <h4 class="text-sm font-semibold
                                                                           text-gray-800
                                                                           dark:text-gray-100">

                                    {{ ucwords(str_replace('_', ' ', $log->status)) }}

                                </h4>

                                <span class="text-xs text-gray-400">

                                    {{ $log->created_at->format('M d, Y • h:i A') }}

                                </span>

                            </div>


                            @if($log->remarks)

                                <p class="mt-1 text-sm
                                                                                              text-gray-600
                                                                                              dark:text-gray-400">

                                    {{ $log->remarks }}

                                </p>

                            @endif


                            @if($log->updatedBy)

                                        <p class="mt-2 text-xs text-gray-400">
                                            Updated by:
                                            <span class="font-medium text-gray-500 dark:text-gray-300">
                                                {{ $log->updatedBy->name
                                ?? $log->updatedBy->email
                                ?? 'Unknown User' }}
                                            </span>
                                        </p>

                            @else

                                <p class="mt-2 text-xs text-gray-400">
                                    Updated by:
                                    <span class="font-medium text-gray-500 dark:text-gray-300">
                                        Unknown User
                                    </span>
                                </p>

                            @endif

                        </div>

                    </div>

                @empty

                    <div class="py-8 text-center">

                        <p class="text-sm text-gray-500
                                                                  dark:text-gray-400">

                            No activity has been recorded for this request.

                        </p>

                    </div>

                @endforelse

            </div>

        </div>


    </div>

@endsection