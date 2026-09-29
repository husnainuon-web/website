<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Customer\ProductController as CustomerProductController;
use App\Http\Controllers\Customer\WishlistController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\Customer\NotificationController;
use App\Http\Controllers\Customer\QuotationController as CustomerQuotationController;
use App\Http\Controllers\Customer\ProfileController;
use App\Http\Controllers\Customer\RecommendationController as CustomerRecommendationController;
use App\Http\Controllers\Customer\SupportController as CustomerSupportController;


/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
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

    return redirect()->route('login');

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
])
->prefix('customer')
->name('customer.')
->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Customer Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [
        CustomerDashboardController::class,
        'index'
    ])->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Products
    |--------------------------------------------------------------------------
    */

    Route::get('/products', [
        CustomerProductController::class,
        'index'
    ])->name('products.index');

    Route::get('/products/{product}', [
        CustomerProductController::class,
        'show'
    ])->name('products.show');

    Route::post('/products/{product}/order', [
        CustomerOrderController::class,
        'storeDirect'
    ])->name('products.order');


    /*
    |--------------------------------------------------------------------------
    | Recommendations
    |--------------------------------------------------------------------------
    */

    Route::get('/recommendations', [
        CustomerRecommendationController::class,
        'index'
    ])->name('recommendations.index');


    /*
    |--------------------------------------------------------------------------
    | Wishlist
    |--------------------------------------------------------------------------
    */

    Route::get('/wishlist', [
        WishlistController::class,
        'index'
    ])->name('wishlist.index');

    Route::post('/wishlist/{product}', [
        WishlistController::class,
        'store'
    ])->name('wishlist.store');

    Route::delete('/wishlist/{product}', [
        WishlistController::class,
        'destroy'
    ])->name('wishlist.destroy');


    /*
    |--------------------------------------------------------------------------
    | Cart
    |--------------------------------------------------------------------------
    */

    Route::get('/cart', [
        CartController::class,
        'index'
    ])->name('cart.index');

    Route::post('/cart/{product}', [
        CartController::class,
        'store'
    ])->name('cart.store');

    Route::patch('/cart/{product}', [
        CartController::class,
        'update'
    ])->name('cart.update');

    Route::delete('/cart/{product}', [
        CartController::class,
        'destroy'
    ])->name('cart.destroy');


    /*
    |--------------------------------------------------------------------------
    | Orders & Checkout
    |--------------------------------------------------------------------------
    */

    Route::get('/checkout', [
        CustomerOrderController::class,
        'checkout'
    ])->name('checkout');

    Route::post('/checkout', [
        CustomerOrderController::class,
        'store'
    ])->name('checkout.store');

    Route::get('/orders', [
        CustomerOrderController::class,
        'index'
    ])->name('orders.index');

    Route::get('/orders/{order}', [
        CustomerOrderController::class,
        'show'
    ])->name('orders.show');


    /*
    |--------------------------------------------------------------------------
    | Notifications
    |--------------------------------------------------------------------------
    */

    Route::get('/notifications', [
        NotificationController::class,
        'index'
    ])->name('notifications.index');

    Route::post('/notifications/{id}/read', [
        NotificationController::class,
        'read'
    ])->name('notifications.read');

    Route::post('/notifications/read-all', [
        NotificationController::class,
        'readAll'
    ])->name('notifications.readAll');


    /*
    |--------------------------------------------------------------------------
    | Quotations
    |--------------------------------------------------------------------------
    */

    Route::get('/quotations', [
        CustomerQuotationController::class,
        'index'
    ])->name('quotations.index');

    Route::get('/products/{product}/quotation', [
        CustomerQuotationController::class,
        'create'
    ])->name('quotations.create');

    Route::post('/products/{product}/quotation', [
        CustomerQuotationController::class,
        'store'
    ])->name('quotations.store');

    Route::get('/quotations/{quotation}', [
        CustomerQuotationController::class,
        'show'
    ])->name('quotations.show');


    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [
        ProfileController::class,
        'index'
    ])->name('profile.index');

    Route::put('/profile', [
        ProfileController::class,
        'update'
    ])->name('profile.update');


    /*
    |--------------------------------------------------------------------------
    | Support
    |--------------------------------------------------------------------------
    */

    Route::prefix('support')
        ->name('support.')
        ->controller(CustomerSupportController::class)
        ->group(function () {

            Route::get('/', 'index')
                ->name('index');

            Route::get('/create', 'create')
                ->name('create');

            Route::post('/', 'store')
                ->name('store');

            Route::get('/{supportTicket}', 'show')
                ->name('show');

        });

});