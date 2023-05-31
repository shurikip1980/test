<?php

use App\Http\Controllers\Api\V1\ArticleController;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\CabinetController;
use App\Http\Controllers\Api\V1\CartController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\DeliveryController;
use App\Http\Controllers\Api\V1\IconController;
use App\Http\Controllers\Api\V1\LanguageController;
use App\Http\Controllers\Api\V1\NewController;
use App\Http\Controllers\Api\V1\PageController;
use App\Http\Controllers\Api\V1\PaymentController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\SearchController;
use App\Http\Controllers\Api\V1\SettingController;
use App\Http\Controllers\Api\V1\SliderController;
use App\Http\Controllers\Api\V1\StockController;
use App\Http\Controllers\Api\V1\TranslateController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('/user', [UserController::class, 'show']);

    Route::prefix('cabinet')->group(function () {
        Route::get('/user/{id}', [CabinetController::class, 'index']);
        Route::post('/user', [CabinetController::class, 'update']);
    });
});

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::prefix('settings')->group(function () {
    Route::get('/', [SettingController::class, 'index']);
});

Route::prefix('search')->group(function () {
    Route::get('/', [SearchController::class, 'search']);
});

Route::prefix('languages')->group(function () {
    Route::get('/', [LanguageController::class, 'index']);
});

Route::prefix('icons')->group(function () {
    Route::get('/', [IconController::class, 'index']);
});

Route::prefix('pages')->group(function () {
    Route::get('/', [PageController::class, 'index']);
    Route::get('/home/', [PageController::class, 'home']);
    Route::get('/{slug}', [PageController::class, 'show']);
});

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/home/', [CategoryController::class, 'home']);
    Route::get('/{id}/homeProducts/', [CategoryController::class, 'homeProducts']);
    Route::get('/{id}/features/', [CategoryController::class, 'features']);
    Route::get('/{slug}', [CategoryController::class, 'show']);
});

Route::prefix('sliders')->group(function () {
    Route::get('/', [SliderController::class, 'index']);
});

Route::prefix('stocks')->group(function () {
    Route::get('/', [StockController::class, 'index']);
    Route::get('/home/', [StockController::class, 'home']);
    Route::get('/{slug}', [StockController::class, 'show']);
});

Route::prefix('news')->group(function () {
    Route::get('/', [NewController::class, 'index']);
    Route::get('/home/', [NewController::class, 'home']);
    Route::get('/{slug}', [NewController::class, 'show']);
});

Route::prefix('articles')->group(function () {
    Route::get('/', [ArticleController::class, 'index']);
    Route::get('/home/', [ArticleController::class, 'home']);
    Route::get('/{slug}', [ArticleController::class, 'show']);
});

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/{id}/comment', [ProductController::class, 'comment']);
    Route::get('/{slug}', [ProductController::class, 'show']);
});

Route::prefix('cart')->group(function () {
    Route::post('/', [CartController::class, 'index']);
    Route::post('/add', [CartController::class, 'addOrder']);
});

Route::prefix('deliveries')->group(function () {
    Route::get('/', [DeliveryController::class, 'index']);
});

Route::prefix('payments')->group(function () {
    Route::get('/', [PaymentController::class, 'index']);
});

Route::prefix('translate')->group(function () {
    Route::get('/', [TranslateController::class, 'index']);
});
