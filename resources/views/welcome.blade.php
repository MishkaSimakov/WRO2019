@include('partials.header')
    <div id="map" style="height: 100%; width: 100%;"></div>

    <script type="text/javascript">
        ymaps.ready(init);

        function init() {
            var myMap = new ymaps.Map("map" , {
                    center: [1, 1],
                    zoom: 0,
                    controls: ['zoomControl', 'searchControl']
                }, {
                maxAnimationZoomDifference: Infinity,
                searchControlProvider: 'yandex#search'
            })

            @foreach ($currents as $current)
            myPlacemark = new ymaps.Placemark([{{ $current->latitude }}, {{ $current->longitude }}], {
                balloonContentHeader: "{{ $current->channel->post->name }}",
                balloonContentBody: '<a href="{{ $current->channel->url }}">{{ $current->channel->sensor->name }}</a>:  {{ $current->value }} {{ $current->channel->sensor->units }}\n',
                balloonContentFooter: '<a href="{{ $current->channel->post->url }}">Подробнее</a>',
                hintContent: "{{ $current->channel->post->name }}"
            });

            myMap.geoObjects.add(myPlacemark);
            @endforeach

            myMap.margin.setDefaultMargin(50);
            myMap.setBounds(myMap.geoObjects.getBounds(), {
                timingFunction: "ease-in",
                duration: 1000
            })
        }

    </script>
@include('partials.footer')