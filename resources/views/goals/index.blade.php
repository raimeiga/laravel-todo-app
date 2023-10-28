@extends('layouts.app')
 
 @section('content')
     <div class="container h-100"> 
          <!-- ↓ バリデーションに引っかかった場合のエラーメッセージを表示 -->
          @if ($errors->any()) 
             <div class="alert alert-danger">
                 <ul>
                     @foreach ($errors->all() as $error)
                         <li>{{ $error }}</li>
                     @endforeach
                 </ul>
             </div>
         @endif
 
         <!-- 目標の追加用モーダル -->
         @include('modals.add_goal')  
 
         <!-- ↓ data-bs-toggle属性やdata-bs-target属性はBootstrapでモーダルなどを実装するときのお作法 
                モーダルを実装するときはdata-bs-toggle属性に"modal"を指定　
        　　　　 data-bs-target属性に"#addGoalModal"と指定すると、そのリンクをクリックしたときにaddGoalModalというidを持つモーダルが呼び出され
            -->
         <div class="d-flex mb-3">
             <a href="#" class="link-dark text-decoration-none" data-bs-toggle="modal" data-bs-target="#addGoalModal">
                 <div class="d-flex align-items-center">
                     <span class="fs-5 fw-bold">＋</span>&nbsp;目標の追加
                 </div>
             </a>          
         </div>                                              
     </div>
 @endsection