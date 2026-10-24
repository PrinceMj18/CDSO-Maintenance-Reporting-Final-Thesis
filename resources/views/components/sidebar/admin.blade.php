    <aside id="cdso-role-sidebar" x-data="{ openLogoutModal: false }" class="cdso-sidebar fixed inset-y-0 left-0 z-40 flex w-[min(18rem,88vw)] flex-shrink-0 flex-col overflow-y-auto shadow-2xl transition-transform duration-200 ease-out md:sticky md:top-0 md:h-screen md:w-64 md:translate-x-0 md:shadow-none"
    :class="mobileSidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
    style="background-color: rgba(96, 120, 68, 1);">

    <div class="py-4 text-white">

        <!-- LOGO / TITLE -->
        <a class="ml-6 text-xl font-bold text-white" href="{{ route('adminDashboard') }}">
            CDSO Administration
        </a>

        <ul class="mt-4">

            <li class="relative px-6 py-3">

                @if(request()->routeIs('adminDashboard'))
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"></span>
                @endif

                <a href="{{ route('adminDashboard') }}"
    class="inline-flex items-center w-full text-sm font-semibold
           transition-colors duration-150
           {{ request()->routeIs('adminDashboard')
               ? 'text-white'
               : 'text-white/80 hover:text-white' }}">

    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M3 12l2-2 7-7 7 7M5 10v10h3m10-11l2 2v10h-3m-6 0h6"></path>
    </svg>

    <span class="ml-4">
        Dashboard
    </span>

</a>

            </li>

        </ul>


        <!-- =============================== -->
        <!-- MAIN MENU -->
        <!-- =============================== -->

        <ul>

            <!-- MAINTENANCE ASSIGNMENT -->
            <li class="relative px-6 py-3">

                @if(
                        request()->routeIs('maintenanceRequest.admin') ||
                        request()->routeIs('viewRequest*')
                    )
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"></span>
                @endif

                <a href="/maintenance-request/admin"
    class="inline-flex items-center w-full text-sm font-semibold
           transition-colors duration-150
           {{ request()->routeIs('maintenanceRequest.admin') ||
              request()->routeIs('viewRequest*')
              ? 'text-white'
              : 'text-white/80 hover:text-white' }}">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                        </path>
                    </svg>

                    <span class="ml-4">
                        Maintenance Requests
                    </span>

                </a>

            </li>



<!-- ARCHIVED REQUESTS -->
<li class="relative px-6 py-3">

    @if(request()->routeIs('admin.archives.requests'))
        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"></span>
    @endif

    <a href="{{ route('admin.archives.requests') }}"
       class="inline-flex items-center w-full text-sm font-semibold
              transition-colors duration-150
              {{ request()->routeIs('admin.archives.requests')
                  ? 'text-white'
                  : 'text-white/80 hover:text-white' }}">

        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-5 h-5"
             aria-hidden="true"
             fill="none"
             stroke="currentColor"
             stroke-linecap="round"
             stroke-linejoin="round"
             stroke-width="2"
             viewBox="0 0 24 24">
            <path d="M3 7h18v13H3z"/>
            <path d="M3 7l2-4h14l2 4"/>
            <path d="M9 12h6"/>
            <path d="M12 10v5"/>
        </svg>

        <span class="ml-4">
            Archived Requests
        </span>

    </a>

</li>



            <!-- INVENTORY -->
            <li class="relative px-6 py-3">

                @if(request()->routeIs('inventory') || request()->routeIs('edit_inventory'))
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"></span>
                @endif

                <a href="{{ route('inventory') }}"
    class="inline-flex items-center w-full text-sm font-semibold
           transition-colors duration-150
           {{ request()->routeIs('inventory') ||
              request()->routeIs('edit_inventory')
              ? 'text-white'
              : 'text-white/80 hover:text-white' }}">

                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>

                        <path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                    </svg>

                    <span class="ml-4">
                        Inventory
                    </span>

                </a>

            </li>


            <!-- =============================== -->
            <!-- BACKUP & RESTORE -->
            <!-- =============================== -->

            <li class="relative px-6 py-3">

                @if(request()->routeIs('admin.backup*'))
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"></span>
                @endif

                <a href="{{ route('admin.backup') }}"
    class="inline-flex items-center w-full text-sm font-semibold
           transition-colors duration-150
           {{ request()->routeIs('admin.backup*')
              ? 'text-white'
              : 'text-white/80 hover:text-white' }}">

                    <!-- Backup Icon -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9M4.582 9H9"></path>

                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20 20v-5h-.581m0 0a8.003 8.003 0 01-15.357-2M19.419 15H15"></path>

                    </svg>

                    <span class="ml-4">
                        Backup & Restore
                    </span>

                </a>

            </li>


            <!-- =============================== -->
            <!-- LOGOUT -->
            <!-- =============================== -->

            <li class="relative px-6 py-3">

                <button @click="openLogoutModal = true" class="cdso-logout-trigger inline-flex w-full items-center justify-center rounded-xl px-4 py-3 text-sm font-semibold text-white/90 transition-colors duration-150 hover:bg-white/10 hover:text-white focus:outline-none focus:ring-2 focus:ring-white/70">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1">
                        </path>

                    </svg>

                    <span class="ml-4">
                        Logout
                    </span>

                </button>

            </li>

        </ul>


        <!-- =============================== -->
        <!-- LOGOUT MODAL -->
        <!-- =============================== -->

        <template x-teleport="body">
        <div x-show="openLogoutModal" x-transition
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">

            <div @click.away="openLogoutModal = false"
                class="w-full max-w-md px-6 py-4 bg-white rounded-lg shadow-lg dark:bg-gray-800">

                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    Confirm Logout
                </h3>

                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    Are you sure you want to logout?
                </p>

                <div class="flex justify-end mt-6 space-x-3">

                    <!-- CANCEL -->
                    <button @click="openLogoutModal = false"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                        Cancel
                    </button>


                    <!-- LOGOUT -->
                    <form action="{{ route('logout') }}" method="POST">

                        @csrf

                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                            Logout
                        </button>

                    </form>

                </div>

            </div>

        </div>
        </template>


        <div class="px-6 my-6">
        </div>

    </div>

</aside>