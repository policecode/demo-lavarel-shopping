@extends('layouts.adminLayout')

{{-- start CSS --}}
@section('css')
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
                            <h4 class="title">Thêm slider mới</h4>
                            <hr>
                            <a href="{{ route('admin.slider.list') }}" class="btn btn-danger btn-fill pull-center">Quay lại trang danh sách</a>

                        </div>
                        <div class="content">
                            <form id="form-category" action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tên Slider</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Nhập tên slider..." value="{{old('name')}}">
                                            @if ($errors->has('name'))
                                                <span style="color:red;" class="errors">
                                                    {{ $errors->first('name') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ckfinder-group">
                                            <label>Ảnh đại diện slider</label>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control image-render"
                                                        name="image_path" value="{{old('image_path')}}">
                                                </div>
                                                <div class="col-md-3">
                                                    <span class="btn btn-primary btn-fill choose-image">Chọn ảnh</span>
                                                </div>
                                            </div>
                                            @if ($errors->has('image_path'))
                                                <span style="color:red;" class="errors">
                                                    {{ $errors->first('image_path') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Mô tả của slider</label>
                                            <textarea name="description" class="form-control" rows="5" placeholder="Mô tả sản phẩm...">
                                                {{old('description')}}
                                            </textarea>
                                            @if ($errors->has('description'))
                                                <span style="color:red;" class="errors">
                                                    {{ $errors->first('description') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info btn-fill pull-right">Thêm mới</button>
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
    @if ($errors->any())
        <script>
            demo.showNotification('top', 'center', 'Vui lòng kiểm tra lại dữ liệu', 'pe-7s-close-circle', 4);
        </script>
    @endif
    @if (!empty(session('product')))
        <script>
            demo.showNotification('top', 'center', {{session('product')}}, 'pe-7s-like2', 2);
        </script>
    @endif
@endsection
{{-- end js --}}
