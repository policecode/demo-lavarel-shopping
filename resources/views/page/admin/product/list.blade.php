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
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Danh sách sản phẩm</h4>
                            <hr>
                            <a href="{{ route('admin.product.add') }}" class="btn btn-primary btn-fill pull-center">Thêm
                                sản phẩm mới</a>
                        </div>
                        <hr>
                        {{-- From tìm kiếm Start--}}
                        <form id="form-category" action="" method="get" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="keyword"
                                                placeholder="Nhập từ khóa tìm kiếm..." value="{{old('keyword')}}">
                                    </div>
                                </div>
                               
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select name="category_id" class="form-control form-control-sm">
                                            <option value="">--- Chọn danh mục ---</option>
                                            @if (!empty($listCategory))
                                                {{ loadOptions($listCategory, 0, '', old('category_id')) }}
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Tìm kiếm</button>
                                </div>
                            </div>
                        </form>
                        {{-- Form tìm kiếm end --}}

                        {{-- Bảng sản phẩm start --}}
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th width="5%">STT</th>
                                    <th>Tên Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Hình ảnh</th>
                                    <th>Danh mục</th>
                                    <th width="10%">Sửa</th>
                                    <th width="10%">Xóa</th>
                                </thead>
                                <tbody>
                                    @if ($getAllProduct->count() > 0)
                                        @foreach ($getAllProduct as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ number_format($item->price) }}</td>
                                                <td>
                                                    <img src="{{ $item->feature_image_path }}" alt="Ảnh đang bị lỗi"
                                                        class="avatar border-gray img-size" />

                                                </td>
                                                <td>{{ $item->category_name }}</td>
                                                <td>
                                                    <a href="{{ route('admin.product.formUpdate', ['id' => $item->id]) }}"
                                                        class="btn btn-warning btn-fill pull-center">
                                                        <i class="pe-7s-settings"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.product.sortDelete') }}" method="post"
                                                        class="form-delete-product">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="hidden" name="id" value="{{ $item->id }}" />
                                                        <button class="btn btn-danger btn-fill pull-center js-delete">
                                                            <i class="pe-7s-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <td colspan="7" style="text-align: center;">Không có thông tin</td>
                                    @endif


                                </tbody>
                            </table>

                            {{-- Start pagination --}}
                            <nav aria-label="Page navigation example" style="text-align: center;">
                                <ul class="pagination ">
                                    <li class="page-item">
                                        @if ($pagination['prev'] >= 1)
                                            <a class="page-link" href="{{ handleUrlPaging($queryArr, $pagination['prev'])}}"
                                                aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        @endif
                                    </li>
                                    @if (!empty($pagination))
                                        @for ($i = $pagination['start']; $i <= $pagination['end']; $i++)
                                            <li class="page-item {{ $i == $pagination['currentPage'] ? 'active' : false }}">
                                                <a class="page-link"
                                                    href="{{ handleUrlPaging($queryArr, $i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                    @endif
                                    <li class="page-item">
                                        @if ($pagination['next'] <= $pagination['pageNumber'])
                                            <a class="page-link" href="{{ handleUrlPaging($queryArr, $pagination['next']) }}" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        @endif
                                    </li>
                                </ul>
                            </nav>
                            {{-- End pagination --}}
                        </div>
                        {{-- Bảng sản phẩm end --}}

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
{{-- end main-panel --}}

{{-- start js --}}
@section('js')
    @if (!empty($sessionData['delete']))
        <script>
            demo.showNotification('top', 'center', '{{ $sessionData['delete'] }}', 'pe-7s-trash', 2);
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
