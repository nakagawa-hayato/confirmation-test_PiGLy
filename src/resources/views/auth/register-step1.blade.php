@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register-step1.css')}}">
@endsection

@section('content')
<div class="register-form">
    <div class="register-form__inner">
        <div class="register-form__heading">
            <div class="register-form__app-name">PiGLy</div>
            <div class="register-form__content-heading">新規会員登録</div>
            <div class="register-form__info">STEP1 アカウント情報の登録</div>
        </div>
        <form class="register-form__form" action="{{ route('register.postStep1') }}" method="post">
            @csrf
            <div class="register-form__group">
                <label class="register-form__label" for="name">お名前</label>
                <input class="register-form__input" type="text" name="name" id="name" value="{{ old('name') }}" placeholder="名前を入力" >
                <p class="register-form__error-message">
                    @error('name')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="register-form__group">
                <label class="register-form__label" for="email">メールアドレス</label>
                <input class="register-form__input" type="text" name="email" id="email" value="{{ old('email') }}" placeholder="メールアドレスを入力" >
                <p class="register-form__error-message">
                    @error('email')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="register-form__group">
                <label class="register-form__label" for="password">パスワード</label>
                <input class="register-form__input" type="password" name="password" id="password" placeholder="パスワードを入力" >
                <p class="register-form__error-message">
                    @error('password')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <input class="btn register-form__btn" type="submit" value="次に進む">
        </form>
        <div class="footer__link">
            <a class="footer__link-btn" href="/login">ログインはこちら</a>
        </div>
    </div>
</div>
@endsection

