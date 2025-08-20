@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/goal_setting.css')}}">
@endsection

@section('content')
<div class="goal-setting">
    <div class="goal-setting__inner">
        <h2 class="goal-setting__heading content__heading">目標体重設定</h2>
        <form class="goal-setting__form" action="{{ route('weight_logs.goal_setting.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="goal-setting__input-group">
                <input class="goal-setting__input" type="number" inputmode="decimal" step="0.1" name="target_weight" id="target_weight" value="{{ old('weight', $target->target_weight) }}" placeholder="50.0">
                <span class="unit">kg</span>
            </div>
            @error('target_weight')
                <p class="error">{{ $message }}</p>
            @enderror

            <div class="goal-setting__action">
                <a href="{{ route('weight_logs.index') }}" class="goal-setting__close-btn">戻る</a>
                <button type="submit" class="btn goal-setting__store-btn">更新</button>
            </div>
        </form>
    </div>
</div>
@endsection