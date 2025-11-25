<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <!-- Sidebar -->
    <div class="flex h-screen">
        <aside class="w-64 bg-gray-800 text-white flex-shrink-0 h-screen flex flex-col">
            <!-- Header -->
            <div class="p-6 text-xl font-bold border-b border-gray-700">Employee Panel</div>

            <!-- Navigation -->
            <nav class="mt-6 flex-1 flex flex-col gap-2 px-2">
                <!-- Dashboard -->
                <a href="#" class="flex items-center gap-3 px-4 py-2 bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-200 font-medium text-white">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 13h8V3H3v10zm10 8h8v-6h-8v6zm0-8h8V3h-8v10zm-10 8h8v-6H3v6z"/>
                    </svg>
                    Dashboard
                </a>

                <!-- Bookings -->
                <a href="#" class="flex items-center gap-3 px-4 py-2 bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-200 font-medium text-white">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17 3H7c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H7V5h10v14z"/>
                        <path d="M14 7h-4v2h4V7zm0 4h-4v2h4v-2zm0 4h-4v2h4v-2z"/>
                    </svg>
                    Manage Bookings
                </a>

                <!-- Customers -->
                <a href="#" class="flex items-center gap-3 px-4 py-2 bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-200 font-medium text-white">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                    Customers
                </a>

                <!-- Reports -->
                <a href="#" class="flex items-center gap-3 px-4 py-2 bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-200 font-medium text-white">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 3h18v2H3V3zm0 4h18v2H3V7zm0 4h12v2H3v-2zm0 4h8v2H3v-2zm0 4h18v2H3v-2z"/>
                    </svg>
                    Reports
                </a>

                <!-- Settings -->
                <a href="#" class="flex items-center gap-3 px-4 py-2 bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-200 font-medium text-white">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58c.18-.14.23-.41.12-.61l-1.92-3.32c-.12-.22-.37-.29-.59-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.22-.08-.47 0-.59.22L2.74 8.87c-.12.21-.08.47.12.61l2.03 1.58c-.05.3-.09.63-.09.94 0 .31.03.64.07.94l-2.03 1.58c-.18.14-.23.41-.12.61l1.92 3.32c.12.22.37.29.59.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.22.08.47 0 .59-.22l1.92-3.32c.12-.22.07-.47-.12-.61l-2.01-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z"/>
                    </svg>
                    Settings
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Navbar -->
            <header class="bg-white shadow p-4 flex justify-between items-center">
                <h1 class="text-2xl font-semibold">Employee Dashboard</h1>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-gray-800">Logout</button>
                    </form>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=667eea&color=fff" 
                         alt="Avatar" 
                         class="rounded-full w-10 h-10" />
                </div>
            </header>

            <!-- Content Area -->
            <main class="p-6 overflow-auto">
                <!-- Stats Overview -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Pending Approvals -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Pending Approvals</p>
                                <h3 class="text-2xl font-bold mt-1">12</h3>
                                <p class="text-green-500 text-sm mt-1">+2 from yesterday</p>
                            </div>
                            <div class="p-3 bg-blue-100 rounded-full">
                                <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Active Bookings -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Active Bookings</p>
                                <h3 class="text-2xl font-bold mt-1">24</h3>
                                <p class="text-green-500 text-sm mt-1">+5 from yesterday</p>
                            </div>
                            <div class="p-3 bg-green-100 rounded-full">
                                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Available Cars -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Available Cars</p>
                                <h3 class="text-2xl font-bold mt-1">18</h3>
                                <p class="text-red-500 text-sm mt-1">-3 from yesterday</p>
                            </div>
                            <div class="p-3 bg-yellow-100 rounded-full">
                                <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.85 7h10.29l1.08 3.11H5.77L6.85 7zM19 17H5v-5h14v5z"/>
                                    <circle cx="7.5" cy="14.5" r="1.5"/>
                                    <circle cx="16.5" cy="14.5" r="1.5"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Revenue -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Today's Revenue</p>
                                <h3 class="text-2xl font-bold mt-1">$3,240</h3>
                                <p class="text-green-500 text-sm mt-1">+12% from yesterday</p>
                            </div>
                            <div class="p-3 bg-purple-100 rounded-full">
                                <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.97 1.39 2.98 3.4 3.51 1.95.51 2.35 1.11 2.35 1.87 0 .53-.39 1.39-2.1 1.39-1.6 0-2.23-.72-2.32-1.64H8.04c.1 1.7 1.36 2.66 2.86 2.97V19h2.34v-1.67c1.52-.29 2.72-1.16 2.73-2.77-.01-2.2-1.9-2.96-3.66-3.38z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">Recent Activity</h2>
                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</button>
                    </div>
                    <div class="space-y-4">
                        @for($i = 0; $i < 5; $i++)
                        <div class="flex items-start pb-4 border-b border-gray-100 last:border-0 last:pb-0">
                            <div class="p-2 bg-blue-100 rounded-full mr-4">
                                <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 6v3l4-4-4-4v3c-4.42 0-8 3.58-8 8 0 1.57.46 3.03 1.24 4.26L6.7 14.8c-.45-.83-.7-1.79-.7-2.8 0-3.31 2.69-6 6-6zm6.76 1.74L17.3 9.2c.44.84.7 1.8.7 2.8 0 3.31-2.69 6-6 6v-3l-4 4 4 4v-3c4.42 0 8-3.58 8-8 0-1.57-.46-3.03-1.24-4.26z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium">New booking request #{{ 1000 + $i }}</p>
                                <p class="text-gray-500 text-sm mt-1">Customer: John Doe • {{ now()->subHours($i)->diffForHumans() }}</p>
                            </div>
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">
                                Pending
                            </span>
                        </div>
                        @endfor
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                            <button class="w-full flex items-center justify-between p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition">
                                <span>Add New Booking</span>
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </button>
                            <button class="w-full flex items-center justify-between p-3 bg-green-50 hover:bg-green-100 rounded-lg transition">
                                <span>Check Car Availability</span>
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </button>
                            <button class="w-full flex items-center justify-between p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition">
                                <span>Generate Report</span>
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Upcoming Returns -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold mb-4">Upcoming Returns</h3>
                        <div class="space-y-4">
                            @for($i = 0; $i < 3; $i++)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="p-2 bg-blue-100 rounded-lg mr-3">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium">Booking #{{ 2000 + $i }}</p>
                                        <p class="text-gray-500 text-xs">Due {{ now()->addDays($i + 1)->format('M j, Y') }}</p>
                                    </div>
                                </div>
                                <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    View
                                </button>
                            </div>
                            @endfor
                        </div>
                    </div>

                    <!-- Performance -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold mb-4">Your Performance</h3>
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span>Bookings This Month</span>
                                    <span class="font-medium">24/30</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: 80%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span>Customer Rating</span>
                                    <span class="font-medium">4.8/5.0</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: 96%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span>Monthly Target</span>
                                    <span class="font-medium">$12,500/$15,000</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-purple-600 h-2 rounded-full" style="width: 83.3%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
