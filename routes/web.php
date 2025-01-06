<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use Illuminate\Support\Facades\Route;

//Route jika url tidak terdefinisi
Route::fallback(function () {
    return response()->redirectToRoute('user.home');
});

//Route ke halaman homepage
Route::get('/', [AuthController::class,'home'])->name('user.home');

//Route ke halaman login
Route::get('/login', [AuthController::class,'login_page'])->name('login');

//Route ke halaman register
Route::get('/register',[AuthController::class,'register_page'])->name('register.page');

//Route aksi register
Route::post('/register',[AuthController::class,'register'])->name('user.register');

//Route untuk login
Route::post('/login',[AuthController::class, 'login'])->name('user.login');

//Route untuk logout
Route::post('/logout',[AuthController::class, 'logout'])->name('user.logout');

//Route untuk search nama makanan
Route::get('/search',[MenuItemController::class,'search'])->name('user.menu.search');

//Route yang bisa di akses oleh user dan admin dengan syarat harus sudah login
Route::get('/riwayat-pemesanan',[OrderController::class,'history'])->middleware('auth')->name('orders-history');

//Route yang hanya bisa diakses oleh admin
Route::middleware(['auth','role:admin'])->group(function () {

    //menambahkan prefix admin
    Route::prefix('admin')->group(function () {

        //Route ke halaman dashboard
        Route::get('/', [AuthController::class,'index'])->name('admin.dashboard');

        //Route ke halaman kategori
        Route::get('/kategori',[KategoriController::class,'index'])->name('admin.kategori.index');

        //Route untuk menambahkan kategori
        Route::post('/kategori',[KategoriController::class,'store'])->name('admin.kategori.create');

        //Route untuk menghapus kategori
        Route::delete('/kategori/{id}',[KategoriController::class,'destroy'])->name('admin.kategori.delete');

        //Route ke halaman form makanan baru
        Route::get('/menu-item', [MenuItemController::class, 'create'])->name('admin.menu.create');

        //Route untuk menambahkan makanan baru
        Route::post('/menu-item',[MenuItemController::class,'store'])->name('admin.menu.store');

        //Route ke halaman update makanan
        Route::get('/menu-item/{id}/edit',[MenuItemController::class,'edit'])->name('admin.menu.edit');

        //Route untuk mengupdate makanan
        Route::patch('/menu-item/{id}',[MenuItemController::class,'update'])->name('admin.menu.update');

        //Route untuk menghapus makanan
        Route::delete('/menu-item/{id}',[MenuItemController::class,'destroy'])->name('admin.menu.delete');

        //Route untuk menampilkan data makanan pesanan
        Route::get('/order',[OrderDetailController::class,'index'])->name('admin.orders.index');

        //Route untuk mengubah status order
        Route::patch('/order/{id}',[OrderController::class,'update'])->name('admin.orders.update');

    });

});


//Route yang hanya bisa di akses oleh customer
Route::middleware(['auth','role:customer'])->group(function(){

    //Route ke halaman detail menu
    Route::get('/menu/{id}',[MenuItemController::class,'show'])->name('customer.menu.show');

    //Route ke halaman keranjang
    Route::get('/cart',[CartController::class,'index'])->name('customer.cart.index');

    //Route untuk menambahkan data ke keranjang
    Route::post('/cart/{menu_id}',[CartController::class,'store'])->name('customer.cart.store');

    //Route untuk menghapus data di keranjang
    Route::delete('/cart/{id}',[CartController::class,'destroy'])->name('customer.cart.destroy');

    //Route ke halaman order
    Route::get('/order',[OrderController::class,'index'])->name('customer.order.index');

    //Route untuk ke halaman pembayaran pesanan
    Route::get('/order/payment',[OrderController::class,'payment'])->name('customer.order.payment');

    //Route untuk menambahkan data order
    Route::post('/order',[OrderController::class,'store'])->name('customer.order.store');

    //Route untuk ke halaman profile customer
    Route::get('/profile',[CustomerController::class,'profile'])->name('customer.profile.index');

    //Route untuk update profile customer
    Route::patch('/profile/{id_customer}',[CustomerController::class,'update'])->name('customer.profile.update');

    

});