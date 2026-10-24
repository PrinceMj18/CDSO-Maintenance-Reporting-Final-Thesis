@extends('layouts.apps')

@section('content')

    <div class="container w-full max-w-full min-w-0 px-3 py-5 mx-auto overflow-x-hidden sm:px-4 lg:px-5">

        <!-- HEADER -->
        <div class="flex flex-col gap-3 mb-6 lg:flex-row lg:items-center lg:justify-between">

            <div>

                <h1 class="text-xl font-bold text-gray-800 sm:text-2xl lg:text-3xl dark:text-white">
                    {{ ucfirst(str_replace('_', ' ', $status ?? 'all')) }} Requests
                </h1>

                <p class="mt-1 text-xs text-gray-500 sm:text-sm dark:text-gray-400">
                    Track and monitor your submitted maintenance requests.
                </p>
            </div>

            <a href="{{ route('userDashboard') }}"
                class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white transition rounded-xl bg-gray-800 hover:bg-gray-900">

                Back to Dashboard
            </a>
        </div>

        <!-- FILTERS -->
        
<!-- REQUEST STATUS FILTERS -->
@php
    $filters = [
        'all' => 'All Requests',
        'pending' => 'Pending',
        'approved' => 'Approved',
        'in_progress' => 'In Progress',
        'completed' => 'Completed',
        'rejected' => 'Rejected',
    ];

    $currentStatus = $status ?? request('status', 'all');

    if (!array_key_exists($currentStatus, $filters)) {
        $currentStatus = 'all';
    }
@endphp

