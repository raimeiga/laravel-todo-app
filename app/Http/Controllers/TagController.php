<?php

namespace App\Http\Controllers;

use App\Models\Tag;
/* ↑ AppフォルダのModelsフォルダのTag.php（モデルのファイル）を使うよ!と宣言
     宣言することで、このファイル内でGoalと記述するだけでGoalクラスを呼び出せるようになる
*/
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/* ↑ Authファサードを利用することで、現在ログイン中のユーザーを取得
     Authファサードは、クラスをインスタンス化しなくても、↓にAuth::id()を
     記述することで、現在ログイン中のユーザーIDを取得
*/

class TagController extends Controller
{
      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $tag = new Tag();
        $tag->name = $request->input('name');
        $tag->user_id = Auth::id();  // ← 現在ログイン中のユーザーのIDをuser_idカラムに代入
        $tag->save();

        return redirect()->route('goals.index');       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $tag->name = $request->input('name');
        $tag->user_id = Auth::id();
        $tag->save();

        return redirect()->route('goals.index');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
 
         return redirect()->route('goals.index');  
    }
}
