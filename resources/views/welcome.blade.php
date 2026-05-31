<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #fff;
            color: #636b6f;
            margin: 0;
        }
        .full-height {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .content {
            text-align: center;
        }
        .title {
            font-size: 3rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }
        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <div class="full-height">
        <div class="content">
            <div class="title">
                {{ config('app.name') }}
            </div>

            @if (Route::has('login'))
                <div class="links mb-3">
                    @auth
                        <a href="{{ url('/chat') }}">Chatroom</a>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif
        </div>
    </div>
</body>
</html>
