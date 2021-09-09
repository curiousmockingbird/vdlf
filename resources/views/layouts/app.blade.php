<div id="app" class="invisible">
  @include('partials.header')
  
  <main class="main min-h-screen">
    @yield('content')
  </main>

  @include('partials.footer')
  @if(function_exists("pll_the_languages"))
    <div id="language-switcher" class="hidden"><?php pll_the_languages(array('show_flags'=>1,'show_names'=>1,'hide_if_empty'=>0))?></div>
  @endif
</div>