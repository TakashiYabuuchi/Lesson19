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

    <table class='table table-hover'>
      <!-- <tr>
　　　<th>名前</th>
　　　<th>アイコン</th>
　　　<th>フォロワー</th>
　　　</tr> -->

      <!-- ログインユーザーをフォローしているユーザーの名前・アイコンを表示 -->
      @foreach ($followed_lists as $followed_list)
      <tr class="user-lists">
        <td class="user-icon"><img src="{{asset('/storage/'.$followed_list->image_path)}}" alt="" width="30" height="20"></td>

        <td class="lt-name"><a href="/memberProfile/{{$followed_list->following_user_id}}">{{ $followed_list->name }}</a></td>

        <td class="lt-button ">
          <!-- ログインユーザーにフォローされている場合、フォロー解除ボタン表示 -->
          @if ($my_follows->contains('followed_user_id',$followed_list->following_user_id))
          {{Form::open(['url' => '/removeFollow'])}}
          {{Form::hidden('removeFollow',$followed_list->following_user_id)}}
          {{Form::submit('フォロー中',['class' => 'btn btn-primary ','id'=>'follow'])}}
          {{Form::close()}}
          @else
          <!-- ログインユーザーにフォローされていない場合、フォローボタン表示 -->
          {{Form::open(['url' => '/addFollow' , 'class' => ''])}}
          {{Form::hidden('addFollow',$followed_list->following_user_id)}}
          {{Form::submit('フォローする',['class' => 'btn btn-primary cancel','id'=>'follow'])}}
          {{Form::close()}}
          @endif
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
  <script type="text/javascript">
    //フォロー/フォロー中ボタンを押した際にボタンを無効化（連打による二重送信回避）
    $(function(){
	  $('[id="follow"]').click(function(){
		$(this).prop('disabled',true);//ボタン無効化
		$(this).closest('form').submit();//フォーム送信
	  });
    });
    </script>
</body>

</html>
@endsection
