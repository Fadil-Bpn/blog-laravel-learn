<!DOCTYPE html>
<html x-data="{ sidebarOpen: false, showLogoutConfirm: false }" x-cloak>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin Posts</title>
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

        <!-- Main Content -->
        <main class="flex-1 p-6 overflow-auto">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Hi, Admin {{ auth()->user()->name }}</h1>
                <p class="text-gray-500">Only admin can see this page</p>
            </div>
<form method="GET" action="{{ route('admin-posts.index') }}" class="mb-6 max-w-md">
    <label class="block text-gray-700 text-sm font-medium mb-2" for="search">Search</label>
    <div class="relative">
        <input type="text" id="search" name="search" value="{{ request('search') }}" autocomplete="off"
            placeholder="Search something..."
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:outline-none" />
        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-4.35-4.35M16.65 16.65A7.5 7.5 0 1117.5 10a7.5 7.5 0 01-0.85 6.65z" />
            </svg>
        </div>
    </div>
    @if(request('search'))
        <p class="text-sm text-gray-500 mt-2">Searching for: "<span class="font-semibold">{{ request('search') }}</span>"</p>
    @endif
</form>
            <!-- Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($posts as $post)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden flex flex-col">
                        @if($post->image)
                            <img src="{{ route('secure.image', basename($post->image)) }}" alt="There are no picture here"
                                class="pointer-events-none w-full h-48 object-cover" draggable="false"
                                style="user-select: none; -webkit-user-drag: none;">

                        @endif
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <h2 class="text-lg font-bold text-gray-800 mb-2">{{ $post->title }}</h2>
                                <p class="text-sm text-gray-500 mb-1">By <strong>{{ $post->author->name }}</strong>
                                    in <em>{{ $post->category->name ?? '-' }}</em></p>
                                <p class="text-sm text-gray-600">{{ Str::limit(strip_tags($post->body), 100) }}</p>
                            </div>
                            <div class="mt-4 flex justify-between text-sm">
                                <a href="{{ route('admin-posts.show', $post->slug) }}"
                                   class="text-blue-600 hover:underline">View</a>

                                <form action="{{ route('admin-posts.destroy', $post->slug) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure want to delete this?')"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        </main>
    </div>
</body>

</html>
