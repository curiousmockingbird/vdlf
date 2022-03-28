@extends('layouts.app')

@section('content')
  @if (! have_posts())
    <page-header 
    @if (get_the_post_thumbnail_url() && get_the_post_thumbnail_url() !="") 
      image-url="{{ get_the_post_thumbnail_url(null, 'original') }}" 
    @endif
    >
      <h1 class="text-3xl">{!! __('Sorry, but the page you are trying to view does not exist.', 'sage') !!}</h1>
    </page-header>
    <div class="container text-formatting-enable text-content px-5 pt-10 pb-14">
      <div class="mt-7 mb-5">{!! get_search_form(false) !!}</div>
    </div>
  @endif
@endsection
