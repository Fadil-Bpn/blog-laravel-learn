{{-- Slug Generator --}}



<!DOCTYPE html>
<html x-data="{ sidebarOpen: false, showLogoutConfirm: false }" x-cloak>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        [x-cloak] {
            display: none !important;
        }

        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
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

        <main class="flex-1 p-6 overflow-auto">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Create New Category</h1>
                <p class="text-gray-500">This is a page to create new category</p>
            </div>

            <form action="/dashboard/categories" method="POST" class="max-w-xl mx-auto">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold mb-1">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" autocomplete="off"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 focus:outline-none"
                        placeholder="Enter category name">
                    @error('name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Slug -->
                <div class="mb-4">
                    <label for="slug" class="block text-gray-700 font-semibold mb-1">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}" autocomplete="off"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 focus:outline-none"
                        placeholder="Enter slug (auto)">
                    @error('slug')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Color -->
                <div class="mb-4">
                    <label for="color" class="block text-gray-700 font-semibold mb-1">Color</label>
                    <input type="text" name="color" id="color" value="{{ old('color') }}" autocomplete="off"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 focus:outline-none"
                        placeholder="slate, gray, zinc, neutral, stone, red, orange, amber, yellow, lime, green, emerald, teal, cyan, sky, blue, indigo, violet, purple, fuchsia, pink, rose">
                    @error('color')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <div class="mt-6">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">
                        Save Category
                    </button>
                </div>
            </form>
        </main>

        <!-- Main content -->

    </div>

    <script>
        const nameInput = document.querySelector('#name');
        const slugInput = document.querySelector('#slug');

        nameInput.addEventListener('change', function() {
            fetch('/dashboard/categories/checkSlug?name=' + nameInput.value)
                .then(response => response.json())
                .then(data => slugInput.value = data.slug);
        });
    </script>
</body>

</html>
