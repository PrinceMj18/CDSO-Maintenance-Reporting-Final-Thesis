<div class="space-y-6">
    <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Your Work Dashboard</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Hi {{ auth()->user()->fname }} — here are the jobs and updates that need your attention.</p>
        </div>
        <a href="{{ route('maintenanceRequest.personnel') }}" class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">View all assigned requests</a>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Active assignments</p>
            <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $activeCount ?? 0 }}</p>
            <p class="mt-1 text-xs text-gray-500">Approved and in-progress jobs</p>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Ready to start</p>
            <p class="mt-2 text-3xl font-bold text-blue-600">{{ $approved ?? 0 }}</p>
            <p class="mt-1 text-xs text-gray-500">Approved assignments waiting for work to begin</p>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Currently in progress</p>
            <p class="mt-2 text-3xl font-bold text-violet-600">{{ $inProgress ?? 0 }}</p>
            <p class="mt-1 text-xs text-gray-500">Jobs already being worked on</p>
        </div>
        <div class="rounded-xl border border-amber-200 bg-amber-50 p-5 shadow-sm dark:border-amber-900 dark:bg-amber-950/30">
            <p class="text-sm font-medium text-amber-800 dark:text-amber-300">High-priority active jobs</p>
            <p class="mt-2 text-3xl font-bold text-amber-700 dark:text-amber-300">{{ $highPriorityCount ?? 0 }}</p>
            <p class="mt-1 text-xs text-amber-700/80 dark:text-amber-300/80">Review these first</p>
        </div>
    </div>

    <div class="grid gap-6 xl:grid-cols-3">
        <section class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800 xl:col-span-2">
            <div class="flex items-start justify-between gap-3 border-b border-gray-100 px-5 py-4 dark:border-gray-700">
                <div>
                    <h3 class="font-semibold text-gray-900 dark:text-white">Your work queue</h3>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Active jobs are sorted to surface in-progress and high-priority work first.</p>
                </div>
                <span class="rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-semibold text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300">{{ $workQueue->count() }} shown</span>
            </div>
            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($workQueue as $work)
                    <a href="{{ route('viewRequest.personnel', $work->id) }}" class="block px-5 py-4 transition hover:bg-gray-50 dark:hover:bg-gray-700/40">
                        <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">
                            <div class="min-w-0">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="font-mono text-xs font-semibold text-indigo-600 dark:text-indigo-300">{{ $work->ticket_number }}</span>
                                    <span class="rounded-full px-2 py-0.5 text-[11px] font-semibold {{ $work->status === 'in_progress' ? 'bg-violet-100 text-violet-700 dark:bg-violet-900/40 dark:text-violet-300' : 'bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300' }}">{{ $work->status === 'in_progress' ? 'In progress' : 'Ready to start' }}</span>
                                    @if($work->priority === 'high')
                                        <span class="rounded-full bg-rose-100 px-2 py-0.5 text-[11px] font-semibold text-rose-700 dark:bg-rose-900/40 dark:text-rose-300">High priority</span>
                                    @endif
                                </div>
                                <p class="mt-1 truncate font-semibold text-gray-900 dark:text-white">{{ $work->title }}</p>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $work->location }} · {{ $work->category }}</p>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Requested by {{ trim(($work->user?->fname ?? '').' '.($work->user?->lname ?? '')) ?: 'Requester' }} · Submitted {{ $work->created_at?->format('M d, Y') }}</p>
                            </div>
                            <span class="shrink-0 text-sm font-semibold text-indigo-600 dark:text-indigo-300">Open job →</span>
                        </div>
                    </a>
                @empty
                    <div class="px-5 py-10 text-center">
                        <p class="font-medium text-gray-800 dark:text-white">You're all caught up.</p>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">There are no active requests currently assigned to you.</p>
                    </div>
                @endforelse
            </div>
            @if($workQueue->count() >= 8)
                <div class="border-t border-gray-100 px-5 py-3 dark:border-gray-700">
                    <a href="{{ route('maintenanceRequest.personnel') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700 dark:text-indigo-300">See all assigned requests →</a>
                </div>
            @endif
        </section>

        <section class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-700">
                <h3 class="font-semibold text-gray-900 dark:text-white">Recent request updates</h3>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Latest activity on jobs currently assigned to you.</p>
            </div>
            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($recentActivity as $log)
                    <div class="px-5 py-4">
                        <p class="text-sm font-semibold text-gray-800 dark:text-gray-100">{{ $log->request?->title ?? 'Maintenance request' }}</p>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            {{ $log->action ? ucfirst(str_replace('_', ' ', $log->action)) : ucfirst(str_replace('_', ' ', $log->status)) }}
                            @if($log->updatedBy) · by {{ trim($log->updatedBy->fname.' '.$log->updatedBy->lname) }} @endif
                        </p>
                        @if($log->remarks)
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">{{ \Illuminate\Support\Str::limit($log->remarks, 110) }}</p>
                        @endif
                        <p class="mt-2 text-[11px] text-gray-400">{{ $log->created_at?->format('M d, Y · h:i A') }}</p>
                    </div>
                @empty
                    <div class="px-5 py-8 text-center text-sm text-gray-500 dark:text-gray-400">No updates on your assigned jobs yet.</div>
                @endforelse
            </div>
        </section>
    </div>

    <div class="rounded-xl border border-gray-200 bg-gray-50 px-5 py-4 dark:border-gray-700 dark:bg-gray-800/60">
        <h3 class="text-sm font-semibold text-gray-800 dark:text-white">End-of-day reminder</h3>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">Record work performed and add remarks as you go. When completing a job, record the materials used or confirm that no materials were needed.</p>
        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Completed today: <span class="font-semibold">{{ $completedToday ?? 0 }}</span></p>
    </div>
</div>
