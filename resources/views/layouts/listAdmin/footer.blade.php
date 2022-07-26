
</body>

<!--   Core JS Files   -->
<script src="{{asset('assets/js/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>

<!--  Charts Plugin -->
<script src="{{asset('assets/js/chartist.min.js')}}"></script>

<!--  Notifications Plugin    -->
<script src="{{asset('assets/js/bootstrap-notify.js')}}"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="{{asset('assets/js/light-bootstrap-dashboard.js?v=1.4.0')}}"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="{{asset('assets/js/demo.js')}}"></script>
<!-- CK Editor-->
<script src="{{asset('ckeditor-main/ckeditor.js')}}"></script>
<script src="{{asset('ckfinder/ckfinder.js')}}"></script>
<!-- select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@yield('js')
</html>
