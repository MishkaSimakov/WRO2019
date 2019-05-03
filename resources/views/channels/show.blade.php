@include('partials.header')

<h1 class="text-center">{{ $channel->sensor->name }}</h1>

      @auth
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">Редактирование</div>

              <div class="card-body">
                <form method="PUT" action="{{ route('channels.edit', compact('channel')) }}">
                  @csrf

                  <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Имя датчика</label>

                    <div class="col-md-6">
                      <input value="{{ $channel->sensor->name }}" id="name" type="text" class="form-control" name="name" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="units" class="col-md-4 col-form-label text-md-right">Единицы измерения</label>

                    <div class="col-md-6">
                      <input value="{{ $channel->sensor->units }}" id="units" type="text" class="form-control" name="units" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="min" class="col-md-4 col-form-label text-md-right">Минимальное значение</label>

                    <div class="col-md-6">
                      <input value="{{ $channel->sensor->min_value }}" id="min" type="float" class="form-control" name="min" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="max" class="col-md-4 col-form-label text-md-right">Максимальное значение</label>

                    <div class="col-md-6">
                      <input value="{{ $channel->sensor->max_value }}" id="max" type="float" class="form-control" name="max" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="precautionary_point" class="col-md-4 col-form-label text-md-right">Предупредительная уставка</label>

                    <div class="col-md-6">
                      <input value="{{ $channel->precautionary_point }}" id="precautionary_point" type="float" class="form-control" name="precautionary_point" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="emergency_point" class="col-md-4 col-form-label text-md-right">Аварийная уставка</label>

                    <div class="col-md-6">
                      <input value="{{ $channel->emergency_point }}" id="emergency_point" type="float" class="form-control" name="emergency_point" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="periodicity" class="col-md-4 col-form-label text-md-right">Частота отправки, секунды</label>

                    <div class="col-md-6">
                      <input value="{{ $channel->periodicity }}" min="10" id="periodicity" type="float" class="form-control" name="periodicity" required>
                    </div>
                  </div>

                  <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                      <button type="submit" class="btn btn-primary">
                        Сохранить
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      @else
        <h2 class="text-left ml-2">Минимальное значение: {{ $channel->sensor->min_value }}</h2>
        <h2 class="text-left ml-2">Максимальное значение: {{ $channel->sensor->max_value }}</h2>
      @endauth

        <h2 class="text-left mt-5 ml-2">Установлен на посте:</h2>

        <a href="{{ $channel->post->url }}"><h2 class="ml-2">{{ $channel->post->name }}</h2></a>

        @include('partials.footer')