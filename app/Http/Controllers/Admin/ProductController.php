<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = DB::table('products')
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.*', 'categories.name as category_name')
            ->orderByDesc('products.created_at')
            ->paginate(15);

        $products->getCollection()->transform(function ($product) {
            $product->category = $product->category_name === null
                ? null
                : (object) ['name' => $product->category_name];
            $product->is_featured = false;
            unset($product->category_name);

            return $product;
        });

        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = DB::table('categories')->where('status', true)->orderBy('name')->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateProduct($request);
        $mainImage = $request->file('main_image')?->store('products', 'public');
        $mainVideo = $request->file('main_video')?->store('products/videos', 'public');
        $now = now();

        $productId = DB::table('products')->insertGetId([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => $this->uniqueSlug($validated['name']),
            'sku' => $validated['sku'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'main_image' => $mainImage,
            'main_video' => $mainVideo,
            'specifications' => $this->encodeSpecifications($validated['specifications'] ?? null),
            'tags' => $this->encodeTags($validated['tags'] ?? null),
            'status' => $request->boolean('status'),
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $this->storeGalleryImages($request, $productId);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function show(int $product): View
    {
        $product = $this->findProduct($product);

        return view('admin.products.show', compact('product'));
    }

    public function edit(int $product): View
    {
        $product = $this->findProduct($product);
        $categories = DB::table('categories')->orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, int $product): RedirectResponse
    {
        $validated = $this->validateProduct($request, $product);
        $existing = DB::table('products')->where('id', $product)->firstOrFail();
        $mainImage = $existing->main_image;
        $mainVideo = $existing->main_video;

        if ($request->hasFile('main_image')) {
            if (!empty($mainImage)) {
                Storage::disk('public')->delete($mainImage);
            }
            $mainImage = $request->file('main_image')->store('products', 'public');
        }

        if ($request->hasFile('main_video')) {
            if (!empty($mainVideo)) {
                Storage::disk('public')->delete($mainVideo);
            }
            $mainVideo = $request->file('main_video')->store('products/videos', 'public');
        }

        DB::table('products')->where('id', $product)->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => $this->uniqueSlug($validated['name'], $product),
            'sku' => $validated['sku'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'main_image' => $mainImage,
            'main_video' => $mainVideo,
            'specifications' => $this->encodeSpecifications($validated['specifications'] ?? null),
            'tags' => $this->encodeTags($validated['tags'] ?? null),
            'status' => $request->boolean('status'),
            'updated_at' => now(),
        ]);

        $this->storeGalleryImages($request, $product);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(int $product): RedirectResponse
    {
        $existing = DB::table('products')->where('id', $product)->firstOrFail();

        if (!empty($existing->main_image)) {
            Storage::disk('public')->delete($existing->main_image);
        }
        if (!empty($existing->main_video)) {
            Storage::disk('public')->delete($existing->main_video);
        }
        $images = DB::table('product_images')->where('product_id', $product)->pluck('image');
        Storage::disk('public')->delete($images->all());
        DB::table('products')->where('id', $product)->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    private function validateProduct(Request $request, ?int $productId = null): array
    {
        return $request->validate([
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'sku' => ['required', 'string', 'max:255', Rule::unique('products', 'sku')->ignore($productId)],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'specifications' => ['nullable', 'string'],
            'tags' => ['nullable', 'string'],
            'main_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'main_video' => ['nullable', 'file', 'mimetypes:video/mp4,video/webm,video/quicktime,video/x-msvideo', 'max:20480'],
            'gallery_images' => ['nullable', 'array', 'max:10'],
            'gallery_images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'status' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
        ]);
    }

    private function findProduct(int $productId): object
    {
        $product = DB::table('products')->where('id', $productId)->firstOrFail();
        $product->category = DB::table('categories')->where('id', $product->category_id)->first();
        $product->images = DB::table('product_images')->where('product_id', $productId)->orderBy('sort_order')->get();
        $product->specifications = json_decode($product->specifications ?? '[]', true) ?: [];
        $product->tags = json_decode($product->tags ?? '[]', true) ?: [];
        $product->is_featured = false;
        $product->created_at = $product->created_at ? Carbon::parse($product->created_at) : null;
        $product->updated_at = $product->updated_at ? Carbon::parse($product->updated_at) : null;

        return $product;
    }

    private function storeGalleryImages(Request $request, int $productId): void
    {
        foreach ($request->file('gallery_images', []) as $index => $image) {
            DB::table('product_images')->insert([
                'product_id' => $productId,
                'image' => $image->store('products/gallery', 'public'),
                'is_primary' => false,
                'sort_order' => $index,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name) ?: 'product';
        $slug = $base;
        $suffix = 2;

        while (DB::table('products')->where('slug', $slug)->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base.'-'.$suffix++;
        }

        return $slug;
    }

    private function encodeSpecifications(?string $text): ?string
    {
        $specifications = [];

        foreach (preg_split('/\r\n|\r|\n/', $text ?? '') as $line) {
            if (str_contains($line, ':')) {
                [$key, $value] = explode(':', $line, 2);
                $key = trim($key);
                if ($key !== '') {
                    $specifications[$key] = trim($value);
                }
            }
        }

        return $specifications ? json_encode($specifications) : null;
    }

    private function encodeTags(?string $text): ?string
    {
        $tags = array_values(array_filter(array_map('trim', explode(',', $text ?? ''))));

        return $tags ? json_encode($tags) : null;
    }
}