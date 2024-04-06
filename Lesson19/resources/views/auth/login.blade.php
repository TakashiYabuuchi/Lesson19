@extends('layouts.app')

@section('content')
<div class="container">
     <!-- キャッシュ制御 -->
  {{header('Cache-control: no-store','Pragma: no-cache');}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @if (Route::has('login'))
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>

                    @endif
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 ">
                            <div class="col-md-6  memory">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('ログイン情報を記録する') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 ">
                                <button type="submit" class="btn btn-primary mb-2" id="form1">
                                    {{ __('ログイン') }}
                                </button>

                                @if (Route::has('password.request'))
                                <div class="memory">
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('パスワードをお忘れの方はこちら') }}
                                    </a>
                                </div>
                                @endif

                                @if (Route::has('register'))
                                <div class="col-md-6 memory">
                                    <a class="btn btn-link" href="{{ route('register') }}">{{ __('新規登録はこちら') }}</a>
                                </div>
                                @endif
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

<script type="text/javascript">
//ログインボタンを押した際にログインボタンを無効化（連打による二重送信回避）
$(function(){
$('[id="form1"]').click(function(){
$(this).prop('disabled',true);//ボタン無効化
$(this).closest('form').submit();//フォーム送信
});
});
</script>

@endsection
