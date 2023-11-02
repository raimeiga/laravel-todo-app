<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  
/* ↑ Authファサードを利用することで、「現在ログイン中のユーザー」を取得
     Authファサードは、クラスをインスタンス化しなくても、Auth::user()を記述することで、
     現在ログイン中のユーザー（Userモデルのインスタンス）を取得できる。
*/
class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //トップ画面のmain部分(データの一覧ページ)を表示するためのアクション
    public function index() 
    {  
        $goals = Auth::user()->goals;  /* ←現在ログイン中のユーザーが持つ目標をすべて取得　 ↑（上の方）にAuthファサードの使用宣言をしているため。
                                           ログアウト状態では、user（現在ログイン中のユーザー）が取得できずにnullとなり、エラーがでるので、
                                           ルーティングファイルに ->middleware('auth');を追記してエラーを防ぐ
                                       */
        $tags = Auth::user()->tags;
        return view('goals.index', compact('goals', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //「+目標の追加」を押した後に開く「目標の追加」モーダルに入力された目標を登録するアクション
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $goal = new Goal();
        $goal->title = $request->input('title');
        $goal->user_id = Auth::id();
        $goal->save();

        return redirect()->route('goals.index');  
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */

    // ↓ 目標の右側「︙」マーク⇒「編集」クリック後に開く「目標の編集」モーダルに表示された目標を更新するアクション
    
    public function update(Request $request, Goal $goal)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $goal->title = $request->input('title');
        $goal->user_id = Auth::id();
        $goal->save();

        return redirect()->route('goals.index');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goal $goal)
    {
        $goal->delete();
 
        return redirect()->route('goals.index'); 
    }
}
