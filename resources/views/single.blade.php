@extends('layouts.app')

@section('content')
  <page-header 
  @if (get_the_post_thumbnail_url() && get_the_post_thumbnail_url() !="") 
    image-url="{{ get_the_post_thumbnail_url(null, 'original') }}" 
  @endif
  >
    <h1>@php(the_title())</h1>
  </page-header>
  <div class="list-style-enable container py-16">
      @php(the_content())
  </div>
@endsection