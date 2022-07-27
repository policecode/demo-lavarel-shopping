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
                            <h4 class="title">Cập nhật trang chủ</h4>
                            <hr>
                            <a href="{{ route('admin.settings.home') }}" class="btn btn-danger btn-fill pull-center">Quay
                                lại trang settings</a>

                        </div>
                        <div class="content">
                            <form id="form-category" action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <h3>Thông tin liên hệ</h3>
                                    @if (!empty(getOptionSetting('phone')))
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ getOptionSetting('phone', 'name') }}</label>
                                                <input type="tel" class="form-control" name="phone"
                                                    placeholder="{{ getOptionSetting('phone', 'name') }}"
                                                    value="{{ getOptionSetting('phone', 'opt_value') }}">
                                                @if ($errors->has('phone'))
                                                    <span style="color:red;" class="errors">
                                                        {{ $errors->first('phone') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                    @if (!empty(getOptionSetting('facebook')))
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ getOptionSetting('facebook', 'name') }}</label>
                                                <input type="text" class="form-control" name="facebook"
                                                    placeholder="{{ getOptionSetting('facebook', 'name') }}"
                                                    value="{{ getOptionSetting('facebook', 'opt_value') }}">
                                                @if ($errors->has('facebook'))
                                                    <span style="color:red;" class="errors">
                                                        {{ $errors->first('facebook') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                    @if (!empty(getOptionSetting('email')))
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ getOptionSetting('email', 'name') }}</label>
                                                <input type="email" class="form-control" name="email"
                                                    placeholder="{{ getOptionSetting('email', 'name') }}"
                                                    value="{{ getOptionSetting('email', 'opt_value') }}">
                                                @if ($errors->has('email'))
                                                    <span style="color:red;" class="errors">
                                                        {{ $errors->first('email') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                    @if (!empty(getOptionSetting('twitter')))
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ getOptionSetting('twitter', 'name') }}</label>
                                                <input type='text' class="form-control" name='twitter'
                                                    placeholder="{{ getOptionSetting('twitter', 'name') }}"
                                                    value="{{ getOptionSetting('twitter', 'opt_value') }}">

                                            </div>
                                        </div>
                                    @endif

                                    @if (!empty(getOptionSetting('youtube')))
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ getOptionSetting('youtube', 'name') }}</label>
                                                <input type="text" class="form-control" name="youtube"
                                                    placeholder="{{ getOptionSetting('youtube', 'name') }}"
                                                    value="{{ getOptionSetting('youtube', 'opt_value') }}">

                                            </div>
                                        </div>
                                    @endif

                                    @if (!empty(getOptionSetting('address')))
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ getOptionSetting('address', 'name') }}</label>
                                                <input type="text" class="form-control" name="address"
                                                    placeholder="{{ getOptionSetting('address', 'name') }}"
                                                    value="{{ getOptionSetting('address', 'opt_value') }}">
                                            </div>
                                        </div>
                                    @endif

                                </div>
                                <div class="row">
                                    <h3>Thông tin gian hàng</h3>
                                    @if (!empty(getOptionSetting('newarrival')))
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ getOptionSetting('newarrival', 'name') }}</label>
                                                <input type="text" class="form-control" name="newarrival"
                                                    placeholder="{{ getOptionSetting('newarrival', 'name') }}"
                                                    value="{{ getOptionSetting('newarrival', 'opt_value') }}">
                                            </div>
                                        </div>
                                    @endif

                                    @if (!empty(getOptionSetting('popuralproduct')))
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ getOptionSetting('popuralproduct', 'name') }}</label>
                                                <input type="text" class="form-control" name="popuralproduct"
                                                    placeholder="{{ getOptionSetting('popuralproduct', 'name') }}"
                                                    value="{{ getOptionSetting('popuralproduct', 'opt_value') }}">
                                            </div>
                                        </div>
                                    @endif

                                    @if (!empty(getOptionSetting('knowledgeshare')))
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ getOptionSetting('knowledgeshare', 'name') }}</label>
                                                <input type="text" class="form-control" name="knowledgeshare"
                                                    placeholder="{{ getOptionSetting('knowledgeshare', 'name') }}"
                                                    value="{{ getOptionSetting('knowledgeshare', 'opt_value') }}">
                                            </div>
                                        </div>
                                    @endif

                                    @if (!empty(getOptionSetting('about')))
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ getOptionSetting('about', 'name') }}</label>
                                                <textarea type="text" class="form-control" name="about" placeholder="{{ getOptionSetting('about', 'name') }}">
                                                    {{ getOptionSetting('about', 'opt_value') }}
                                                </textarea>
                                            </div>
                                        </div>
                                    @endif
                                    @if (!empty(getOptionSetting('newsletter')))
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ getOptionSetting('newsletter', 'name') }}</label>
                                                <textarea type="text" class="form-control editor" name="newsletter"
                                                    placeholder="{{ getOptionSetting('newsletter', 'name') }}">
                                                {{ getOptionSetting('newsletter', 'opt_value') }}
                                            </textarea>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                                <div class="row">
                                    <h3>Thông tin chia sẻ</h3>
                                    @if (!empty(getOptionSetting('knowledgesharecontent1')))
                                        @php
                                            $content1 = getOptionSetting('knowledgesharecontent1', 'opt_value');
                                        @endphp
                                        <div class="col-md-6">
                                            <h5>{{ getOptionSetting('knowledgesharecontent1', 'name') }}</h5>
                                            <div class="form-group">
                                                <label>Tiêu đề</label>
                                                <input type="text" class="form-control"
                                                    name="knowledgesharecontent1[title]" placeholder=""
                                                    value="{{ !empty($content1['title']) ? $content1['title'] : false }}">
                                                <hr>
                                                <label>Đường link dẫn tới bài viết</label>
                                                <input type="text" class="form-control"
                                                    name="knowledgesharecontent1[link]" placeholder=""
                                                    value="{{ !empty($content1['link']) ? $content1['link'] : false }}">
                                                <hr>
                                                <label>Nội dung cần chia sẻ</label>
                                                <textarea type="text" class="form-control editor" name="knowledgesharecontent1[content]">
                                                    {{ !empty($content1['content']) ? $content1['content'] : false }}
                                                </textarea>
                                            </div>
                                        </div>
                                    @endif

                                    @if (!empty(getOptionSetting('knowledgesharecontent2')))
                                        @php
                                            $content2 = getOptionSetting('knowledgesharecontent2', 'opt_value');
                                        @endphp
                                        <div class="col-md-6">
                                            <h5>{{ getOptionSetting('knowledgesharecontent2', 'name') }}</h5>
                                            <div class="form-group">
                                                <label>Tiêu đề</label>
                                                <input type="text" class="form-control"
                                                    name="knowledgesharecontent2[title]" placeholder=""
                                                    value="{{ !empty($content2['title']) ? $content2['title'] : false }}">
                                                <hr>
                                                <label>Đường link dẫn tới bài viết</label>
                                                <input type="text" class="form-control"
                                                    name="knowledgesharecontent2[link]" placeholder=""
                                                    value="{{ !empty($content2['link']) ? $content2['link'] : false }}">
                                                <hr>
                                                <label>Nội dung cần chia sẻ</label>
                                                <textarea type="text" class="form-control editor" name="knowledgesharecontent2[content]">
                                                {{ !empty($content2['content']) ? $content2['content'] : false }}
                                            </textarea>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-info btn-fill pull-right">Cập nhật</button>
                                <div class="clearfix"></div>
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
    @if ($errors->any())
        <script>
            demo.showNotification('top', 'center', 'Vui lòng kiểm tra lại dữ liệu', 'pe-7s-close-circle', 4);
        </script>
    @endif
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
@endsection
{{-- end js --}}
