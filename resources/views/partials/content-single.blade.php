@php 

$image = get_the_post_thumbnail_url(get_the_ID()) ? get_the_post_thumbnail_url(get_the_ID(), 'original') : null;
$tags = get_the_tags() ? array_map(function($tag) {
    return $tag->slug;
}, get_the_tags()) : null;

$tagName = get_the_tags() ? array_map(function($tag) {
    return $tag->name;
}, get_the_tags()) : null;

$categorySlug = wp_get_post_terms(get_the_ID(), 'category') ? array_map(function($tag) {
    return $tag->slug;
}, wp_get_post_terms(get_the_ID(), 'category')) : null;

$tagSlug = get_the_tags() ? implode(",",$tags) : null;
$tagString = get_the_tags() ? implode(",",$tagName) : null;

$categories  = wp_get_post_terms(get_the_ID(), 'category'); 

if ($categorySlug) {
  $categorySlug = implode(",",$categorySlug);
}else{
  $categorySlug = "/";
}

@endphp
<section class="elementor-section elementor-section-boxed">
  <article class="elementor-container">
      <article-header 
        title="{!! $title !!}" 
        author="{{ get_the_author() }}" 
        date="{{ get_the_date() }} "
        description="{{ get_the_excerpt() }}"
        tags="{{$tagSlug}}"
        categories="{{ json_encode($categories) }}"
        class="md:px-2"
      >    
      </article-header>

      <article-content 
        tags="{{ get_the_tags() ? json_encode(get_the_tags()) : null }}" 
        @if ($image) image="{{ $image }}" @endif
        class="md:px-2"
        >
        @php(the_content())
      </article-content>

      <recent-post 
        exclude="{{ get_the_ID() }}" 
        category-slug="{{ $categorySlug }} "
        class="md:px-2">
      </recent-post>
  </article>
</section>