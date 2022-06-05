<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EditionController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\VoiceController;
use App\Models\Edition;
use App\Models\Favorite;
use App\Models\Platform;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::view('/', 'usersetup');
Route::view('/admin/sub', 'adminsetup');
// Platform
Route::post('/admin/sub/create', [PlatformController::class, 'create']);
Route::get('/admin/sub/read', [PlatformController::class, 'read']);
Route::delete('/admin/sub/delete/{id}', [PlatformController::class, 'delete']);
Route::post('/admin/addgame/restadd/addingPlatform', [PlatformController::class, 'createPlatform']);
Route::get('/admin/addgame/restadd/gettingPlatform/{id}', [PlatformController::class, 'gotPlatform']);
Route::delete('/admin/addgame/restadd/deletePlatform/{id}', [PlatformController::class, 'deletePlatform']);
//Voice
Route::post('/admin/sub/voice/create', [VoiceController::class, 'create']);
Route::get('/admin/sub/voice/read', [VoiceController::class, 'read']);
Route::delete('/admin/sub/voice/delete/{id}', [VoiceController::class, 'delete']);
Route::post('/admin/addgame/restadd/addingVoice', [VoiceController::class, 'createVoice']);
Route::get('/admin/addgame/restadd/gettingVoice/{id}', [VoiceController::class, 'gotVoice']);
Route::delete('/admin/addgame/restadd/deleteVoice/{id}', [VoiceController::class, 'deleteVoice']);
//Edition
Route::post('/admin/sub/edition/create', [EditionController::class, 'create']);
Route::get('/admin/sub/edition/read', [EditionController::class, 'read']);
Route::delete('/admin/sub/edition/delete/{id}', [EditionController::class, 'delete']);
Route::post('/admin/addgame/restadd/addingEdition', [EditionController::class, 'createEdition']);
Route::get('/admin/addgame/restadd/gettingEdition/{id}', [EditionController::class, 'gotEdition']);
Route::delete('/admin/addgame/restadd/deleteEdition/{id}', [EditionController::class, 'deleteEdition']);
// admin auth
Route::get('/admin/login', function () {
    return view('adminsetup');
});
Route::get('/admin/register', function () {
    return view('adminsetup');
});
// dashboard
Route::get('/admin/dashboard', function () {
    return view('adminsetup');
});
Route::get('/admin/addgame', function () {
    return view('adminsetup');
});
// game insert
Route::post('/admin/insertgame', [GameController::class, 'create']);
Route::get('/admin/readgame', [GameController::class, 'read']);
Route::put('/admin/updategame/{id}', [GameController::class, 'update']);
Route::get('/admin/restadd/getbyid/{id}', [GameController::class, 'readById']);
Route::view('/admin/addgame/restadd/{id}', 'adminsetup');
Route::delete('/admin/addgame/deleteItem/{id}', [GameController::class, 'deleteItem']);


//Category
Route::post('/admin/sub/category/create', [CategoryController::class, 'create']);
Route::get('/admin/sub/category/read', [CategoryController::class, 'read']);
Route::delete('/admin/sub/category/delete/{id}', [CategoryController::class, 'delete']);
Route::post('/admin/addgame/restadd/addingCategory', [CategoryController::class, 'createCategory']);
Route::get('/admin/addgame/restadd/gettingCategory/{id}', [CategoryController::class, 'gotCategory']);
Route::delete('/admin/addgame/restadd/deleteCategory/{id}', [CategoryController::class, 'deleteCategory']);
Route::get('/user/index/getCategory/{id}', [CategoryController::class, 'getCategory']);
Route::get('/user/shop/getAllCount/{platform}', [CategoryController::class, 'getAllCountPlatform']);
//Photo
Route::post('/admin/addgame/restadd/addphotos/{id}/{index}', [PhotoController::class, 'create']);
Route::get('/admin/addgame/restadd/getPhotoById/{id}', [PhotoController::class, 'readPhotoById']);
Route::delete('/admin/addgame/restadd/deletePhoto/{id}/{gid}', [PhotoController::class, 'deletePhoto']);

//user 
Route::view('/user/index', 'usersetup');
Route::view('/user/index/info/{id}', 'usersetup');
Route::view('/user/login', 'usersetup');
Route::view('/user/register', 'usersetup');
Route::get('/user/getGamesCategory', [GameController::class, 'getGamesCategory']);
Route::get('/user/getTplatformData', [GameController::class, 'getTplatformData']);
Route::get('/user/information/getPlatformById/{id}', [GameController::class, 'getPlatformById']);
Route::get('/user/shop/getAllProduct/{platform}', [GameController::class, 'getAllProducts']);
Route::get('/user/shop/getAllProducts/{platform}', [GameController::class, 'getManyProducts']);
//whishlist

Route::post('/user/information/addwhistlist', [FavoriteController::class, 'create']);
Route::get("/user/information/isWhistList/{id}/{uid}", [FavoriteController::class, 'getIsWhistList']);
Route::view('/user/whishlist', 'usersetup');
Route::get('/user/whishlist/getwhishlist/{uid}', [FavoriteController::class, 'read']);
Route::delete('/user/whishlist/delete/{id}', [FavoriteController::class, 'delete']);
Route::get('/user/index/getwhishlistcount/{uid}', [FavoriteController::class, 'getWhishlistCount']);
Route::view('/user/shop/{platform}', 'usersetup');
Route::get('/user/shop/getCount/{platform}', [CategoryController::class, 'getAllCount']);

Route::get('/user/shop/getPlatformByGameId/{id}', [PlatformController::class, 'getPlatformByGameId']);
Route::get('/user/shop/{platform}/{current}/{total}', function () {
    return view('usersetup');
});
Route::match(['get', 'post'], '/user/shop/getGamesByCategoryId/{id}', [GameController::class, 'getGamesByCatId']);
Route::get('/user/addtocart', function () {
    return view('usersetup');
});
Route::post('/user/index/addtocart', [CartController::class, 'insert']);
Route::get('/user/addtocart/getCartGames/{id}', [GameController::class, 'getCartGames']);
Route::put('/user/index/updatecart/{id}', [CartController::class, 'updateCart']);
Route::get('/user/information/checkincart/{gid}/{uid}', [CartController::class, 'checkInCart']);
Route::get('/user/index/getcartlistcount/{uid}', [CartController::class, 'getCartlistCount']);
Route::delete('/user/addtocart/deleteCartGame/{id}', [CartController::class, 'deleteCartGame']);
Route::get('/user/index/getDataByUserId/{uid}', [GameController::class, 'getDataByUserId']);
Route::view('/user/myorders', 'usersetup');

//Orders
Route::post('/user/myorders/insert', [OrderController::class, 'insert']);
Route::get('/user/getmyorderlist/{uid}', [OrderController::class, 'readByUserId']);
Route::view('/user/myorderlists', 'usersetup');
Route::get('/admin/order/getPendingOrders', [OrderController::class, 'getAllPendingOrders']);
Route::put('/admin/order/updateStatus/{oid}', [OrderController::class, 'updateStatus']);
Route::get('/admin/dashboard/getusers', [AuthController::class, 'getAllUsers']);
