@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register-step2.css')}}">
@endsection

@section('content')
<div class="register-form">
    <div class="register-form__inner">
        <div class="register-form__heading">
            <div class="register-form__app-name">PiGLy</div>
            <div class="register-form__content-heading">新規会員登録</div>
            <div class="register-form__info">STEP2 体重データの入力</div>
        </div>
        <form class="register-form__form" action="{{ route('register.postStep2') }}" method="post">
            @csrf
            <div class="register-form__group">
                <label class="register-form__label" for="current_weight">現在の体重</label>
                <div class="register-form__input-group">
                    <input class="register-form__input" type="text" step="0.1" name="current_weight" id="current_weight" value="{{ old('current_weight') }}" placeholder="現在の体重を入力" >
                    <span class="unit">kg</span>
                </div>
                <p class="register-form__error-message">
                    @error('current_weight')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="register-form__group">
                <label class="register-form__label" for="target_weight">目標の体重</label>
                <div class="register-form__input-group">
                    <input class="register-form__input" type="text" step="0.1" name="target_weight" id="target_weight" value="{{ old('target_weight') }}" placeholder="目標の体重を入力" >
                    <span class="unit">kg</span>
                </div>
                <p class="register-form__error-message">
                    @error('target_weight')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <input class="register-form__btn btn" type="submit" value="登録完了">
        </form>
    </div>
</div>
@endsection