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
                            <h4 class="title">Slider</h4>
                            <hr>
                            <a href="{{ route('admin.slider.add') }}" class="btn btn-primary btn-fill pull-center">Thêm slider
                                 mới</a>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th width="5%">STT</th>
                                    <th>Tên Slider</th>
                                    <th>Hình ảnh</th>
                                    <th width="10%">Sửa</th>
                                    <th width="10%">Xóa</th>
                                </thead>
                                <tbody>
                                    @if (!empty($allSlider))
                                        @foreach ($allSlider as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    <img src="{{ $item->image_path }}" alt="Ảnh đang bị lỗi"
                                                        class="avatar border-gray img-size" />
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.slider.formUpdate', ['id' => $item->id]) }}"
                                                        class="btn btn-warning btn-fill pull-center">
                                                        <i class="pe-7s-settings"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.slider.sortDelete') }}" method="post"
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
