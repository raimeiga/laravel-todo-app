<!-- ToDoの削除用モーダル index.blade.php内のatマークinclude('modals.delete_todo') で呼び出す-->

<div class="modal fade" id="deleteTodoModal{{ $todo->id }}" tabindex="-1" aria-labelledby="deleteTodoModalLabel{{ $todo->id }}">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="deleteTodoModalLabel{{ $todo->id }}">「{{ $todo->content }}」を削除してもよろしいですか？</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
             </div>
             <div class="modal-footer">
                            <!--↓ routeヘルパーの第2引数には、Todoコントローラのupdate、destroyアクションに
                                ↓ 渡すTodoモデルのインスタンス2つ（$goalと$todo）を記述 -->
                 <form action="{{ route('goals.todos.destroy', [$goal, $todo]) }}" method="post">
                     @csrf
                     @method('delete')
                     <button type="submit" class="btn btn-danger">削除</button>
                 </form>
             </div>
         </div>
     </div>
 </div> 