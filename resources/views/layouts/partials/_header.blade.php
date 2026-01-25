<header
  class="bg-gray-900 shadow-lg relative top-8"
  x-data="{ open: false, loggedIn: true, userMenuOpen: false }">
  @include('layouts.partials.nav._main')

  <!-- Menu pour mobile -->
  @include('layouts.partials.nav._mobile')
</header>