<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://api-maps.yandex.ru/2.1/?apikey=7853fd78-30e8-41f2-8c06-0d9196db4bf3&lang=ru_RU" type="text/javascript">
  </script>

  <title>Посты контроля</title>
</head>
<body>

<style>
  html, body {
    width: 100%;
    height: 100%;

    margin: 0px;
    padding: 0px;
  }

  .main-menu {
    position: fixed;
    z-index:2;
    right: 25px;
    top: 25px;
  }

  .main-menu ul {
    list-style: none;
  }

  .main-menu ul li {
    display: inline-block;
  }
</style>

<div class="main-menu">
  <ul>
    <li><a href="/">Главная</a></li>
    <li><a href="{{ route('posts') }}">Посты</a></li>
  </ul>
</div>