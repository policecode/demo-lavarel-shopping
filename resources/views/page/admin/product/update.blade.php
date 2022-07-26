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
                <div class="col">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Thêm sản phẩm mới</h4>
                            <hr>
                            <a href="{{ route('admin.product.list') }}" class="btn btn-danger btn-fill pull-center">Quay
                                lại trang danh sách</a>

                        </div>
                        <div class="content">
                            <form id="form-category" action="{{ route('admin.product.update') }}" method="post"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tên sản phẩm</label>
                                            {{-- <p>{{!empty(old('name'))?old('name'):false}}</p> --}}
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Nhập tên sản phẩm..."
                                                value="{{ !empty(old('name')) ? old('name') : $firstProduct->name }}">
                                            @if ($errors->has('name'))
                                                <span style="color:red;" class="errors">
                                                    {{ $errors->first('name') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Chọn danh mục sản phẩm</label>
                                            <select name="category_id" class="form-control form-control-sm">
                                                <option value="">--- Chọn danh mục ---</option>
                                                @if (!empty($listCategory))
                                                    {{ loadOptions($listCategory, 0, '', !empty(old('category_id')) ? old('category_id') : $firstProduct->category_id) }}
                                                @endif
                                            </select>
                                            @if ($errors->has('category_id'))
                                                <span style="color:red;" class="errors">
                                                    {{ $errors->first('category_id') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Giá sản phẩm</label>
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <input type="number" class="form-control" name="price"
                                                        placeholder="Giá sản phẩm..."
                                                        value="{{ !empty(old('price')) ? old('price') : $firstProduct->price }}">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" disabled class="form-control" value="VNĐ">
                                                </div>
                                            </div>
                                            @if ($errors->has('price'))
                                                <span style="color:red;" class="errors">
                                                    {{ $errors->first('price') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nhập tag cho sản phẩm</label>
                                            <select class="form-control js-example-tags" name="tags[]" multiple="multiple">
                                                @if (!empty($allTag))
                                                    @foreach ($allTag as $item)
                                                        <option
                                                            {{ selectedTag($listProductTag, $item->id) }}>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ckfinder-group">
                                            <label>Ảnh đại diện</label>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control image-render"
                                                        name="feature_image_path"
                                                        value="{{ !empty(old('feature_image_path'))?old('feature_image_path'):$firstProduct->feature_image_path }}">
                                                </div>
                                                <div class="col-md-3">
                                                    <span class="btn btn-primary btn-fill choose-image">Chọn ảnh</span>
                                                </div>
                                            </div>
                                            <img src="{{ !empty(old('feature_image_path'))?old('feature_image_path'):$firstProduct->feature_image_path }}" class="selectorImageJs"
                                                alt="">
                                            @if ($errors->has('feature_image_path'))
                                                <span style="color:red;" class="errors">
                                                    {{ $errors->first('feature_image_path') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Ảnh chi tiết</label>
                                        <div class="form-group form-path">
                                            @if (!empty($listProductImage))
                                            @php
                                                // Chuyển từ collect về mảng để xử lý 
                                                $arr = renderArrImagePath($listProductImage);
                                                if (!empty(old('image_path'))) {
                                                    $arr = old('image_path');
                                                }
                                            @endphp
                                                @foreach ($arr as $item)
                                                    <div class="row ckfinder-group">
                                                        <div class="col-md-8">
                                                            <input type="text"
                                                                value="{{ $item }}"class="form-control image-render"
                                                                name="image_path[]">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <span class="btn btn-primary btn-fill choose-image">Chọn
                                                                ảnh</span>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <span class="btn btn-danger btn-fill close-path"><i
                                                                    class="pe-7s-trash"></i></span>
                                                        </div>
                                                        <span style="color:red;" class="errors"></span>
                                                    </div>
                                                @endforeach
                                            @endif

                                        </div>
                                        <span class="btn btn-success btn-fill add-path">Thêm ảnh</span>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Mô tả</label>
                                            <textarea name="content" class="form-control editor" rows="5" placeholder="Mô tả sản phẩm...">
                                                {{ json_decode(!empty(old('content'))?old('content'):$firstProduct->content, true) }}
                                            </textarea>
                                            @if ($errors->has('content'))
                                                <span style="color:red;" class="errors">
                                                    {{ $errors->first('content') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info btn-fill pull-right">Cập nhật</button>
                                <div class="clearfix"></div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control">
                                <input type="hidden" name="_method" value="put" class="form-control">
                                <input type="hidden" name="id" value="{{ $firstProduct->id }}"
                                    class="form-control">
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
            demo.showNotification('top', 'center', {{ session('product') }}, 'pe-7s-like2', 2);
        </script>
    @endif
    @if (!empty($sessionData['update']))
        <script>
            demo.showNotification('top', 'center', '{{ $sessionData['update'] }}', 'pe-7s-like2', 2);
        </script>
    @endif
@endsection
{{-- end js --}}
