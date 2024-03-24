@extends('layouts.app')
@section('content')

<!-- トップ画面 -->

<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8"'>
  <link rel='stylesheet' href="{{ asset('/css/app.css') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <div class='container'>
    <!-- app.blade.phpに移動 -->
    <!-- プロフィール画面へのリンク -->
    <!-- フォローリスト/フォロワーリスト -->
    <!-- <div class=text-end>
      <a class="btn btn-info" href="/userProfile">プロフィール</a>
      <a class="btn btn-outline-primary" href="/followingList">フォローリスト</a>
      <a class="btn btn-outline-secondary" href="/followedList">フォロワーリスト</a>
      <a class="btn btn-outline-secondary" href="/login">ログアウト</a>
    </div> -->


    <!-- app.blade.phpに移動 -->
    <!-- <h2 class='page-header'>投稿一覧</h2>
    <div id="search">
      {!! Form::open(['url' => '/index']) !!}
      {!! Form::input('text', 'postSearch', null, ['placeholder' => '投稿検索']) !!} -->
    <!-- 検索ボタン -->
    <!-- <button type="submit" name="search" class="fas fa-search">検索</button>
      {!! Form::close() !!}
    </div> -->

    <!-- 投稿データを表示 -->
    <table class='table table-hover'>
      <!-- <tr>
        <th>名前</th>
        <th>投稿内容</th>
        <th>投稿日時</th>
        <th></th>
        <th></th>
      </tr> -->

      @foreach ($lists as $list)
      <tr class="post-tr">

        <td class="tr-name">{{ $list->user_name }}</td>
        <td class="tr-contents"> {{ $list->contents }}</td>

        <!-- <td class="tr-time">{{ $list->post_updated_at }}</td> -->

        <!-- ログインユーザーが投稿したものに、更新・削除ボタンを表示 -->
        @if($list->user_name==\Auth::user()->name)
        <td class="table-right">
          <div class="tr-time">{{ $list->post_updated_at }}</div>
          <div class="tr-button">
            <!-- 更新ボタン -->
            <a class="btn btn-primary" href="/post/{{$list->id}}/update-form">編集</a>
            <!-- 削除ボタン -->
            {!! Form::open(['url' => '/post/delete']) !!}
            {!! Form::hidden('id', $list->id) !!}
            <button type="submit" class="btn btn-danger" id="delete">削除</button>
            {!! Form::close() !!}
          </div>
        </td>

        <!-- 更新ボタン -->
        <!-- <td class="tr-button">
          <a class="btn btn-primary" href="/post/{{$list->id}}/update-form">編集</a>
        </td> -->
        <!-- 削除ボタン -->
        <!-- <td class="tr-button">
          {!! Form::open(['url' => '/post/delete']) !!}
          {!! Form::hidden('id', $list->id) !!}
          <button type="submit" class="btn btn-danger" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</button>
          {!! Form::close() !!}
        </td> -->

        @else
        <td class="table-right">
          <div class="tr-time">{{ $list->post_updated_at }}</div>
          <div class="tr-buttom"></div>
        </td>
        @endif


      </tr>
      @endforeach
    </table>

    @if ($lists->isEmpty()&&!empty($keyword) && !mb_ereg_match("^(\s|　)+$", $keyword))
    <p>{{ $keyword }}の検索結果は0件です。</p>
    @elseif($lists->isNotEmpty() && !empty($keyword) && !mb_ereg_match("^(\s|　)+$", $keyword))
    <p>{{ $keyword }}の検索結果</p>
    @endif


    <!-- 投稿フォーム画面へのリンク -->
    <p class="pull-right"><a class="btn btn-success plus" href="/create-form">＋</a></p>

  </div>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

  <script type="text/javascript">
  //投稿削除ボタンを押した際に投稿削除ボタンを無効化（連打による二重送信防止）
  $(function(){
	$('[id="delete"]').click(function(){
  if(window.confirm('こちらの投稿を削除してもよろしいでしょうか？')){
  $(this).prop('disabled',true);//ボタン無効化
  $(this).closest('form').submit();//フォーム送信
  } else {
  $(this).prop('disabled',false);//ボタン無効化解除
  return false;// 処理中断
  }
  });
  });
  </script>

</body>

</html>
@endsection
