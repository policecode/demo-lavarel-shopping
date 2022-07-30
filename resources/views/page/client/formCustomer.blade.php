@extends('layouts.clientLayout2')

{{-- CSS start --}}
@section('css')
@endsection
{{-- CSS end --}}

{{-- Main-wrap Start --}}
@section('main-wrap')
    <!--======= PAGES INNER =========-->
    <section class="chart-page padding-top-100 padding-bottom-100">
        <div class="container">

            <!-- Payments Steps -->
            <div class="shopping-cart">

                <!-- SHOPPING INFORMATION -->
                <div class="cart-ship-info">
                    <div class="row">

                        <!-- ESTIMATE SHIPPING & TAX -->
                        <div class="col-sm-7">
                            <h6>Thông tin người mua hàng</h6>
                            <form method="post" action="{{ route('pay.form-customer') }}" id="form-payment-product">
                                <ul class="row">

                                    <!-- Name -->
                                    <li class="col-md-6 mb-4">
                                        <label> *HỌ TÊN
                                            <input type="text" name="fullname" value="{{ old('fullname') }}"
                                                placeholder="Họ tên của bạn">
                                        </label>
                                        @if ($errors->has('fullname'))
                                            <span style="color:red;" class="errors">
                                                {{ $errors->first('fullname') }}
                                            </span>
                                        @endif
                                    </li>
                                    <!-- LAST NAME -->
                                    <li class="col-md-6 mb-4">
                                        <label> *SỐ ĐIỆN THOẠI
                                            <input type="phone" name="phone" value="{{ old('phone') }}"
                                                placeholder="VD: 0961234567">
                                        </label>
                                        @if ($errors->has('phone'))
                                            <span style="color:red;" class="errors">
                                                {{ $errors->first('phone') }}
                                            </span>
                                        @endif
                                    </li>
                                    <li class="col-md-6 mb-4">
                                        <!-- COMPANY NAME -->
                                        <label> *EMAIL
                                            <input type="text" name="email" value="{{ old('email') }}"
                                                placeholder="VD: nguyenvana@gmail.com">
                                        </label>
                                        @if ($errors->has('email'))
                                            <span style="color:red;" class="errors">
                                                {{ $errors->first('email') }}
                                            </span>
                                        @endif
                                    </li>
                                    <li class="col-md-12 mb-4">
                                        <!-- ADDRESS -->
                                        <label>*ĐỊA CHỈ NHẬN HÀNG
                                            <input type="text" name="address" value="{{ old('address') }}"
                                                placeholder="VD: số 115 Hàng Bông, phường Hàng Bông, quận Hoàn Kiếm, Hà Nội">
                                        </label>
                                        @if ($errors->has('address'))
                                            <span style="color:red;" class="errors">
                                                {{ $errors->first('address') }}
                                            </span>
                                        @endif
                                    </li>
                                    <li class="col-md-6">
                                        <button type="submit" class="btn">Đặt hàng</button>
                                        @csrf
                                    </li>
                                </ul>
                            </form>
                        </div>

                        <!-- SUB TOTAL -->
                        <div class="col-sm-5">
                            <h6>HÓA ĐƠN</h6>
                            <div class="order-place">
                                <div class="order-detail order-detail-js" data-link="{{ route('cart.apiOrderCart') }}">

                                </div>
                                <div class="pay-meth">
                                    <ul>
                                        <li>
                                            <div class="radio">
                                                <input type="radio" name="radio1" id="radio1" value="option1" checked>
                                                <label for="radio1"> COD (Cash on delivery) </label>
                                            </div>
                                            <p>Thanh toán khi nhận được hàng</p>
                                        </li>

                                        <li>
                                            <div class="checkbox">
                                                <input id="checkbox3-4" class="styled" type="checkbox" checked="checked">
                                                <label for="checkbox3-4"> TÔI ĐÃ ĐỌC VÀ CHẤP NHẬN <span class="color"> ĐIỀU
                                                        KHOẢN, ĐIỀU KIỆN</span> </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!-- About -->
    <section class="small-about padding-top-150 padding-bottom-150">
        <div class="container">

            <!-- Main Heading -->
            <div class="heading text-center">
                <h4>{{ getOptionSetting('about', 'name') }}</h4>
                <span>{{ getOptionSetting('about', 'opt_value') }}</span>
            </div>

            <!-- Social Icons -->
            <ul class="social_icons">
                <li><a href="{{ getOptionSetting('facebook', 'opt_value') }}" target="_blank"><i
                            class="icon-social-facebook"></i></a></li>
                <li><a href="{{ getOptionSetting('twitter', 'opt_value') }}" target="_blank"><i
                            class="icon-social-twitter"></i></a></li>
                <li><a href="{{ getOptionSetting('youtube', 'opt_value') }}" target="_blank"><i
                            class="icon-social-youtube"></i></a></li>
            </ul>
        </div>
    </section>
@endsection
{{-- Main-wrap End --}}

{{-- Js Start --}}
@section('js')
    <script></script>
@endsection
{{-- Js End --}}
