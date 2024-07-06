<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CoatingController;
use App\Http\Controllers\DamageController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::prefix('/')->controller(HelperController::class)->group(function () {
    Route::get('/', 'login')->name('login');
    Route::post('/', 'signin')->name('signin');
});

Route::middleware(['web', 'auth'])->group(function () {

    Route::prefix('/report')->controller(ReportController::class)->group(function () {
        Route::get('/sales', 'sales')->name('report.sales');
        Route::post('/sales', 'salesFetch')->name('report.sales.fetch');

        Route::get('/purchase', 'purchase')->name('report.purchase');
        Route::post('/purchase', 'purchaseFetch')->name('report.purchase.fetch');

        Route::get('/damage', 'damage')->name('report.damage');
        Route::post('/damage', 'damageFetch')->name('report.damage.fetch');
    });

    Route::prefix('/pdf')->controller(PdfController::class)->group(function () {
        Route::get('/purchase/detail/{id}', 'purchaseDetail')->name('report.purchase.detail.pdf');
    });

    Route::prefix('/ajax')->controller(AjaxController::class)->group(function () {
        Route::get('/product/{product}/{editQty}', 'getStock')->name('ajax.get.stock');
        Route::get('/change/type', 'changeType')->name('ajax.change.type');
        Route::get('/get/products', 'getProducts')->name('ajax.get.products');
        Route::get('/get/power/{type}', 'getPower')->name('ajax.get.power');
    });

    Route::prefix('/order')->controller(ApiController::class)->group(function () {
        Route::get('/show', 'order')->name('order');
        Route::post('/show', 'orderFetch')->name('order.fetch');
    });

    Route::prefix('/')->controller(HelperController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/logout', 'logout')->name('logout');

        Route::get('/failed/import', 'failedImport')->name('import.failed');
        Route::get('/failed/import/export', 'failedImportExport')->name('failed.import.export');
    });

    Route::prefix('/user')->controller(UserController::class)->group(function () {
        Route::get('/', 'index')->name('user.register');
        Route::get('/create', 'create')->name('user.create');
        Route::post('/create', 'store')->name('user.save');
        Route::get('/edit/{id}', 'edit')->name('user.edit');
        Route::post('/edit/{id}', 'update')->name('user.update');
        Route::get('/delete/{id}', 'destroy')->name('user.delete');
    });

    Route::prefix('/role')->controller(RoleController::class)->group(function () {
        Route::get('/', 'index')->name('role.register');
        Route::get('/create', 'create')->name('role.create');
        Route::post('/create', 'store')->name('role.save');
        Route::get('/edit/{id}', 'edit')->name('role.edit');
        Route::post('/edit/{id}', 'update')->name('role.update');
        Route::get('/delete/{id}', 'destroy')->name('role.delete');
    });

    Route::prefix('/category')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'index')->name('category.register');
        Route::get('/create', 'create')->name('category.create');
        Route::post('/create', 'store')->name('category.save');
        Route::get('/edit/{id}', 'edit')->name('category.edit');
        Route::post('/edit/{id}', 'update')->name('category.update');
        Route::get('/delete/{id}', 'destroy')->name('category.delete');
    });

    Route::prefix('/type')->controller(TypeController::class)->group(function () {
        Route::get('/', 'index')->name('type.register');
        Route::get('/create', 'create')->name('type.create');
        Route::post('/create', 'store')->name('type.save');
        Route::get('/edit/{id}', 'edit')->name('type.edit');
        Route::post('/edit/{id}', 'update')->name('type.update');
        Route::get('/delete/{id}', 'destroy')->name('type.delete');
    });

    Route::prefix('/material')->controller(MaterialController::class)->group(function () {
        Route::get('/', 'index')->name('material.register');
        Route::get('/create', 'create')->name('material.create');
        Route::post('/create', 'store')->name('material.save');
        Route::get('/edit/{id}', 'edit')->name('material.edit');
        Route::post('/edit/{id}', 'update')->name('material.update');
        Route::get('/delete/{id}', 'destroy')->name('material.delete');
    });

    Route::prefix('/coating')->controller(CoatingController::class)->group(function () {
        Route::get('/', 'index')->name('coating.register');
        Route::get('/create', 'create')->name('coating.create');
        Route::post('/create', 'store')->name('coating.save');
        Route::get('/edit/{id}', 'edit')->name('coating.edit');
        Route::post('/edit/{id}', 'update')->name('coating.update');
        Route::get('/delete/{id}', 'destroy')->name('coating.delete');
    });

    Route::prefix('/product')->controller(ProductController::class)->group(function () {
        Route::get('/', 'index')->name('product.register');
        Route::get('/create', 'create')->name('product.create');
        Route::post('/create', 'store')->name('product.save');
        Route::get('/edit/{id}', 'edit')->name('product.edit');
        Route::post('/edit/{id}', 'update')->name('product.update');
        Route::get('/delete/{id}', 'destroy')->name('product.delete');

        Route::get('/new', 'new')->name('product.new');
        Route::post('/new', 'save')->name('product.store');

        Route::get('/track', 'track')->name('product.track');
        Route::post('/track', 'trackFetch')->name('product.track.fetch');

        Route::get('/product/export/excel', 'exportProductExcel')->name('product.export.excel');
        Route::get('/product/export/pdf', 'exportProductPdf')->name('product.export.pdf');

        Route::get('/product/limit/export', 'exportProduct')->name('product.export');
        Route::post('/product/limit/export', 'exportProductFetch')->name('product.export.fetch');
        Route::get('/product/limit/export/excel', 'exportLimitProductExcel')->name('product.limit.export.excel');
        Route::get('/product/limit/export/pdf', 'exportLimitProductPdf')->name('product.limit.export.pdf');
    });

    Route::prefix('/damage')->controller(DamageController::class)->group(function () {
        Route::get('/', 'index')->name('damage.register');
        Route::get('/create', 'create')->name('damage.create');
        Route::post('/save', 'store')->name('damage.save');
        Route::get('/edit/{id}', 'edit')->name('damage.edit');
        Route::post('/update/{id}', 'update')->name('damage.update');
        Route::get('/delete/{id}', 'destroy')->name('damage.delete');
    });

    Route::prefix('/supplier')->controller(SupplierController::class)->group(function () {
        Route::get('/', 'index')->name('supplier.register');
        Route::get('/create', 'create')->name('supplier.create');
        Route::post('/save', 'store')->name('supplier.save');
        Route::get('/edit/{id}', 'edit')->name('supplier.edit');
        Route::post('/update/{id}', 'update')->name('supplier.update');
        Route::get('/delete/{id}', 'destroy')->name('supplier.delete');
    });

    Route::prefix('/purchase')->controller(PurchaseController::class)->group(function () {
        Route::get('/', 'index')->name('purchase.register');
        Route::get('/create', 'create')->name('purchase.create');
        Route::post('/save', 'store')->name('purchase.save');
        Route::get('/edit/{id}', 'edit')->name('purchase.edit');
        Route::post('/update/{id}', 'update')->name('purchase.update');
        Route::get('/delete/{id}', 'destroy')->name('purchase.delete');

        Route::get('/import', 'purchaseImport')->name('purchase.import');
        Route::post('/import', 'purchaseImportUpdate')->name('purchase.import.update');
    });

    Route::prefix('/sales')->controller(SalesController::class)->group(function () {
        Route::get('/', 'index')->name('sales.register');
        Route::post('/', 'create')->name('sales.create');
        Route::post('/save', 'store')->name('sales.save');
        Route::get('/edit/{id}', 'edit')->name('sales.edit');
        Route::post('/update/{id}', 'update')->name('sales.update');
        Route::get('/delete/{id}', 'destroy')->name('sales.delete');
    });
});
