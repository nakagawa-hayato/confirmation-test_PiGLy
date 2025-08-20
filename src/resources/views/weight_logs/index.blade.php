@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('content')
<div class="index-form">
    <div class="index-form__inner">
        <div class="top-contents">
            <div class="top-content">
                <label class="top-content__label">目標体重</label>
                <p class="top-content__weight-group">
                    <span class="top-content__weight">{{ $targetWeight ?? '-' }}</span>
                    <span>kg</span>
                </p>
            </div>
            <div class="top-content">
                <label class="top-content__label">目標まで</label>
                <p class="top-content__weight-group">
                    <span class="top-content__weight">{{ $diff !== null ? number_format($diff, 1) : '-' }}</span>
                    <span>kg</span>
                </p>
            </div>
            <div class="top-content">
                <label class="top-content__label">最新体重</label>
                <p class="top-content__weight-group">
                    <span class="top-content__weight">{{ $latestWeight ?? '-' }}</span>
                    <span>kg</span>
                </p>
            </div>
        </div>

        <div class="under-contents">
            <div class="under-content__search-form">
                <form class="search-form" action="{{ route('weight_logs.index') }}" method="GET">
                    <div class="search-form__inputs">
                        <input class="search-form__date" type="date" name="start_date" value="{{ request('start_date') }}">
                        <span class="search-form__date-tilde">〜</span>
                        <input class="search-form__date" type="date" name="end_date" value="{{ request('end_date') }}">
                    </div>
                    <div class="search-form__actions">
                        <button class="search-form__search-btn" type="submit">検索</button>
                        @if(request('start_date') || request('end_date'))
                            <a href="{{ route('weight_logs.index') }}" class="search-form__reset-btn">リセット</a>
                        @endif
                    </div>
                </form>
                <a class="btn weight-data_create" href="#modal">データ追加</a>
            </div>

                {{-- 検索メッセージ --}}
                @if(!empty($searchMessage))
                    <p class="search-message">{{ $searchMessage }}</p>
                @endif

            <div class="under-content">
                <table class="under-content__table">
                    <tr class="under-content__row">
                        <th class="under-content__label">日付</th>
                        <th class="under-content__label">体重</th>
                        <th class="under-content__label">食事摂取カロリー</th>
                        <th class="under-content__label">運動時間</th>
                        <th class="under-content__label"></th>
                    </tr>
                    @foreach($logs as $log)
                    <tr class="under-content__row">
                        <td class="under-content__data">{{ \Carbon\Carbon::parse($log->date)->format('Y/m/d') }}</td>
                        <td class="under-content__data">{{ number_format($log->weight, 1) }}kg</td>
                        <td class="under-content__data">{{ number_format($log->calories) }}cal</td>
                        <td class="under-content__data">{{ \Carbon\Carbon::parse($log->exercise_time)->format('H:i') }}</td>
                        <td class="under-content__data">
                        <a class="under-content__detail-btn" href="{{ route('weight_logs.show', $log->id) }}"><img src=" {{ asset('image/定番ペンのフリーアイコン素材 1.png')}} "></a></td>
                    </tr>
                    @endforeach
                </table>
                <div class="pagination-wrapper">
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- データ追加モーダル --}}
    <div id="modal" class="modal">
        <a href="#!" class="modal-overlay"></a>
        <div class="modal-form__inner" role="dialog" aria-modal="true" aria-labelledby="create-modal-title">
            <h2 id="create-modal-title" class="modal-form__heading content__heading">Weight Log</h2>
            <form class="modal-form__form" action="{{ route('weight_logs.store') }}" method="POST">
                @csrf

                <div class="modal-form__group">
                    <label class="modal-form__label" for="date">日付</label>
                    <input class="modal-form__input" type="date" id="date" name="date" value="{{ old('date', now()->toDateString()) }}" >
                    @error('date')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="modal-form__group">
                    <label class="modal-form__label" for="weight">体重</label>
                    <div class="modal-form__input-group">
                        <input class="modal-form__input" type="text" name="weight" id="weight" value="{{ old('weight')}}" placeholder="50.0">
                        <span class="unit">kg</span>
                    </div>
                    @error('weight')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="modal-form__group">
                    <label class="modal-form__label" for="calory">摂取カロリー</label>
                    <div class="modal-form__input-group">
                        <input class="modal-form__input" type="text" name="calories" id="calory" value="{{ old('calories') }}" placeholder="1200">
                        <span class="unit">cal</span>
                    </div>
                    @error('calories')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="modal-form__group">
                    <label class="modal-form__label" for="exercise_time">運動時間</label>
                    <input class="modal-form__input" type="text" name="exercise_time" id="exercise_time" value="{{ old('exercise_time') }}" placeholder="00:00">
                    @error('exercise_time')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="modal-form__group">
                    <label class="modal-form__label">運動内容</label>
                    <textarea class="modal-form__textarea" name="exercise_content" cols="30" rows="10" placeholder="運動内容を追加">{{ old('exercise_content') }}</textarea>
                    @error('exercise_content')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="modal-action">
                    <a href="#!" class="modal-form__close-btn">戻る</a>
                    <button type="submit" class="btn modal-form__store-btn">登録</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection



