<!-- 新規投稿画面 -->
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

    <!-- 投稿フォーム -->
    <h2 class='page-header'>Contents</h2>
    {!! Form::open(['url' => 'post/create']) !!}
    <div class="form-group">
      {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容']) !!}
    </div>

    <!-- エラーメッセージ表示 -->
    @if ($errors->first())
    <p class="validation">{{$errors->first()}}</p>
    @endif

    <!-- 提出ボタン -->
    {{Form::submit('投稿する', ['class'=>'btn btn-success pull-right add'])}}
    {!! Form::close() !!}


    <!-- トップページに戻るボタン -->
    <p><a class="btn btn-primary cancel2" href="/index">キャンセル</a></p>
  </div>


  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

 <script type="text/javascript">
  //投稿ボタンを押した際に投稿ボタンを無効化（連打による二重送信防止）
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
