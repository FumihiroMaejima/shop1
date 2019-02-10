<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body{background-color: #c5d295;}

        .navbar-brand{
            font-family: Comic Sans MS;
        }

        #customer_login,#customer_register,#navbarDropdown {
            color: #fff;
            /*padding: 5%;*/
            padding: 10%, 5%;
            /*width: 180px;*/
            /*height: 180px;*/
            /*margin: 0 -15px;*/
            margin: 0 15px;
            mix-blend-mode: multiply;
        }

        #customer_login {
            background: #f92;
            border-radius: 80% 30% 50% 50%/50%;
        }

        #customer_register {
            background: #fc2;
            border-radius: 40% 40% 50% 40%/30% 50% 50% 50%;
        }
        @media (max-width: 770px) {
            #admin_login,#customer_login,#customer_register {
                color: #fff;
                /*padding: 5%;*/
                padding: 10%, 5%;
                width: 150px;
                /*height: 180px;*/
                /*margin: 0 -15px;*/
                margin: 0 15px;
                mix-blend-mode: multiply;
                text-align: center;
            }
        }

        #navbarDropdown{
            background: #f92;
            border-radius: 50% 50% 50% 70%/50% 50% 70% 60%;
        }

    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="background-color: #eae1c2;">
            <div class="container">
                @guest
                    <a class="navbar-brand" href="{{ url('/') }}">
                @else
                    <a class="navbar-brand" href="{{ url('/') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                @endguest
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" id="customer_login" href="{{ route('customer_login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="customer_register" href="{{ route('customer_register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('customer_home') }}">
                                        {{ __('Customer Home') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('customer_logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('customer_logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