<div class="mb-5">
    <label for="request-status-mobile"
        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300 sm:hidden">
        Filter requests
    </label>

    <!-- MOBILE: STATUS DROPDOWN -->
    <form method="GET" action="{{ route('trackReq') }}"
        class="sm:hidden">
        @foreach(request()->except(['status', 'page']) as $key => $value)
            @if(is_scalar($value))
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endif
        @endforeach

        <select id="request-status-mobile"
            name="status"
            onchange="this.form.submit()"
            class="block w-full rounded-lg border border-gray-300 bg-white
                   px-3 py-3 text-sm text-gray-800 shadow-sm
                   focus:border-gray-500 focus:ring-2 focus:ring-gray-200
                   dark:border-gray-600 dark:bg-gray-800 dark:text-white">

            @foreach($filters as $key => $label)
                <option value="{{ $key }}"
                    {{ $currentStatus === $key ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>

        <noscript>
            <button type="submit"
                class="mt-2 rounded-lg border border-gray-300 px-4 py-2 text-sm">
                Apply filter
            </button>
        </noscript>
    </form>

    <!-- DESKTOP: MINIMALIST STATUS BUTTONS -->
    <nav aria-label="Filter requests by status"
        class="hidden flex-wrap gap-2 sm:flex">

        @foreach($filters as $key => $label)
            <a href="{{ route('trackReq', array_merge(request()->query(), ['status' => $key, 'page' => 1])) }}"
                @if($currentStatus === $key) aria-current="page" @endif
                class="inline-flex items-center rounded-lg border px-3 py-2
                       text-sm font-medium transition
                       {{ $currentStatus === $key
                            ? 'border-gray-800 bg-gray-800 text-white dark:border-gray-200 dark:bg-gray-200 dark:text-gray-900'
                            : 'border-gray-200 bg-white text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700' }}">
                {{ $label }}
            </a>
        @endforeach

    </nav>
</div>

        <!-- SEARCH & FILTERS -->
        <form method="GET" action="{{ route('trackReq') }}" class="mb-6">

            <!-- Keep current status -->
            <input type="hidden" name="status" value="{{ $status ?? 'all' }}">

            <div class="flex flex-col gap-3 sm:flex-row">

                <!-- Search -->
                <div class="flex-1">
                    <label class="block mb-1 text-xs font-medium text-gray-500 dark:text-gray-400">
                        Search
                    </label>

                    <div class="relative">

                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search ticket number, title, description, or location..." class="w-full px-4 py-2.5 pl-10 text-sm bg-white border border-gray-200 rounded-xl
                                       focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                                       dark:bg-gray-800 dark:border-gray-700 dark:text-white
                                       dark:placeholder-gray-500">

                        <svg class="absolute w-4 h-4 text-gray-400 left-3 top-3.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m21 21-4.35-4.35m2.35-5.65a8 8 0 1 1-16 0 8 8 0 0 1 16 0z">
                            </path>

                        </svg>

                    </div>
                </div>


                <!-- Category -->
                <div class="sm:w-56">

                    <label class="block mb-1 text-xs font-medium text-gray-500 dark:text-gray-400">
                        Category
                    </label>

                    <select name="category" class="w-full px-4 py-2.5 text-sm bg-white border border-gray-200 rounded-xl
                                   focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                                   dark:bg-gray-800 dark:border-gray-700 dark:text-white">

                        <option value="">All Categories</option>

                        @foreach($categories as $category)

                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>

                                {{ ucfirst($category) }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <!-- Search Button -->
                <div class="flex items-end">

                    <button type="submit" class="w-full px-5 py-2.5 text-sm font-medium text-white
                                   bg-indigo-600 rounded-xl hover:bg-indigo-700
                                   sm:w-auto">

                        Search

                    </button>

                </div>


                <!-- Reset -->
                <div class="flex items-end">

                    <a href="{{ route('trackReq', ['status' => $status ?? 'all']) }}" class="w-full px-5 py-2.5 text-sm font-medium text-gray-700
                                   bg-gray-100 rounded-xl hover:bg-gray-200
                                   dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600
                                   sm:w-auto text-center">

                        Reset

                    </a>

                </div>

            </div>

        </form>
        <!-- TABLE -->
        <div
            class="w-full overflow-hidden bg-white border border-gray-100 shadow-sm rounded-2xl dark:border-gray-700 dark:bg-gray-800">

            <div class="w-full overflow-x-auto">
                <table class="w-full min-w-[700px]">

                    <thead class="bg-gray-50 dark:bg-gray-700">

                        <tr
                            class="text-[11px] font-semibold tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                            <th class="px-4 py-3">Ticket No.</th>
                            <th class="px-4 py-3">Request</th>
                            <th class="px-4 py-3">Category</th>
                            <th class="px-4 py-3">Priority</th>
                            <th class="px-4 py-3">Location</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Date</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700 mb-4">

                        @forelse($requests as $request)

                                            @php
                                                $priorityColors = [
                                                    'low' => 'bg-green-100 text-green-700',
                                                    'medium' => 'bg-yellow-100 text-yellow-700',
                                                    'high' => 'bg-red-100 text-red-700',
                                                ];

                                                $statusColors = [
                                                    'pending' => 'bg-orange-100 text-orange-700',
                                                    'approved' => 'bg-yellow-100 text-yellow-700',
                                                    'in_progress' => 'bg-blue-100 text-blue-700',
                                                    'completed' => 'bg-green-100 text-green-700',
                                                    'rejected' => 'bg-red-100 text-red-700',
                                                ];
                                            @endphp

                                            <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-700/40">
                                                <!-- TICKET NUMBER -->
                                                <td class="px-3 py-4 whitespace-nowrap">

                                                    <span class="inline-flex items-center w-fit max-w-full px-2 py-1 text-xs font-semibold
                               text-indigo-700 bg-indigo-100 rounded-md
                               dark:bg-indigo-900/40 dark:text-indigo-300">

                                                        {{ $request->ticket_number ?? 'Not assigned' }}

                                                    </span>

                                                </td>
                                                <!-- REQUEST -->
                                                <td class="inline-flex w-fit max-w-full px-2.5 py-1">

                                                    <div class="max-w-[220px]">

                                                        <h3 class="text-sm font-semibold text-gray-800 truncate dark:text-white">
                                                            {{ $request->title }}
                                                        </h3>

                                                        <p class="mt-1 text-xs text-gray-500 truncate dark:text-gray-400">
                                                            {{ $request->description }}
                                                        </p>
                                                    </div>
                                                </td>

                                                <!-- CATEGORY -->
                                                <td class="px-4 py-4 text-xs sm:text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap">
                                                    {{ ucfirst($request->category) }}
                                                </td>

                                                <!-- PRIORITY -->
                                                <td class="px-4 py-4 whitespace-nowrap">

                                                    <span
                                                        class="inline-flex w-fit max-w-full px-2.5 py-1 text-[11px] font-semibold rounded-full {{ $priorityColors[$request->priority] ?? 'bg-gray-100 text-gray-700' }}">

                                                        {{ ucfirst($request->priority) }}
                                                    </span>
                                                </td>

                                                <!-- LOCATION -->
                                                <td
                                                    class="px-4 py-4 text-xs sm:text-sm text-gray-700 dark:text-gray-300 max-w-[160px] truncate">
                                                    {{ $request->location }}
                                                </td>

                                                <!-- STATUS -->
                                                <td class="px-4 py-4 whitespace-nowrap">

                                                    <span
                                                        class="inline-flex w-fit max-w-full px-2.5 py-1 text-[11px] font-semibold rounded-full {{ $statusColors[$request->status] ?? 'bg-gray-100 text-gray-700' }}">

                                                        {{ ucfirst(str_replace('_', ' ', $request->status)) }}
                                                    </span>
                                                </td>

                                                <!-- DATE -->
                                                <td class="px-4 py-4 text-xs sm:text-sm text-gray-500 dark:text-gray-400 whitespace-nowrap">
                                                    {{ $request->created_at->format('M d, Y') }}
                                                </td>

                                                <!-- VIEW -->
                                                <td class="px-4 py-4 text-right whitespace-nowrap">
                                                    <a href="{{ route('viewRequest.user', $request->id) }}"
                                                        class="inline-flex w-fit max-w-full px-2.5 py-1 rounded-lg bg-gray-900 text-white text-xs font-semibold hover:bg-indigo-700">
                                                        View updates
                                                    </a>
                                                </td>
                                            </tr>

                        @empty

                            <tr>

                                <td colspan="8" class="px-6 py-12 text-center">

                                    <div class="flex flex-col items-center">

                                        <svg class="w-14 h-14 mb-3 text-gray-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 17v-2a4 4 0 018 0v2m-4-6a4 4 0 100-8 4 4 0 000 8z" />
                                        </svg>

                                        <h3 class="text-base font-semibold text-gray-700 dark:text-white">
                                            No requests found
                                        </h3>

                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                            No maintenance requests available for this status.
                                        </p>
                                    </div>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
        <!-- PAGINATION -->

        <!-- CUSTOM PAGINATION -->
        @php
            $paginator = $requests;
            $currentPage = $paginator->currentPage();
            $lastPage = $paginator->lastPage();

            $visiblePages = collect(range(1, max(1, $lastPage)))
                ->filter(
                    fn($page) =>
                        $page === 1 ||
                        $page === $lastPage ||
                        abs($page - $currentPage) <= 2
                )
                ->values();
        @endphp

        <div class="flex flex-col gap-4 mt-4 border border-gray-100 rounded-xl
                bg-white px-4 py-4 dark:border-gray-700 dark:bg-gray-800
                sm:flex-row sm:items-center sm:justify-between">

            <!-- Showing X to Y of Z -->
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Showing
                <span class="font-semibold text-gray-800 dark:text-white">
                    {{ $paginator->firstItem() ?? 0 }}
                </span>
                to
                <span class="font-semibold text-gray-800 dark:text-white">
                    {{ $paginator->lastItem() ?? 0 }}
                </span>
                of
                <span class="font-semibold text-gray-800 dark:text-white">
                    {{ $paginator->total() }}
                </span>
                requests
            </p>

            <div class="flex flex-wrap items-center gap-2">

                <!-- Previous -->
                @if($paginator->onFirstPage())
                    <span class="rounded-lg border border-gray-200 px-3 py-2
                                 text-sm text-gray-300 dark:border-gray-700">
                        &lsaquo;
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" aria-label="Previous page" class="rounded-lg border border-gray-200 px-3 py-2 text-sm
                              text-gray-700 hover:bg-gray-100 dark:border-gray-700
                              dark:text-gray-200 dark:hover:bg-gray-700">
                        &lsaquo;
                    </a>
                @endif

                <!-- Page Numbers -->
                @php $previousPage = 0; @endphp

                @foreach($visiblePages as $page)
                    @if($previousPage && $page > $previousPage + 1)
                        <span class="px-1 text-gray-500">...</span>
                    @endif

                    @if($page === $currentPage)
                        <span aria-current="page" class="flex h-9 min-w-9 items-center justify-center
                                         rounded-full bg-gray-800 px-3 text-sm font-semibold
                                         text-white dark:bg-indigo-600">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $paginator->url($page) }}" class="flex h-9 min-w-9 items-center justify-center
                                      rounded-full px-3 text-sm font-medium text-gray-700
                                      hover:bg-gray-100 dark:text-gray-200
                                      dark:hover:bg-gray-700">
                            {{ $page }}
                        </a>
                    @endif

                    @php $previousPage = $page; @endphp
                @endforeach

                <!-- Next -->
                @if($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" aria-label="Next page" class="rounded-lg border border-gray-200 px-3 py-2 text-sm
                              text-gray-700 hover:bg-gray-100 dark:border-gray-700
                              dark:text-gray-200 dark:hover:bg-gray-700">
                        &rsaquo;
                    </a>
                @else
                    <span class="rounded-lg border border-gray-200 px-3 py-2
                                 text-sm text-gray-300 dark:border-gray-700">
                        &rsaquo;
                    </span>
                @endif

                <!-- Go to Page -->
                @if($lastPage > 1)
                    <form method="GET" action="{{ route('trackReq') }}" class="ml-2 flex items-center gap-2">

                        @foreach(request()->except('page') as $key => $value)
                            @if(is_scalar($value))
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endif
                        @endforeach

                        <input type="hidden" name="status" value="{{ $status }}">

                        <label for="track-jump" class="text-xs text-gray-500 dark:text-gray-400">
                            Go to
                        </label>

                        <select id="track-jump" name="page" onchange="this.form.submit()" class="rounded-lg border border-gray-300 bg-white px-2 py-2
                                       text-sm dark:border-gray-700 dark:bg-gray-900
                                       dark:text-white">

                            @for($page = 1; $page <= $lastPage; $page++)
                                <option value="{{ $page }}" @selected($page === $currentPage)>
                                    {{ $page }}
                                </option>
                            @endfor
                        </select>
                    </form>
                @endif

            </div>
        </div>

    </div>

@endsection