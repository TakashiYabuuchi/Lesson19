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
<h2 class='page-header'>フォロワーリスト</h2>


<table class='table table-hover'>
<tr>
<th>名前</th>
<th>アイコン</th>
<th>フォロワー</th>
</tr>

<!-- ログインユーザーをフォローしているユーザーの名前・アイコンを表示 -->
@foreach ($followed_lists as $followed_list)
<tr>
<td><a href="/memberProfile/{{$followed_list->id}}">{{ $followed_list->name }}</a></td>
<td><img src="{{asset('/storage/'.$followed_list->image_path)}}" alt="" width="30" height="20"></td>
<td>

<!-- ログインユーザーにフォローされている場合、フォロー解除ボタン表示 -->
@if ($my_follows->contains('followed_user_id',$followed_list->following_user_id))
{{Form::open(['url' => '/removeFollow'])}}
{{Form::hidden('removeFollow',$followed_list->following_user_id)}}
{{Form::submit('フォロー解除')}}
{{Form::close()}}
@else
<!-- ログインユーザーにフォローされていない場合、フォローボタン表示 -->
{{Form::open(['url' => '/addFollow'])}}
{{Form::hidden('addFollow',$followed_list->following_user_id)}}
{{Form::submit('フォローする')}}
{{Form::close()}}
@endif

</td>
</tr>
@endforeach
</table>


<!-- ユーザープロフィールに戻るボタン -->
<p><a class="btn btn-info" href="/userProfile">ユーザープロフィールへ</a></p>

<!-- トップページに戻るボタン -->
<p><a class="btn btn-primary" href="/index">トップページに戻る</a></p>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
@endsection
