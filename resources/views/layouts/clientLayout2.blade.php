@include('layouts.listClient.header')

<!-- Wrap -->
<div id="wrap">
    <!-- header -->
    @include('layouts.listClient.headerNavbar')
    <!--======= HOME MAIN SLIDER =========-->
    
    @include('layouts.listClient.slider2')
    <div id="content">

        @yield('main-wrap')

        @include('layouts.listClient.newsletter')
    </div>
</div>
<!-- Content -->
@include('layouts.listClient.footer')
