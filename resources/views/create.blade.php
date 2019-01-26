@include('partials.header')

<h1 class="header">Новая запись</h1>

<form method="POST" action="{{ route('currents.create') }}">
  {{ csrf_field() }}

  <select name="channel" required>
    @foreach($channels as $channel)
      <option>{{ $channel->id }}</option>
    @endforeach
  </select>

  <input type="float" placeholder="значение" name="value" required>
  <input type="date" placeholder="дата" name="date" required>
  <input type="float" min="-90" max="90" placeholder="долгота" name="longitude" required>
  <input type="float" min="-180" max="180" placeholder="широта" name="latitude" required>

  <select name="status" required>
    @foreach($statuses as $status)
    <option>{{ $status->name }}</option>
    @endforeach
  </select>

  <input type="submit" value="Сохранить">
</form>


<h1>Новый канал</h1>

<form method="POST" action="{{ route('channels.create') }}">
  {{ csrf_field() }}

  <select name="post" required>
    @foreach($posts as $post)
      <option>{{ $post->name }}</option>
    @endforeach
  </select>

  <select name="sensor" required>
    @foreach($sensors as $sensor)
      <option>{{ $sensor->name }}</option>
    @endforeach
  </select>

  <input type="float" name="precautionary_point" placeholder="Предупредительная уставка" required>
  <input type="float" name="emergency_point" placeholder="Аварийная уставка" required>

  <input type="submit" value="Сохранить">
</form>


<h1>Новый пост</h1>

<form method="POST" action="{{ route('posts.create') }}">
  {{ csrf_field() }}

  <input type="text" placeholder="Имя поста" name="name" required>

  <input type="submit" value="Сохранить">
</form>


<h1>Новый датчик</h1>

<form method="POST" action="{{ route('sensors.create') }}">
  {{ csrf_field() }}

  <input type="text" name="name" placeholder="Имя датчика" required>
  <input type="float" name="max_value" placeholder="Максимальное значение" required>
  <input type="float" name="min_value" placeholder="Минимальное значение" required>
  <input type="text" name="units" placeholder="Единицы измерения" required>

  <input type="submit" value="Сохранить">
</form>


<h1>Новый статус</h1>

<form method="POST" action="{{ route('statuses.create') }}">
  {{ csrf_field() }}

  <input type="text" placeholder="Имя статуса" name="name" required>
  <input type="color" name="color" required>

  <input type="submit" value="Сохранить">
</form>

@include('partials.footer')