<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelperController;
use App\Mail\FulfillMail;
use Illuminate\Support\Facades\Mail;

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

Route::get('/shoppingContactPage', function () {
    return view('shoppingContactPage');
});

Route::post('/addCart', [App\Http\Controllers\CartController::class, 'add'])->name('addCart');
Route::get('/shoppingCartPage', [App\Http\Controllers\CartController::class, 'showMyCart'])->name('myCart');
Route::get('/deleteItem/{id}', [App\Http\Controllers\CartController::class, 'delete'])->name('deleteCart');
Route::post('/updateCart', [App\Http\Controllers\CartController::class, 'update'])->name('updateCart');

Route::get('/shoppingShowProductPage', [App\Http\Controllers\shoppingPageController::class, 'view'])->name('shoppingShowProductPage');
Route::get('/priceLowToHigh', [App\Http\Controllers\shoppingPageController::class, 'priceLTH'])->name('priceLowToHigh');
Route::get('/priceHighToLow', [App\Http\Controllers\shoppingPageController::class, 'priceHTL'])->name('priceHighToLow');
Route::get('/shoppingShowProductDetails/{id}', [App\Http\Controllers\shoppingPageController::class, 'viewDetails'])->name('shoppingShowProductDetails');
Route::post('/shoppingShowProductPage', [App\Http\Controllers\shoppingPageController::class, 'searchProduct'])->name('search.product');
Route::get('/getCatProduct/{catid}', [App\Http\Controllers\shoppingPageController::class, 'getProduct'])->name('getCatProduct');

Route::post('\checkout', [App\Http\Controllers\OrderController::class, 'paymentPost'])->name('payment.post');
Route::get('/order', [App\Http\Controllers\OrderController::class, 'showOrder'])->name('myOrder');
Route::get('/order/{orderID}',[App\Http\Controllers\OrderController::class, 'viewOrder'])->name('orderDetail');

