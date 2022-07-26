
@extends('layoutLog.loginForm')
@section('title')
    Xác minh email
@endsection

@section('form-login')
        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                Một liên kết xác minh mới đã được gửi đến địa chỉ email bạn đã cung cấp trong quá trình đăng ký
            </div>
        @endif
    <h1 class="w3ls">Xác thực email</h1>
    <div class="content-w3ls">
        <div class="content-agile1">
            <h2 class="agileits1"></h2>
            <p class="agileits2">Cảm ơn bạn đã đăng ký! Trước khi bắt đầu, bạn có thể xác minh địa chỉ email của mình bằng cách nhấp vào liên
                kết mà chúng tôi vừa gửi qua email cho bạn không? Nếu bạn không nhận được email, chúng tôi sẽ sẵn lòng gửi
                cho bạn một email khác.</p>
        </div>
        <div class="content-agile2">
            <form action="{{ route('verification.send') }}" method="post">
                <input type="submit" class="register" value="Gửi lại email xác minh">
                @csrf
            </form>

            <form action="{{ route('logout') }}" method="post">
                <input type="submit" class="register" value="Đăng xuất" style="background: rgb(243, 73, 73);">
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
