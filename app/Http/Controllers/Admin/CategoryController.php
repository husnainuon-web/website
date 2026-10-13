<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = DB::table('categories')
            ->select('categories.*')
            ->selectSub(
                DB::table('products')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('products.category_id', 'categories.id'),
                'products_count'
            )
            ->orderBy('name')
            ->paginate(12);

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:5120'],
            'status' => ['nullable', 'boolean'],
        ]);

        $image = $request->file('image')?->store('categories', 'public');

        DB::table('categories')->insert([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'image' => $image,
            'status' => $request->boolean('status'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function show(int $category): RedirectResponse
    {
        return redirect()->route('admin.categories.edit', $category);
    }

    public function edit(int $category): View
    {
        $category = DB::table('categories')->where('id', $category)->firstOrFail();

        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, int $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:5120'],
            'status' => ['nullable', 'boolean'],
        ]);

        $existing = DB::table('categories')->where('id', $category)->firstOrFail();
        $image = $existing->image;

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($image);
            $image = $request->file('image')->store('categories', 'public');
        }

        DB::table('categories')->where('id', $category)->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'image' => $image,
            'status' => $request->boolean('status'),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(int $category): RedirectResponse
    {
        $existing = DB::table('categories')->where('id', $category)->firstOrFail();

        if (DB::table('products')->where('category_id', $category)->exists()) {
            return back()->withErrors(['category' => 'Move or delete this category’s products before deleting the category.']);
        }

        Storage::disk('public')->delete($existing->image);
        DB::table('categories')->where('id', $category)->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}