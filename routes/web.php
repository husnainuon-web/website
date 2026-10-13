<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Auth Controllers
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;


/*
|--------------------------------------------------------------------------
| Admin Controllers
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SupportController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\QuotationController;
use App\Http\Controllers\Admin\RecommendationController;


/*
|--------------------------------------------------------------------------
| Customer Controllers
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Customer\ProductController as CustomerProductController;
use App\Http\Controllers\Customer\WishlistController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\Customer\QuotationController as CustomerQuotationController;


/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $query = DB::table('products')
        ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
        ->where('products.status', true)
        ->select('products.id', 'products.name', 'products.description', 'products.price', 'products.main_image', 'categories.id as category_id', 'categories.name as category_name');

    $search = trim((string) request()->query('search', ''));
    $categoryId = request()->query('category');

    if ($search !== '') {
        $query->where(function ($query) use ($search) {
            $query->where('products.name', 'like', '%'.$search.'%')
                ->orWhere('products.description', 'like', '%'.$search.'%')
                ->orWhere('products.sku', 'like', '%'.$search.'%')
                ->orWhere('categories.name', 'like', '%'.$search.'%');
        });
    }

    if ($categoryId) {
        $query->where('products.category_id', $categoryId);
    }

    $products = $query->orderByDesc('products.created_at')
        ->limit(8)
        ->get();
    $categories = DB::table('categories')
        ->where('status', true)
        ->orderBy('name')
        ->get(['id', 'name']);

    return view('storefront', compact('products', 'categories', 'search', 'categoryId'));
});

/*
|--------------------------------------------------------------------------
| Login
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

Route::post('/login', [
    AuthenticatedSessionController::class,
    'store'
])->middleware('guest');


/*
|--------------------------------------------------------------------------
| Register
|--------------------------------------------------------------------------
*/

Route::get('/register', [
    RegisteredUserController::class,
    'create'
])->middleware('guest')->name('register');

Route::post('/register', [
    RegisteredUserController::class,
    'store'
])->middleware('guest');


/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

Route::post('/logout', function () {

    Auth::logout();

    request()->session()->invalidate();

    request()->session()->regenerateToken();

    return redirect('/');

})->middleware('auth')->name('logout');


/*
|--------------------------------------------------------------------------
| Main Dashboard Redirect
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($user->role === 'customer') {
        return redirect()->route('customer.dashboard');
    }

    abort(403, 'Invalid user role.');

})->middleware('auth')->name('dashboard');


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:admin',
])
->prefix('admin')
->name('admin.')
->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Admin Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [
        DashboardController::class,
        'index'
    ])->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Categories
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'categories',
        CategoryController::class
    );


    /*
    |--------------------------------------------------------------------------
    | Products
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'products',
        ProductController::class
    );


    /*
    |--------------------------------------------------------------------------
    | Orders
    |--------------------------------------------------------------------------
    */

    Route::get('/orders', [
        OrderController::class,
        'index'
    ])->name('orders.index');

    Route::get('/orders/{order}', [
        OrderController::class,
        'show'
    ])->name('orders.show');

    Route::put('/orders/{order}', [
        OrderController::class,
        'update'
    ])->name('orders.update');


    /*
    |--------------------------------------------------------------------------
    | Support
    |--------------------------------------------------------------------------
    */

    Route::get('/support', [
        SupportController::class,
        'index'
    ])->name('support.index');

    Route::get('/support/{supportTicket}', [
        SupportController::class,
        'show'
    ])->name('support.show');

    Route::put('/support/{supportTicket}', [
        SupportController::class,
        'update'
    ])->name('support.update');


    /*
    |--------------------------------------------------------------------------
    | Customer Management
    |--------------------------------------------------------------------------
    */

    Route::get('/customers', [
        CustomerController::class,
        'index'
    ])->name('customers.index');

    Route::get('/customers/{user}', [
        CustomerController::class,
        'show'
    ])->name('customers.show');


    /*
    |--------------------------------------------------------------------------
    | Quotations Management
    |--------------------------------------------------------------------------
    */

    Route::get('/quotations', [
        QuotationController::class,
        'index'
    ])->name('quotations.index');

    Route::get('/quotations/{quotation}', [
        QuotationController::class,
        'show'
    ])->name('quotations.show');

    Route::put('/quotations/{quotation}', [
        QuotationController::class,
        'update'
    ])->name('quotations.update');


    /*
    |--------------------------------------------------------------------------
    | Reports
    |--------------------------------------------------------------------------
    */

    Route::get('/reports', [
        \App\Http\Controllers\Admin\ReportController::class,
        'index'
    ])->name('reports.index');


    /*
    |--------------------------------------------------------------------------
    | AI Recommendation Management
    |--------------------------------------------------------------------------
    */

    Route::get('/recommendations', [
        RecommendationController::class,
        'index'
    ])->name('recommendations.index');

});


/*
|--------------------------------------------------------------------------
| CUSTOMER ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:customer',
])->prefix('customer')->name('customer.')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Customer Dashboard
    |--------------------------------------------------------------------------
    */



    /*
    |--------------------------------------------------------------------------
    | Recommendations
    |--------------------------------------------------------------------------
    */



    /*
    |--------------------------------------------------------------------------
    | Notifications
    |--------------------------------------------------------------------------
    */



    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */



    /*
    |--------------------------------------------------------------------------
    | Support
    |--------------------------------------------------------------------------
    */

});

Route::get('/customer/dashboard', function () {
    return redirect()->route('customer.products.index');
})->middleware(['auth', 'role:customer'])->name('customer.dashboard');


/*
|--------------------------------------------------------------------------
| Public Customer Store
|--------------------------------------------------------------------------
*/

Route::prefix('customer')->name('customer.')->group(function () {
    Route::get('/products', [CustomerProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product}', [CustomerProductController::class, 'show'])->name('products.show');
    Route::post('/products/{product}/order', [CustomerOrderController::class, 'storeDirect'])->name('products.order');

    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/{product}', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('/wishlist/{product}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/cart/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{product}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/checkout', [CustomerOrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [CustomerOrderController::class, 'store'])->name('checkout.store');
    Route::get('/orders', [CustomerOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [CustomerOrderController::class, 'show'])->name('orders.show');

    Route::get('/quotations', [CustomerQuotationController::class, 'index'])->name('quotations.index');
    Route::get('/products/{product}/quotation', [CustomerQuotationController::class, 'create'])->name('quotations.create');
    Route::post('/products/{product}/quotation', [CustomerQuotationController::class, 'store'])->name('quotations.store');
    Route::get('/quotations/{quotation}', [CustomerQuotationController::class, 'show'])->name('quotations.show');
});