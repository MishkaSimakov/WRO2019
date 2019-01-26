@include('partials.header')

<h1 class="header">{{ $post->name }}</h1>

@foreach($post->channels as $channel)
  <div class="box">
    <h2><a href="{{ $channel->url }}"><span>{{ $channel->sensor->name }}</span></a></h2>

  <div class="hide">
  <ul>
  @foreach($channel->archives as $archive)
    <li>
      <a href="{{ $archive->status->url }}">
        <h2 style="color: {{ $archive->status->color }}" title="{{ $archive->status->name }}">
          {{ $archive->value }} {{ $archive->channel->sensor->units }}

          <time>{{ $archive->date->format('d-m-y H:i') }}</time>
        </h2>
      </a>
    </li>
  @endforeach
  </ul>

  <hr>

  <div id="graph_div_{{ $channel->id }}"></div>

  </div>
  </div>

  {!! \Lava::render('AreaChart', 'graph' . $channel->id, 'graph_div_'.$channel->id) !!}
@endforeach

@include('partials.footer')