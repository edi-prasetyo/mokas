<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\PackageController as AdminPackageController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\VariantContoller;
use App\Http\Controllers\Admin\VehicleController as AdminVehicleController;
use App\Http\Controllers\Frontend\FrontendController;
// use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Seller\OrderController as SellerOrderController;
use App\Http\Controllers\Seller\PackageController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Seller\VehicleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['verify' => true]);

// Frontend
Route::get('/', [FrontendController::class, 'index']);
Route::get('/category', [FrontendController::class, 'categories']);
Route::get('/category/{category_slug}', [FrontendController::class, 'products']);
Route::get('/mobil-dijual', [FrontendController::class, 'car']);
Route::get('/jual-mobil-dan-motor', [FrontendController::class, 'vehicle']);
Route::get('/jual/{category}', [FrontendController::class, 'categories']);
Route::get('/jual-{category_slug}/{vehicle_slug}', [FrontendController::class, 'show']);

// New Member
Route::prefix('member')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
    Route::get('/otp', [HomeController::class, 'verify_otp'])->name('verify_otp');
    Route::post('/send-otp', [HomeController::class, 'send_otp'])->name('send_otp');
    Route::post('/resend-otp', [HomeController::class, 'resend_otp'])->name('resend_otp');

    Route::post('/fetch-city', [HomeController::class, 'fetchCity']);

    Route::get('/update-password', [HomeController::class, 'edit_password']);
    Route::put('/update_password', [HomeController::class, 'update_password']);
    Route::get('/seller', [HomeController::class, 'seller']);
    Route::put('/add-seller', [HomeController::class, 'add_seller']);
});

// Seller
Route::prefix('seller')->middleware(['auth', 'isSeller'])->group(function () {

    Route::get('dashboard', [SellerController::class, 'index']);
    Route::get('create', [VehicleController::class, 'create']);
    Route::post('store', [VehicleController::class, 'store']);
    Route::post('vehicle/fetch-brands', [VehicleController::class, 'fetchBrand']);
    Route::post('vehicle/fetch-types', [VehicleController::class, 'fetchType']);

    // Order Route
    Route::get('orders', [SellerOrderController::class, 'index']);

    // Package Route
    Route::get('packages', [PackageController::class, 'index']);
    Route::post('packages/order', [PackageController::class, 'order']);
    Route::get('payment/{uuid}', [SellerOrderController::class, 'payment']);

    // Image
    Route::get('/upload_image', [VehicleController::class, 'upload_image'])->name('upload_image');
    Route::post('/store_image', [VehicleController::class, 'store_image'])->name('store_image');
});

// Admin
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index']);
    // Category Route
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/edit/{category}', 'edit');
        Route::put('/category/{category}', 'update');
        Route::get('/category/delete/{category}', 'destroy');
        Route::post('category/fetch-brand', 'fetchBrand');
        // Brand Route
        Route::get('/category/brand/{category}', 'brand');
        Route::post('/category/brand/', 'store_brand');
        Route::get('/category/edit-brand/{brand}', 'edit_brand');
        Route::put('/category/update-brand/{brand_id}', 'update_brand');
        Route::get('/category/delete-brand/{brand}', 'destroy_brand');
        // Type Route
        Route::get('/category/brand/type/{brand}', 'type');
        Route::post('/category/brand/type/', 'store_type');
        Route::get('/category/brand/type/delete/{type}', 'destroy_type');
    });

    // Variant Route
    Route::controller(VariantContoller::class)->group(function () {
        Route::get('/variants', 'index');
        Route::get('/variants/create', 'create');
        Route::post('/variants', 'store');
        Route::get('/variants/edit/{variant}', 'edit');
        Route::put('/variants/{variant}', 'update');
        Route::get('/variants/delete/{variant}', 'destroy');
    });

    // Bank Route
    Route::controller(BankController::class)->group(function () {
        Route::get('/banks', 'index');
        Route::get('/banks/create', 'create');
        Route::post('/banks', 'store');
        Route::get('/banks/edit/{bank}', 'edit');
        Route::put('/banks/{bank}', 'update');
    });
    // Package Route
    Route::controller(AdminPackageController::class)->group(function () {
        Route::get('/packages', 'index');
        Route::get('/packages/create', 'create');
        Route::post('/packages', 'store');
        Route::get('/packages/edit/{package}', 'edit');
        Route::put('/packages/{package}', 'update');
        Route::get('/delete/{package}', 'destroy');
    });
    // Order Route
    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders', 'index');
        Route::get('/orders/{order_id}', 'show');
        Route::post('/orders/confirmation/{order_id}', 'confirmation');
    });
    // Sliders Route
    Route::controller(SliderController::class)->group(function () {
        Route::get('/sliders', 'index');
        Route::get('/sliders/create', 'create');
        Route::post('/sliders/create', 'store');
        Route::get('/sliders/edit/{slider}', 'edit');
        Route::put('/sliders/{slider}', 'update');
        Route::get('/sliders/delete/{slider}', 'destroy');
    });


    // Option Route
    Route::controller(OptionController::class)->group(function () {
        Route::get('/options', 'index');
        Route::get('/options/edit/{brand}', 'edit');
        Route::post('/options', 'update');
    });
    // Province Route
    Route::controller(ProvinceController::class)->group(function () {
        Route::get('/provinces', 'index');
        Route::post('/provinces', 'store');
        Route::get('/provinces/create', 'create');
        Route::get('/provinces/edit/{brand}', 'edit');
        Route::put('/provinces', 'update');
        Route::get('/provinces/delete/{province}', 'destroy');
        // City Route
        Route::get('/provinces/city/{province}', 'city');
        Route::post('/provinces/city/', 'store_city');
        Route::get('/provinces/city/delete/{city}', 'destroy_city');
    });
    // Vehicles Route
    Route::controller(AdminVehicleController::class)->group(function () {
        Route::get('/vehicles', 'index');
        Route::get('/vehicles/show/{id}', 'show');
    });
});
