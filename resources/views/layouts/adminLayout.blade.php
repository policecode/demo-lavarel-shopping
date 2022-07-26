@include('layouts.listAdmin.header')


<div class="wrapper">

    @include('layouts.listAdmin.sidebar')

    <div class="main-panel">
        @include('layouts.listAdmin.main-navbar')
        @yield('main-panel')
        @include('layouts.listAdmin.main-footer')
    </div>
</div>

@include('layouts.listAdmin.footer')
