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
                            <h3 class="title">Cập nhật lại thông tin</h3>
                            <hr>
                            <a href="{{ route('admin.categories') }}" class="btn btn-danger btn-fill pull-center">Quay lại trang danh
                                sách</a>

                        </div>
                        <div class="content">
                            <form id="form-category" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tên danh mục mới</label>
                                            <input type="text" class="form-control" name="name" id="title"
                                                placeholder="Nhập tên danh mục mới" value="{{$category->name}}">
                                            <span style="color:red;" class="errors"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Chọn danh mục cha</label>
                                            <select name="parent_id" class="form-control">
                                                <option value="0">--- Danh mục mặc định ---</option>
                                                @if (!empty($listCategory))
                                                    {{loadOptions($listCategory, 0, '', $category->parent_id)}}
                                                  
                                                @endif
                                            </select>
                                            <span style="color:red;" class="errors"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Slug</label>
                                            <input type="text" class="form-control" disabled name="slug"
                                                id="slug" placeholder="Đường dẫn tĩnh" value="{{$category->slug}}">
                                            <span style="color:red;" class="errors"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Icon</label>
                                            <input type="text" class="form-control"  name="icon"
                                              placeholder="icon..." value="{{$category->icon}}">
                                            <span style="color:red;" class="errors"></span>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-info btn-fill pull-right">Cập nhật</button>
                                <div class="clearfix"></div>
                                <input type="hidden" name="id" value="{{$category->id}}" class="form-control" >
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control">
                                <input type="hidden" name="_method" value="put" class="form-control">
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

            const title = formCategory.querySelector('#title');
            if (title) {
                title.onkeyup = function(e) {
                    document.getElementById('slug').value = slug(e.target.value);
                }
            }
            formCategory.onsubmit = function(e) {
                e.preventDefault();
                let data = {};
                formValues.forEach(element => {
                    data[element.name] = element.value;
                });
                fetch('{{ route('admin.categories.update') }}', {
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
