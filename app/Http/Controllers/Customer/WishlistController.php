<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class WishlistController extends Controller
{
    public function index(Request $request): View
    {
        if (Auth::check()) {
            $productIds = DB::table('wishlists')->where('user_id', Auth::id())->pluck('product_id')->all();
        } else {
            $productIds = $request->session()->get('customer_wishlist', []);
        }

        $products = $productIds
            ? DB::table('products')->whereIn('id', $productIds)->get()->keyBy('id')
            : collect();
        $wishlistItems = collect($productIds)
            ->map(fn ($id) => $products->get($id))
            ->filter()
            ->values();

        return view('customer.wishlist.index', compact('wishlistItems'));
    }

    public function store(Request $request, int $product): RedirectResponse
    {
        DB::table('products')->where('id', $product)->where('status', true)->firstOrFail();

        if (Auth::check()) {
            DB::table('wishlists')->insertOrIgnore([
                'user_id' => Auth::id(),
                'product_id' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $items = $request->session()->get('customer_wishlist', []);
            $items[] = $product;
            $request->session()->put('customer_wishlist', array_values(array_unique($items)));
        }

        return back()->with('success', 'Product saved to your wishlist.');
    }

    public function destroy(Request $request, int $product): RedirectResponse
    {
        if (Auth::check()) {
            DB::table('wishlists')
                ->where('user_id', Auth::id())
                ->where('product_id', $product)
                ->delete();
        } else {
            $items = $request->session()->get('customer_wishlist', []);
            $request->session()->put(
                'customer_wishlist',
                array_values(array_filter($items, fn ($id) => (int) $id !== $product))
            );
        }

        return back()->with('success', 'Product removed from your wishlist.');
    }
}
