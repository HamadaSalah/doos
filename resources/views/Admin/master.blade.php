@include('Admin.layouts.header')

@include('Admin.layouts.menu')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden">

    @include('Admin.layouts.nav')
    @include('Admin.layouts.messages')

    @yield('content')

</main>
@include('Admin.layouts.footer')
