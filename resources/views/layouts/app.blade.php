<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ @$title ? __($title).' | ' : '' }}{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @auth
    <script>
        window.apiToken = '{{ \Auth::user()->api_token }}'
    </script>
    @endauth
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('head-scripts')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body class="bg-white">
    <nav class="navbar navbar-expand-md navbar-light shadow">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <form action="{{ route('search', app()->getLocale()) }}" class="ml-md-4 input-group" autocomplete="off">
                        <input type="text" class="form-control" name="q" placeholder="{{ __("Let's search anything") }}...">
                        <div class="input-group-append">
                            <button class="input-group-text bg-primary">
                                <img src="/images/icons/search.svg" alt="" height="15">
                            </button>
                        </div>
                    </form>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mr-md-4">
                        <a href="{{ route('blog', app()->getLocale()) }}" class="nav-link">{{ __('Blog') }}</a>
                    </li>
                    <li class="nav-item mr-md-4">
                        <a href="{{ route('projects', app()->getLocale()) }}" class="nav-link">{{ __('Projects') }}</a>
                    </li>
                    <li class="nav-item mr-md-4 d-flex align-items-center">
                        <a class="nav-link {{ app()->getLocale() == 'ru' ? 'underline' : '' }}" href="{{ route('home', 'ru') }}">RU</a>
                        <div class="nav-text">/</div>
                        <a class="nav-link {{ app()->getLocale() == 'en' ? 'underline' : '' }}" href="{{ route('home', 'en') }}">EN</a>
                    </li>
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login', app()->getLocale()) }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register', app()->getLocale()) }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile', app()->getLocale()) }}">
                                {{ __('Profile') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('profile.settings', app()->getLocale()) }}">
                                {{ __('Settings') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout', app()->getLocale()) }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
    <footer class="py-5 bg-secondary">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-2">
                        <a class="text-white" href="{{ route('home', app()->getLocale()) }}">{{ __('Home') }}</a>
                    </div>
                    <div class="mb-2">
                        <a class="text-white" href="{{ route('projects', app()->getLocale()) }}">{{ __('Projects') }}</a>
                    </div>
                    <div class="mb-2">
                        <a class="text-white" href="{{ route('blog', app()->getLocale()) }}">{{ __('Blog') }}</a>
                    </div>
                </div>
                <div class="col-sm-6 d-flex justify-content-end">
                    <a class="text-white {{ app()->getLocale() == 'ru' ? 'underline' : '' }}" href="{{ route('home', 'ru') }}">RU</a>
                    <div class="mx-2 text-white">/</div>
                    <a class="text-white {{ app()->getLocale() == 'en' ? 'underline' : '' }}" href="{{ route('home', 'en') }}">EN</a>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    @yield('scripts')
</body>
</html>
