<!-- タグの編集用モーダル -->
<div class="modal fade" id="editTagModal" tabindex="-1" aria-labelledby="editTagModalLabel">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="editTagModalLabel">タグの編集</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
             </div>
             <form action="" method="post" name="editTagForm">
                 @csrf
                 @method('patch')  <!--　atマークmethod=（ ）内にGETとPOST以外のHTTPリクエストメソッド(今回はpatch=修正・更新）が使えるようになる -->
                 <div class="modal-body">
                     <input type="text" class="form-control" name="name" value="">
                 </div>
                 <div class="modal-footer">
                     <button type="submit" class="btn btn-primary">更新</button>
                 </div>   
             </form>             
         </div>
     </div>
 </div>