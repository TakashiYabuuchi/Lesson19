@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>

<body>

  <div class="row mb-0">
    <div class="col-md-8 ">
      <!-- <div class="card-header">{{ __('Register') }}</div> -->

      <h2 class="wel">ようこそ　{{ Auth::user()->name }}さん</h2>
      <p class="wel">アカウントの登録が完了しました。</p>
      <form action="{{ route('logout') }}" method="post">
        @csrf
        <input type="submit" class="btn btn-primary wel" value="ログイン画面に戻る">
      </form>
    </div>
  </div>

</body>

</html>
@endsection
