<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Client;
use App\Http\Controllers\Supplier;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //client's routes
    Route::post('create-client', [Client\AuthClientController::class, 'newClient'])->name('client.new-client');
    Route::get('create-client', [Client\AuthClientController::class, 'index'])->name('client.create-client');
    Route::get('/client/dashboard', [Client\DashboardController::class, 'index'])->name('client.dashboard');
    Route::resource('client-fertilizer', Client\FertilizerController::class);
    Route::resource('client-equipment', Client\EquipmentController::class);

    //Hiring routes
    Route::get('/client/hire-equipment/{equipment_id}', [Client\HiringEquipmentController::class, 'create'])->name('client.hire-equipment');
    Route::post('/client/hire-equipment', [Client\HiringEquipmentController::class, 'store'])->name('client.hire-equipment.store');
    Route::get('/client/hire-equipment', [Client\HiringEquipmentController::class, 'index'])->name('client.hire-equipment.index');

    //Cart routes
    Route::get('/client/cart', [Client\CartController::class, 'index'])->name('client.cart.index');
    Route::post('/client/cart', [Client\CartController::class, 'store'])->name('client.cart.store');
    Route::delete('/client/cart/{cart}', [Client\CartController::class, 'destroy'])->name('client.cart.destroy');
    Route::put('/client/cart/{cart}', [Client\CartController::class, 'update'])->name('client.cart.update');

    //checkout routes
    Route::get('/client/checkout', [Client\CheckoutController::class, 'index'])->name('client.checkout.index');
    Route::post('/client/checkout', [Client\CheckoutController::class, 'store'])->name('client.checkout.store');

    //order routes
    Route::post('/client/order', [Client\OrderController::class, 'store'])->name('client.order.store');
    Route::get('/client/order', [Client\OrderController::class, 'index'])->name('client.order.index');
    Route::get('/supplier/order', [Supplier\OrdersController::class, 'index'])->name('supplier.order.index');
    Route::post('/supplier/order-mark-complete/{id}', [Supplier\OrdersController::class, 'updateStatus'])->name('supplier.order.update-status');

    //supplier's routes
    Route::get('/supplier/dashboard', [Supplier\DashboardController::class, 'index'])->name('supplier.dashboard');
    Route::post('create-supplier', [Supplier\AuthSupplierController::class, 'newSupplier'])->name('supplier.new-supplier');
    Route::get('create-supplier', [Supplier\AuthSupplierController::class, 'index'])->name('supplier.create-supplier');
    Route::resource('sup-fertilizer', Supplier\FertilizerController::class);
    Route::resource('sup-equipment', Supplier\EquipmentController::class);

    //reviews
    Route::post('/fertilizer/review', [Client\ReviewController::class, 'store'])->name('client.review-fertilizer.store');
    Route::get('/fertilizer/review/{id}', [Client\ReviewController::class, 'create'])->name('client.review-fertilizer.create');

    //search
    Route::get('/search', [Client\SearchController::class, 'index'])->name('search.index');

    //admin routes
    Route::get('/admin/dashboard', [Admin\AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/view-orders', [Admin\AdminController::class, 'viewOrders'])->name('admin.view-orders');
    Route::get('/admin/view-clients', [Admin\AdminController::class, 'viewClients'])->name('admin.view-clients');
    Route::get('/admin/view-suppliers', [Admin\AdminController::class, 'viewSuppliers'])->name('admin.view-suppliers');
});



require __DIR__ . '/auth.php';
