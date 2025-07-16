<!DOCTYPE html>
<html x-data="{ sidebarOpen: false, showLogoutConfirm: false }" x-cloak>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit</title>
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


        <!-- Main content -->

        <main class="flex-1 p-6 overflow-auto">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Edit Post</h1>
                <p class="text-gray-500">This is a page to edit the post</p>
            </div>

            <form action="/dashboard/posts/{{ $post->slug }}" method="POST" class="max-w-xl mx-auto" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <!-- Title -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-semibold mb-1">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 focus:outline-none"
                        placeholder="Enter post title">
                    @error('title')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Slug -->
                <div class="mb-4">
                    <label for="slug" class="block text-gray-700 font-semibold mb-1">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $post->slug) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 focus:outline-none"
                        placeholder="Enter post slug">
                    @error('slug')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="category" class="block text-gray-700 font-semibold mb-1">Pilih Kategori</label>
                    <select id="category" name="category_id"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @foreach ($categories as $category)
                            @if (old('category_id', $post->category_id) == $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="body" class="form-label block mb-2 text-sm font-medium text-gray-900">Body</label>
                    @error('body')
                        <p class="text-sm text-red-600 mb-1">{{ $message }}</p>
                    @enderror
                    <input type="hidden" name="body" id="body" value="{{ old('body', $post->body) }}">
                    <trix-editor input="body"></trix-editor>
                </div>
                 <label class="block mb-2 text-sm font-medium text-gray-900" for="image">Post Image</label>
                 <input type="hidden" name="oldImage" value="{{$post->image}}">
                 @if($post->image)
                 <img src="{{asset('storage/' . $post->image)}}" class="img-preview mb-3 w-full max-w-xs rounded shadow object-cover d-block">
                 @else
                 <img class="img-preview mb-3 w-full max-w-xs rounded shadow object-cover hidden">
                 @endif
                <input onchange="previewImage()"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                    id="image" type="file" name="image">
                @error('image')
                    <p class="text-sm text-red-600 mb-1">{{ $message }}</p>
                @enderror

                <!-- Submit -->
                <div class="mt-6">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">
                        Save Post
                    </button>
                </div>
            </form>




        </main>


    </div>

    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function() {
            fetch('/dashboard/posts/checkSlug?title=' + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });

        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        })
        function previewImage() {
            const image=document.querySelector('#image');
        const imgPreview=document.querySelector('.img-preview')

        imgPreview.style.display = 'block';

        const oFreader = new FileReader();
        oFreader.readAsDataURL(image.files[0]);

        oFreader.onload = function(oFREvent) {
            imgPreview.src =oFREvent.target.result;
        }
        }
    </script>
</body>

</html>
