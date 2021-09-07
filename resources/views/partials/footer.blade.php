@php 
  $itsLabel = "Website developed <a href='http://indietechsolutions.com/' target='_blank'>Indietech</a>";
@endphp
<main-footer its-label="{{ $itsLabel }}">
    @if (has_nav_menu('footer_navigation'))
      {!! wp_nav_menu(['theme_location' => 'footer_navigation', 'menu_class' => 'nav', 'echo' => false]) !!}
    @endif
  <template v-slot:navigation>
    @if (has_nav_menu('copyright_navigation'))
      {!! wp_nav_menu(['theme_location' => 'copyright_navigation', 'menu_class' => 'nav', 'echo' => false]) !!}
    @endif
  </template>
</main-footer>