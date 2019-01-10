@include('partials.header')

<h1>{{ $channel->sensor->name }}</h1>
<h2>Минимальное значение: {{ $channel->sensor->min_value }}</h2>
<h2>Максимальное значение: {{ $channel->sensor->max_value }}</h2>

<form method="PUT" action="{{ route('channels.edit', compact('channel')) }}">
  {{ csrf_field() }}

  <input type="text" name="name" placeholder="название" value="{{ $channel->sensor->name }}" required>
  <input type="number" name="min" placeholder="минимальное значение" value="{{ $channel->sensor->min_value }}" required>
  <input type="number" name="max" placeholder="максимальное значение" value="{{ $channel->sensor->max_value }}" required>

  <h3>Изменение уставки</h3>
  <input type="number" name="precautionary_point" placeholder="предупредительная уставка" value="{{ $channel->precautionary_point }}" required>
  <input type="number" name="emergency_point" placeholder="аварийная уставка" value="{{ $channel->emergency_point }}" required>

  <input type="submit" value="сохранить">
</form>

<h2>Установлен на посте:</h2>

<a href="{{ $channel->post->url }}"><h2>{{ $channel->post->name }}</h2></a>

@include('partials.footer')