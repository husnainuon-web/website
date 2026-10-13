<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $categoryId = $request->query('category');

        $products = DB::table('products')
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->where('products.status', true)
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('products.name', 'like', '%'.$search.'%')
                        ->orWhere('products.description', 'like', '%'.$search.'%')
                        ->orWhere('products.sku', 'like', '%'.$search.'%')
                        ->orWhere('categories.name', 'like', '%'.$search.'%');
                });
            })
            ->when($categoryId, fn ($query) => $query->where('products.category_id', $categoryId))
            ->select('products.*', 'categories.name as category_name')
            ->orderBy('products.name')
            ->paginate(12);

        $categories = DB::table('categories')
            ->where('status', true)
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('customer.products.index', compact('products', 'categories', 'search', 'categoryId'));
    }

    public function show(int $product): View
    {
        $product = DB::table('products')
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->where('products.status', true)
            ->where('products.id', $product)
            ->select('products.*', 'categories.name as category_name')
            ->firstOrFail();

        $isWishlisted = auth()->check()
            ? DB::table('wishlists')->where('user_id', auth()->id())->where('product_id', $product->id)->exists()
            : in_array((int) $product->id, session('customer_wishlist', []), true);

        return view('customer.products.show', compact('product', 'isWishlisted'));
    }
}
