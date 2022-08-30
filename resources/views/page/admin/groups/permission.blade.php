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
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Phân quyền nhóm: {{ $group->name }}</h4>
                            <hr>
                            <a href="{{ route('admin.groups.index') }}" class="btn btn-danger btn-fill pull-center">Quay lại
                                trang danh sách</a>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <form id="form-category" action="{{ route('admin.groups.permission', ['group' => $group])}}" method="post" enctype="multipart/form-data">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th width="5%">STT</th>
                                        <th width="15%">Danh mục</th>
                                        <th>Chức năng</th>
                                    </thead>
                                    <tbody>
                                        @if ($module->count() > 0)
                                            @foreach ($module as $index => $item)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $item->title }}</td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <label for="{{ $item->name . 'view' }}">
                                                                    <input type="checkbox" id="{{ $item->name . 'view' }}"
                                                                        name="{{ $item->name}}[]" value="view" {{isRole($permission, $item->name, 'view')?'checked':false}} />
                                                                    Xem
                                                                </label>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <label for="{{ $item->name . 'create' }}">
                                                                    <input type="checkbox" id="{{ $item->name . 'create' }}"
                                                                        name="{{ $item->name}}[]" value="create" {{isRole($permission, $item->name, 'create')?'checked':false}}>
                                                                    Thêm
                                                                </label>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <label for="{{ $item->name . 'edit' }}">
                                                                    <input type="checkbox" id="{{ $item->name . 'edit' }}"
                                                                        name="{{ $item->name}}[]" value="edit" {{isRole($permission, $item->name, 'edit')?'checked':false}}>
                                                                    Sửa
                                                                </label>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label for="{{ $item->name . 'delete' }}">
                                                                    <input type="checkbox" id="{{ $item->name . 'delete' }}"
                                                                        name="{{ $item->name}}[]" value="delete" {{isRole($permission, $item->name, 'delete')?'checked':false}}> 
                                                                    Xóa
                                                                </label>
                                                            </div>
                                                            @if ($item->name == 'groups')
                                                                <div class="col-md-2">
                                                                    <label for="{{ $item->name . 'permission' }}">
                                                                        <input type="checkbox"
                                                                            id="{{ $item->name . 'permission' }}"
                                                                            name="{{ $item->name}}[]" value="permission" {{isRole($permission, $item->name, 'permission')?'checked':false}}>
                                                                        Phân quyền
                                                                    </label>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <td colspan="5" style="text-align: center;">Không có thông tin</td>
                                        @endif


                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-info btn-fill pull-right">Phân quyền</button>
                                <div class="clearfix"></div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control">
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
    @if (session('msg'))
        <script>
            window.onload = function() {
                demo.showNotification('top', 'center', '{{ session('msg') }}', 'pe-7s-like2', 2);
            }
        </script>
    @endif

    <script>
        let jsDelete = document.querySelectorAll('.js-delete');
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
