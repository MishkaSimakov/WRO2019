@include('partials.header')

<h1 class="text-center">Посты</h1>

@foreach($posts as $post)
  <h2 class="ml-2"><a href="{{ $post->url }}">{{ $post->name }}</a></h2>
@endforeach

@include('partials.footer')