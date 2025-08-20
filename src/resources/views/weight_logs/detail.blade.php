@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css')}}">
@endsection

@section('content')
<div class="detail-form">
    <h2 class="detail-form__heading content__heading">Weight Log</h2>
    <div class="detail-form__inner">
        <form class="detail-form__form" action="{{ route('weight_logs.update', $log->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="detail-form__group">
                <label class="detail-form__label" for="date">日付</label>
                <input class="detail-form__input" type="date" id="date" name="date" value="{{ old('date', now()->toDateString()) }}" >
                @error('date')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="detail-form__group">
                <label class="detail-form__label" for="weight">体重</label>
                <div class="detail-form__input-group">
                    <input class="detail-form__input" type="text" name="weight" id="weight" value="{{ old('weight', $log->weight) }}" placeholder="50.0">
                    <span class="unit">kg</span>
                </div>
                @error('weight')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="detail-form__group">
                <label class="detail-form__label" for="calory">摂取カロリー</label>
                <div class="detail-form__input-group">
                    <input class="detail-form__input" type="text" name="calories" id="calory" value="{{ old('calories', $log->calories) }}" placeholder="1200">
                    <span class="unit">cal</span>
                </div>
                @error('calories')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="detail-form__group">
                <label class="detail-form__label" for="exercise_time">運動時間</label>
                
                <input class="detail-form__input" type="time" name="exercise_time" id="exercise_time" value="{{ old('exercise_time', $log->exercise_time ?? '') }}">

                @error('exercise_time')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="detail-form__group">
                <label class="detail-form__label">運動内容</label>
                <textarea class="detail-form__textarea" name="exercise_content" cols="30" rows="10" placeholder="運動内容を追加">{{ old('exercise_content', $log->exercise_content) }}</textarea>
                @error('exercise_content')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="detail-action">
                <a href="{{ route('weight_logs.index') }}" class="detail-form__close-btn">戻る</a>
                <button type="submit" class="btn detail-form__store-btn">更新</button>
            </div>
        </form>

        <form action="{{ route('weight_logs.delete', $log->id) }}" method="POST" >
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete" onclick="return confirm('本当に削除しますか？')">🗑️</button>
        </form>
    </div>
</div>
@endsection