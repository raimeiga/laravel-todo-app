<!-- このファイルはトップページ（親ビュー）
このファイルを親ビューとして「!DOCTYPE html」から始まる全体のコードを書き、
main要素などページごとに異なるコードのみを子ビュー（index.blade.phpなど）に書く

（認証機能ログインのページ ）
このファイルは、Laravel UIとBootstrapをインストールし、認証機能作成と同時にインストールしたもの
詳細は「LaravelでToDoアプリを作ろう」3.4 Bootstrapと認証機能用の各種ファイルをインストール 
-->

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" > -->
    @stack('styles') 
    <!-- ← 子ビュー（index.blade.php)のatマークpush('styles')とコンビ
     このファイル（親ビュー）の下に、多くのファイル（子ビュー）が存在するため、stackの1行上のlinkでcssが全てのファイルに反映されるが、
     style.cssに記述したスタイルやscript.jsに記述したイベント処理は、トップページ以外（アカウント作成ページやログインページなど）では使わない。
     なので、トップページ（index.blade.php＝トップ画面のメイン部分を切り出したファイル)のみに、linkの1行を反映させたい。
     そこで、linkの1行の代わりに、atマークstack('styles')を記し、index.blade.phpのはじめのほうに、linkの1行を記し、atマークpush～endpushで囲む。
    -->
</head>

<body style="padding: 60px 0;">
    <div id="app">
        <!--↓ atマークinclude＝他のビューファイルを呼び出すディレクティブ。
              引数には［フォルダ名+ファイル名の省略形］を書く -->
        @include('layouts.header')  <!--部品化したヘッダーを呼びだす -->
            <main class="py-4">
              @yield('content')     <!--main部分は、このトップページのファイルの可読性向上のため、index.blade.php
                                        のatマークsection('content')～atマークendsectionに記述-->
            </main>
        @include('layouts.footer')  <!--部品化したフッターを呼びだす -->
    </div>

    <!-- <script src="{{ asset('/js/script.js') }}"></script> -->
    @stack('scripts') 
    <!-- ← 子ビュー（index.blade.php)のatマークpush('scripts')とコンビ
     このファイル（親ビュー）の下に、多くのファイル（子ビュー）が存在するため、stackの1行上のlinkでscriptsが全てのファイルに反映されるが、
     style.cssに記述したスタイルやscript.jsに記述したイベント処理は、トップページ以外（アカウント作成ページやログインページなど）では使わない。
     なので、トップページ（index.blade.php＝トップ画面のメイン部分を切り出したファイル)のみに、linkの1行を反映させたい。
     そこで、linkの1行の代わりに、atマークstack('scripts')を記し、index.blade.phpのはじめのほうに、linkの1行を記し、atマークpush～endpushで囲む。
    -->
</body>
</html>
