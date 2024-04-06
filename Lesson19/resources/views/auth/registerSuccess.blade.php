@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>
   <!-- キャッシュ制御 -->
  {{header('Cache-control: no-store','Pragma: no-cache');}}
<body>

  <div class="row mb-0">
    <div class="col-md-8 ">
      <!-- <div class="card-header">{{ __('Register') }}</div> -->

      <h2 class="wel">ようこそ　{{ Auth::user()->name }}さん</h2>
      <p class="wel">アカウントの登録が完了しました。</p>
      <form action="{{ route('logout') }}" method="post">
        @csrf
        <input type="submit" class="btn btn-primary wel" value="ログイン画面に戻る" id="form1">
      </form>
    </div>
  </div>

</body>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

<script type="text/javascript">
//アカウント作成ボタンを押した際にアカウント作成ボタンを無効化（連打による二重送信回避）
$(function(){
$('[id="form1"]').click(function(){
$(this).prop('disabled',true);//ボタン無効化
$(this).closest('form').submit();//フォーム送信
});
});
</script>

</html>
@endsection
