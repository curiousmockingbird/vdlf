<main-header 
    blog-name="{{ get_bloginfo('name', 'display') }}" 
    homepage-url="{{ home_url('/') }}" 
    {{-- @if (is_front_page()) bg-white="true" @endif --}}
>
    @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'echo' => false]) !!}
    @endif

    <template v-slot:mobile>
        @if (has_nav_menu('mobile_navigation'))
            {!! wp_nav_menu(['theme_location' => 'mobile_navigation', 'menu_class' => 'nav', 'echo' => false, 'after' => '<span></span>']) !!}
        @else
            {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'echo' => false, 'after' => '<span></span>']) !!}
        @endif
    </template>
</main-header>