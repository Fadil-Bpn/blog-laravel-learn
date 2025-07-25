<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;





class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.posts.index', [
            'posts' => Post::where('author_id', Auth::id())->with('category')->latest()->get()

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'image' => 'image|file|max:2048',
            'body' => 'required'
        ]);
        if ($request->file('image')) {
            // Simpan ke folder privat
            $validatedData['image'] = $request->file('image')->store('private-post-images');
        }

        $validatedData['author_id'] = Auth::id();

        Post::create($validatedData);
        return redirect('/dashboard/posts')->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if (!Auth::check() || (Auth::id() !== $post->author_id )) {
            abort(403, 'Post ini bukan milik anda!');
        }
        return view('dashboard.posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (!Auth::check() || (Auth::id() !== $post->author_id && !Auth::user()?->is_admin)) {
            abort(403, 'Anda tidak diizinkan mengedit post ini. Post ini bukan milik anda!');
        }

        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ];


        if ($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }
        $validatedData = $request->validate($rules);
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            // Simpan ke folder privat
            $validatedData['image'] = $request->file('image')->store('private-post-images');
        }

        $validatedData['author_id'] = Auth::id();


        Post::where('id', $post->id)
            ->update($validatedData);

        return redirect('/dashboard/posts')->with('success', 'New post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (Auth::id() !== $post->author_id && !Auth::user()?->is_admin) {
            abort(403, 'You are not the owner of this post!');
        }
        if ($post->image) {
            Storage::delete($post->image);
        }

        Post::destroy($post->id);
        return redirect('/dashboard/posts')->with('success', 'Post has been deleted!');
    }
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
    public function datatable(Request $request)
{
    if ($request->ajax()) {
        $query = Post::where('author_id', Auth::id())->with('category');

        return DataTables::of($query)
            ->addColumn('category', function ($post) {
                return '<span class="inline-block px-2 py-1 text-xs font-semibold text-white bg-indigo-500 rounded">'
                        . e($post->category->name) . '</span>';
            })
  ->editColumn('created_at', function ($post) {
        return $post->created_at->format('d M Y H:i'); // contoh: 25 Jul 2025 13:45
    })
            ->addColumn('action', function ($post) {
                return '
                    <div class="flex space-x-2">
                        <a href="' . route('posts.show', $post->slug) . '"
                            class="text-xs bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">View</a>
                        <a href="' . route('posts.edit', $post->slug) . '"
                            class="text-xs bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Edit</a>
                        <form action="' . route('posts.destroy', $post->slug) . '" method="POST"
                            class="inline" onsubmit="return confirm(\'Hapus?\')">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="text-xs bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                Delete
                            </button>
                        </form>
                    </div>
                ';
            })
            ->rawColumns(['category', 'action']) // penting agar HTML tidak di-escape
            ->make(true);
    }
}

}
