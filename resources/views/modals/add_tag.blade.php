<!-- トップページの「＋タグの追加」を押すと開くモーダル -->

<!-- タグの編集用モーダル -->
@include('modals.edit_tag')     
<!-- ↑↓ タグの編集用と削除用モーダルを記述する位置について
        Bootstrapの仕様上、モーダルの中にモーダルを作成できないので、下記↓(コードのまん中くらい）
        にあるatマークforeach ($tags as $tag)～endforeach内には書かず、foreach文の外に書いている 
 -->
<!-- タグの削除用モーダルだよ！ -->
@include('modals.delete_tag')

<div class="modal fade" id="addTagModal" tabindex="-1" aria-labelledby="addTagModalLabel">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="addTagModalLabel">タグの追加</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
             </div>
             <form action="{{ route('tags.store') }}" method="post">
                 @csrf
                 <div class="modal-body">
                     <input type="text" class="form-control" name="name">
                     <div class="d-flex flex-wrap">
                         @foreach ($tags as $tag)
                             <div class="d-flex align-items-center mt-3 me-3">                            
                                 <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editTagModal" data-bs-dismiss="modal" data-tag-id="{{ $tag->id }}" data-tag-name="{{ $tag->name }}">{{ $tag->name }}</button>
                                 <!-- ↑ タグ自体を編集用ボタンにしているので、タグをクリックすると、タグの編集用モーダルが開くよう設定 -->
                                 <button type="button" class="btn-close ms-1" aria-label="削除" data-bs-toggle="modal" data-bs-target="#deleteTagModal" data-bs-dismiss="modal" data-tag-id="{{ $tag->id }}" data-tag-name="{{ $tag->name }}"></button>                                                 
                                 <!-- ↑ 削除をクリックすると「タグの削除用モーダル」delete_tagが開く -->
                                 <!-- ↑ 2つ　Bootstrapの仕様上、モーダルの中にモーダルを作成できないので、foreach文の外（コード上部）に
                                 　「タグの編集用モーダル」edit_tagとタグの削除用モーダル書く。すると、各ループにおけるモデルのインスタンス（今回の場合は$tag）を
                                 　　編集・削除用モーダルで活用できないようになる。なので、button1行にHTMLカスタムデータ属性（data-tag-idとdata-tag-name）を書き、
                                  　 JavaScriptファイルで取得し、そのjavaファイルをapp.blade.phpで読み込む措置をとる
                                 -->
                             </div>
                         @endforeach
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="submit" class="btn btn-primary">登録</button>
                 </div>
             </form>
         </div>
     </div>
 </div>