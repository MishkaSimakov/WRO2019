@include('partials.header')

<h1 class="header">{{ $channel->sensor->name }}</h1>

@auth
<form class="channel-form" method="PUT" action="{{ route('channels.edit', compact('channel')) }}">
  {{ csrf_field() }}
  <h2 class="left-header">Редактирование</h2>

  <label for="name">Имя</label>
  <input id="name" type="text" class="name-header" name="name" placeholder="название" value="{{ $channel->sensor->name }}" required>

  <label for="min">Минимальное значение</label>
  <input id="min" type="float" name="min" placeholder="минимальное значение" value="{{ $channel->sensor->min_value }}" required>

  <label for="max">Максимальное значение</label>
  <input id="max" type="float" name="max" placeholder="максимальное значение" value="{{ $channel->sensor->max_value }}" required>



  <label for="precautionary_point">Предупредительная уставка</label>
  <input type="float" id="precautionary_point" name="precautionary_point" placeholder="предупредительная уставка" value="{{ $channel->precautionary_point }}" required>

  <label for="emergency_point">Аварийная уставка</label>
  <input type="float" id="emergency_point" name="emergency_point" placeholder="аварийная уставка" value="{{ $channel->emergency_point }}" required>

  <input type="submit" value="сохранить">
</form>
@else
  <h2 class="left-header">Минимальное значение: {{ $channel->sensor->min_value }}</h2>
  <h2 class="left-header margin-bottom">Максимальное значение: {{ $channel->sensor->max_value }}</h2>
@endauth

<h2 class="left-header">Установлен на посте:</h2>

<a href="{{ $channel->post->url }}"><h2>{{ $channel->post->name }}</h2></a>

@include('partials.footer')