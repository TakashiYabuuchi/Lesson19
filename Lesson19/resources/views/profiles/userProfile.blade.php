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
    <!-- <h2 class='page-header'>ユーザープロフィール</h2> -->

    <div class="profile">
      <!-- アイコンとプロフィール編集画面ボタン -->
      <div class="profile-left">
        <img src="{{asset('/storage/'.\Auth::user()->image_path)}}" alt="" width="30" height="20">
        <a class="btn btn-primary" href="/updateProfileForm">プロフィール編集</a>
      </div>

      <!-- 右側にフォローや自己紹介を並べる -->
      <div class="profile-right">
        <!-- フォロー数・フォロワー数を表示 -->
        <table class='table table-hover pf-1'>
          <tr>
            <th>名前</th>
            <th>フォロー</th>
            <th>フォロワー</th>
          </tr>

          <tr>
            <td>{{ \Auth::user()->name }}</td>
            <td><a href="/followingList">{{ $number_following }}</a></td>
            <td><a href="/followedList">{{ $number_followed }}<a></a></td>
          </tr>
        </table>

        <!-- ユーザーの自己紹介を表示 -->
        <table class='table table-hover pf-2'>
          <!-- <tr>
            <th>自己紹介</th>
          </tr> -->
          <tr class="profile-sen">
            <td>{{ \Auth::user()->bio }}</td>
          </tr>
        </table>
      </div>
    </div>

    <!-- ユーザーの投稿データを表示 -->
    <h2 class='page-header'>投稿</h2>
    <table class='table table-hover'>

      @foreach ($user_posts as $user_post)
      <tr class="post-tr">
        <td class="tr-name">{{ $user_post->user_name }}</td>
        <td class="tr-contents">{{ $user_post->contents }}</td>

        <td class="table-right">
          <div class="tr-time">{{ $user_post->post_updated_at }}</div>
          <div class="tr-button">
            <!-- 更新ボタン -->
            <a class="btn btn-primary" href="/post/{{$user_post->id}}/update-form">編集</a>
            <!-- 削除ボタン -->
            {!! Form::open(['url' => '/post/delete']) !!}
            {!! Form::hidden('id', $user_post->id) !!}
            <button type="submit" class="btn btn-danger" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</button>
            {!! Form::close() !!}
          </div>
        </td>
      </tr>
      @endforeach
    </table>

    <!-- トップページに戻るボタン -->
    <p><a class="btn btn-primary cancel" href="/index">ホームに戻る</a></p>
  </div>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>

</html>
@endsection
