<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;



class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        return view('dashboard.categories.index', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:categories',
            'color' => 'required|unique:categories'
        ]);

        Category::create($validated);

        return redirect('/dashboard/categories')->with('success', 'New category has been added!');
    }
    public function checkSlug(Request $request)
    {
        $slug = Str::slug($request->name);
        if (Category::where('slug', $slug)->exists()) {
            $slug .= '-' . uniqid();
        }

        return response()->json(['slug' => $slug]);
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Category::destroy($category->id);

        return redirect('/dashboard/categories')->with('success', 'Category deleted successfully.');
    }
    public function datatable()
{
    $query = Category::query();

    return DataTables::of($query)
        ->addColumn('action', function ($category) {
            return '
                <form action="' . route('categories.destroy', $category->slug) . '" method="POST" onsubmit="return confirm(\'Yakin ingin menghapus kategori ini?\')" class="inline-block">
                    ' . csrf_field() . method_field('DELETE') . '
                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm flex items-center">
                        <svg class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                        </svg>
                        Delete
                    </button>
                </form>
            ';
        })
        ->rawColumns(['action'])
        ->make(true);
}
}
