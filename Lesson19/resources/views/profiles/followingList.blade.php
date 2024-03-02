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
<h2 class='page-header'>フォローリスト</h2>


<table class='table table-hover'>
<tr>
<th>名前</th>
<th>アイコン</th>
<th>フォロー</th>
</tr>

<!-- ログインユーザーがフォローしているユーザーの名前・アイコン・フォロー解除ボタンを表示 -->
@foreach ($following_lists as $following_list)
<tr>
<td><a href="/memberProfile/{{$following_list->followed_user_id}}">{{ $following_list->name }}</a></td>
<td><img src="{{asset('/storage/'.$following_list->image_path)}}" alt="" width="30" height="20"></td>
<td>

{{Form::open(['url' => '/removeFollow'])}}
{{Form::hidden('removeFollow',$following_list->followed_user_id)}}
{{Form::submit('フォロー解除')}}
{{Form::close()}}

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
