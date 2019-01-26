@include('partials.header')

    <div id="map"></div>

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