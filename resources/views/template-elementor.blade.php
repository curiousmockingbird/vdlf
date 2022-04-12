{{-- 
    Template Name: Elementor FullPage
    Template Post Type: post, page, press-releases, news-updates   
--}}

@extends('layouts.app')

@section('content')
    <div class="list-style-enable">
        @php(the_content())
    </div>

@endsection
