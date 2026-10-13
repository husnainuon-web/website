<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerCart
{
    public static function items(Request $request): array
    {
        if (Auth::check()) {
            return DB::table('carts')
                ->where('user_id', Auth::id())
                ->pluck('quantity', 'product_id')
                ->map(fn ($quantity) => (int) $quantity)
                ->all();
        }

        return collect($request->session()->get('customer_cart', []))
            ->map(fn ($quantity) => (int) $quantity)
            ->all();
    }

    public static function add(Request $request, int $productId, int $quantity): void
    {
        if (Auth::check()) {
            $existing = (int) (DB::table('carts')
                ->where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->value('quantity') ?? 0);

            DB::table('carts')->upsert(
                [[
                    'user_id' => Auth::id(),
                    'product_id' => $productId,
                    'quantity' => $existing + $quantity,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]],
                ['user_id', 'product_id'],
                ['quantity', 'updated_at']
            );

            return;
        }

        $items = $request->session()->get('customer_cart', []);
        $items[$productId] = (int) ($items[$productId] ?? 0) + $quantity;
        $request->session()->put('customer_cart', $items);
    }

    public static function setQuantity(Request $request, int $productId, int $quantity): void
    {
        if (Auth::check()) {
            DB::table('carts')->upsert(
                [[
                    'user_id' => Auth::id(),
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]],
                ['user_id', 'product_id'],
                ['quantity', 'updated_at']
            );

            return;
        }

        $items = $request->session()->get('customer_cart', []);
        $items[$productId] = $quantity;
        $request->session()->put('customer_cart', $items);
    }

    public static function remove(Request $request, int $productId): void
    {
        if (Auth::check()) {
            DB::table('carts')
                ->where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->delete();

            return;
        }

        $items = $request->session()->get('customer_cart', []);
        unset($items[$productId]);
        $request->session()->put('customer_cart', $items);
    }

    public static function clear(Request $request): void
    {
        if (Auth::check()) {
            DB::table('carts')->where('user_id', Auth::id())->delete();

            return;
        }

        $request->session()->forget('customer_cart');
    }

    public static function mergeIntoUser(Request $request, User $user): void
    {
        DB::transaction(function () use ($request, $user) {
            foreach ($request->session()->get('customer_cart', []) as $productId => $quantity) {
                if (!DB::table('products')->where('id', $productId)->exists()) {
                    continue;
                }

                $existing = (int) (DB::table('carts')
                    ->where('user_id', $user->id)
                    ->where('product_id', $productId)
                    ->value('quantity') ?? 0);

                DB::table('carts')->upsert(
                    [[
                        'user_id' => $user->id,
                        'product_id' => $productId,
                        'quantity' => $existing + (int) $quantity,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]],
                    ['user_id', 'product_id'],
                    ['quantity', 'updated_at']
                );
            }

            $wishlist = $request->session()->get('customer_wishlist', []);
            foreach (array_unique(array_map('intval', $wishlist)) as $productId) {
                if (DB::table('products')->where('id', $productId)->exists()) {
                    DB::table('wishlists')->insertOrIgnore([
                        'user_id' => $user->id,
                        'product_id' => $productId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            $orderIds = $request->session()->get('customer_order_ids', []);
            if ($orderIds) {
                DB::table('orders')
                    ->whereNull('user_id')
                    ->whereIn('id', $orderIds)
                    ->update(['user_id' => $user->id, 'updated_at' => now()]);
            }

            $quotationIds = $request->session()->get('customer_quotation_ids', []);
            if ($quotationIds) {
                DB::table('quotations')
                    ->whereNull('user_id')
                    ->whereIn('id', $quotationIds)
                    ->update(['user_id' => $user->id, 'updated_at' => now()]);
            }
        });

        $request->session()->forget(['customer_cart', 'customer_wishlist']);
    }
}
