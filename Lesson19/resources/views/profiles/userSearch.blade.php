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

    <!-- app.blade.phpに移動 -->
    <!-- <div id="search">
      {!! Form::open(['url' => '/userSearch']) !!}
      {!! Form::input('text', 'userSearch', null, ['placeholder' => 'ユーザー検索']) !!} -->
    <!-- 検索ボタン -->
    <!-- <button type="submit" name="search" class="fas fa-search">検索</button>
      {!! Form::close() !!}
    </div> -->

    <table class='table table-hover'>
      <!-- <tr>
        <th>名前</th>
        <th>アイコン</th>
        <th>フォロー</th>
      </tr> -->

      <!-- すべてのユーザーの名前・・アイコン表示 -->
      @foreach ($user_lists as $user_list)
      <tr class="user-lists">
        <td class="user-icon"><img src="{{asset('/storage/'.$user_list->image_path)}}" alt="" width="30" height="20"></td>

        <td class="lt-name"><a href="/memberProfile/{{$user_list->id}}">{{ $user_list->name }}</a></td>

        <td class="lt-button">
          <!-- ログインユーザー以外のユーザーにフォロー/フォロー解除ボタンを表示 -->
          @if($user_list->id!=\Auth::user()->id)
          <!-- ログインユーザーがフォローしている場合、フォロー解除ボタンを表示 -->
          @if ($my_follows->contains('followed_user_id',$user_list->id))
          {{Form::open(['url' => '/removeFollow'])}}
          {{Form::hidden('removeFollow',$user_list->id)}}
          {{Form::submit('フォロー中' ,['class' => 'btn btn-primary'])}}
          {{Form::close()}}
          @else
          <!-- ログインユーザーがフォローしていない場合、フォローボタンを表示 -->
          {{Form::open(['url' => '/addFollow'])}}
          {{Form::hidden('addFollow',$user_list->id)}}
          {{Form::submit('フォローする',['class' => 'btn btn-primary cancel'])}}
          {{Form::close()}}
          @endif
          @endif
        </td>
      </tr>
      @endforeach
    </table>

    @if ($user_lists->isEmpty()&&!empty($keyword) && !mb_ereg_match("^(\s|　)+$", $keyword))
    <p>{{ $keyword }}の検索結果は0件です。</p>
    @elseif($user_lists->isNotEmpty() && !empty($keyword) && !mb_ereg_match("^(\s|　)+$", $keyword))
    <p>{{ $keyword }}の検索結果</p>
    @endif


    <!-- トップページに戻るボタン -->
    <p><a class="btn btn-primary cancel" href="/index">ホームに戻る</a></p>
  </div>

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>

</html>
@endsection
