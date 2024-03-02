@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>
<body>

<div class="row mb-0">
<div class="col-md-8 offset-md-4">
<p>ようこそ{{ Auth::user()->name }}さん</p>
<p>ユーザー登録が完了しました。</p>
<form action="{{ route('logout') }}" method="post">
  @csrf
  <input type="submit" class="btn btn-success pull-right" value="ログイン画面に戻る">
</form>
</div>
</div>

</body>
</html>
@endsection
