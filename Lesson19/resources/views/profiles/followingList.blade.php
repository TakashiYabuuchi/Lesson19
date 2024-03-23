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

    <table class='table table-hover'>
      <!-- <tr>
        <th>名前</th>
        <th>アイコン</th>
        <th>フォロー</th>
      </tr> -->

      <!-- ログインユーザーがフォローしているユーザーの名前・アイコン・フォロー解除ボタンを表示 -->
      @foreach ($following_lists as $following_list)
      <tr class="user-lists">
        <td class="lt-icon"><img src="{{asset('/storage/'.$following_list->image_path)}}" alt="" width="30" height="20"></td>

        <td class="lt-name"><a href="/memberProfile/{{$following_list->followed_user_id}}">{{ $following_list->name }}</a></td>

        <td class="lt-button">
          {{Form::open(['url' => '/removeFollow' ,'class' => ''])}}
          {{Form::hidden('removeFollow',$following_list->followed_user_id)}}
          {{Form::submit('フォロー中',['class' => 'btn btn-primary '])}}
          {{Form::close()}}
        </td>
      </tr>
      @endforeach
    </table>

    <div class="list-url">
      <!-- トップページに戻るボタン -->
      <p><a class="btn btn-primary cancel" href="/index">ホームに戻る</a></p>

      <!-- ユーザープロフィールに戻るボタン -->
      <p class="to-pf"><a class="btn btn-primary " href="/userProfile">自分のプロフィールへ</a></p>
    </div>

  </div>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>

</html>
@endsection
