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


        <x-sidebar></x-sidebar>
        <!-- Overlay (Mobile) -->


        <!-- Main content -->

        <main class="flex-1 p-6 overflow-auto">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Post Categories</h1>
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
            <div class="alert alert-success" role="alert">
                {{session('success')}}
            </div>

            @endif

            <div class="bg-white shadow-md rounded-lg overflow-hidden">

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
                        <tr>
                            <th class="px-6 py-4 text-left">Category Name</th>
                            <th class="px-6 py-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100 text-gray-700">
                        @foreach ($categories as $category)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium">{{ $category->name }}</td>
                                <td class="px-6 py-4 space-x-2">
                                    <!-- Show -->
                                    <a href="/dashboard/categories/{{$category->slug}}/show"
                                        class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Show
                                    </a>

                                    <!-- Edit -->
                                    <a href="/dashboard/categories/{{$category->slug}}/edit"
                                        class="inline-flex items-center text-yellow-500 hover:text-yellow-600 text-sm">

                                        <svg class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path fill-rule="evenodd"
                                                d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z"
                                                clip-rule="evenodd" />
                                            <path fill-rule="evenodd"
                                                d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z"
                                                clip-rule="evenodd" />
                                        </svg>

                                        Edit
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('categories.destroy', $category->slug) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus post ini?')"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center text-red-600 hover:text-red-800 text-sm">

                                            <svg class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                            </svg>

                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        @if ($categories->isEmpty())
                            <tr>
                                <td colspan="3" class="text-center text-gray-500 py-6">
                                    Tidak ada post untuk ditampilkan.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>



        </main>


    </div>

</body>

</html>
