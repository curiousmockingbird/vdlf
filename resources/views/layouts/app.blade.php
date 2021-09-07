<div id="app" class="invisible">
  @include('partials.header')
  
  <main class="main min-h-screen">
    @yield('content')
  </main>

  @include('partials.footer')
</div>