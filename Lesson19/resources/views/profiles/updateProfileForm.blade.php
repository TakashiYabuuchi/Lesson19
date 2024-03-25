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
    <!-- <h2 class='page-header'>ユーザー情報更新</h2> -->
    <!-- <div class="collapse navbar-collapse"> -->
    <!-- プロフィールに戻るボタン -->
    <!-- <a class="btn btn-primary" href="/userProfile">プロフィールに戻る</a></td>
    </div> -->

    <!-- 新規パスワードフォーム表示/非表示ボタン -->
    @if(empty($password_form))
    {{Form::hidden('passwordForm',1, ['form' => 'form2'])}}
    {{Form::submit('パスワードを変更する',['form' => 'form2'])}}
    @else
    {{Form::hidden('passwordForm',null, ['form' => 'form2'])}}
    {{Form::submit('パスワードを変更しない',['form' => 'form2'])}}
    @endif

    <div class="row mb-3">
    {!! Form::open(['url' => '/updateProfileForm', 'method' => 'post', 'id' => 'form2']) !!}
    {!! Form::close() !!}

      {!! Form::open(['url' => '/profile/update' , 'method' => 'POST', 'enctype' => 'multipart/form-data' , 'file' => 'true']) !!}
      <div class="form-group col-md-12">
        <label for="text" class="col-md-4 col-form-label ">名前（12文字まで） (※)</label>
        {!! Form::input('text', 'upName', \Auth::user()->name, ['class' => 'form-control ed-item', 'placeholder' => '名前' ]) !!}
        <label for="text" class="col-md-4 col-form-label">自己紹介（100文字まで）</label>
        {!! Form::input('text', 'upBio', \Auth::user()->bio, ['class' => 'form-control ed-item', 'placeholder' => '自己紹介文']) !!}

        <div class="ed-icon">
          <label for="file" class="col-md-4 col-form-label">アイコン
            （アップロード可能：.jpg , .jpeg , .png 1024KBまで）
          </label>
          <img src="{{asset('/storage/'.\Auth::user()->image_path)}}" alt="" width="30" height="20">

          <div class="dl-icon">
            <!-- 設定しているアイコンがデフォルトではない場合、「アイコンをデフォルトに戻す」チェックボックスを表示 -->
            @if(\Auth::user()->image_path!="default.png")
            <p class="dl-icon">アイコンをデフォルトに戻す</p>{{Form::checkbox('deleteIcon', '1', false,['class'=>''])}}
            @endif
          </div>
        </div>

        {!! Form::input('file', 'upIcon', null, ['class' => 'form-control ed-item', 'placeholder' => 'アイコン','accept' => '.jpg,.jpeg,.png']) !!}

        <label for="password" class="col-md-4 col-form-label">パスワード (※)</label>
        {!! Form::input('password','upPassword', null, ['class' => 'form-control ed-item', 'placeholder' => '現在のパスワード']) !!}

        <!-- 「パスワードを変更する」ボタンが押されている場合、新規パスワード入力フォームと確認フォームが表示される -->
        @if(!empty($password_form))
        <label for="password" class="col-md-4 col-form-label">新規パスワード（6文字以上12文字まで）(※)</label>
        {!! Form::input('password','newPassword', null, ['class' => 'form-control ed-item', 'placeholder' => '新しいパスワード']) !!}
        <label for="password" class="col-md-4 col-form-label">新規パスワード確認(※)</label>
        {!! Form::input('password','newPassword_confirmation', null, ['class' => 'form-control ed-item', 'placeholder' => '新しいパスワード（確認）']) !!}
        @endif

      </div>
      <p>※：入力必須</p>
      <!-- エラーメッセージ表示 -->
      @if ($errors->first())
      <p class="validation">{{$errors->first()}}</p>
      @endif

      <!-- 提出ボタン -->
      {{Form::submit('登録', ['class'=>'btn btn-primary reg','id'=>'form1'])}}
      {!! Form::close() !!}
    </div>

    <!-- 前のページに戻るボタン -->
    <p><button class="btn btn-primary cancel" onClick="history.back();">戻る</button></p>

    <!-- トップページに戻るボタン -->
    <p><a class="btn btn-primary cancel" href="/index">ホームに戻る</a></p>


    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    //登録ボタンを押した際に登録ボタンを無効化（連打による二重送信回避）
    $(function(){
	  $('[id="form1"]').click(function(){
		$(this).prop('disabled',true);//ボタン無効化
		$(this).closest('form').submit();//フォーム送信
	  });
    });
    </script>
</body>

</html>
@endsection
