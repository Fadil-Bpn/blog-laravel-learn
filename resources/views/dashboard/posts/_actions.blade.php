->addColumn('action', function ($post) {
    return '
        <div class="flex space-x-2">
            <a href="/dashboard/posts/'.$post->id.'" class="text-xs bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">View</a>
            <a href="/dashboard/posts/'.$post->id.'/edit" class="text-xs bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Edit</a>
            <form action="/dashboard/posts/'.$post->id.'" method="POST" onsubmit="return confirm(\'Hapus?\')" class="inline">
                '.csrf_field().method_field('DELETE').'
                <button type="submit" class="text-xs bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Delete</button>
            </form>
        </div>
    ';
})
