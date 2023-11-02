<!-- ルーティングのファイル -->
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TagController;

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
Route::get('/', [GoalController::class, 'index'])->middleware('auth');
                  /* middleware()メソッド＝引数として渡すエイリアス（別名、あだ名）により、その前処理の内容を決定
                     auth＝ユーザーがログイン済みであることを確認するエイリアス。（laravel基礎「28.3 認可の実装方法」に詳細）                     
　　　　　　　　　　　middlewareとその引数に'auth'を追記しないと、コントローラでuserが読み込まれずエラーになる
　　　　　　　　　　　追記しておけば、未ログインの場合、デフォルトではログインページ（/login）にリダイレクトされる。
                  */
Auth::routes();
/* ↑「Auth::routes……」を記述するだけで、アカウント作成やログイン、ログアウト、パスワードなど、認証機能用のルーティングを一括で設定できる
     Bootstrapのインストール時に--authオプションをつけて、認証機能用の各種ファイルと同時にインストールしたもの
*/

// ↓ localhost/laravel-todo-app/public/home を指定している。
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('goals', GoalController::class)->only(['index', 'store', 'update', 'destroy'])->middleware('auth');
/* ↑ edit_goal.blade.phpとdelete_goal.blade.phpのform情報がrouteヘルパーで各々の$goalインスタンスとともに飛んできて、   
     GoalControllerのupdateとdestroyアクションに、それぞれ$goalsインスタンスとともに渡される
*/

Route::resource('goals.todos', TodoController::class)->only(['store', 'update', 'destroy'])->middleware('auth');


Route::resource('tags', TagController::class)->only(['store', 'update', 'destroy'])->middleware('auth');

