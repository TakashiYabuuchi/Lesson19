@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8"'>
  <link rel='stylesheet' href='/css/app.css'>
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- キャッシュ制御 -->
  {{header('Cache-control: no-store','Pragma: no-cache');}}
</head>

<body>
  <div class='container'>
    <!-- <h2 class='page-header'>ユーザー情報更新</h2> -->
    <!-- <div class="collapse navbar-collapse"> -->
    <!-- プロフィールに戻るボタン -->
    <!-- <a class="btn btn-primary" href="/userProfile">プロフィールに戻る</a></td>
    </div> -->

     <button id="show_form">パスワードを変更する</button>
     <button id="hide_form" style = 'display:none'>パスワードを変更しない</button>

    <div class="row mb-3">
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
        <div id="password_form" style = 'display:none'>
        <label for="password" class="col-md-4 col-form-label" id="password_form">新規パスワード（6文字以上12文字まで）(※)</label>
        {!! Form::input('password','newPassword', null, ['class' => 'form-control ed-item', 'placeholder' => '新しいパスワード','id'=>'password_form', 'disabled' => 'true']) !!}
        <label for="password" class="col-md-4 col-form-label" id="password_form">新規パスワード確認(※)</label>
        {!! Form::input('password','newPassword_confirmation', null, ['class' => 'form-control ed-item', 'placeholder' => '新しいパスワード（確認）','id'=>'password_form','disabled' => 'true']) !!}
      </div>
      </div>


      <p>※：入力必須</p>
      <!-- エラーメッセージ表示 -->
      @if(count($errors) > 0)
      <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>
      @endif

      <!-- 提出ボタン -->
      {{Form::submit('登録', ['class'=>'btn btn-primary reg','id'=>'form1'])}}
      {!! Form::close() !!}
    </div>

    <!-- 戻るボタン -->
    <p><button type="button" class="btn btn-primary cancel" onClick="history.back()">戻る</button></p>

    <!-- トップページに戻るボタン -->
    <p><a class="btn btn-primary cancel" href="/index">ホームに戻る</a></p>


    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

    <script type="text/javascript">
     $(function(){
    //「パスワードを変更する」ボタンを押すと、新規パスワードフォーム表示
    $('[id="show_form"]').on("click",function(){
        $('[id="password_form"]').show().prop('disabled',false);
        $('[id="show_form"]').hide();
        $('[id="hide_form"]').show();
      });//
      });

      $(function(){
    //「パスワードを変更しない」ボタンを押すと、新規パスワードフォーム非表示
    $('[id="hide_form"]').on("click",function(){
        $('[id="password_form"]').hide().prop('disabled',true);
        $('[id="show_form"]').show();
        $('[id="hide_form"]').hide();
      });//
      });

    //登録ボタンを押した際に登録ボタンを無効化（連打による二重送信回避）
    $(function(){
	  $('[id="form1"]').click(function(){
		$(this).prop('disabled',true);//ボタン無効化
		$(this).closest('form').submit();//フォーム送信
	  });
    });

    // ブラウザバック時に登録ボタンを無効化（ブラウザバックによる二重送信防止）
    $(document).ready(function () {
    if (window.performance.navigation.type == 2) {
        $('[id="form1"]').prop('disabled',true);
    }
});
    </script>
</body>

</html>
@endsection
