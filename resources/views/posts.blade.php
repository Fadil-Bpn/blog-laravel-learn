<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-search></x-search>
    {{ $posts->links() }}
    <div class="py-4 px-4 mx-auto max-w-screen-xl lg:py-8 lg:px-0">

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($posts as $post)
                <article
                    class="p-6 bg-white rounded-lg border border-gray-200 shadow-md transform transition duration-200 hover:scale-105">

                    @if (Auth::check())
                        <div class="relative select-none" oncontextmenu="return false;">
                            <img src="{{ route('secure.image', basename($post->image)) }}" alt="There are no picture here"
                                class="pointer-events-none w-full h-48 object-cover" draggable="false"
                                style="user-select: none; -webkit-user-drag: none;">
                        </div>
                    @else
                        <p class="text-red-500 italic">Silakan login untuk melihat gambar ini.</p>
                    @endif

                    <div class="flex justify-between items-center mb-5 text-gray-500">
                        <a href="/posts?category={{ $post->category->slug }}">
                            <span
                                class="bg-{{ $post->category->color }}-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded  ">
                                {{ $post->category->name }}
                            </span>
                        </a>

                        <span class="text-sm">{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                    <a href="/posts/{{ $post['slug'] }}">
                        <h2 class="hover:underline mb-2 text-2xl font-bold tracking-tight text-gray-900 ">
                            {{ $post->title }}</h2>
                    </a>
                    <p class="mb-5 font-light text-gray-500 dark:text-gray-700">
                        {{ Str::limit(html_entity_decode(strip_tags($post->body)), 150) }}
                    </p>
                    <div class="flex justify-between items-center">
                        <a href="/posts?author={{ $post->author->username }}">
                            <div class="flex items-center space-x-4">
                                <img class="w-7 h-7 rounded-full"
                                    src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png"
                                    alt="{{ $post->author->name }}" />
                                <span class="font-medium text-gray-600 text-sm ">
                                    {{ $post->author->name }}
                                </span>
                            </div>
                        </a>
                        <a href="/posts/{{ $post['slug'] }}"
                            class="inline-flex items-center font-medium text-sm text-blue-600 hover:underline">
                            Read more
                            <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                </article>

            @empty
                <div>
                    <p class="font-semibold text-xl my-4">Article not found!</p>
                    <a href="/posts" class="block text-blue-600 hover:underline">&laquo;Back to Articles</a>
                </div>
            @endforelse
        </div>
    </div>

</x-layout>
