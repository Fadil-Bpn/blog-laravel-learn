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
                @if ($post->image)
                <div style="max-height: 450px; overflow:hidden;">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}">
                </div>
                @else
                    <img src="{{ asset('storage/' . $post->category->image) }}" alt="{{ $post->category->name }}">
                @endif

                <div class="prose max-w-none text-gray-800">
                    {{ html_entity_decode(strip_tags($post->body)) }}

                </div>

                <!-- Actions -->
                <div class="flex gap-3 mt-8">
                    <a href="{{ route('posts.index') }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali
                    </a>
                    <a href="/dashboard/posts/{{ $post->slug }}/edit"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-yellow-300 rounded hover:bg-yellow-500">

                        <svg class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path fill-rule="evenodd"
                                d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z"
                                clip-rule="evenodd" />
                        </svg>

                        Edit
                    </a>
                    <form action="{{ route('posts.destroy', $post->slug) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus post ini?')" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-red-300 rounded hover:bg-red-500">

                            <svg class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                            </svg>

                            Delete
                        </button>
                    </form>
                </div>
            </main>
        </div>
    </div>

</body>

</html>
