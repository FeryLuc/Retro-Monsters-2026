<!DOCTYPE html>
<html lang="fr">

  @include('layouts.partials._head')

  <body class="bg-gray-800 text-white font-sans">
    <!-- Header -->
    @include('layouts.partials._header')
    @if (session('success'))
        <div id="flash-message" class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-lg z-50">{{session('success')}}</div>
    @endif
    <script>
        setTimeout(() => {
            const flash = document.getElementById('flash-message');
            if(flash){
                flash.classList.add('opacity-0', 'transition', 'duration-1000'); // 1 seconde fade
                setTimeout(() => flash.remove(), 1000); // supprime après fade
            }
        }, 2000); // attend 2 secondes avant de commencer
    </script>
    <!-- Main Content -->
    @include('layouts.partials._main')

    <!-- Footer -->
    @include('layouts.partials._footer')
  </body>
</html>
