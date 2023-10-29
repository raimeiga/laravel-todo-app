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
         <div class="row row-cols-1 row row-cols-md-2 row-cols-lg-3 g-4">                         
                 @foreach ($goals as $goal)   <!--変数$goalsは、Goalコントローラのindexアクションから渡された「現在ログイン中のユーザーが持つすべての目標」 -->
             
                 <!-- 目標の編集用モーダル -->
                 @include('modals.edit_goal') 
 
                 <!-- 目標の削除用モーダル -->
                 @include('modals.delete_goal')  

                 <!-- ToDoの追加用モーダル -->
                 @include('modals.add_todo')  
 
                 <div class="col">     
                     <div class="card bg-light">
                         <div class="card-body d-flex justify-content-between align-items-center">
                             <h4 class="card-title ms-1 mb-0">{{ $goal->title }}</h4>  <!-- 更新・削除するデータ goalsテーブルのtitleカラム -->
                             <div class="d-flex align-items-center">                                 
                                   <a href="#" class="px-2 fs-5 fw-bold link-dark text-decoration-none" data-bs-toggle="modal" data-bs-target="#addTodoModal{{ $goal->id }}">＋</a>    
                                  <div class="dropdown">
                                     <a href="#" class="dropdown-toggle px-1 fs-5 fw-bold link-dark text-decoration-none menu-icon" id="dropdownGoalMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">︙</a>                                     
                                     <ul class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="dropdownGoalMenuLink">
                                               <!-- 編集・削除リンク（目標の編集用・削除用モーダルを開くためのリンク）
                                                 ↓ data-bs-toggle属性に"modal"を指定すれば、モーダルを実装できる
                                                 ↓ data-bs-target属性に"#addGoalModal"と指定し、リンクをクリックしたときにaddGoalModalというidを持つモーダルが呼び出す -->
                                         <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editGoalModal{{ $goal->id }}">編集</a></li>                                   
                                          <div class="dropdown-divider"></div>                 <!-- ↑ ↓ id属性の値は重複不可なので、末尾に{{ $goal->id }}をつけて区別 -->
                                         <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteGoalModal{{ $goal->id }}">削除</a></li>                                                                                                          
                                     </ul>
                                 </div>
                             </div>
                         </div>
                     </div>                           
                 </div>
             @endforeach                       
         </div>                                                      
     </div>
 @endsection