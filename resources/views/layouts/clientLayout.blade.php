@include('layouts.listClient.header')


<!-- LOADER -->
{{-- <div id="loader">
  <div class="position-center-center">
    <div class="ldr"></div>
  </div>
</div> --}}

<!-- Wrap -->
<div id="wrap"> 
  
  <!-- header -->
  @include('layouts.listClient.headerNavbar')

  
  <!--======= HOME MAIN SLIDER =========-->
  @include('layouts.listClient.slider')

  @yield('main-wrap')
  
  <!-- Content -->

  
@include('layouts.listClient.footer')
  