@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css')}}">
@endsection

@section('content')
<div class="login-form">
    <div class="login-form__inner">
        <div class="login-form__heading">
            <div class="login-form__app-name">PiGLy</div>
            <div class="login-form__content-heading">ログイン</div>
        </div>
        <form class="login-form__form" action="/login" method="post">
            @csrf
            <div class="login-form__group">
                <label class="login-form__label" for="email">メールアドレス</label>
                <input class="login-form__input" type="text" name="email" id="email" value="{{ old('email') }}" placeholder="メールアドレスを入力" >
                <p class="login-form__error-message">
                    @error('email')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="login-form__group">
                <label class="login-form__label" for="password">パスワード</label>
                <input class="login-form__input" type="password" name="password" id="password" placeholder="パスワードを入力" >
                <p class="login-form__error-message">
                    @error('password')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <input class="btn login-form__btn" type="submit" value="ログイン">
        </form>
        <div class="footer__link">
            <a class="footer__link-btn" href="{{ route('register.step1') }}">アカウント作成はこちら</a>
        </div>
    </div>
</div>
@endsection