Route::get('/account', [App\Http\Controllers\UserController::class, 'acc'])->name('myAccount');
Route::post('/account/updateUser', [App\Http\Controllers\UserController::class, 'updateUser'])->name('update.User');

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
        return view('admin.insertProduct',['categoryID'=>App\Models\category::where('status','=','Available')->get(),
                                            'brandID'=>App\Models\brand::where('status','=','Available')->get(),
                                            'SupplierID'=>App\Models\Supplier::where('status','=','Available')->get()]);
        })->name('insertProduct');
        
        Route::post('/insertProduct/store', [App\Http\Controllers\ProductController::class, 'store'])->name('addProduct');
        Route::get('/viewProduct', [App\Http\Controllers\ProductController::class, 'view'])->name('viewProduct');
        Route::get('/editProduct/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('editProduct');
        Route::post('/updateProduct', [App\Http\Controllers\ProductController::class, 'update'])->name('updateProduct');
        Route::get('/deleteProduct/{id}', [App\Http\Controllers\ProductController::class, 'delete'])->name('deleteProduct');
        Route::post('/adminSearchProduct', [App\Http\Controllers\ProductController::class, 'adminSearchProduct'])->name('search.adminProduct');
        Route::get('/uploadProduct', [App\Http\Controllers\ProductController::class, 'uplaod'])->name('uploadProduct');
        Route::post('/storeUpProduct', [App\Http\Controllers\ProductController::class, 'uploadContent'])->name('storeUpProduct');
        Route::get('/bulkUploadInstruction', function () {
            return view('admin.bulkUploadInstruction');
        });

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
        Route::get('/insertUser', [App\Http\Controllers\UserController::class, 'user'])->name('insertUser');
        Route::post('/insertUser/store', [App\Http\Controllers\UserController::class, 'insert'])->name('addUser');
        Route::get('/editUser/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('editUser');
        Route::post('/updateUser', [App\Http\Controllers\UserController::class, 'update'])->name('updateUser');
        Route::get('/deleteUser/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('deleteUser');
        Route::post('/showUser', [App\Http\Controllers\UserController::class, 'searchUser'])->name('search.user');

        //Purchase Order Route
        Route::get('/viewPurchaseOrder', [App\Http\Controllers\PurchaseOrderController::class, 'view'])->name('viewPurchaseOrder');
        Route::get('/insertPurchaseOrder', [App\Http\Controllers\PurchaseOrderController::class, 'insertPO'])->name('insertPO');
        Route::get('/insertPurchaseOrder/{supplier}', [App\Http\Controllers\PurchaseOrderController::class, 'getProduct'])->name('getProduct');
        Route::post('/addPO', [App\Http\Controllers\PurchaseOrderController::class, 'store'])->name('addPO');
        Route::get('/viewPurchaseOrder/{id}', [App\Http\Controllers\PurchaseOrderController::class, 'previewPrint'])->name('viewPurchaseOrderDetail');
        Route::get('/updatePurchaseOrder/{id}', [App\Http\Controllers\PurchaseOrderController::class, 'updatePO'])->name('updatePurchaseOrder');
        Route::post('/savePO/{id}', [App\Http\Controllers\PurchaseOrderController::class, 'savePO'])->name('savePO');
        Route::post('/searchPurchaseOrder', [App\Http\Controllers\PurchaseOrderController::class, 'searchPO'])->name('searchPurchaseOrder');
        Route::get('/deletePurchaseOrder/{id}', [App\Http\Controllers\PurchaseOrderController::class, 'deletePO'])->name('deletePurchaseOrder');

        //DO
        Route::get('/viewDOHistory/{id}', [App\Http\Controllers\PurchaseOrderController::class, 'viewDOList'])->name('viewDOHistory');
        Route::get('/viewDeliveryOrder/{id}', [App\Http\Controllers\PurchaseOrderController::class, 'previewDO'])->name('viewDeliveryOrder');
        Route::get('/updateDeliveryOrder/{id}', [App\Http\Controllers\PurchaseOrderController::class, 'updateDO'])->name('updateDeliveryOrder');
        Route::post('/saveDO/{id}', [App\Http\Controllers\PurchaseOrderController::class, 'saveDO'])->name('saveDO');

        //Invoice
        Route::get('/viewINHistory/{id}', [App\Http\Controllers\PurchaseOrderController::class, 'viewInvoiceList'])->name('viewINHistory');
        Route::get('/viewInvoice/{id}', [App\Http\Controllers\PurchaseOrderController::class, 'previewInvoice'])->name('viewInvoice');
        Route::get('/viewOnlyInvoice/{id}', [App\Http\Controllers\PurchaseOrderController::class, 'previewOnlyInvoice'])->name('viewOnlyInvoice');
        Route::get('/insertInvoice/{id}', [App\Http\Controllers\PurchaseOrderController::class, 'insertInvoice'])->name('insertInvoice');
        Route::get('/updateOnlyInvoice/{id}', [App\Http\Controllers\PurchaseOrderController::class, 'updateOnlyInvoice'])->name('updateOnlyInvoice');
        Route::get('/updateInvoice/{id}', [App\Http\Controllers\PurchaseOrderController::class, 'updateINV'])->name('updateInvoice');
        Route::post('/saveInvoice/{id}', [App\Http\Controllers\PurchaseOrderController::class, 'saveINV'])->name('saveInvoice');
        Route::post('/saveOnlyInvoice/{id}', [App\Http\Controllers\PurchaseOrderController::class, 'saveOnlyINV'])->name('saveOnlyInvoice');

        //Order
        Route::get('/viewOrder', [App\Http\Controllers\OrderController::class, 'view'])->name('viewOrder');
        Route::get('/editOrder/{id}', [App\Http\Controllers\OrderController::class, 'edit'])->name('editOrder');
        Route::post('/updateOrder/{id}', [App\Http\Controllers\OrderController::class, 'update'])->name('updateOrder');
        Route::post('/adminSearchOrder', [App\Http\Controllers\OrderController::class, 'adminSearchOrder'])->name('searchAdminOrder');

        //Offline Order
        Route::get('/viewOfflineOrder', [App\Http\Controllers\OrderController::class, 'viewOfflineOrder'])->name('viewOfflineOrder');
        Route::get('/insertOfflineOrder', [App\Http\Controllers\OrderController::class, 'insertOfflineOrder'])->name('insertOfflineOrder');
        Route::post('/addOfflineOrder', [App\Http\Controllers\OrderController::class, 'storeOfflineOrder'])->name('addOfflineOrder');
        Route::get('/viewOfflineOrderDetail/{id}', [App\Http\Controllers\OrderController::class, 'viewOfflineOrderDetail'])->name('viewOfflineOrderDetail');
        Route::get('/deleteOfflineOrder/{id}', [App\Http\Controllers\OrderController::class, 'deleteOfflineOrder'])->name('deleteOfflineOrder');
        Route::post('/searchOfflineOrder', [App\Http\Controllers\OrderController::class, 'searchOfflineOrder'])->name('searchOfflineOrder');
        
        //admin logout
        Route::get('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');
	});
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
