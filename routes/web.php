<?php
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
// Login, user and admin operation(By Razu)
Route::get('login','AuthController@getLogin')->name('login');
Route::post('login/save','AuthController@loginSave')->name('loginSave');
Route::get('user/add','AuthController@createUser')->name('createUser');
Route::post('user/save','AuthController@saveUser')->name('saveUser');
Route::get('user/edit/{id}','AuthController@editUser')->name('editUser')->where(['id'=>'[0-9]+']);
Route::get('user/delete/{id}','AuthController@deleteUser')->name('deleteUser')->where(['id'=>'[0-9]+']);
Route::get('user','AuthController@displayUser')->name('displayUser');
Route::get('user/profile','AuthController@profileUser')->name('profileUser');

//Password Reset by RAZU
Route::get('password-reset', 'PasswordController@showForm')->name('resetpassword');
Route::post('password-reset-post', 'PasswordController@sendPasswordResetToken')->name('sendPasswordResetToken');
Route::get('reset-password/{token}', 'PasswordController@showPasswordResetForm')->name('showPasswordResetForm');
Route::post('reset-password/{token}', 'PasswordController@resetPassword')->name('resetPassword');
//Logout by RAZU
Route::get('logout','AuthController@userLogout')->name('userLogout');
Route::group(['middleware' => 'auth'], function () {
//setting by RAZU
    Route::get('reset-password','AdminController@userResetPawssword')->name('userResetPawssword');
    Route::post('reset-password','AdminController@userResetPawssword')->name('userResetPawssword');
    Route::get('setting','AdminController@adminSetting')->name('adminSetting');
    Route::post('setting/header/save','AdminController@headerSettingSave')->name('headerSettingSave');
    Route::post('setting/footer/save','AdminController@footerSettingSave')->name('footerSettingSave')->where(['id'=>'[0-9]+']);
    Route::post('setting/vat/save','AdminController@vatSettingSave')->name('vatSettingSave')->where(['id'=>'[0-9]+']);
    Route::post('setting/tax/save','AdminController@taxSettingSave')->name('taxSettingSave');
    Route::post('setting/discount/save','AdminController@discountSettingSave')->name('discountSettingSave');
    Route::post('setting/login/save','AdminController@loginSettingSave')->name('loginSettingSave');
    Route::get('/','DashboardController@getDashboard')->name('getDashboard');
    Route::post('/','DashboardController@getDashboard')->name('getDashboard');
    //Category Add, Edit & Delete (By Naim)
    Route::get('category','CategoryController@listCategory')->name('listCategory');
    Route::get('category/add','CategoryController@addCategory')->name('addCategory');
    Route::post('category/save','CategoryController@saveCategory')->name('saveCategory');
    Route::get('category/edit/{id}','CategoryController@editCategory')->name('editCategory');
    Route::get('category/delete/{id}','CategoryController@deleteCategory')->name('deleteCategory');
    Route::post('category-active-inactive','CategoryController@activeInactive')->name('activeInactive');
    //supplier crud "by Bacchu"
    Route::get('supplier/addSupplier','SupplierController@addSupplier')->name('addSupplier');
    Route::post('supplier/saveSupplier','SupplierController@saveSupplier')->name('saveSupplier');
    Route::get('supplier','SupplierController@allSupplier')->name('allSupplier');
    Route::get('supplier/viewSupplier/{id}','SupplierController@viewSupplier')->name('viewSupplier')->where(['id'=>'[0-9]+']);
    Route::get('supplier/editSupplier/{id}','SupplierController@editSupplier')->name('editSupplier')->where(['id'=>'[0-9]+']);
    Route::get('/supplier/deleteSupplier/{id}','SupplierController@deleteSupplier')->name('deleteSupplier')->where(['id'=>'[0-9]+']);
    // warehouse crud 'by bacchu'
    Route::get('warehouse', 'WarehouseController@warehouseList')->name('warehouseList');
    Route::get('warehouse/add', 'WarehouseController@addWarehouse')->name('addWarehouse');
    Route::post('warehouse/save','WarehouseController@saveWarehouse')->name('saveWarehouse');
    Route::get('warehouse/edit/{id}','WarehouseController@editWarehouse')->name('editWarehouse')->where(['id'=>'[0-9]+']);
    Route::get('warehouse/delete/{id}', 'WarehouseController@deleteWarehouse')->name('deleteWarehouse')->where(['id'=>'[0-9]+']);
    Route::post('warehouse-active-inactive','WarehouseController@warehouseActiveInactive')->name('warehouseActiveInactive');
    // lot crud 'by Bacchu'
    Route::get('lot','LotController@lotList')->name('lotList');
    Route::get('addLot','LotController@addLot')->name('addLot');
    Route::post('lot/save','LotController@saveLot')->name('saveLot');
    Route::get('lot/edit/{id}', 'LotController@editLot')->name('editLot')->where(['id'=>'[0-9]+']);
    Route::get('lot/delete/{id}', 'LotController@deleteLot')->name('deleteLot')->where(['id'=>'[0-9]+']);
    Route::post('lot-active-inactive','LotController@lotActiveInactive')->name('lotActiveInactive');
    // Brand crud 'by Bacchu'
    Route::get('brand','BrandController@brandList')->name('brandList');
    Route::get('brand/add','BrandController@addBrand')->name('addBrand');
    Route::post('brand/save','BrandController@saveBrand')->name('saveBrand');
    Route::get('brand/edit/{id}','BrandController@editBrand')->name('editBrand')->where(['id'=>'[0-9]+']);
    Route::get('brand/delete/{id}','BrandController@deleteBrand')->name('deleteBrand')->where(['id'=>'[0-9]+']);
    Route::post('brand-active-inactive','BrandController@brandActiveInactive')->name('brandActiveInactive');
    //Product Add, Edit & Delete (By Naim)
    Route::get('product','ProductController@productAdd')->name('productAdd');
    Route::post('product/save','ProductController@productSave')->name('productSave');
    Route::get('product/list','ProductController@productList')->name('productList');
    Route::post('product/list','ProductController@productList')->name('productList');
    Route::get('product/edit/{id}','ProductController@productEdit')->name('productEdit');
    Route::get('product/delete/{id}','ProductController@deleteProduct')->name('deleteProduct');
    Route::get('product/pdf','ProductController@printView')->name('printView');
    Route::get('product/barcode','ProductController@productBarcode')->name('productBarcode');
    Route::post('product/barcode','ProductController@productBarcode')->name('productBarcode');

    Route::get('pdf', function (){
        $pdf = PDF::loadView('product.print');
        return $pdf->download('invoice.pdf');
    });
    //cupon add (by Bacchu)
    Route::get('cupon','CuponController@addCupon')->name('addCupon');
    Route::get('cupon/edit/{id}','CuponController@editCupon')->name('editCupon');
    Route::get('cupon/delete/{id}','CuponController@deleteCupon')->name('deleteCupon');
    Route::post('cupon/save','CuponController@saveCupon')->name('saveCupon');
    Route::post('cupon/update','CuponController@updateCupon')->name('updateCupon');
    Route::get('cupon/list','CuponController@listCupon')->name('listCupon');
    //bulk csv / excel upload (by bacchu)
    Route::get('csv','BulkController@csv')->name('csv');
    Route::post('csv/upload','BulkController@csvUpload')->name('csvUpload');
    Route::get('excel','BulkController@excel')->name('excel');
    Route::post('excel/upload','BulkController@excelUpload')->name('excelUpload');
    //sell product (by Bacchu)
    Route::get('sell','ProductController@productPage')->name('productPage');
    Route::get('update-cart','ProductController@updateCart')->name('updateCart');
    Route::get('remove-from-cart-{id}','OrderController@removeFromCart')->name('removeFromCart');
    Route::post('productSearch','ProductController@productSearch')->name('productSearch');
    Route::get('cartClear','OrderController@cartClear')->name('cartClear');
    Route::post('saveOrder','OrderController@saveOrder')->name('saveOrder');
    Route::get('invoice','OrderController@printInvoice')->name('printInvoice');

    Route::get('/home','TestController@home')->name('home');

    // Report
    Route::get('daily-sell','DashboardController@todayReport')->name('todayReport');
    Route::get('monthly-sell','DashboardController@monthlyReport')->name('monthlyReport');
    Route::get('all-sell','DashboardController@allReport')->name('allReport');

});
//});
//Role Add, Edit & Delete (By Naim)
Route::get('role','RoleController@roleAdd')->name('roleAdd');
Route::post('role/save','RoleController@roleSave')->name('roleSave');
Route::get('role/list','RoleController@roleList')->name('roleList');
Route::get('role/edit/{id}','RoleController@roleEdit')->name('roleEdit');
Route::get('role/delete/{id}','RoleController@deleteRole')->name('deleteRole');
Route::get('role/delete/{id}','RoleController@deleteRole')->name('deleteRole');
Route::get('/test','DashboardController@dashboardReport')->name('test');



