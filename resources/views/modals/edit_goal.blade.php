<!-- 目標の編集モーダル -->
<div class="modal fade" id="editGoalModal{{ $goal->id }}" tabindex="-1" aria-labelledby="editGoalModalLabel{{ $goal->id }}">
                                                    <!-- ↑ id属性の値の重複を避けるために$goal->id を記述 ↑ -->
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="editGoalModalLabel{{ $goal->id }}">目標の編集</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
             </div>
             <form action="{{ route('goals.update', $goal) }}" method="post">
                 @csrf
                  @method('patch')  <!--HTMLのフォームでサポートされているHTTPリクエストメソッドはGETとPOSTのみなので、フォームで
                                    PUT、PATCH、DELETEメソッドを使いたい場合、atマークmethodでPUT、PATCH、DELETEのいずれかを指定-->                                                   
                 <div class="modal-body">
                     <input type="text" class="form-control" name="title" value="{{ $goal->title }}">
                 </div>                                                          <!-- ↑ id属性の値の重複を避けるために$goal->id を記述  -->
                 <div class="modal-footer">
                     <button type="submit" class="btn btn-primary">更新</button>
                 </div>   
             </form>             
         </div>
     </div>
 </div>