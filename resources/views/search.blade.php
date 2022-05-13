@extends('layouts.app')
@php 
$limitStart = 0;
$limitEnd = $limitStart+300;
@endphp
@section('content')
<page-header 
@if (get_the_post_thumbnail_url() && get_the_post_thumbnail_url() !="") 
  image-url="{{ get_the_post_thumbnail_url(null, 'original') }}" 
@endif
>
  <h1 class="text-3xl">Search Result for "{{ the_title() }}" </h1>
</page-header>
  <div class="container paragraph text-content px-5 pt-10 pb-14">
    <div class="mt-7 mb-5">{!! get_search_form(false) !!}</div>
    @if (have_posts())
      @while(have_posts()) @php(the_post())
        <?php 
        $categories = wp_get_post_terms(get_the_ID(), 'category') ;
        ?>
        <div class="border-b border-dashed border-gray-300 py-3">
          <header>
            <h2 class="font-display text-2xl no-underline" style="margin-bottom:0">
              <a class="no-underline" href="{{ get_permalink() }}?keyword={{ $_REQUEST['s'] }}">
                {!! the_title() !!}
              </a>
            </h2>
          @if ($categories && count($categories) >0)
          <?php 
          $category = $categories[0]; 
          ?>
          in <a href="<?php echo get_term_link($category->slug,"category");?>" class="no-underline font-semibold text-darkGreen mb-3"><?php echo ucwords($category->name); ?></a>, date of publication : {{ get_the_date()}}
          @endif
          </header>
          <?php 
          $keywords=$_REQUEST['s']; 
          $content = strip_tags(get_the_content());
          $keys = explode(" ",$keywords);
          $found = 0;
          foreach ($keys as $key) {
            $found = stripos($content, $key);
            if ($found) {
              $limitStart = $found-50 < 0 ? 0 : $found-50;
              $limitEnd = $limitStart+100 > strlen($content) ? strlen($content) : $limitStart+100;
              break;
            }
          }

          $content = substr($content, $limitStart, $limitEnd);
          foreach ($keys as $keyword) {
            $content = preg_replace("/\w*?".preg_quote($keyword)."\w*/i", "<mark>$0</mark>", $content);
          }
          ?>
          <div class="entry-summary">
            {!! $content !!}
          </div>
        </div>
      @endwhile
      <div class="pt-10">
        {!! get_the_posts_navigation() !!}
      </div>
    @else
      <div class="border-b border-dashed border-gray-300 py-3">
        {{ sprintf(__('Sorry, no results were found for "%s"', 'sage'), \get_search_query()) }} 
      </div>
    @endif
    
  </div>
@endsection