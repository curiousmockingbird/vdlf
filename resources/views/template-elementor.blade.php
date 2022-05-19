{{-- 
    Template Name: Elementor FullPage
    Template Post Type: post, page, press-releases, news-updates   
--}}

@extends('layouts.app')

@section('content')
    <div class="paragraph">
        @php(the_content())
    </div>
@endsection
