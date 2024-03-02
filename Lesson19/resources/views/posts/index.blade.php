@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>

<head>
<meta charset='utf-8"'>
<link rel='stylesheet' href="{{ asset('/css/app.css') }}">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<div class='container'>
<!-- 投稿フォーム画面へのリンク -->
<p class="pull-right"><a class="btn btn-success" href="/create-form">投稿する</a></p>

<div class=text-end>
<!-- プロフィール画面へのリンク -->
<p class="pull-right"><a class="btn btn-info" href="/userProfile">プロフィール</a></p>
</div>

<!-- フォローリスト/フォロワーリスト -->
<div class=text-end>
<a class="btn btn-outline-primary" href="/followingList">フォローリスト</a>
<a class="btn btn-outline-secondary" href="/followedList">フォロワーリスト<a></a>
</div>

<!-- ユーザー検索画面へのリンク -->
<p class="pull-right"><a class="btn btn-primary" href="/userSearch">ユーザー検索</a></p>

<h2 class='page-header'>投稿一覧</h2>
<div id="search">
  {!! Form::open(['url' => '/index']) !!}
  {!! Form::input('text', 'postSearch', null, ['placeholder' => '投稿検索']) !!}
  <!-- 検索ボタン -->
  <button type="submit" name="search" class="fas fa-search">検索</button>
  {!! Form::close() !!}
</div>

<!-- 投稿データを表示 -->
<table class='table table-hover'>
<tr>
<th>名前</th>
<th>投稿内容</th>
<th>投稿日時</th>
<th></th>
<th></th>
</tr>

@foreach ($lists as $list)
<tr>
<td>{{ $list->user_name }}</td>
<td>{{ $list->contents }}</td>
<td>{{ $list->post_updated_at }}</td>

<!-- ログインユーザーが投稿したものに、更新・削除ボタンを表示 -->
@if($list->user_name==\Auth::user()->name)
<!-- 更新ボタン -->
<td>
<a class="btn btn-primary" href="/post/{{$list->id}}/update-form">更新</a>
</td>

<!-- 削除ボタン -->
<td>
{!! Form::open(['url' => '/post/delete']) !!}
{!! Form::hidden('id', $list->id) !!}
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
@if ($lists->isEmpty()&&!empty($keyword) && !mb_ereg_match("^(\s|　)+$", $keyword))
<p>{{ $keyword }}の検索結果は0件です。</p>
@elseif($lists->isNotEmpty() && !empty($keyword) && !mb_ereg_match("^(\s|　)+$", $keyword))
<p>{{ $keyword }}の検索結果</p>
@endif
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>
@endsection
