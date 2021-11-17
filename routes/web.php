<?php

use Illuminate\Support\Facades\Route;

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

//login route
Route::get('/register', function () {
    return view('register');
});

//Shopping Page Route
Route::get('/', function () {
    return view('shoppingHomePage');
});
Route::get('/customerLoginPage', function () {
    return view('customerLoginPage');
});
Route::get('/customerRegisterPage', function () {
    return view('customerRegisterPage');
});
Route::get('/shoppingCartPage', function () {
    return view('shoppingCartPage');
});
Route::get('/shoppingShowProductPage', [App\Http\Controllers\shoppingPageController::class, 'view'])->name('shoppingShowProductPage');
Route::get('/shoppingShowProductDetails/{id}', [App\Http\Controllers\shoppingPageController::class, 'viewDetails'])->name('shoppingShowProductDetails');
Route::post('/shoppingShowProductPage', [App\Http\Controllers\shoppingPageController::class, 'searchProduct'])->name('search.product');

//admin
Route::group(['prefix' => 'admin'], function() {
	Route::group(['middleware' => 'admin.guest'], function(){
		Route::view('/login','admin.login')->name('admin.login');
		Route::post('/login',[App\Http\Controllers\AdminController::class, 'authenticate'])->name('admin.auth');
	});

	Route::group(['middleware' => 'admin.auth'], function(){
		Route::get('/dashboard',[App\Http\Controllers\DashboardController::class, 'dashboard'])->name('admin.dashboard');

        //Brand Route
        Route::get('/insertBrand', [App\Http\Controllers\BrandController::class, 'brand'])->name('insertBrand');
        Route::post('/insertBrand/store', [App\Http\Controllers\BrandController::class, 'insert'])->name('addBrand');
        Route::get('/viewBrand', [App\Http\Controllers\BrandController::class, 'view'])->name('viewBrand');
        Route::get('/editBrand/{id}', [App\Http\Controllers\BrandController::class, 'edit'])->name('editBrand');
        Route::post('/updateBrand', [App\Http\Controllers\BrandController::class, 'update'])->name('updateBrand');
        Route::get('/deleteBrand/{id}', [App\Http\Controllers\BrandController::class, 'delete'])->name('deleteBrand');

        //Category Route
        Route::get('/insertCategory', [App\Http\Controllers\CategoryController::class, 'category'])->name('insertCategory');
        Route::post('/insertCategory/store', [App\Http\Controllers\CategoryController::class, 'insert'])->name('addCategory');
        Route::get('/viewCategory', [App\Http\Controllers\CategoryController::class, 'view'])->name('viewCategory');
        Route::get('/editCategory/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('editCategory');
        Route::post('/updateCategory', [App\Http\Controllers\CategoryController::class, 'update'])->name('updateCategory');
        Route::get('/deleteCategory/{id}', [App\Http\Controllers\CategoryController::class, 'delete'])->name('deleteCategory');

        //Product Route
        Route::get('/insertProduct', function () {
        return view('insertProduct',['categoryID'=>App\Models\category::all(),'brandID'=>App\Models\brand::all(),'SupplierID'=>App\Models\Supplier::all()]);
        })->name('insertProduct');
        Route::post('/insertProduct/store', [App\Http\Controllers\ProductController::class, 'store'])->name('addProduct');
        Route::get('/viewProduct', [App\Http\Controllers\ProductController::class, 'view'])->name('viewProduct');
        Route::get('/editProduct/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('editProduct');
        Route::post('/updateProduct', [App\Http\Controllers\ProductController::class, 'update'])->name('updateProduct');
        Route::get('/deleteProduct/{id}', [App\Http\Controllers\ProductController::class, 'delete'])->name('deleteProduct');

        //Supplier Route
        Route::get('/insertSupplier', [App\Http\Controllers\SupplierController::class, 'supplier'])->name('insertSupplier');
        Route::post('/insertSupplier/store', [App\Http\Controllers\SupplierController::class, 'insert'])->name('addSupplier');
        Route::get('/viewSupplier', [App\Http\Controllers\SupplierController::class, 'view'])->name('viewSupplier');
        Route::get('/editSupplier/{id}', [App\Http\Controllers\SupplierController::class, 'edit'])->name('editSupplier');
        Route::post('/updateSupplier', [App\Http\Controllers\SupplierController::class, 'update'])->name('updateSupplier');
        Route::get('/deleteSupplier/{id}', [App\Http\Controllers\SupplierController::class, 'delete'])->name('deleteSupplier');

        //Staff Route
        Route::get('/showStaff', [App\Http\Controllers\StaffController::class, 'viewStaff'])->name('showStaff');
        Route::post('/insertStaff/store', [App\Http\Controllers\StaffController::class, 'insert'])->name('addStaff');
        Route::get('/insertStaff', [App\Http\Controllers\StaffController::class, 'staff'])->name('insertStaff');
        Route::get('/editStaff/{id}', [App\Http\Controllers\StaffController::class, 'edit'])->name('editStaff');
        Route::post('/updateStaff', [App\Http\Controllers\StaffController::class, 'update'])->name('updateStaff');
        Route::get('/deleteStaff/{id}', [App\Http\Controllers\StaffController::class, 'delete'])->name('deleteStaff');

        //Purchase Order Route
        Route::get('/purchaseOrder', [App\Http\Controllers\PurchaseOrderController::class, 'view'])->name('purchaseOrder');

        //admin logout
        Route::get('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');
	});
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
