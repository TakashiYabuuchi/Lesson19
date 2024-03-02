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
<h2 class='page-header'>ユーザー情報更新</h2>
<div class="collapse navbar-collapse">
<!-- プロフィールに戻るボタン -->
<a class="btn btn-primary" href="/userProfile">プロフィールに戻る</a></td>
</div>
<div class="row mb-3">
{!! Form::open(['url' => '/profile/update' , 'method' => 'POST', 'enctype' => 'multipart/form-data' , 'file' => 'true']) !!}
<div class="form-group col-md-6">
<label for="text" class="col-md-4 col-form-label">名前※</label>
{!! Form::input('text', 'upName', \Auth::user()->name, ['class' => 'form-control', 'placeholder' => '名前']) !!}
<label for="text" class="col-md-4 col-form-label">自己紹介文</label>
{!! Form::input('text', 'upBio', \Auth::user()->bio, ['class' => 'form-control', 'placeholder' => '自己紹介文']) !!}
<label for="file" class="col-md-4 col-form-label">アイコン</label>（アップロード可能：.jpg,.jpeg,.png）
<img src="{{asset('/storage/'.\Auth::user()->image_path)}}" alt="" width="30" height="20">
<!-- 設定しているアイコンがデフォルトではない場合、「アイコンを消去する」チェックボックスを表示 -->
@if(\Auth::user()->image_path!="default.png")
<p>アイコンを消去する{{Form::checkbox('deleteIcon', '1', false)}}</p>
@endif
{!! Form::input('file', 'upIcon', null, ['class' => 'form-control', 'placeholder' => 'アイコン','accept' => '.jpg,.jpeg,.png']) !!}
<label for="password" class="col-md-4 col-form-label">現在のパスワード※</label>
{!! Form::input('password','upPassword', null, ['class' => 'form-control', 'placeholder' => '現在のパスワード']) !!}
<label for="password" class="col-md-4 col-form-label">新規パスワード</label>
{!! Form::input('password','newPassword', null, ['class' => 'form-control', 'placeholder' => '新しいパスワード']) !!}
<label for="password" class="col-md-4 col-form-label">新規パスワード（確認）</label>
{!! Form::input('password','newPassword_confirmation', null, ['class' => 'form-control', 'placeholder' => '新しいパスワード（確認）']) !!}

</div>
<p>※：入力必須</p>
<!-- エラーメッセージ表示 -->
@if ($errors->first())
<p class="validation">{{$errors->first()}}</p>
@endif

<!-- 提出ボタン -->
<button type="submit" class="btn btn-success pull-right">登録</button>
{!! Form::close() !!}
</div>

<!-- 前のページに戻るボタン -->
<p><button class="btn btn-primary" onClick="history.back();">戻る</button></p>
<!-- トップページに戻るボタン -->
<p><a class="btn btn-primary" href="/index">トップページに戻る</a></p>


<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
@endsection
