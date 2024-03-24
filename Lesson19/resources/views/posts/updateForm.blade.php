<!-- 投稿編集画面 -->
@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8"'>
  <link rel='stylesheet' href='/css/app.css'>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <div class='container'>

    <!-- 投稿編集フォーム -->
    <h2 class='page-header'>Contents</h2>
    {!! Form::open(['url' => '/post/update']) !!}
    <div class="form-group">
      {!! Form::hidden('id', $post->id) !!}
      {!! Form::input('text', 'upPost', $post->contents, ['required', 'class' => 'form-control']) !!}
    </div>

    <!-- エラーメッセージ表示 -->
    @if ($errors->first())
    <p class="validation">{{$errors->first()}}</p>
    @endif

    <!-- 提出ボタン -->
    {{Form::submit('更新する', ['class'=>'btn btn-primary pull-right add'])}}
    {!! Form::close() !!}

    <!-- 前のページに戻るボタン -->
    <!-- <p><button class="btn btn-primary" onClick="history.back();">戻る</button></p> -->

    <!-- トップページに戻るボタン -->
    <p><a class="btn btn-primary cancel2" href="/index">キャンセル</a></p>
  </div>

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

  <script type="text/javascript">
  //更新ボタンを押した際に更新ボタンを無効化（連打による二重送信防止）
  $(function(){
	$('[type="submit"]').click(function(){
	$(this).prop('disabled',true);//ボタン無効化
	$(this).closest('form').submit();//フォーム送信
	});
  });
  </script>
</body>

</html>
@endsection
