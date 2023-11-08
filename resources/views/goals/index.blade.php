<!-- このファイルはapp.blade.php（親ビュー）内の@yield('content')の部分を記述する子ビュー -->

@extends('layouts.app') <!--　↓　atマークsection(ディレクティブ)とコンビで使用 -->   


<!-- add.blade.php（親ビュー）のstack('styles')とつながっている -->
 @push('styles')
     <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
 @endpush
 
 <!-- add.blade.php（親ビュー）のstack('scripts')とつながっている -->
 @push('scripts')
     <script src="{{ asset('/js/script.js') }}"></script>
 @endpush

 <!-- 親ビュー（layouts/app.blade.php)のatマーク「yield('content')」の部分の具体化（こちらのファイルに切り出し）
 　　　コードのトップのatマークextendsというディレクティブを使ってベースとなる親ビューを指定している -->
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
 
         <!-- 目標の追加用モーダル 　　-->
         @include('modals.add_goal')  
            <!-- ↑↓atマークinclude＝他のビューファイルを呼び出すディレクティブ。引数には［フォルダ名+ファイル名の省略形］ -->
         <!-- タグの追加用モーダル -->
         @include('modals.add_tag')
 
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
             <a href="#" class="ms-4 link-dark text-decoration-none" data-bs-toggle="modal" data-bs-target="#addTagModal">
                 <div class="d-flex align-items-center">
                     <span class="fs-5 fw-bold">＋</span>&nbsp;タグの追加
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
                                   <!-- ↓ ToDoの追加ボタン　クリックするとモーダルが開く -->
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
                         @foreach ($goal->todos()->orderBy('done', 'asc')->get() as $todo) 
                             <!-- ToDoの編集用モーダル -->
                             @include('modals.edit_todo')
 
                             <!-- ToDoの削除用モーダル -->
                             @include('modals.delete_todo')
 
                             <div class="card mx-2 mb-2">
                                 <div class="card-body">
                                     <div class="d-flex justify-content-between align-items-center mb-2">
                                     <h5 class="card-title ms-1 mb-0">
                                             @if ($todo->done)                <!-- 条件：doneにtrue（完了）が入った場合（↓数行下のform actionからルートにtrueが送られた）場合 -->
                                                 <s>{{ $todo->content }}</s>  <!-- 結果：sタグを使ってToDoの内容に打ち消し線を引いて表示する -->
                                             @else                            <!-- 条件：doneにfalse（未完了）が入った場合（↓数行下のform actionからルートにtrueが送られた）場合-->
                                                 {{ $todo->content }}         <!-- 結果：ToDoの内容をそのまま表示する -->
                                             @endif
                                         </h5>      
                                         <div class="dropdown">
                                             <a href="#" class="dropdown-toggle px-1 fs-5 fw-bold link-dark text-decoration-none menu-icon" id="dropdownTodoMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">︙</a>
                                             <ul class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="dropdownTodoMenuLink">                                                                                                                                                                                       
                                                <li>  
                                                     <form action="{{ route('goals.todos.update', [$goal, $todo]) }}" method="post">
                                                         @csrf
                                                         @method('patch') 
                                                         <input type="hidden" name="content" value="{{ $todo->content }}">
                                                           <!-- form actionから「route('goals.todos.update…」ルートに"true"か"false"が送られ、TodoController.phpのupdateアクションに引数が渡される。
                                                          「完了」「未完了」ボタン（数行下）のクリックは、update関数内の$todo->doneにtrue.falseを渡すのみで、content内容は未入力なので、update関数内に
                                                           設定したバリデーションにひっかかり、「contentは必ず指定してください。」というメッセがでてしまう。そこで、何らかのcontentを送ることで
                                                           バリデーションを突破したいが、もともとtodo内容が入力・表示されているので、type="hidden"を書くことで、update関数に隠れたcontentがある
                                                           ように認識させる必要がある。一方、todo「編集」を押すと開くToDoの編集用モーダルはtodoのcontentの更新なので、formにinput type="text"
                                                           とあるように、hiddenを書く必要はない。updateアクションで、編集内容と入力・未入力表示の２つの更新をするために必要な措置と考えよう。 
                                                           -->

                                                         @if ($todo->done)  <!-- doneにtrue（完了）が入った場合の2つ（1.2.)の処理↓ -->
                                                             <input type="hidden" name="done" value="false">
                                                             <!-- ↑ 2.未完了ボタン（↓）をクリックしたら、input type="hidden"を使って"false"という値を送信 -->
                                                             <!--   つまりform actionから「route('goals.todos.update…」ルートに"false"が渡るってこと -->
                                                             <button type="submit" class="dropdown-item btn btn-link">未完了</button>
                                                             <!-- ↑ 1.フォームの送信ボタンに「未完了」と表示される -->                                                          

                                                         @else   <!-- doneにfalse（未完了）が入った場合の2つ（1.2.)の処理↓ -->
                                                             <input type="hidden" name="done" value="true">
                                                             <!-- ↑ 2.完了ボタンをクリックしたら、input type="hidden"を使って"true"という値を送信 -->
                                                             <!--   つまりform actionから「route('goals.todos.update…」ルートに"true"が渡る-->
                                                             <button type="submit" class="dropdown-item btn btn-link">完了</button> 
                                                             <!-- ↑ 1.フォームの送信ボタンに「完了」と表示する -->
                                                             
                                                             
                                                         @endif
                                                     </form>                                                       
                                                 </li>              
                                             <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editTodoModal{{ $todo->id }}">編集</a></li>                                                  
                                                 <div class="dropdown-divider"></div>
                                                 <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteTodoModal{{ $todo->id }}">削除</a></li>  
                                             </ul>
                                         </div>
                                     </div>   
                                     <h6 class="card-subtitle ms-1 mb-1 text-muted">{{ $todo->created_at }}</h6>                                                               
                                      <div class="d-flex flex-wrap mx-1 mb-1">
                                         @foreach ($todo->tags()->orderBy('id', 'asc')->get() as $tag)                                    
                                             <span class="badge bg-secondary mt-2 me-2 fw-light">{{ $tag->name }}</span>                                      
                                         @endforeach   
                                      </div>               
                                    </div>                                
                             </div>
                         @endforeach
                     </div>                           
                 </div>
             @endforeach                       
         </div>                                                      
     </div>
 @endsection