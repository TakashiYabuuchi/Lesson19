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
<h2 class='page-header'>プロフィール</h2>

<table class='table table-hover'>
<tr>
<th>フォロー数</th>
<th>フォロワー数</th>
</tr>
<tr>
<td>{{ $number_following }}</td>
<td>{{ $number_followed }}</td>
</table>

@foreach ($member_profiles as $member_profile)

<!-- ログインユーザーのプロフィールであれば、プロフィール編集画面へのボタンを表示 -->
@if($member_profile->id==\Auth::user()->id)
<!-- プロフィール編集画面ボタン -->
<div class=text-end>
<a class="btn btn-info" href="/updateProfileForm">プロフィール編集</a>
</div>
@endif

<table class='table table-hover'>
<tr>
<th>名前</th>
<th>アイコン</th>
<th>自己紹介</th>
</tr>
<tr>
<!-- 名前 -->
<td>{{ $member_profile->name }}</td>
<!-- アイコン -->
<td><img src="{{asset('/storage/'.$member_profile->image_path)}}" alt="" width="30" height="20"></td>
<!-- 自己紹介 -->
<td>{{ $member_profile->bio }}</td>
@endforeach
</table>

<table class='table table-hover'>
<tr>
<th>投稿内容</th>
<th>投稿日時</th>
<th></th>
<th></th>
</tr>

@foreach ($member_posts as $member_post)
<tr>
<!-- 投稿内容 -->
<td>{{ $member_post->contents }}</td>
<!-- 投稿更新日時 -->
<td>{{ $member_post->post_updated_at }}</td>

<!-- ログインユーザーが投稿したものであれば、更新・削除ボタンを表示 -->
@if($member_post->user_name==\Auth::user()->name)
<!-- 更新ボタン -->
<td>
<a class="btn btn-primary" href="/post/{{$member_post->id}}/update-form">更新</a>
</td>

<!-- 削除ボタン -->
<td>
{!! Form::open(['url' => '/post/delete']) !!}
{!! Form::hidden('id', $member_post->id) !!}
<button type="submit" class="btn btn-danger" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</button>
{!! Form::close() !!}
</td>
@else
<td></td>
<td></td>
@endif
</tr>
@endforeach
</table>


<!-- ログインユーザーのプロフィールであれば、ユーザー検索画面へのボタンを表示 -->
@if($member_profile->id==\Auth::user()->id)
<!-- ユーザー検索画面ボタン -->
<p><a class="btn btn-primary" href="/userSearch">戻る</a></p>
@else
<!-- 前のページに戻るボタン -->
<p><button class="btn btn-primary" onClick="history.back();">戻る</button></p>
@endif
<!-- トップページに戻るボタン -->
<p><a class="btn btn-primary" href="/index">トップページに戻る</a></p>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
@endsection
