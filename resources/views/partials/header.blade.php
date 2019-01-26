<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://api-maps.yandex.ru/2.1/?apikey=7853fd78-30e8-41f2-8c06-0d9196db4bf3&lang=ru_RU" type="text/javascript">
  </script>

  <link rel="stylesheet" href="{{ asset('css/index.css') }}" type="text/css">

  <title>Посты контроля</title>
</head>
<body>

<div class="main-menu">
  <ul>
    <li><a href="/">Главная</a></li>
    <li><a href="{{ route('posts') }}">Посты</a></li>

    @guest

    <li class="nav-item">
      <a class="nav-link" href="{{ route('login') }}">Войти</a>
    </li>

    @endguest
  </ul>
</div>