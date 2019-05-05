@include('partials.header')

<h1 class="text-center">{{ $post->name }}</h1>

<!--
<div class="container my-0 p-0 w-100">
  <div id="map" class="m-0 p-0 w-100" style="min-height: 100vh;"></div>
</div>

<script type="text/javascript">
    ymaps.ready(init);

    function init() {
        var myMap = new ymaps.Map("map" , {
            center: [1, 1],
            zoom: 0,
            controls: ['zoomControl']
        }, {
            maxAnimationZoomDifference: Infinity,
            searchControlProvider: 'yandex#search'
        });

        var myPolyline = new ymaps.Polyline([
            // Указываем координаты вершин ломаной.
            @foreach($post->archives as $archive)
              @if($post->IsGPSconnected == false)
                [{{ $post->default_latitude }}, {{ $post->default_longitude }}],
              @else
                [{{ $archive->latitude }}, {{ $archive->longitude }}],
              @endif
          @endforeach
        ], {
            // Описываем свойства геообъекта.
            // Содержимое балуна.
            balloonContent: "Передвижение поста"
        }, {
            // Задаем опции геообъекта.
            // Отключаем кнопку закрытия балуна.
            balloonCloseButton: false,
            // Цвет линии.
            strokeColor: "#000000",
            // Ширина линии.
            strokeWidth: 4,
            // Коэффициент прозрачности.
            strokeOpacity: 0.5
        });

        myMap.geoObjects.add(myPolyline);

        myMap.setBounds(myMap.geoObjects.getBounds(), {
            timingFunction: "ease-in",
            duration: 1000
        })
    }
</script>-->

    @foreach($post->channels as $channel)
          <div class="p-3 col-md-5 col-sm-5 m-2 d-inline-block container  mx-md-5 mx-sm-4" style="border: 1px solid lightgray; border-radius: 10px;">
            <h2 class="text-center mb-4"><a href="{{ $channel->url }}"><span>{{ $channel->sensor->name }}</span></a></h2>

            <div id="graph{{ $channel->id }}"></div>

          <ul class="list-inline mb-0 text-left">
            <li class="list-inline-item"><a href="" class="spoiler_links_day" onclick="loadData({{ $channel->id }}, 1)">за день</a></li>
            <li class="list-inline-item"><a href="" class="spoiler_links_week" onclick="loadData({{ $channel->id }}, 7)">за неделю</a></li>
            <li class="list-inline-item"><a href="" class="spoiler_links_year" onclick="loadData({{ $channel->id }}, 365)">за год</a></li>
            <li class="list-inline-item"><a href="" class="spoiler_links_all" onclick="loadData({{ $channel->id }}, 'all')">за всё время</a></li>
          </ul>

            <div style="display: none" class="spoiler_body">
              <ul id="{{ $channel->id }}" class="list-group list-group-flush">
                <!-- Сюда вставляются значения с датчиков при динамической загрузке -->
              </ul>

              <a href="" class="spoiler_links_hide">скрыть</a>
              {!! \Lava::render('LineChart', 'graph' . $channel->id, 'graph' . $channel->id) !!}
            </div>


          </div>
    @endforeach

@auth
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Редактирование</div>

          <div class="card-body">
            <form method="PUT" action="{{ route('posts.edit', compact('post')) }}">
              @csrf

              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Имя поста</label>

                <div class="col-md-6">
                  <input value="{{ $post->name }}" id="name" type="text" class="form-control" name="name" required>
                </div>
              </div>

              @if ($post->IsGPSconnected == false)
                <div class="form-group row">
                  <label for="latitude" class="col-md-4 col-form-label text-md-right">Широта по умолчанию</label>

                  <div class="col-md-6">
                    <input value="{{ $post->default_latitude }}" id="latitude" type="float" class="form-control" name="latitude" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="longitude" class="col-md-4 col-form-label text-md-right">Долгота по умолчанию</label>

                  <div class="col-md-6">
                    <input value="{{ $post->default_longitude }}" id="longitude" type="float" class="form-control" name="longitude" required>
                  </div>
                </div>
              @endif

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

<script type="text/javascript">
  $(document).ready(function(){
      $('.spoiler_links_day').click(function(){
          $(this).parent().parent().parent().children('.spoiler_body').show('normal');

          return false;
      });
      $('.spoiler_links_week').click(function(){
          $(this).parent().parent().parent().children('.spoiler_body').show('normal');

          return false;
      });
      $('.spoiler_links_year').click(function(){
          $(this).parent().parent().parent().children('.spoiler_body').show('normal');

          return false;
      });
      $('.spoiler_links_all').click(function(){
          $(this).parent().parent().parent().children('.spoiler_body').show('normal');

          return false;
      });

      $('.spoiler_links_hide').click(function(){
          $(this).parent().hide('normal');

          return false;
      });

      @foreach($post->channels as $channel)
        loadData({{ $channel->id }}, 1)
      @endforeach
  })

  function loadData(channel_id, time, post_id = {{ $post->id }}) {
      $('#' + channel_id).html('<li class="list-group-item"><h2>Загрузка</h2></li>')

      $.ajax({
          url: "{{ route('data.load') }}",
          method: "GET",
          dataType: 'json',
          data: {
              channel_id: channel_id,
              post_id: post_id,
              time: time
          },
          success: function(data) {
              $('#' + channel_id).html(data)
          }
      })

      $.ajax({
          url: "{{ route('channels.chart') }}",
          method: "GET",
          dataType: 'json',
          data: {
              channel_id: channel_id
          },
          success: function(data) {
              lava.loadData('graph' + channel_id, data);
          }
      })
  }
</script>

@include('partials.footer')