<!DOCTYPE html>
<html x-data="{ sidebarOpen: false, showLogoutConfirm: false }" x-cloak>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - Show Post</title>
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
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <h1 class="text-xl font-semibold">Dashboard</h1>
    </header>
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <x-sidebar></x-sidebar>

        <!-- Main content -->
        <div class="flex-1 flex flex-col">
            <!-- Topbar for mobile -->


            <!-- Page content -->
            <main class="flex-1 p-6">
                <div class="mb-6 border-b pb-4">
                    <h1 class="text-4xl font-bold text-gray-800 mb-1">{{ $post->title }}</h1>
                    <div class="text-sm text-gray-500">
                        Ditulis oleh <a class="text-blue-500"
                            href="#"><strong>{{ $post->author->name ?? '-' }}</strong></a> • Kategori:
                        <a class="text-blue-500" href="#"><strong>{{ $post->category->name ?? '-' }}</strong></a>
                    </div>
                </div>
                @if (Auth::check())
                    <div class="relative select-none" oncontextmenu="return false;">
                        <img src="{{ route('secure.image', basename($post->image)) }}"
                            alt="Gambar tidak bisa ditampilkan" class="pointer-events-none"
                            style="user-select: none; -webkit-user-drag: none;">
                    </div>
                @else
                    <p class="text-red-500 italic">Silakan login untuk melihat gambar ini.</p>
                @endif

                <div class="prose max-w-none text-gray-800">
                    {{ html_entity_decode(strip_tags($post->body)) }}
                </div>

                <!-- Actions -->
                <div class="flex gap-3 mt-8">
                    <a href="{{ route('admin-posts.index') }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali
                    </a>


                </div>
            </main>
        </div>
    </div>

</body>

</html>
