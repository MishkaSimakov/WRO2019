<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://api-maps.yandex.ru/2.1/?apikey=7853fd78-30e8-41f2-8c06-0d9196db4bf3&lang=ru_RU" type="text/javascript">
  </script>

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script type="text/javascript" src="{{ asset('js/lava.js') }}"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
  <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
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
              <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  Посты <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" style="z-index: 99999999;" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('posts') }}">
                    Все посты
                  </a>

                  @auth
                  <a class="dropdown-item" href="{{ route('posts') }}" onclick="event.preventDefault();
                                                     document.getElementById('our_post-form').submit();">
                    Мои посты
                  </a>

                    <a class="dropdown-item" href="{{ route('posts.confirmation') }}">
                      Добавить пост
                    </a>

                  <form id="our_post-form" action="{{ route('posts') }}" method="GET" style="display: none;">
                    <input name="user_id" class="hidden" value="{{ Auth::user()->id }}">

                    @csrf
                  </form>
                  @endauth
                </div>
              </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
              <form class="form-inline">
                <i class="fas fa-search" aria-hidden="true"></i>
                <input oninput="search($('#serch').val())" class="form-control form-control-sm w-75" id="serch" type="text" placeholder="Искать" aria-label="Search">
              </form>

              <!-- Authentication Links -->
              @guest
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Вход</a>
              </li>
              @if (Route::has('register'))
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                </li>
              @endif
              @else
                <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                      Выйти
                    </a>

                    <a class="dropdown-item" href="{{ route('home') }}">
                      Личный кабинет
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form>
                  </div>
                </li>
                @endguest
            </ul>
          </div>
    </div>
  </nav>

  <script type="text/javascript">
      function search(query) {
          $.ajax({
              url: "{{ route('search') }}",
              method: "GET",
              dataType: 'json',
              data: {
                  query: query
              },
              success: function(data) {
                  $('.main').html(data)
              }
          })
      }
  </script>

  <main class="main">