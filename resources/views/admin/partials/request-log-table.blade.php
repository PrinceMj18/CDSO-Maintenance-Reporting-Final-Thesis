<div class="w-full overflow-x-auto">

    <table class="w-full whitespace-no-wrap">

        <thead>
            <tr class="text-xs font-semibold tracking-wide text-left
                       text-gray-500 uppercase border-b
                       dark:border-gray-700
                       bg-gray-50 dark:bg-gray-800">
                <th class="px-4 py-3">Ticket No.</th>
                <th class="px-4 py-3">Title</th>
                <th class="px-4 py-3">Date</th>
                <th class="px-4 py-3">Requester</th>
                <th class="px-4 py-3">Category</th>
                <th class="px-4 py-3">Location</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Action</th>
            </tr>
        </thead>

        <tbody class="bg-white divide-y
                     dark:divide-gray-700
                     dark:bg-gray-800">

            @forelse($requestList as $request)

                <tr class="text-gray-700 dark:text-gray-300">
                    <td class="px-4 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold
                     text-indigo-700 bg-indigo-100 rounded-lg
                     dark:bg-indigo-900/40 dark:text-indigo-300">
                            {{ $request->ticket_number ?? 'Not assigned' }}
                        </span>
                    </td>
                    <!-- Title -->
                    <td class="px-4 py-3 text-sm">
                        {{ $request->title }}
                    </td>


                    <!-- Date -->
                    <td class="px-4 py-3 text-sm">
                        {{ $request->updated_at->format('M d, Y') }}
                    </td>
                    <!-- Requester -->
                    <td class="px-4 py-3 text-sm">
                        {{ $request->user->email ?? 'N/A' }}
                    </td>

                    <!-- Category -->
                    <td class="px-4 py-3 text-sm">
                        {{ $request->category }}
                    </td>

                    <!-- Location -->
                    <td class="px-4 py-3 text-sm">
                        {{ $request->location }}
                    </td>

                    <!-- Status -->
                    <td class="px-4 py-3 text-sm">

                        @if($status === 'pending')

                            <span class="px-2 py-1 font-semibold leading-tight
                                                 text-yellow-700 bg-yellow-100 rounded-full">
                                Pending
                            </span>

                        @elseif($status === 'approved')

                            <span class="px-2 py-1 font-semibold leading-tight
                                                 text-blue-700 bg-blue-100 rounded-full">
                                Approved
                            </span>

                        @elseif($status === 'in_progress')

                            <span class="px-2 py-1 font-semibold leading-tight
                                                 text-purple-700 bg-purple-100 rounded-full">
                                In Progress
                            </span>

                        @elseif($status === 'completed')

                            <span class="px-2 py-1 font-semibold leading-tight
                                                 text-green-700 bg-green-100 rounded-full">
                                Completed
                            </span>

                        @elseif($status === 'rejected')

                            <span class="px-2 py-1 font-semibold leading-tight
                                                 text-red-700 bg-red-100 rounded-full">
                                Rejected
                            </span>

                        @endif

                    </td>

                    <!-- Action -->
                    <td class="px-4 py-3 text-sm">

                        <a href="{{ route('viewHistoryRequest.admin', $request->id) }}" class="px-3 py-1 font-semibold
                                      text-indigo-700
                                      bg-indigo-100
                                      rounded-full
                                      hover:bg-indigo-200">

                            View

                        </a>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="8" class="px-4 py-8 text-center
                                   text-gray-500
                                   dark:text-gray-400">

                        No {{ strtolower($statusLabel) }} requests found.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>


<!-- Pagination -->

@if($requestList->hasPages())

    <div class="flex flex-col items-center justify-between gap-3
                    px-4 py-4 mt-4
                    bg-white border border-gray-100 rounded-xl
                    sm:flex-row
                    dark:bg-gray-800 dark:border-gray-700">

        <!-- Showing X to Y of Z -->
        <div class="text-xs text-gray-500 dark:text-gray-400">

            Showing

            <span class="font-medium text-gray-700 dark:text-gray-200">
                {{ $requestList->firstItem() }}
            </span>

            to

            <span class="font-medium text-gray-700 dark:text-gray-200">
                {{ $requestList->lastItem() }}
            </span>

            of

            <span class="font-medium text-gray-700 dark:text-gray-200">
                {{ $requestList->total() }}
            </span>

            requests

        </div>

        <!-- Pagination buttons -->
        <div>
            {{ $requestList->appends(request()->query())->links() }}
        </div>

    </div>

@endif