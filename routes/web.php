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

Route::post('/addCart', [App\Http\Controllers\CartController::class, 'add'])->name('addCart');
Route::get('/shoppingCartPage', [App\Http\Controllers\CartController::class, 'showMyCart'])->name('myCart');

Route::get('/shoppingShowProductPage', [App\Http\Controllers\shoppingPageController::class, 'view'])->name('shoppingShowProductPage');
Route::get('/shoppingShowProductDetails/{id}', [App\Http\Controllers\shoppingPageController::class, 'viewDetails'])->name('shoppingShowProductDetails');
Route::post('/shoppingShowProductPage', [App\Http\Controllers\shoppingPageController::class, 'searchProduct'])->name('search.product');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
        Route::post('/showBrand', [App\Http\Controllers\BrandController::class, 'searchBrand'])->name('search.brand');

        //Category Route
        Route::get('/insertCategory', [App\Http\Controllers\CategoryController::class, 'category'])->name('insertCategory');
        Route::post('/insertCategory/store', [App\Http\Controllers\CategoryController::class, 'insert'])->name('addCategory');
        Route::get('/viewCategory', [App\Http\Controllers\CategoryController::class, 'view'])->name('viewCategory');
        Route::get('/editCategory/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('editCategory');
        Route::post('/updateCategory', [App\Http\Controllers\CategoryController::class, 'update'])->name('updateCategory');
        Route::get('/deleteCategory/{id}', [App\Http\Controllers\CategoryController::class, 'delete'])->name('deleteCategory');
        Route::post('/showCategory', [App\Http\Controllers\CategoryController::class, 'searchCategory'])->name('search.category');

        //Product Route
        Route::get('/insertProduct', function () {
        return view('admin.insertProduct',['categoryID'=>App\Models\category::all(),'brandID'=>App\Models\brand::all(),'SupplierID'=>App\Models\Supplier::all()]);
        })->name('insertProduct');
        Route::post('/insertProduct/store', [App\Http\Controllers\ProductController::class, 'store'])->name('addProduct');
        Route::get('/viewProduct', [App\Http\Controllers\ProductController::class, 'view'])->name('viewProduct');
        Route::get('/editProduct/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('editProduct');
        Route::post('/updateProduct', [App\Http\Controllers\ProductController::class, 'update'])->name('updateProduct');
        Route::get('/deleteProduct/{id}', [App\Http\Controllers\ProductController::class, 'delete'])->name('deleteProduct');
        Route::post('/adminSearchProduct', [App\Http\Controllers\ProductController::class, 'adminSearchProduct'])->name('search.adminProduct');

        //Supplier Route
        Route::get('/insertSupplier', [App\Http\Controllers\SupplierController::class, 'supplier'])->name('insertSupplier');
        Route::post('/insertSupplier/store', [App\Http\Controllers\SupplierController::class, 'insert'])->name('addSupplier');
        Route::get('/viewSupplier', [App\Http\Controllers\SupplierController::class, 'view'])->name('viewSupplier');
        Route::get('/editSupplier/{id}', [App\Http\Controllers\SupplierController::class, 'edit'])->name('editSupplier');
        Route::post('/updateSupplier', [App\Http\Controllers\SupplierController::class, 'update'])->name('updateSupplier');
        Route::get('/deleteSupplier/{id}', [App\Http\Controllers\SupplierController::class, 'delete'])->name('deleteSupplier');
        Route::post('/showSupplier', [App\Http\Controllers\SupplierController::class, 'searchSupplier'])->name('search.supplier');

        //User Route
        Route::get('/viewUser', [App\Http\Controllers\UserController::class, 'viewUser'])->name('viewUser');
        Route::post('/insertUser/store', [App\Http\Controllers\UserController::class, 'insert'])->name('insertUser');
        Route::get('/editUser/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('editUser');
        Route::post('/updateUser', [App\Http\Controllers\UserController::class, 'update'])->name('updateUser');
        Route::get('/deleteUser/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('deleteUser');
        Route::post('/showUser', [App\Http\Controllers\UserController::class, 'searchUser'])->name('search.user');

        //Purchase Order Route
        Route::get('/viewPurchaseOrder', [App\Http\Controllers\PurchaseOrderController::class, 'view'])->name('viewPurchaseOrder');
        Route::get('/chooseSupplier', [App\Http\Controllers\PurchaseOrderController::class, 'chooseSupplier'])->name('chooseSupplier');
        Route::get('/insertPurchaseOrder/{id}', [App\Http\Controllers\PurchaseOrderController::class, 'getProduct'])->name('getProduct');

        //admin logout
        Route::get('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');
	});
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
