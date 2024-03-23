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

    <div class="profile">

      @foreach ($member_profiles as $member_profile)
      <!-- プロフィール左側 -->
      <div class="profile-left">
        <!-- アイコン-->
        <img src="{{asset('/storage/'.$member_profile->image_path)}}" alt="" width="30" height="20">
        <!-- <a class="btn btn-info" href="/updateProfileForm">プロフィール編集</a> -->
      </div>

      <!-- プロフィール右側 -->
      <div class="profile-right">
        <table class='table table-hover pf-1'>
          <tr>
            <th>Name</th>
            <th>Following</th>
            <th>Followed</th>
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

    <h2 class='page-header'>Posts</h2>
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
            <button type="submit" class="btn btn-danger" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</button>
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
    <!-- 前のページに戻るボタン -->
    <p><button class="btn btn-primary cancel" onClick="history.back();">戻る</button></p>
    @endif
    <!-- トップページに戻るボタン -->
    <p><a class="btn btn-primary cancel" href="/index">ホームに戻る</a></p>
  </div>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>

</html>
@endsection
