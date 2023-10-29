<!-- ToDoの編集用モーダル -->
<div class="modal fade" id="editTodoModal{{ $todo->id }}" tabindex="-1" aria-labelledby="editTodoModalLabel{{ $todo->id }}">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="editTodoModalLabel{{ $todo->id }}">ToDoの編集</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
             </div>
                            <!--↓ routeヘルパーの第2引数には、Todoコントローラのupdate、destroyアクションに
                                ↓渡すTodoモデルのインスタンス2つ（$goalと$todo）を記述 -->
             <form action="{{ route('goals.todos.update', [$goal, $todo]) }}" method="post">
                 @csrf                                   
                 @method('patch')  
                 <div class="modal-body">
                     <input type="text" class="form-control" name="content" value="{{ $todo->content }}">                                         
                 </div>
                 <div class="modal-footer">
                     <button type="submit" class="btn btn-primary">更新</button>
                 </div>
             </form>
         </div>
     </div>
 </div>
