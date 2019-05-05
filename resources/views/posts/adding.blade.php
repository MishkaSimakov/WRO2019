@include('partials.header')

<h1 class="text-center">Добавление постов</h1>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Введите данные, как показано в инструкции к посту</div>

        <div class="card-body">
          <form method="POST" action="{{ route('posts.confirm') }}">
            @csrf

            <div class="form-group row">
              <label for="name" class="col-md-4 col-form-label text-md-right ">Название поста</label>

              <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" required>
              </div>
            </div>

            <div class="form-group row">
              <label for="mac" class="col-md-4 col-form-label text-md-right">Адрес поста</label>

              <div class="col-md-6">
                <input id="mac" type="text" class="form-control{{ $errors->has('mac') ? ' is-invalid' : '' }}" value="{{ old('mac') }}" name="mac" required>

                @if ($errors->has('email'))
                  <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mac') }}</strong>
                                    </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="code" class="col-md-4 col-form-label text-md-right">Код поста</label>

              <div class="col-md-6">
                <input id="code" type="text" class="form-control" name="code" required>
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  Добавить
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@include('partials.footer')