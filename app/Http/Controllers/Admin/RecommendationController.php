<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RecommendationController extends Controller
{
    public function index(): View
    {
        $mostViewedProducts = DB::table('product_views')
            ->select('product_id')
            ->selectRaw('COUNT(*) as view_count')
            ->groupBy('product_id')
            ->orderByDesc('view_count')
            ->limit(10)
            ->get()
            ->map(fn ($item) => $this->attachProduct($item));

        $popularCategories = DB::table('product_views')
            ->join('products', 'products.id', '=', 'product_views.product_id')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->select('categories.id', 'categories.name')
            ->selectRaw('COUNT(*) as view_count')
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('view_count')
            ->limit(10)
            ->get();

        $recentViews = DB::table('product_views')
            ->orderByDesc('created_at')
            ->limit(20)
            ->get()
            ->map(function ($view) {
                $view->created_at = $view->created_at ? Carbon::parse($view->created_at) : null;
                $view->user = DB::table('users')->where('id', $view->user_id)->first();
                $view->product = DB::table('products')->where('id', $view->product_id)->first();

                if ($view->product) {
                    $view->product->category = DB::table('categories')->where('id', $view->product->category_id)->first();
                }

                return $view;
            });

        return view('admin.recommendations.index', [
            'totalViews' => DB::table('product_views')->count(),
            'activeCustomers' => DB::table('product_views')
                ->where('created_at', '>=', now()->subDays(30))
                ->distinct('user_id')
                ->count('user_id'),
            'viewedProducts' => DB::table('product_views')->distinct('product_id')->count('product_id'),
            'totalProducts' => DB::table('products')->count(),
            'mostViewedProducts' => $mostViewedProducts,
            'popularCategories' => $popularCategories,
            'recentViews' => $recentViews,
        ]);
    }

    private function attachProduct(object $item): object
    {
        $item->product = DB::table('products')->where('id', $item->product_id)->first();

        if ($item->product) {
            $item->product->category = DB::table('categories')->where('id', $item->product->category_id)->first();
        }

        return $item;
    }
}