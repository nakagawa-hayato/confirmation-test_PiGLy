<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <div class="app">
        @auth
            <header class="header">
                <div class="header__heading">PiGLy</div>
                @yield('link')

                <div class="header__nav">
                    <div class="header__item">
                        <a href="{{ route('weight_logs.goal_setting') }}" class="header-nav__link" >目標体重設定</a>
                    </div>
                    <div class="header__item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="header-nav__button" type="submit">ログアウト</button>
                        </form>
                    </div>
                </div>
            </header>
        @endauth
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>

</html>


