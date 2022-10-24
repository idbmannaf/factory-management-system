<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\Web\Admin\Role\AdminRoleController;
use App\Http\Controllers\Web\Admin\AdminDashboardController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\account\AccountProductManufacturController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Production\PackagingController;
use App\Http\Controllers\SamplesController;
use App\Http\Controllers\Production\ProductManufacturController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\Web\Admin\AdminProductManufactureController;
use App\Http\Controllers\StationeryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DailyProductionController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\FactoryManagerController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\Web\User\UserDashboardController;

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

require __DIR__ . '/auth.php';

Route::get('/', [
    'uses' => 'Ecommerce\WelcomeController@welcome',
    'as' => 'welcome',
]);
Route::get('hello/{type}', function (Request $request) {
    $totals = DB::table('requisitions')
        ->selectRaw('count(*) as total')
        ->selectRaw("count(case when status = 'pending' then 1 end) as pending")
        ->selectRaw("count(case when status = 'approved' then 1 end) as approved")
        ->selectRaw("count(case when status = 'collected' then 1 end) as collected")
        ->selectRaw("count(case when status = 'stocked' then 1 end) as stocked")
        ->first();
    return $totals->approved;
});


Route::get('/dashboard', function () {
    // return view('dashboard');
    return redirect()->route('welcome');
})->middleware(['auth'])->name('dashboard');

Route::get('select/user', [
    'uses' => 'User\UserDashboardController@selectUser',
    'as' => 'user.selectUser',
]);


Route::get('select/new/product', [UserDashboardController::class, 'selectNewProduct'])->name('selectNewProduct');
Route::get('import', [UserDashboardController::class, 'importData'])->name('import');
Route::post('import', [UserDashboardController::class, 'importData'])->name('import');

//admin
Route::group(['middleware' => ['myrole:admin', 'auth'], 'prefix' => 'admin'], function () {

    Route::get('materials/all/type/{type}', [AdminDashboardController::class, 'materials'])->name('admin.materials');
    Route::post('materials/add/type/{type}', [AdminDashboardController::class, 'addMaterials'])->name('admin.addMaterials');
    Route::post('materials/{material}/update/type/{type}', [AdminDashboardController::class, 'updateMaterials'])->name('admin.updateMaterials');
    Route::get('materials/{material}/delete/type/{type}', [AdminDashboardController::class, 'deleteMaterials'])->name('admin.deleteMaterials');


    Route::get('all/production', [AdminRoleController::class, 'allProduction'])->name('admin.production');
    Route::post('add/new/production', [AdminRoleController::class, 'addNewProduction'])->name('admin.addNewProduction');
    Route::post('delete/production/{role}', [AdminRoleController::class, 'deleteProduction'])->name('admin.deleteProduction');

    Route::get('all/accounts', [AdminRoleController::class, 'allAccounts'])->name('admin.accounts');
    Route::post('add/new/accounts', [AdminRoleController::class, 'addNewAccounts'])->name('admin.addNewAccounts');
    Route::post('delete/accounts/{role}', [AdminRoleController::class, 'deleteAccounts'])->name('admin.deleteAccounts');

    Route::get('categories/type/{type}', [CategoryController::class, 'index'])->name('categories');
    Route::post('categories/store/{type}', [CategoryController::class, 'storeCategories'])->name('storeCategories');
    Route::post('category/{category}/update', [CategoryController::class, 'updateCategories'])->name('updateCategories');
    Route::post('category/{category}/delete', [CategoryController::class, 'deleteCategories'])->name('deleteCategories');


    Route::get('subcategories', [CategoryController::class, 'subcategories'])->name('subcategories');
    Route::post('subcategory/store', [CategoryController::class, 'storeSubCategories'])->name('storeSubCategories');
    Route::post('subcategory/{subcat}/update', [CategoryController::class, 'updateSubCategories'])->name('updateSubCategories');
    Route::post('subcategory/{subcat}/delete', [CategoryController::class, 'deleteSubCategories'])->name('deleteSubCategories');

    Route::get('stationeries', [StationeryController::class, 'stationeries'])->name('admin.stationeries');
    Route::post('stationeries/store', [StationeryController::class, 'storeStationeries'])->name('admin.storeStationeries');
    Route::post('stationery/{stationery}/update', [StationeryController::class, 'updateStationery'])->name('admin.updateStationery');
    Route::get('stationery/{stationery}/delete', [StationeryController::class, 'deleteStationery'])->name('admin.deleteStationery');

    Route::get('supplier/all/', [SupplierController::class, 'allSuppliers'])->name('admin.allSupplier');
    Route::post('add/supplier', [SupplierController::class, 'addSupplier'])->name('admin.addSupplier');
    Route::post('update/supplier/{supplier}', [SupplierController::class, 'updateSupplier'])->name('admin.updateSupplier');
    Route::get('delete/supplier/{supplier}', [SupplierController::class, 'deleteSupplier'])->name('admin.deleteSupplier');
    Route::get('orders/supplier/{supplier}', [SupplierController::class, 'supplierOrders'])->name('admin.orders');
    Route::get('order/{order}/details/supplier/{supplier}', [SupplierController::class, 'supplierOrderDetails'])->name('admin.supplierOrderDetails');
    Route::get('payments/supplier/{supplier}', [SupplierController::class, 'supplierPaymentHistory'])->name('admin.payments');
    Route::post('payments/supplier/{supplier}/pay/now', [SupplierController::class, 'payNow'])->name('admin.payNow');
    Route::post('payments/supplier/{supplier}/payment{payment}/update', [SupplierController::class, 'updatePayment'])->name('admin.updatePayment');
    Route::get('payments/supplier/{supplier}/payment{payment}/delete', [SupplierController::class, 'deletePayment'])->name('admin.deletePayment');
    Route::get('payments/supplier/{supplier}/order/search', [SupplierController::class, 'orderSearch'])->name('admin.orderSearch');


    Route::get('requisition/type/{type}', [AdminDashboardController::class, 'requisitionList'])->name('admin.requisitionList');

    Route::get('add/requisition/', [AdminDashboardController::class, 'newRequisition'])->name('admin.newRequisition');
    Route::get('add/stationary/requisition/', [AdminDashboardController::class, 'stationaryRequisition'])->name('admin.stationaryRequisition');
    Route::get('add/pack/requisition/', [AdminDashboardController::class, 'packagingRequisition'])->name('admin.packagingRequisition');

    Route::get('requisition/view/{requisition}', [AdminDashboardController::class, 'requisitionView'])->name('admin.requisitionView');
    Route::get('requisition/edit/{requisition}', [AdminDashboardController::class, 'requisitionEdit'])->name('admin.requisitionEdit');
    Route::get('requisition/delete/{requisition}', [AdminDashboardController::class, 'requisitionDelete'])->name('admin.requisitionDelete');
    Route::post('/requisition/{requisition}', [AdminDashboardController::class, 'requisitionProcessUpdate'])->name('admin.requisitionProcess');


    Route::post('requisition/update/{requisition}/type/{type}', [AdminDashboardController::class, 'requisitionUpdate'])->name('admin.requisitionUpdate');

    Route::get('stocked/materials/type/{type}', [AdminDashboardController::class, 'stockedMaterials'])->name('admin.stockedMaterials');
    Route::get('stocked/materials/modify/history', [AdminDashboardController::class, 'stockedMaterialsModifyHistory'])->name('admin.stockedMaterialsModifyHistory');
    Route::post('stocked/materials/stock/{stock}/modify/store', [AdminDashboardController::class, 'stockedMaterialsModifyHistory'])->name('admin.stockedMaterialsModifyHistory');
    Route::post('store/custom/raw/stocked/material/type/{type}', [AdminDashboardController::class, 'storeCustomMaterials'])->name('admin.storeCustomMaterials');

    //Sample Start
    Route::get('/samples', [SamplesController::class, 'allSamples'])->name('admin.allSamples');
    Route::get('create/sample', [SamplesController::class, 'createSample'])->name('admin.createSample');
    Route::get('create/samples/ajax', [SamplesController::class, 'createSamplesAjax'])->name('admin.createSamplesAjax');
    Route::get('check/raw/batch', [SamplesController::class, 'checkRawBatch'])->name('admin.checkRawBatch');
    Route::post('store/sample', [SamplesController::class, 'storeSample'])->name('admin.storeSample');
    Route::get('edit/sample/{sample}', [SamplesController::class, 'editSample'])->name('admin.editSample');
    Route::post('update/sample/{sample}', [SamplesController::class, 'updateSample'])->name('admin.updateSample');
    Route::get('view/sample/{sample}', [SamplesController::class, 'viewSample'])->name('admin.viewSample');
    Route::delete('delete/sample/{sample}', [SamplesController::class, 'deleteSample'])->name('admin.deleteSample');

    // some Ajax
    Route::get('check/type/{type}/unit', [SamplesController::class, 'checkRawUnit'])->name('admin.checkRawUnit');
    //Sample End

    //Admin Product manufacture Start
    Route::get('product/manufacturing/{type}', [AdminProductManufactureController::class, 'productManufacturing'])->name('admin.productManufacturing');
    Route::get('add/product/manufacturing', [AdminProductManufactureController::class, 'AddProductManufacturing'])->name('admin.AddProductManufacturing');
    Route::get('add/product/manufacturing/ajax/product/{product}', [AdminProductManufactureController::class, 'productManufacturingAjax'])->name('admin.productManufacturingAjax');
    // Route::get('add/product/manufacturing/calculate/ajax/sample/product/{product}', [AdminProductManufactureController::class, 'productManufacturingCalculateAjax'])->name('admin.productManufacturingCalculateAjax');
    Route::post('store/product/manufacturing/calculate/ajax/sample/product/{product}', [AdminProductManufactureController::class, 'storeProductManufacturing'])->name('admin.storeProductManufacturing');
    Route::delete('delete/product/{product}/manufacturing/', [AdminProductManufactureController::class, 'deleteProductManufacturing'])->name('admin.deleteProductManufacturing');
    Route::get('view/product/{product}/manufacturing/', [AdminProductManufactureController::class, 'viewProductManufacturing'])->name('admin.viewProductManufacturing');
    Route::get('view/product/{product}/manufacturing/after/proccess', [AdminProductManufactureController::class, 'viewProductManufacturingAfterProccess'])->name('admin.viewProductManufacturingAfterProccess');
    Route::get('load/manufacturing/type/{type}', [AdminProductManufactureController::class, 'loadItem'])->name('admin.loadItem');
    Route::get('get/unit/', [AdminProductManufactureController::class, 'getUnit'])->name('admin.getUnit');

    Route::get('edit/product/{product}/manufacturing/', [AdminProductManufactureController::class, 'editProductManufacturing'])->name('admin.editProductManufacturing');
    Route::get('edit/product/{product}/manufacturing/ajax', [AdminProductManufactureController::class, 'editProductManufacturingAjax'])->name('admin.editProductManufacturingAjax');
    Route::post('update/product/{product}/manufacturing/status/{status}', [AdminProductManufactureController::class, 'updateProductManufacturing'])->name('admin.updateProductManufacturing');
    Route::get('packaging/product/{product}/mendotory/check', [AdminProductManufactureController::class, 'appendMandotoryPack'])->name('admin.appendMandotoryPack');
    Route::get('packaging/product/{product}/temp', [AdminProductManufactureController::class, 'addTemp'])->name('admin.addTemp');


    //Ajax for Packaging
    Route::get('packaging/product/{product}/on/change/mandetory/quantity', [AdminProductManufactureController::class, 'onChangeMandetoryQuantity'])->name('admin.onChangeMandetoryQuantity');
    Route::get('packaging/product/{product}/select/type/{type}', [AdminProductManufactureController::class, 'selectUnselect'])->name('admin.selectUnselect');
    Route::get('packaging/product/{product}/change/quantity/{type}', [AdminProductManufactureController::class, 'changeQty'])->name('admin.changeQty');
    Route::get('packaging/product/{product}/on/remove/mandetory', [AdminProductManufactureController::class, 'removeMandetoryPack'])->name('admin.removeMandetoryPack');


    Route::get('packaging/product/{product}/on/change/mandetory/stock', [AdminProductManufactureController::class, 'onChangeMandetory'])->name('admin.onChangeMandetory');


    Route::get('packaging/product/{product}/check/if-have-last-temp', [AdminProductManufactureController::class, 'checkIfHaveLastTemp'])->name('admin.checkIfHaveLastTemp');




    Route::get('ready/product/list', [AdminProductManufactureController::class, 'readyProducts'])->name('admin.readyProducts');


    //Daily Production
    Route::get('daily/production/type/{type?}', [DailyProductionController::class, 'dailyProduction'])->name('admin.dailyProduction');
    Route::post('daily/production/post', [DailyProductionController::class, 'dailyProductionPost'])->name('admin.dailyProductionPost');
    Route::get('daily/production/{production}/edit', [DailyProductionController::class, 'editDailyProduction'])->name('admin.editDailyProduction');
    Route::get('daily/production/{production}/delete', [DailyProductionController::class, 'deleteDailyProduction'])->name('admin.deleteDailyProduction');
    Route::post('daily/production/{production}/update', [DailyProductionController::class, 'updateDailyProduction'])->name('admin.updateDailyProduction');
    Route::get('daily/production/{production}/update/status/{status}', [DailyProductionController::class, 'updateDailyProductionStatus'])->name('admin.updateDailyProductionStatus');

    Route::get('download/type/{type}/status/{status?}', [DownloadController::class, 'downloadNow'])->name('downloadNow');



    Route::get('report/type/{type}', [ReportController::class, 'report'])->name('admin.report');

    //Daily Productions
    Route::get('/dashboard', [
        'uses' => 'Admin\AdminDashboardController@dashboard',
        'as' => 'admin.dashboard',
    ]);

    Route::get('/dashboard/chart-data/get', [
        'uses' => 'Admin\AdminDashboardController@getChartData',
        'as' => 'admin.getChartData',
    ]);

    Route::get('admins/all/', [
        'uses' => 'Admin\Role\AdminRoleController@adminsAll',
        'as' => 'admin.adminsAll',
    ]);
    Route::get('admin/purchase', [AdminRoleController::class, 'purchase'])->name('admin.purchase');
    Route::post('admin/add/new/purchase', [AdminRoleController::class, 'purchasePost'])->name('admin.purchasePost');
    Route::get('admin/factory_manager', [AdminRoleController::class, 'factory_manager'])->name('admin.factory_manager');
    Route::post('admin/add/new/factory_manager', [AdminRoleController::class, 'factoryManagerPost'])->name('admin.factoryManagerPost');
    Route::post('admin/user/{user}/role/{role}', [AdminRoleController::class, 'addPermission'])->name('admin.addPermission');

    Route::get('factory/all/', [
        'uses' => 'Admin\Role\AdminRoleController@factoryAll',
        'as' => 'admin.factoryAll',
    ]);

    Route::get('select/new/role', [
        'as' => 'admin.selectNewRole',
        'uses' => 'Admin\Role\AdminRoleController@selectNewRole',
    ]);


    Route::post('admin/add/new/post', [
        'uses' => 'Admin\Role\AdminRoleController@adminAddNewPost',
        'as' => 'admin.adminAddNewPost',
    ]);

    Route::post('admin/delete/{role}', [
        'uses' => 'Admin\Role\AdminRoleController@adminDelete',
        'as' => 'admin.adminDelete',
    ]);

    Route::get('/users', [
        'uses' => 'Admin\Ecommerce\AdminUserController@index',
        'as' => 'admin.ecommerce.users',
    ]);
    Route::get('/user/{user}', [
        'uses' => 'Admin\Ecommerce\AdminUserController@show',
        'as' => 'admin.ecommerce.user.edit',
    ]);
    Route::post('/user/{user}', [
        'uses' => 'Admin\Ecommerce\AdminUserController@update',
        'as' => 'admin.ecommerce.user.update',
    ]);
    Route::post('/user/{user}/password', [
        'uses' => 'Admin\Ecommerce\AdminUserController@updatePassword',
        'as' => 'admin.ecommerce.user.password',
    ]);

    /// report
    Route::get('/report/{type}', [
        'uses' => 'Admin\AdminReportController@index',
        'as' => 'admin.report',
    ]);

    Route::get('/commissions', [
        'uses' => 'Admin\AdminReportController@commissionList',
        'as' => 'admin.commissionList',
    ]);

    Route::get('/search/{type}', [
        'uses' => 'Admin\AdminSearchController@search',
        'as' => 'admin.search',
    ]);
});

