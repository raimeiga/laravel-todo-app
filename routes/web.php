<!-- ルーティングのファイル -->
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoalController;

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

/*↓ルーティング設定のファイルなので、
   アクセスするURL、その際に実行されるコントローラのアクションを記述
   アクセスするURLは、localhost/laravel-todo-app/public の次にくるパス名を決定し、記述。
   このURLにアクセスしたときは〇〇コントローラの□□アクションを実行する、と設定される
   ↓だったらlocalhost/laravel-todo-app/public/ を指定している（publicの後に「/」を設定している）*/
Route::get('/', [GoalController::class, 'index']);

Auth::routes();

// ↓ localhost/laravel-todo-app/public/home を指定している。
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('goals', GoalController::class)->only(['index', 'store', 'update', 'destroy']);
/* ↑ edit_goal.blade.phpとdelete_goal.blade.phpのform情報がrouteヘルパーで各々の$goalインスタンスとともに飛んできて、   
     GoalControllerのupdateとdestroyアクションに、それぞれ$goalsインスタンスとともに渡される
*/