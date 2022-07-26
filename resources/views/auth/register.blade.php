
@extends('layoutLog.loginForm')
@section('title')
    Trang Đăng Ký
@endsection
@section('form-login')
    <h1 class="w3ls">Đăng ký tài khoản</h1>
    <div class="content-w3ls">
        <div class="content-agile1">
            <h2 class="agileits1">Official</h2>
            <p class="agileits2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
        <div class="content-agile2">
            @if ($errors->any())
                <div class="error-form">
                    Đã có lỗi xảy ra. vui lòng kiểm tra lại dữ liệu
                </div>
            @endif
            <form action="" method="post">
                <div class="form-control w3layouts">
                    <input type="text" id="email" name="name" placeholder="Nguyễn Văn A . . ."
                        value=""    title="Vui lòng nhập họ tên của bạn">
                    @error('name')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control w3layouts">
                    <input type="text" id="email" name="email" placeholder="hoangdat@email.com"
                        value="" title="Vui lòng nhập email của bạn">
                    @error('email')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control agileinfo">
                    <input type="password" class="lock" name="password" placeholder="Mật khẩu..." id="password1">
                    @error('password')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-control agileinfo">
                    <input type="password" class="lock" name="password_confirmation" placeholder="Nhập lại mật khẩu..." id="password1">
                    @error('password_confirmation')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
                <input type="submit" class="register" value="Đăng ký">
                @csrf
            </form>
            <script type="text/javascript">
                window.onload = function() {
                    document.getElementById("password1").onchange = validatePassword;
                    document.getElementById("password2").onchange = validatePassword;
                }

                function validatePassword() {
                    var pass2 = document.getElementById("password2").value;
                    var pass1 = document.getElementById("password1").value;
                    if (pass1 != pass2)
                        document.getElementById("password2").setCustomValidity("Passwords Don't Match");
                    else
                        document.getElementById("password2").setCustomValidity('');
                    //empty string means no validation error
                }
            </script>
            <p class="wthree w3l">Fast Signup With Your Favourite Social Profile</p>
            <ul class="social-agileinfo wthree2">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
@endsection