//admin

//Production Section START
Route::group(['middleware' => ['myrole:production', 'auth'], 'prefix' => 'production'], function () {
    Route::get('/dashboard', [ProductionController::class, 'dashboard'])->name('production.dashboard');
    Route::get('/requisition/type/{type}', [ProductionController::class, 'requisitions'])->name('production.requisitions');
    Route::get('add/requisition/', [ProductionController::class, 'newRequisition'])->name('production.newRequisition');
    Route::get('add/stationary/requisition/', [ProductionController::class, 'stationaryRequisition'])->name('production.stationaryRequisition');
    Route::get('add/pack/requisition/', [ProductionController::class, 'packagingRequisition'])->name('production.packagingRequisition');
    Route::get('append/materials/Ajax/type/{type}', [ProductionController::class, 'materialsAjax'])->name('production.materialsAjax');
    Route::get('stocked/materials/type/{type}', [ProductionController::class, 'stockedMaterials'])->name('production.stockedMaterials');

    Route::get('ready/product/list', [ProductionController::class, 'readyProducts'])->name('production.readyProducts');
    Route::get('load/row/categories', [ProductionController::class, 'loadRawCats'])->name('production.loadRawCats');
    Route::get('load/type/{type}', [ProductionController::class, 'loadData'])->name('production.loadData');
    Route::get('select/product', [ProductionController::class, 'selectProduct'])->name('production.selectProduct');
    Route::get('unselect/product/', [ProductionController::class, 'unSelectProduct'])->name('production.unSelectProduct');
    Route::get('update/quanity/', [ProductionController::class, 'updateQuanity'])->name('production.updateQuanity');
    Route::post('store/pack/requisition/{requisition}', [ProductionController::class, 'packRequisitionUpdate'])->name('production.packRequisitionUpdate');


    //Requisition Start
    Route::get('view/requisition/{requisition}', [ProductionController::class, 'viewRequisition'])->name('production.viewRequisition');
    Route::get('edit/requisition/{requisition}', [ProductionController::class, 'editRequisition'])->name('production.editRequisition');
    Route::post('update/requisition/{requisition}/type/{type}', [ProductionController::class, 'updateRequisition'])->name('production.updateRequisition');
    Route::get('delete/requisition/{requisition}', [ProductionController::class, 'deleteRequisition'])->name('production.deleteRequisition');
    Route::post('update/status/requisition/{requisition}', [ProductionController::class, 'updateStatusRequisition'])->name('production.updateStatusRequisition');
    //Requisition Start

    //Daily Production
    Route::get('daily/production', [ProductionController::class, 'dailyProduction'])->name('production.dailyProduction');
    Route::post('daily/production/post', [DailyProductionController::class, 'dailyProductionPost'])->name('production.dailyProductionPost');
    Route::get('daily/production/{production}/edit', [DailyProductionController::class, 'editDailyProduction'])->name('production.editDailyProduction');
    Route::get('daily/production/{production}/delete', [DailyProductionController::class, 'deleteDailyProduction'])->name('production.deleteDailyProduction');
    Route::post('daily/production/{production}/update', [DailyProductionController::class, 'updateDailyProduction'])->name('production.updateDailyProduction');
    Route::post('daily/production/{production}/update/status/{status}', [DailyProductionController::class, 'updateDailyProductionStatus'])->name('production.updateDailyProductionStatus');

    //Daily Productions

    Route::get('/samples', [ProductionController::class, 'allSamples'])->name('production.allSamples');
    Route::get('view/sample/{sample}', [ProductionController::class, 'viewSample'])->name('production.viewSample');
    Route::get('create/sample', [ProductionController::class, 'createSample'])->name('production.createSample');
    Route::get('edit/sample/{sample}', [ProductionController::class, 'editSample'])->name('production.editSample');
    Route::get('view/sample/{sample}', [ProductionController::class, 'viewSample'])->name('production.viewSample');
    // Route::get('/samples', [ProductionController::class, 'allSamples'])->name('production.allSamples');


    //Raw/Packing Department
    Route::get('materials/all/type/{type}', [ProductionController::class, 'materials'])->name('production.materials');


    //Product Manufacturing Start
    Route::get('product/manufacturing/type/{type}', [ProductManufacturController::class, 'productManufacturing'])->name('production.productManufacturing');
    Route::get('add/product/manufacturing', [ProductManufacturController::class, 'AddProductManufacturing'])->name('production.AddProductManufacturing');
    Route::get('add/product/manufacturing/ajax/product/{product}', [ProductManufacturController::class, 'productManufacturingAjax'])->name('production.productManufacturingAjax');
    Route::get('add/product/manufacturing/calculate/ajax/sample/product/{product}', [ProductManufacturController::class, 'productManufacturingCalculateAjax'])->name('production.productManufacturingCalculateAjax');
    Route::post('store/product/manufacturing/calculate/ajax/sample/product/{product}', [ProductManufacturController::class, 'storeProductManufacturing'])->name('production.storeProductManufacturing');
    Route::delete('delete/product/{product}/manufacturing/', [ProductManufacturController::class, 'deleteProductManufacturing'])->name('production.deleteProductManufacturing');
    Route::get('view/product/{product}/manufacturing/', [ProductManufacturController::class, 'viewProductManufacturing'])->name('production.viewProductManufacturing');
    Route::get('edit/product/{product}/manufacturing/', [ProductManufacturController::class, 'editProductManufacturing'])->name('production.editProductManufacturing');
    Route::get('edit/product/{product}/manufacturing/ajax', [ProductManufacturController::class, 'editProductManufacturingAjax'])->name('production.editProductManufacturingAjax');
    Route::post('update/product/{product}/manufacturing/status/{status}', [ProductManufacturController::class, 'updateProductManufacturing'])->name('production.updateProductManufacturing');
    Route::get('view/product/{product}/manufacturing/after/proccess', [ProductManufacturController::class, 'viewProductManufacturingAfterProccess'])->name('production.viewProductManufacturingAfterProccess');
    //Product Manufacturing End

    Route::get('packging', [PackagingController::class, 'packaging'])->name('production.packaging');
    Route::get('get-price', [PackagingController::class, 'getPrice'])->name('production.getPrice');
});
//Production Section END


