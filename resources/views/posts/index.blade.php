@include('partials.header')

<h1 class="header">Посты</h1>

@foreach($posts as $post)
  <h2 class="list"><a href="{{ $post->url }}">{{ $post->name }}</a></h2>
@endforeach

@include('partials.footer')