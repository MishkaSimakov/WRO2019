@include('partials.header')

<h1 class="text-center">{{ $status->name }}</h1>

@auth
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Редактирование</div>

          <div class="card-body">
            <form method="PUT" action="{{ route('statuses.edit', compact('status')) }}">
              @csrf

              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Название</label>

                <div class="col-md-6">
                  <input value="{{ $status->name }}" id="name" type="text" class="form-control" name="name" required>
                </div>
              </div>

              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Цвет</label>

                <div class="col-md-6">
                  <input value="{{ $status->color }}" id="color" type="color" class="form-control" name="color" required>
                </div>
              </div>

              <div class="form-group row">
                <label for="code" class="col-md-4 col-form-label text-md-right">Программа</label>

                <div class="col-md-6">
                  <textarea id="code" class="form-control" name="code" required>{{ $status->code }}</textarea>
                </div>
              </div>

              <div class="form-group row">
                <label for="issue" class="col-md-4 col-form-label text-md-right">Выделение</label>

                <div class="col-md-6">
                  <select class="browser-default custom-select" name="issue" id="isuue" value="{{ $status->issue }}">
                    <option class="list-group-item-success" value="list-group-item-success"
                            @if($status->issue == 'list-group-item-success')
                            selected
                        @endif
                    >Выделять зелёным</option>
                    <option class="list-group-item-warning" value="list-group-item-warning"
                            @if($status->issue == 'list-group-item-warning')
                            selected
                        @endif
                    >Выделять оранжевым</option>
                    <option class="list-group-item-danger" value="list-group-item-danger"
                            @if($status->issue == 'list-group-item-danger')
                            selected
                        @endif>Выделять красным</option>
                  </select>
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
@endauth

@include('partials.footer')