//Accounts Section START
Route::group(['middleware' => ['myrole:accounts', 'auth'], 'prefix' => 'accounts'], function () {
    Route::get('/dashboard', [AccountsController::class, 'dashboard'])->name('accounts.dashboard');
    Route::get('/dashboard/chart-data/get', [AccountsController::class, 'getChartData'])->name('accounts.getChartData');
    Route::post('/image', [AccountsController::class, 'image'])->name('accounts.image');

    Route::get('/requisition/type/{type}', [AccountsController::class, 'requisitions'])->name('accounts.requisitions');
    Route::get('/requisition/{requisition}', [AccountsController::class, 'requisitionProcess'])->name('accounts.requisitionProcess');
    Route::post('/requisition/{requisition}', [AccountsController::class, 'requisitionProcessUpdate'])->name('accounts.requisitionProcessUpdate');
    Route::get('stocked/materials/type/{type}', [AccountsController::class, 'stockedMaterials'])->name('accounts.stockedMaterials');

    Route::get('materials/all/type/{type}', [AccountsController::class, 'materials'])->name('accounts.materials');

    Route::get('/samples', [AccountsController::class, 'allSamples'])->name('account.allSamples');
    Route::get('view/sample/{sample}', [AccountsController::class, 'viewSample'])->name('account.viewSample');

    Route::get('all/suppliers/{supplier?}', [AccountsController::class, 'allSupliers'])->name('account.allSuppliers');
    Route::get('orders/supplier/{supplier}', [AccountsController::class, 'supplierOrders'])->name('account.orders');
    Route::get('order/{order}/supplier/{supplier}', [AccountsController::class, 'supplierOrderDetails'])->name('account.supplierOrderDetails');
    Route::get('download/order/{order}/supplier/{supplier}', [AccountsController::class, 'downloadSupplierOrderDetails'])->name('account.downloadSupplierOrderDetails');
    Route::get('payments/supplier/{supplier}', [AccountsController::class, 'supplierPaymentHistory'])->name('account.payments');


    //production Product manufacture Start
    Route::get('product/manufacturing/type/{type}', [AccountProductManufacturController::class, 'productManufacturing'])->name('account.productManufacturing');
    Route::get('add/product/manufacturing', [AccountProductManufacturController::class, 'AddProductManufacturing'])->name('account.AddProductManufacturing');
    Route::get('add/product/manufacturing/ajax/product/{product}', [AccountProductManufacturController::class, 'productManufacturingAjax'])->name('account.productManufacturingAjax');
    Route::get('add/product/manufacturing/calculate/ajax/sample/product/{product}', [AccountProductManufacturController::class, 'productManufacturingCalculateAjax'])->name('account.productManufacturingCalculateAjax');
    Route::post('store/product/manufacturing/calculate/sample/product/{product}', [AccountProductManufacturController::class, 'storeProductManufacturing'])->name('account.storeProductManufacturing');
    Route::delete('delete/product/{product}/manufacturing/', [AccountProductManufacturController::class, 'deleteProductManufacturing'])->name('account.deleteProductManufacturing');
    Route::get('view/product/{product}/manufacturing/', [AccountProductManufacturController::class, 'viewProductManufacturing'])->name('account.viewProductManufacturing');
    Route::get('edit/product/{product}/manufacturing/', [AccountProductManufacturController::class, 'editProductManufacturing'])->name('account.editProductManufacturing');
    Route::get('edit/product/{product}/manufacturing/ajax', [AccountProductManufacturController::class, 'editProductManufacturingAjax'])->name('account.editProductManufacturingAjax');
    Route::post('update/product/{product}/manufacturing/status/{status}', [AccountProductManufacturController::class, 'updateProductManufacturing'])->name('account.updateProductManufacturing');
    Route::get('ready/product/list', [AccountProductManufacturController::class, 'readyProducts'])->name('accounts.readyProducts');
    //production Product manufacture END


    Route::get('append/supplier/requisition/{requisition}/item/{item}', [AccountsController::class, 'addMoreSupplier'])->name('account.addMoreSupplier');
    Route::get('store/supplier/requisition/{requisition}/item/{item}', [AccountsController::class, 'storeMoreSupplier'])->name('account.storeMoreSupplier');
    //Report Control by Accounts Start
    Route::get('report/type/{type}', [ReportController::class, 'report'])->name('account.report');

    //Report Control by Accounts End


    Route::get('daily/production', [AccountsController::class, 'dailyProduction'])->name('account.dailyProduction');

    //Category Subcategory

    Route::get('categories', [AccountsController::class, 'category'])->name('account.categories');
    Route::get('subcategories', [AccountsController::class, 'subcategories'])->name('account.subcategories');
});
//Accounts Section END


