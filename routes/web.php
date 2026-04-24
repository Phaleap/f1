<?php
use App\Models\Product;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;  // ← move here
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\InventoryController as AdminInventoryController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\CarModelController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;


Route::get('/', function () {

    $products = Product::with('mainImage')
        ->where('status', 'active')
        ->where('product_type', 'merchandise')
        ->latest()
        ->take(4)
        ->get();

    $featuredCars = Product::with([
            'mainImage',
            'carModel.team',
            'carModel.driver',
        ])
        ->where('status', 'active')
        ->where('product_type', 'car')
        ->latest()
        ->take(4)
        ->get();

    return view('home', compact('products', 'featuredCars'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/shop', [ProductController::class, 'shop'])->name('shop');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');      // if not already there
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show'); // needed for grid card links
Route::get('/cars', [ProductController::class, 'cars'])->name('products.cars');
Route::get('/merchandise', [ProductController::class, 'merchandise'])->name('products.merchandise');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart routes — merged into same middleware group ↓
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{item}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{item}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    // Products
     Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/{item}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    // Reviews
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    // Coupon
    Route::post('/coupon/apply', [CouponController::class, 'apply'])->name('coupon.apply');
    Route::post('/coupon/remove', [CouponController::class, 'remove'])->name('coupon.remove');
    // Payment
    Route::get('/payment/{order}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/{order}', [PaymentController::class, 'process'])->name('payment.process');
    // Shipment tracking
    Route::get('/track/{order}', [ShipmentController::class, 'track'])->name('shipment.track');    
    //shop
});
Route::get('/about', function () {
    return view('about_us.index');
})->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    // Products
    Route::resource('products', AdminProductController::class);
    Route::delete('products/image/{image}', [AdminProductController::class, 'deleteImage'])->name('products.image.delete');
    // Orders
    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::post('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');
    Route::post('orders/{order}/shipment', [AdminOrderController::class, 'addShipment'])->name('orders.shipment');
    // Inventory
    Route::get('inventory', [AdminInventoryController::class, 'index'])->name('inventory.index');
    Route::post('inventory/{inventory}/adjust', [AdminInventoryController::class, 'adjust'])->name('inventory.adjust');
    Route::get('inventory/low-stock', [AdminInventoryController::class, 'lowStock'])->name('inventory.low-stock');
    // Users
    Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('users/{user}', [AdminUserController::class, 'show'])->name('users.show');
    Route::post('users/{user}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('users.toggle-status');
    // Teams, Drivers, Car Models, Categories, Brands
    Route::resource('teams', TeamController::class);
    Route::resource('drivers', DriverController::class);
    Route::resource('car-models', CarModelController::class)->parameters(['car-models' => 'carModel']);
    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);
});


require __DIR__.'/auth.php';