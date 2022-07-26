
@extends('layoutLog.loginForm')
@section('title')
    Tìm lại mật khẩu
@endsection
@section('form-login')
    <h1 class="w3ls">Tìm lại mật khẩu</h1>
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
                    <input type="text" id="email" name="email" placeholder="hoangdat@email.com"
                        title="Vui lòng nhập email của bạn">
                    @error('email')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                <input type="submit" class="register" value="Gửi xác nhận đến email">
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
            <p class="wthree w3l">
                Quên mật khẩu? Không vấn đề gì. Chỉ cần cho chúng tôi biết địa chỉ email của bạn và chúng tôi sẽ gửi cho bạn một liên kết đặt lại mật khẩu qua email cho phép bạn chọn một mật khẩu mới.
            </p>
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
