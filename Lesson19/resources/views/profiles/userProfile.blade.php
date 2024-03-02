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
<h2 class='page-header'>ユーザープロフィール</h2>
<!-- プロフィール編集画面ボタン -->
<div class=text-end>
<a class="btn btn-outline-primary" href="/updateProfileForm">プロフィール編集</a>
</div>

<!-- フォロー数・フォロワー数を表示 -->
<table class='table table-hover'>
<tr>
<th>フォロー数</th>
<th>フォロワー数</th>
</tr>
<tr>
<td><a href="/followingList">{{ $number_following }}</a></td>
<td><a href="/followedList">{{ $number_followed }}<a></a></td>
</table>

<!-- ユーザーのプロフィールを表示 -->
<table class='table table-hover'>
<tr>
<th>名前</th>
<th>アイコン</th>
<th>自己紹介</th>
</tr>
<tr>
<td>{{ \Auth::user()->name }}</td>
<td><img src="{{asset('/storage/'.\Auth::user()->image_path)}}" alt="" width="30" height="20"></td>
<td>{{ \Auth::user()->bio }}</td>
</table>

<!-- ユーザーの投稿データを表示 -->
<table class='table table-hover'>
<tr>
<th>投稿内容</th>
<th>投稿日時</th>
<th></th>
<th></th>
</tr>

@foreach ($user_posts as $user_post)
<tr>
<td>{{ $user_post->contents }}</td>
<td>{{ $user_post->post_updated_at }}</td>
<!-- 更新ボタン -->
<td>

<a class="btn btn-primary" href="/post/{{$user_post->id}}/update-form">更新</a>
</td>

<!-- 削除ボタン -->
<td>
{!! Form::open(['url' => '/post/delete']) !!}
{!! Form::hidden('id', $user_post->id) !!}
<button type="submit" class="btn btn-danger" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</button>
{!! Form::close() !!}
</td>
</tr>
@endforeach
</table>



<!-- トップページに戻るボタン -->
<p><a class="btn btn-primary" href="/index">トップページに戻る</a></p>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
@endsection
