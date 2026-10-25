<div class="container px-6 mx-auto grid">

    <!-- SECTION HEADER -->
    <div class="flex items-end justify-between mb-5">

        <div>
            <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">
                Overview
            </p>

            <h2 class="mt-1 text-xl font-semibold text-gray-800 dark:text-gray-100">
                Account Summary
            </h2>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Overview of registered accounts by role.
            </p>
        </div>

    </div>


    <!-- ACCOUNT CARDS -->
    <div class="grid gap-5 mb-8 sm:grid-cols-2 xl:grid-cols-5">


        <!-- TOTAL ACCOUNTS -->
        <div class="relative overflow-hidden
                    p-5 bg-white
                    border border-gray-200
                    rounded-xl shadow-sm
                    dark:bg-gray-800 dark:border-gray-700
                    transition-all duration-200
                    hover:shadow-md">

            <!-- Accent -->
            <div class="absolute top-0 left-0 w-full h-1"
                 style="background-color: rgba(82, 105, 58, 1);">
            </div>

            <div class="flex items-start justify-between">

                <!-- Icon -->
                <div class="flex items-center justify-center
                            w-11 h-11 rounded-xl"
                     style="background-color: rgba(82, 105, 58, 0.12);">

                    <svg class="w-5 h-5"
                         style="color: rgba(82, 105, 58, 1);"
                         fill="currentColor"
                         viewBox="0 0 20 20">

                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                        </path>

                    </svg>

                </div>

                <!-- Label -->
                <span class="text-xs font-medium text-gray-400 dark:text-gray-500">
                    All
                </span>

            </div>

            <div class="mt-5">

                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                    Total Accounts
                </p>

                <p class="mt-1 text-2xl font-bold text-gray-800 dark:text-white">
                    {{ $total ?? 0 }}
                </p>

                <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">
                    Registered system accounts
                </p>

            </div>

        </div>


        <!-- SUPER ADMIN -->
        

        <!-- ADMIN -->
        <div class="relative overflow-hidden
                    p-5 bg-white
                    border border-gray-200
                    rounded-xl shadow-sm
                    dark:bg-gray-800 dark:border-gray-700
                    transition-all duration-200
                    hover:shadow-md">

            <div class="absolute top-0 left-0 w-full h-1 bg-blue-500"></div>

            <div class="flex items-start justify-between">

                <div class="flex items-center justify-center
                            w-11 h-11
                            text-blue-600
                            bg-blue-50
                            rounded-xl
                            dark:bg-blue-900/20
                            dark:text-blue-300">

                    <svg class="w-5 h-5"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 3l7 4v5c0 4.42-3.13 8.36-7 9-3.87-.64-7-4.58-7-9V7l7-4z">
                        </path>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M9 12l2 2 4-4">
                        </path>

                    </svg>

                </div>

                <span class="text-xs font-medium text-gray-400 dark:text-gray-500">
                    Management
                </span>

            </div>

            <div class="mt-5">

                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                    Admin
                </p>

                <p class="mt-1 text-2xl font-bold text-gray-800 dark:text-white">
                    {{ $admin ?? 0 }}
                </p>

                <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">
                    Administrative accounts
                </p>

            </div>

        </div>


        <!-- PERSONNEL -->
        <div class="relative overflow-hidden
                    p-5 bg-white
                    border border-gray-200
                    rounded-xl shadow-sm
                    dark:bg-gray-800 dark:border-gray-700
                    transition-all duration-200
                    hover:shadow-md">

            <div class="absolute top-0 left-0 w-full h-1 bg-amber-500"></div>

            <div class="flex items-start justify-between">

                <div class="flex items-center justify-center
                            w-11 h-11
                            text-amber-600
                            bg-amber-50
                            rounded-xl
                            dark:bg-amber-900/20
                            dark:text-amber-300">

                    <svg class="w-5 h-5"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M14.7 6.3a4 4 0 01-5.4 5.4L3 18l3 3 6.3-6.3a4 4 0 005.4-5.4l-2.2 2.2-2.8-2.8 2-2.4z">
                        </path>

                    </svg>

                </div>

                <span class="text-xs font-medium text-gray-400 dark:text-gray-500">
                    Staff
                </span>

            </div>

            <div class="mt-5">

                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                    Personnel
                </p>

                <p class="mt-1 text-2xl font-bold text-gray-800 dark:text-white">
                    {{ $personnel ?? 0 }}
                </p>

                <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">
                    Maintenance personnel
                </p>

            </div>

        </div>


        <!-- USER -->
        <div class="relative overflow-hidden
                    p-5 bg-white
                    border border-gray-200
                    rounded-xl shadow-sm
                    dark:bg-gray-800 dark:border-gray-700
                    transition-all duration-200
                    hover:shadow-md">

            <div class="absolute top-0 left-0 w-full h-1 bg-gray-400"></div>

            <div class="flex items-start justify-between">

                <div class="flex items-center justify-center
                            w-11 h-11
                            text-gray-600
                            bg-gray-100
                            rounded-xl
                            dark:bg-gray-700
                            dark:text-gray-300">

                    <svg class="w-5 h-5"
                         fill="currentColor"
                         viewBox="0 0 20 20">

                        <path
                            d="M10 2a4 4 0 100 8 4 4 0 000-8zM4 16a6 6 0 1112 0v1H4v-1z">
                        </path>

                    </svg>

                </div>

                <span class="text-xs font-medium text-gray-400 dark:text-gray-500">
                    Standard
                </span>

            </div>

            <div class="mt-5">

                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                    User
                </p>

                <p class="mt-1 text-2xl font-bold text-gray-800 dark:text-white">
                    {{ $user ?? 0 }}
                </p>

                <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">
                    Standard user accounts
                </p>

            </div>

        </div>

    </div>

</div>