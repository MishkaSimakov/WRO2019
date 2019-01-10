@include('partials.header')

<h1>{{ $post->name }}</h1>
<h2>Просмотр значений</h2>

@foreach($archives as $archive)
<a href="{{ $archive->channel->url }}"><h2>{{ $archive->channel->sensor->name }}:  {{ $archive->value }} {{ $archive->channel->sensor->units }}</h2></a><time title="{{ $archive->date }}">{{ date('H', $archive->date) }}</time>
@endforeach

@include('partials.footer')