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
                        <h4 class="title">Danh sách tài khoản</h4>
                        <hr>
                        <a href="{{route('admin.users.add')}}" class="btn btn-primary btn-fill pull-center">Thêm tài khoản mới</a>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th width="5%">STT</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Nhóm</th>
                                <th width="10%">Sửa</th>
                                <th width="10%">Xóa</th>
                            </thead>
                            <tbody>
                                @if ($lists->count() > 0)
                                    
                                    @foreach ($lists as $index => $item)
                                        <tr>
                                            <td>{{$index + 1}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>
                                                {{-- <a href="{{route('admin.users.formUpdate', ['id' => $item['id']])}}" class="btn btn-warning btn-fill pull-center">
                                                    <i class="pe-7s-settings"></i>
                                                </a> --}}
                                            </td>
                                            <td>
                                                {{-- <a href="{{route('admin.users.sortDelete', ['id' => $item['id']])}}" class="btn btn-danger btn-fill pull-center js-delete" >
                                                    <i class="pe-7s-trash"></i>
                                                </a> --}}
                                            </td>
                                        </tr>
                                        
                                    @endforeach
                                @else
                                    <td colspan="5" style="text-align: center;">Không có thông tin</td>
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
    @if (session('statusDelete') == 'success')
        <script>
            demo.showNotification('top', 'center', 'Thực hiện thao tác xóa thành công', 'pe-7s-like2', 2);
        </script>
    @endif

    @if (session('statusDelete') == 'error')
        <script>
            demo.showNotification('top', 'center', 'Thao tác xóa gặp trực trặc, vui lòng thử lại sau', 'pe-7s-close-circle', 4);
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
