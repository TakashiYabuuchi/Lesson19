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

    <div class="profile">

      @foreach ($member_profiles as $member_profile)
      <!-- プロフィール左側 -->
      <div class="profile-left">
        <!-- アイコン-->
        <img src="{{asset('/storage/'.$member_profile->image_path)}}" alt="" width="30" height="20">
        <!-- ログインユーザーのプロフィールであれば、プロフィール編集画面へのボタンを表示 -->
        @if($member_profile->id==\Auth::user()->id)
        <a class="btn btn-primary" href="/updateProfileForm">プロフィール編集</a>
        @endif
      </div>

      <!-- プロフィール右側 -->
      <div class="profile-right">
        <table class='table table-hover pf-1'>
          <tr>
            <th>名前</th>
            <th>フォロー</th>
            <th>フォロワー</th>
          </tr>

          <tr>
            <td>{{ $member_profile->name }}</td>
            <td>{{ $number_following }}</td>
            <td>{{ $number_followed }}</td>
          </tr>
        </table>


        <!-- ユーザー自己紹介 -->
        <table class='table table-hover pf-2'>
          <tr class="profile-sen">
            <td>{{ $member_profile->bio }}</td>
          </tr>
        </table>
      </div>
      @endforeach
    </div>

    <h2 class='page-header'>投稿</h2>
    <table class='table table-hover'>

      @foreach ($member_posts as $member_post)
      <tr class="post-tr">
        <!-- 投稿者 -->
        <td class="tr-name">{{ $member_post->user_name }}</td>
        <!-- 投稿内容 -->
        <td class="tr-contents">{{ $member_post->contents }}</td>

        <td class="table-right">
          <!-- 投稿更新日時 -->
          <div class="tr-time">{{ $member_post->post_updated_at }}</div>
          <div class="tr-button">
            <!-- ログインユーザーが投稿したものであれば、更新・削除ボタンを表示 -->
            @if($member_post->user_name==\Auth::user()->name)
            <!-- 更新ボタン -->
            <a class="btn btn-primary" href="/post/{{$member_post->id}}/update-form">更新</a>
            <!-- 削除ボタン -->
            {!! Form::open(['url' => '/post/delete']) !!}
            {!! Form::hidden('id', $member_post->id) !!}
            <button type="submit" class="btn btn-danger" id="delete">削除</button>
            {!! Form::close() !!}
          </div>
          @else
        <td></td>
        <td></td>
        @endif
        </td>
      </tr>
      @endforeach
    </table>


    <!-- ログインユーザーのプロフィールであれば、ユーザー検索画面へのボタンを表示 -->
    @if($member_profile->id==\Auth::user()->id)
    <!-- ユーザー検索画面ボタン -->
    <p><a class="btn btn-primary cancel" href="/userSearch">戻る</a></p>
    @else
    <!-- ユーザー検索画面に戻るボタン -->
    <p><button class="btn btn-primary cancel" onClick="history.back();">戻る</button></p>
    @endif
    <!-- トップページに戻るボタン -->
    <p><a class="btn btn-primary cancel" href="/index">ホームに戻る</a></p>
  </div>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

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
