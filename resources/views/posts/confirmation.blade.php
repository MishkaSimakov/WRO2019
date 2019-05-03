@include('partials.header')

<h1 class="text-center">Добавление постов</h1>

@foreach($posts as $post)
  <h2><a href="{{ route('posts.confirm') }}">{{ $post->mac_address }}</a></h2>
@endforeach

@include('partials.footer')

{{--@include('partials.header')--}}

{{--<h1 class="text-center">Добавление постов</h1>--}}

{{--<div class="container">--}}
  {{--<div class="row justify-content-center">--}}
    {{--<div class="col-md-8">--}}
      {{--<div class="card">--}}
        {{--<div class="card-header">Введите код на посте контроля</div>--}}

        {{--<div class="card-body">--}}
        {{--<form method="PUT" action="{{ route('posts.edit', compact('post')) }}">--}}
          {{--@csrf--}}

          {{--<div class="form-group row">--}}
            {{--<label for="name" class="col-md-4 col-form-label text-md-right">Защитный код</label>--}}

            {{--<div class="col-md-6">--}}
              {{--<input value="{{ $post->name }}" id="name" type="text" class="form-control" name="name" required>--}}
            {{--</div>--}}
          {{--</div>--}}
        {{--</form>--}}
        {{--</div>--}}
      {{--</div>--}}
    {{--</div>--}}
  {{--</div>--}}
{{--</div>--}}

{{--@include('partials.footer')--}}