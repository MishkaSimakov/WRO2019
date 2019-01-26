@include('partials.header')

<h1 class="header">{{ $status->name }}</h1>

@auth
  <form method="PUT" action="{{ route('statuses.edit', compact('status')) }}">
    {{ csrf_field() }}

    <label for="name">Название</label>
    <input type="text" id="name" name="name" placeholder="название" value="{{ $status->name }}" required>

    <label for="color">Цвет</label>
    <input type="color" id="color" name="color" placeholder="цвет на карте" value="{{ $status->color }}" required>

    <input type="submit" value="сохранить">
  </form>
@endauth

@include('partials.footer')