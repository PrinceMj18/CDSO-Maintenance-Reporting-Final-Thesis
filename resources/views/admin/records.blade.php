@extends('layouts.apps')

@section('content')

<div class="container mx-auto px-4 py-8 max-w-7xl">

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
            Order History
        </h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2">
            View your recent purchases and order status
        </p>
    </div>

    <!-- Orders -->
    <div class="space-y-6">

        <!-- ORDER CARD -->
        <details class="bg-white dark:bg-gray-800 rounded-lg shadow-xs border border-gray-200 dark:border-gray-700 group">

            <!-- CLICKABLE HEADER -->
            <summary class="p-6 cursor-pointer list-none">
                <div class="flex flex-col md:flex-row justify-between items-center">

                    <div class="mb-4 md:mb-0">
                        <div class="flex items-center space-x-4">

                            <span class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                Order #1234
                            </span>

                            <span class="px-3 py-1 rounded-full text-xs font-medium 
                                         bg-green-100 text-green-800 
                                         dark:bg-green-700 dark:text-green-100">
                                Completedphp
                            </span>

                        </div>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Order Date: March 15, 2024
                        </p>
                    </div>

                    <div class="text-right flex items-center space-x-3">
                        <div>
                            <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                $245.00
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                2 items
                            </p>
                        </div>

                        <!-- Arrow -->
                        <span class="transition-transform duration-300 group-open:rotate-180 text-gray-500 dark:text-gray-300">
                            ▼
                        </span>
                    </div>

                </div>
            </summary>

            <!-- TOGGLE CONTENT -->
            <div class="border-t border-gray-100 dark:border-gray-700">

                <div class="p-6 space-y-6">

                    <!-- Items -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-900 dark:text-gray-200 mb-4">
                            Items Purchased
                        </h3>

                        <div class="space-y-4">

                            <!-- ITEM -->
                            <div class="flex items-center space-x-4">
                                <img src="https://via.placeholder.com/80"
                                     class="w-16 h-16 rounded-md border border-gray-200 dark:border-gray-700">

                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                        Wireless Headphones
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        Quantity: 1
                                    </p>
                                </div>

                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                    $149.99
                                </p>
                            </div>

                            <!-- ITEM -->
                            <div class="flex items-center space-x-4">
                                <img src="https://via.placeholder.com/80"
                                     class="w-16 h-16 rounded-md border border-gray-200 dark:border-gray-700">

                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                        Smartwatch
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        Quantity: 1
                                    </p>
                                </div>

                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                    $95.00
                                </p>
                            </div>

                        </div>
                    </div>

                    <!-- Summary -->
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">

                        <div class="grid grid-cols-2 gap-4 text-sm">

                            <div>
                                <p class="font-medium text-gray-900 dark:text-gray-200">
                                    Shipping Address
                                </p>
                                <p class="text-gray-700 dark:text-gray-300">
                                    123 Main Street
                                </p>
                                <p class="text-gray-700 dark:text-gray-300">
                                    New York, NY
                                </p>
                                <p class="text-gray-700 dark:text-gray-300">
                                    United States
                                </p>
                            </div>

                            <div>
                                <p class="font-medium text-gray-900 dark:text-gray-200">
                                    Payment Method
                                </p>
                                <p class="text-gray-700 dark:text-gray-300">
                                    Visa
                                </p>
                                <p class="text-gray-700 dark:text-gray-300">
                                    Card: **** **** **** 1234
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="border-t border-gray-100 dark:border-gray-700 px-6 py-4 bg-gray-50 dark:bg-gray-800">

                    <div class="flex justify-end space-x-4">

                        <button class="px-4 py-2 border border-gray-300 dark:border-gray-600 
                                       text-gray-700 dark:text-gray-300 
                                       hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md text-sm">
                            View Invoice
                        </button>

                        <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 
                                       text-white rounded-md text-sm">
                            Reorder
                        </button>

                    </div>
                </div>

            </div>

        </details>

    </div>
</div>

@endsection