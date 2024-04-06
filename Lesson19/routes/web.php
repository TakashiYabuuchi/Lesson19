<?php

use Illuminate\Support\Facades\Route;

// use宣言追加（PostsController）
use App\Http\Controllers\PostsController;

// use宣言追加（ProfilesController）
use App\Http\Controllers\ProfilesController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// PostsController
// アクセス時のルーティング
Route::get('/',[PostsController::class,'index']);

// index（投稿一覧画面表示）へのルーティング
Route::get('index', [PostsController::class,'index']);
Route::post('index', [PostsController::class,'index']);

// createForm（新規投稿画面）へのルーティング
Route::get('/create-form',[PostsController::class,'createForm']);

// create（新規投稿処理）へのルーティング
Route::post('/post/create',[PostsController::class,'create']);

// updateForm（投稿編集画面）へのルーティング
Route::get('/post/{id}/update-form',[PostsController::class,'updateForm']);

// update（投稿編集処理）へのルーティング
Route::post('/post/update',[PostsController::class,'update']);

// delete（投稿削除処理へのルーティング）
Route::post('/post/delete',[PostsController::class,'delete']);


// ProfilesController
// userProfile（ユーザープロファイル画面）へのルーティング
Route::get('/userProfile',[ProfilesController::class,'userProfile']);

// updateProfileForm（ユーザープロファイル編集画面）へのルーティング
Route::get('/updateProfileForm',[ProfilesController::class,'updateProfileForm']);
Route::post('/updateProfileForm',[ProfilesController::class,'updateProfileForm']);

// updateProfile（ユーザープロファイル編集処理）へのルーティング
Route::post('/profile/update',[ProfilesController::class,'updateProfile']);

// userSearch（ユーザー検索画面）へのルーティング
Route::get('/userSearch',[ProfilesController::class,'userSearch']);
Route::post('/userSearch',[ProfilesController::class,'userSearch']);

// memberProfile（他ユーザーのプロフィール画面）へのルーティング
Route::get('/memberProfile/{id}',[ProfilesController::class,'memberProfile']);

// addFollow(フォロー追加処理へのルーティング）
Route::get('/addFollow',[ProfilesController::class,'addFollow']);
Route::post('/addFollow',[ProfilesController::class,'addFollow']);

// removeFollow（フォロー解除処理へのルーティング）
Route::get('/removeFollow',[ProfilesController::class,'removeFollow']);
Route::post('/removeFollow',[ProfilesController::class,'removeFollow']);

// followingList（フォローリスト画面）へのルーティング
Route::get('/followingList',[ProfilesController::class,'followingList']);

// followedList（フォロワーリスト画面）へのルーティング
Route::get('/followedList',[ProfilesController::class,'followedList']);



// 認証機能へのルーティング
Auth::routes();

// registerSuccess（新規登録完了画面）へのルーティング
Route::get('registerSuccess', [PostsController::class,'registerSuccess'])->middleware('web');



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
