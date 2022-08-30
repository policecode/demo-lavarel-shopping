@extends('layouts.adminLayout')

{{-- start CSS --}}
@section('css')
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ asset('assets/css/demo.css') }} " rel="stylesheet" />
@endsection
{{-- end CSS --}}

{{-- start main-panel --}}
@section('main-panel')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Thay đổi thông tin nhóm: {{ $group->name }}</h4>
                            <hr>
                            <a href="{{ route('admin.groups.index') }}" class="btn btn-danger btn-fill pull-center">Quay lại
                                trang danh
                                sách</a>

                        </div>
                        <div class="content">
                            <form id="form-category" method="post" action="{{ route('admin.groups.edit', ['group' => $group]) }}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tên nhóm</label>
                                            <input type="text" class="form-control" name="name" id=""
                                                placeholder="Nhập tên nhóm" value="{{ $group->name }}">
                                            @error('name')
                                                <span style="color:red;" class="errors">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-info btn-fill pull-right">Cập nhật</button>
                                <div class="clearfix"></div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control">
                                {{-- <input type="hidden" name="_method" value="put" class="form-control"> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- end main-panel --}}

{{-- start js --}}
@section('js')
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    @if (session('msg'))
        <script>
            window.onload = function() {
                demo.showNotification('top', 'center', '{{ session('msg') }}', 'pe-7s-like2', 2);
            }
        </script>
    @endif
@endsection
{{-- end js --}}
