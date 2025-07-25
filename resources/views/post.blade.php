<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>


    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white antialiased">
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
            <article
                class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                <a href="/posts" class="font-medium text-xs text-blue-600 hover:underline">&laquo; Back to all post</a>
                <header class="mb-4 lg:mb-6 not-format">
                    <address class="flex items-center my-6 not-italic">
                        <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">

                            <div>
                                @if (Auth::check())
                                    <div class="relative select-none" oncontextmenu="return false;">
                                        <img src="{{ route('secure.image', basename($post->image)) }}"
                                            alt="Gambar tidak bisa ditampilkan" class="pointer-events-none"
                                            draggable="false" style="user-select: none; -webkit-user-drag: none;">
                                    </div>
                                @else
                                    <p class="text-red-500 italic">Silakan login untuk melihat gambar ini.</p>
                                @endif
                                <a href="/posts?author={{ $post->author->username }}" rel="author"
                                    class="text-xl font-bold text-gray-900 dark:text-black">{{ $post->author->name }}</a>


                                <p class="text-base text-gray-500 mb-1 dark:text-gray-400">
                                    {{ $post->created_at->diffForHumans() }}</p>
                                <div class="flex justify-between items-center mb-5 text-gray-500">
                                    <a href="/posts?categories={{ $post->category->slug }}">
                                        <span
                                            class="bg-{{ $post->category->color }}-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800 transform transition duration-200 hover:scale-105">
                                            {{ $post->category->name }}
                                        </span>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </address>

                    <h1 class="mb-4 text-3xl font-extrabold leading-tight text-black lg:mb-6 lg:text-4xl ">
                        {{ $post->title }}
                    </h1>
                </header>
                <p class="lead text-gray-600">{{ html_entity_decode(strip_tags($post->body)) }}
                </p>
            </article>
        </div>
    </main>


</x-layout>
