<div class="container mx-auto flex flex-wrap pt-4 pb-12">
    <main class="w-full md:w-3/4 p-4">
        @yield('content')
    </main>

    <!-- Sidebar -->
    @include('layouts.partials._aside')
</div>