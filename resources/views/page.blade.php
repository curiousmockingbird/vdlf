@extends('layouts.app')

@section('content')
  <page-header 
  @if (get_the_post_thumbnail_url() && get_the_post_thumbnail_url() !="") 
    image-url="{{ get_the_post_thumbnail_url(null, 'original') }}" 
  @endif
  >
    <h2 class="text-black font-display">@php(the_title())</h2>
  </page-header>
  <div class="list-style-enable container pt-10">
      @php(the_content())
  </div>
@endsection