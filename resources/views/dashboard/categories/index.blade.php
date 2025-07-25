<!DOCTYPE html>
<html x-data="{ sidebarOpen: false, showLogoutConfirm: false }" x-cloak>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
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


        <x-sidebar></x-sidebar>
        <!-- Overlay (Mobile) -->


        <!-- Main content -->

        <main class="flex-1 p-6 overflow-auto">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Hi, Admin {{ auth()->user()->name }}</h1>
                <p class="text-gray-500">Only admin can see this page</p>
            </div>

            <div class="mb-6 max-w-md">

                <!-- Optional display result -->

            </div>

            <!-- KOSONGKAN BAGIAN INI -->
            <!-- Tabel Post -->
            <a href="/dashboard/categories/create"
                class="inline-flex items-center px-4 py-2 mb-5 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-1 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Create New Category
            </a>
            @if (session()->has('success'))
                <div class="mb-4 px-4 py-3 rounded-md bg-green-100 text-green-800 border border-green-300">
                    {{ session('success') }}
                </div>
            @endif


            <div class="bg-white shadow-md rounded-lg overflow-hidden">

                <table id="categoryTable" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
                        <tr>
                            <th class="px-6 py-4 text-left">Category Name</th>
                            <th class="px-6 py-4 text-left">Actions</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </main>
    </div>
    <script>
        $(document).ready(function() {
            $('#categoryTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('categories.datatable') }}',
                columns: [{
                        data: 'name',
                        name: 'name',
                        className: 'px-6 py-4'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'px-6 py-4'
                    },
                ]
            });
        });
    </script>
</body>

</html>
