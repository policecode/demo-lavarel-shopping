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
                            <h4 class="title">Thêm menu mới</h4>
                            <hr>
                            <a href="{{ route('admin.menu') }}" class="btn btn-danger btn-fill pull-center">Quay lại trang danh
                                sách</a>

                        </div>
                        <div class="content">
                            <form id="form-category" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tên danh mục mới</label>
                                            <input type="text" class="form-control" name="name" 
                                                placeholder="Nhập tên danh mục mới" value="">
                                            <span style="color:red;" class="errors"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Chọn danh mục cha</label>
                                            <select name="parent_id" class="form-control form-control-sm">
                                                <option value="0">--- Danh mục mặc định ---</option>
                                                @if (!empty($menus))
                                                    {{loadOptions($menus)}}
                                                  
                                                @endif
                                            </select>
                                            <span style="color:red;" class="errors"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Link</label>
                                            <input type="text" class="form-control"  name="link"
                                                placeholder="Đường dẫn tĩnh">
                                            <span style="color:red;" class="errors"></span>
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
    <script>
        const formCategory = document.querySelector('#form-category');
        if (formCategory) {
            const formValues = formCategory.querySelectorAll('.form-control');

            formCategory.onsubmit = function(e) {
                e.preventDefault();
                let data = {};
                formValues.forEach(element => {
                    data[element.name] = element.value;
                });
                fetch('{{ route('admin.menu.create') }}', {
                        method: 'POST', // or 'PUT'
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(data),
                    })
                    .then(response => {
                        return response.json();
                    })
                    .then(data => {
                        const errors = formCategory.querySelectorAll('.errors');
                        if (errors) {
                            errors.forEach(element => {
                                element.innerHTML = '';
                            });
                        }
                        if (data.status == 'errors') {
                            demo.showNotification('top', 'center', data.msg, 'pe-7s-close-circle', 4);
                            const errors = data.errors;
                            for (const key in errors) {
                                formValues.forEach(element => {
                                    if (element.name == key) {
                                        element.parentElement.querySelector('.errors').innerHTML = errors[key];
                                    }
                                });
                            }

                        } else {
                            formValues.forEach(element => {
                                if (element.name != '_token') {
                                    element.value = '';
                                    if (element.name == 'parent_id') {
                                        element.value = 0;
                                    }
                                }
                            });
                            demo.showNotification('top', 'center', data.msg, 'pe-7s-check', 2);
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
            }
        }
    </script>
@endsection
{{-- end js --}}
