<!DOCTYPE html>
<html x-data="{ sidebarOpen: false, showLogoutConfirm: false }" x-cloak>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">
<header class="bg-white shadow-md px-4 py-4 flex justify-between items-center md:hidden">
                <button @click="sidebarOpen = true" class="text-gray-600 p-2 md:hidden">
                    <!-- Menu / Hamburger Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <h1 class="text-xl font-semibold">Dashboard</h1>
            </header>
    <div class="flex min-h-screen">

        <!-- Overlay (Mobile) -->
        <x-sidebar></x-sidebar>

        <!-- Main content -->

        <main class="flex-1 p-6 overflow-auto">
                <div class="mb-6">
                    <h1 class="text-3xl font-bold text-gray-800">Welcome, {{ auth()->user()->name }}</h1>
                    <p class="text-gray-500">This is a display of your Dashboard</p>
                </div>

                <div class="mb-6 max-w-md">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="search">Search</label>
                    <div class="relative">
                        <input type="text" id="search" placeholder="Search something..." x-model="searchQuery"
                            autocomplete="off"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:outline-none" />
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-4.35-4.35M16.65 16.65A7.5 7.5 0 1117.5 10a7.5 7.5 0 01-0.85 6.65z" />
                            </svg>
                        </div>
                    </div>
                    <!-- Optional display result -->
                    <p class="text-sm text-gray-500 mt-2" x-show="searchQuery">Searching for: "<span
                            x-text="searchQuery"></span>"</p>
                </div>

                <!-- KOSONGKAN BAGIAN INI -->
                <div class="bg-white border border-dashed border-gray-300 rounded-lg p-10 text-center text-gray-400">
                    <p class="text-lg">Tidak ada konten saat ini.</p>
                    <p class="text-sm mt-2">Silakan tambahkan modul atau komponen yang diperlukan.</p>
                </div>

            </main>


    </div>

</body>

</html>
