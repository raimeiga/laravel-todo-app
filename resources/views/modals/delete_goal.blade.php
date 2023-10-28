<!-- 削除モーダルのファイル -->
<div class="modal fade" id="deleteGoalModal{{ $goal->id }}" tabindex="-1" aria-labelledby="deleteGoalModalLabel{{ $goal->id }}">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="deleteGoalModalLabel{{ $goal->id }}">「{{ $goal->title }}」を削除してもよろしいですか？</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
             </div>
             <div class="modal-footer">
                 <form action="{{ route('goals.destroy', $goal) }}" method="post">
                     @csrf   <!-- routeヘルパーの第1引数に名前付きルート（goals.destroy）,第2引数にGoalモデルのインスタンスを渡す -->
                     @method('delete')  <!--HTMLのフォームでサポートされているHTTPリクエストメソッドはGETとPOSTのみなので、フォームで
                                            PUT、PATCH、DELETEメソッドを使いたい場合、atマークmethodでPUT、PATCH、DELETEのいずれかを指定-->                                                  
                     <button type="submit" class="btn btn-danger">削除</button>
                 </form>
             </div>
         </div>
     </div>
 </div>