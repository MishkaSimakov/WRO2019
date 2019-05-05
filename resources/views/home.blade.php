@include('partials.header')
  <h1 class="text-center">Личный кабинет</h1>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Доска объявлений</div>

        <div class="card-body">
          @if(auth()->user()->isAdmin)
            <h2 class="ml-2 text-center">Вы вошли в аккаунт администратора</h2>

            <h3 class="ml-2 mt-3">Добавление оффициальных постов</h3>

            <form method="POST" action="{{ route('admin.add_untrusted') }}">
              @csrf

              <div class="form-group row">
                <label for="mac_address" class="col-md-4 col-form-label text-md-right">Mac адрес поста</label>

                <div class="col-md-6">
                  <input id="mac_address" type="text" class="form-control" name="mac_address" required>
                </div>
              </div>

              <div class="form-group row">
                <label for="code" class="col-md-4 col-form-label text-md-right">Секретный код</label>

                <div class="col-md-6">
                  <input id="code" min="1" max="99" type="number" class="form-control" name="code" required>
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


            <h3 class="ml-2 mt-3">Тестовая отправка данных с поста</h3>

            <form method="POST" action="{{ route('upload') }}">
              <div class="form-group row">
                <label for="message" class="col-md-4 col-form-label text-md-right">Данные</label>

                <div class="col-md-6">
                  <input id="message" type="text" class="form-control" name="message" required>
                </div>
              </div>

              <div class="form-group row">
                <label for="signature" class="col-md-4 col-form-label text-md-right">Подпись</label>

                <div class="col-md-6">
                  <input id="signature" type="text" class="form-control" name="signature" required>
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    Отправить
                  </button>
                </div>
              </div>
            </form>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

@include('partials.footer')