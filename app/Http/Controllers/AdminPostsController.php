<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;

class AdminPostsController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['category', 'author']);

    if ($request->has('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search . '%')
              ->orWhereHas('author', fn($a) => $a->where('name', 'like', '%' . $request->search . '%'))
              ->orWhereHas('category', fn($c) => $c->where('name', 'like', '%' . $request->search . '%'));
        });
    }

    $posts = $query->latest()->paginate(15)->withQueryString();

    return view('dashboard.admin-posts.index', compact('posts'));

    }

    public function show(Post $admin_post)
    {
        return view('dashboard.admin-posts.show', [
            'post' => $admin_post
        ]);
    }

    public function edit(Post $admin_post)
    {
        return view('dashboard.admin-posts.edit', [
            'post' => $admin_post,
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request, Post $admin_post)
    {
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ];

        if ($request->slug !== $admin_post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        $validated = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validated['image'] = $request->file('image')->store('private-post-images');
        }

        $admin_post->update($validated);

        return redirect()->route('admin-posts.index')->with('success', 'Post updated.');
    }

    public function destroy(Post $admin_post)
    {
        if ($admin_post->image) {
            Storage::delete($admin_post->image);
        }

        $admin_post->delete();

        return redirect()->route('admin-posts.index')->with('success', 'Post deleted.');
    }
}
