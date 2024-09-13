<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ApparelController;
use App\Http\Controllers\ApparelTypeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\StyleController;



Route::get('/', function () {
    return view('index');
});

//accounts
Route::get('/accounts', [AccountController::class, 'index'])->name('accounts.index');

Route::get('/accounts/create', [AccountController::class, 'create'])->name('accounts.create');

Route::post('/accounts', [AccountController::class, 'store'])->name('accounts.store');

Route::get('/accounts/{account}/edit', [AccountController::class, 'edit'])->name('accounts.edit');

Route::put('/accounts/{account}', [AccountController::class, 'update'])->name('accounts.update');

Route::delete('/accounts/{account}', [AccountController::class, 'destroy'])->name('accounts.destroy');

//brands
Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');

Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create');

Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');

Route::get('/brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');

Route::put('/brands/{brand}', [BrandController::class, 'update'])->name('brands.update');

Route::delete('/brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');

//styles
Route::get('/styles', [StyleController::class, 'index'])->name('styles.index');

Route::get('/styles/create', [StyleController::class, 'create'])->name('styles.create');

Route::post('/styles', [StyleController::class, 'store'])->name('styles.store');

Route::get('/styles/{style}/edit', [StyleController::class, 'edit'])->name('styles.edit');

Route::put('/styles/{style}', [StyleController::class, 'update'])->name('styles.update');

Route::delete('/styles/{style}', [StyleController::class, 'destroy'])->name('styles.destroy');

//apparel-types
Route::get('/apparel-types', [ApparelTypeController::class, 'index'])->name('apparel-types.index');

Route::get('/apparel-types/create', [ApparelTypeController::class, 'create'])->name('apparel-types.create');

Route::post('/apparel-types', [ApparelTypeController::class, 'store'])->name('apparel-types.store');

Route::get('/apparel-types/{apparelType}/edit', [ApparelTypeController::class, 'edit'])->name('apparel-types.edit');

Route::put('/apparel-types/{apparelType}', [ApparelTypeController::class, 'update'])->name('apparel-types.update');

Route::delete('/apparel-types/{apparelType}', [ApparelTypeController::class, 'destroy'])->name('apparel-types.destroy');

//categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');

Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');

Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');

Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::get('/categories/{in_out}', [CategoryController::class, 'getCategoriesInOut']);

//budgets
Route::get('/budgets', [BudgetController::class, 'index'])->name('budgets.index');

Route::get('/budgets/create', [BudgetController::class, 'create'])->name('budgets.create');

Route::post('/budgets', [BudgetController::class, 'store'])->name('budgets.store');

Route::get('/budgets/{budget}/edit', [BudgetController::class, 'edit'])->name('budgets.edit');

Route::put('/budgets/{budget}', [BudgetController::class, 'update'])->name('budgets.update');

Route::delete('/budgets/{budget}', [BudgetController::class, 'destroy'])->name('budgets.destroy');

Route::get('/budgets/{budget}/delete-attachment', [BudgetController::class, 'deleteAttachment'])->name('budgets.deleteAttachment');

Route::get('/budgets/analytics/category', [BudgetController::class, 'analyticsByCategory'])->name('budgets.analytics-category');

Route::get('/budgets/analytics/account', [BudgetController::class, 'analyticsByAccount'])->name('budgets.analytics-account');

//events
Route::get('/events', [EventController::class, 'index'])->name('events.index');

Route::get('/events/create', [EventController::class, 'create'])->name('events.create');

Route::post('/events', [EventController::class, 'store'])->name('events.store');

Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');

Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');

Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

Route::get('/events/{event}/delete-attachment', [EventController::class, 'deleteAttachment'])->name('events.deleteAttachment');

Route::get('/events/analytics/timeframe', [EventController::class, 'analyticsByTimeframe'])->name('budgets.analytics-timeframe');

//apparels
Route::get('/apparels', [ApparelController::class, 'index'])->name('apparels.index');

Route::get('/apparels/create', [ApparelController::class, 'create'])->name('apparels.create');

Route::post('/apparels', [ApparelController::class, 'store'])->name('apparels.store');

Route::get('/apparels/{apparel}/edit', [ApparelController::class, 'edit'])->name('apparels.edit');

Route::put('/apparels/{apparel}', [ApparelController::class, 'update'])->name('apparels.update');

Route::delete('/apparels/{apparel}', [ApparelController::class, 'destroy'])->name('apparels.destroy');

Route::get('/apparels/{apparel}/delete-attachment', [ApparelController::class, 'deleteAttachment'])->name('apparels.deleteAttachment');

Route::get('/apparels/analytics/type', [ApparelController::class, 'analyticsByType'])->name('apparels.analytics-type');

Route::get('/apparels/analytics/style', [ApparelController::class, 'analyticsByStyle'])->name('apparels.analytics-style');

Route::get('/apparels/analytics/brand', [ApparelController::class, 'analyticsByBrand'])->name('apparels.analytics-brand');

Route::get('/apparels/analytics/type/timeframe', [ApparelController::class, 'analyticsByTypeTimeframe'])->name('apparels.analytics-typeTimeframe');

Route::get('/apparels/analytics/style/timeframe', [ApparelController::class, 'analyticsByStyleTimeframe'])->name('apparels.analytics-styleTimeframe');

Route::get('/apparels/analytics/brand/timeframe', [ApparelController::class, 'analyticsByBrandTimeframe'])->name('apparels.analytics-brandTimeframe');



