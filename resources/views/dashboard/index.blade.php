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



            </main>


    </div>

</body>

</html>
