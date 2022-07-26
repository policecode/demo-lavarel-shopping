@extends('layouts.adminLayout')

{{-- start CSS --}}
@section('css')
    <link href="{{ asset('assets/css/custom.css') }} " rel="stylesheet" />
@endsection
{{-- end CSS --}}

{{-- start main-panel --}}
@section('main-panel')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <a href="{{route('admin.settings.update.home')}}" class="box_setting color-0">
                        <img src="{{ asset('assets/images/1647541196_72_1001.jpg') }}" class="box_setting-img" alt="">
                        <div class="box_setting-content">
                            Trang chủ
                        </div>
                    </a>
                </div>
                {{-- <div class="col-md-4 mb-4">
                    <a href="#" class="box_setting color-1">
                        <img src="{{ asset('assets/images/1647541196_875_1001.jpg') }}" class="box_setting-img"
                            alt="">
                        <div class="box_setting-content">
                            Trang blog
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="#" class="box_setting color-2">
                        <img src="{{ asset('assets/images/1647541196_599_1001.jpg') }}" class="box_setting-img"
                            alt="">
                        <div class="box_setting-content">
                            Trang mua săm
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="#" class="box_setting color-3">
                        <img src="{{ asset('assets/images/1647541196_340_1001.jpg') }}" class="box_setting-img"
                            alt="">
                        <div class="box_setting-content">
                            Trang chi tiết
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="#" class="box_setting color-4">
                        <img src="{{ asset('assets/images/1647541196_980_1001.jpg') }}" class="box_setting-img"
                            alt="">
                        <div class="box_setting-content">
                            Trang ý kiến khách hàng
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="#" class="box_setting color-5">
                        <img src="{{ asset('assets/images/1647541196_786_1001.jpg') }}" class="box_setting-img"
                            alt="">
                        <div class="box_setting-content">
                            Trang thiết kế
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="#" class="box_setting color-0">
                        <img src="{{ asset('assets/images/1647541196_837_1001.jpg') }}" class="box_setting-img"
                            alt="">
                        <div class="box_setting-content">
                            Trang sản phẩm
                        </div>
                    </a>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
{{-- end main-panel --}}

{{-- start js --}}
@section('js')
    @if (!empty($sessionData['DBsuccess']))
        <script>
            demo.showNotification('top', 'center', '{{ $sessionData['DBsuccess'] }}', 'pe-7s-like2', 2);
        </script>
    @endif
    @if (!empty($sessionData['DBerror']))
        <script>
            demo.showNotification('top', 'center', '{{ $sessionData['DBerror'] }}', 'pe-7s-close-circle', 4);
        </script>
    @endif
    <script>
        let jsDelete = document.querySelectorAll('.form-delete-product');
        if (jsDelete) {
            jsDelete.forEach(element => {
                element.onclick = function(e) {
                    const check = confirm('Bạn có chắc chắn muốn xóa không?');
                    if (!check) {
                        e.preventDefault();
                    }
                }
            });
        }
    </script>
@endsection
{{-- end js --}}