//Purchase Section START
Route::group(['middleware' => ['myrole:purchase', 'auth'], 'prefix' => 'purchase'], function () {
    Route::get('/dashboard', [PurchaseController::class, 'dashboard'])->name('purchase.dashboard');
    Route::get('/requisition/type/{type}', [PurchaseController::class, 'requisitions'])->name('purchase.requisitions');
    Route::get('/requisition/{requisition}', [PurchaseController::class, 'requisitionProcess'])->name('purchase.requisitionProcess');
});
//Purchase Section END

//Factory manager Section START
Route::group(['middleware' => ['myrole:factory_manager', 'auth'], 'prefix' => 'factory'], function () {
    Route::get('/dashboard', [FactoryManagerController::class, 'dashboard'])->name('factory.dashboard');
    Route::get('/samples', [FactoryManagerController::class, 'allSamples'])->name('factory.allSamples');
    Route::get('view/sample/{sample}', [FactoryManagerController::class, 'viewSample'])->name('factory.viewSample');

    Route::get('materials/all/type/{type}', [FactoryManagerController::class, 'materials'])->name('factory.materials');
    Route::get('stocked/materials/type/{type}', [FactoryManagerController::class, 'stockedMaterials'])->name('factory.stockedMaterials');
    Route::get('ready/product/list', [FactoryManagerController::class, 'readyProducts'])->name('factory.readyProducts');
    Route::get('daily/production/type/{type?}', [FactoryManagerController::class, 'dailyProduction'])->name('factory.dailyProduction');
    Route::get('daily/production/{production}/edit', [DailyProductionController::class, 'editDailyProduction'])->name('factory.editDailyProduction');

    Route::get('/requisition/type/{type}', [FactoryManagerController::class, 'requisitions'])->name('factory.requisitions');
    Route::get('/requisition/{requisition}', [FactoryManagerController::class, 'requisitionProcess'])->name('factory.requisitionProcess');
    Route::post('/requisition/{requisition}', [FactoryManagerController::class, 'requisitionProcessUpdate'])->name('factory.requisitionProcessUpdate');

    Route::get('product/manufacturing/type/{type}', [FactoryManagerController::class, 'productManufacturing'])->name('factory.productManufacturing');
    Route::get('view/product/{product}/manufacturing/', [FactoryManagerController::class, 'viewProductManufacturing'])->name('factory.viewProductManufacturing');
    Route::get('edit/product/{product}/manufacturing/', [FactoryManagerController::class, 'editProductManufacturing'])->name('factory.editProductManufacturing');
    Route::post('update/product/{product}/manufacturing/status/{status}', [FactoryManagerController::class, 'updateProductManufacturing'])->name('factory.updateProductManufacturing');
});
//Factory manager Section END
