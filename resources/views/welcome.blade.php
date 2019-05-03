@include('partials.header')

<div class="my-0 p-0 w-100">
    <div id="map" class="m-0 p-0 w-100" style="height: 91.7vh;"></div>
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

        @foreach ($posts as $post)
            @if($post->current->id != null)
            @if($post->IsGPSconnected == false)
            myPlacemark = new ymaps.Placemark([{{ $post->default_latitude }}, {{ $post->default_longitude }}], {
            balloonContentHeader: '<h3 class="text-center">{{ $post->name }}</h3>',
            balloonContentBody: '<ul class="list-group list-group-flush">' @foreach($post->currents as $current)
            + "<li class='list-group-item'><a href='{{ $current->channel->url }}'>{{ $current->channel->sensor->name }}</a>: {{ $current->value }} {{ $current->channel->sensor->units }}(<a href='{{ $current->status->url }}' style='color: {{ $current->status->color }}'>{{ $current->status->name }}</a>)<br>"
            + "{{ $current->date->format('d-m-y H:i') }}</li>"
            @endforeach,
            balloonContentFooter: '<a href="{{ $post->url }}">Подробнее</a>',
            hintContent: "{{ $post->name }}"
        }, {
            iconColor: "{{ $post->current->status->color }}"
        });
        @else
            myPlacemark = new ymaps.Placemark([{{ $post->current->longitude }}, {{ $post->current->latitude }}], {
            balloonContentHeader: "{{ $post->name }}",
            balloonContentBody: '' @foreach($post->currents as $current)
            + "<a href='{{ $current->channel->url }}'>{{ $current->channel->sensor->name }}</a> : {{ $current->value }} {{ $current->channel->sensor->units }}(<a href='{{ $current->status->url }}' style='color: {{ $current->status->color }}'>{{ $current->status->name }}</a>)<br>"
            + "{{ $current->date->format('d-m-y H:i') }}<hr>"
            @endforeach,
            balloonContentFooter: '<a href="{{ $post->url }}">Подробнее</a>',
            hintContent: "{{ $post->name }}"
        }, {
            iconColor: "{{ $post->current->status->color }}"
        });
        @endif

        myMap.geoObjects.add(myPlacemark);
        @endif
        @endforeach

        myMap.margin.setDefaultMargin(50);
        myMap.setBounds(myMap.geoObjects.getBounds(), {
            timingFunction: "ease-in",
            duration: 1000
        })
    }
</script>

@include('partials.footer')