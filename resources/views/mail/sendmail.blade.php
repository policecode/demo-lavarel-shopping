<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hóa đơn mua hàng</title>
</head>
<body>
    <p>Cảm ơn anh {{$customer['fullname']}} đã mua hàng chỗ chúng tôi</p>
    <p>Thông tin sản phẩm đặt mua:</p>
    @if ($allCart)
        @foreach ($allCart as $item)
        <p>{{$item['name']}}  x{{$item['qty']}} = <span>{{number_format($item['price'] * $item['qty'])}} đ</span></p>
        @endforeach
        <p class="all-total">TỔNG TIỀN: <span>{{number_format($totalPrice)}} đ</span></p>
    @endif
    <hr>
    <p>Địa chỉ nhận hàng: {{$customer['address']}} </p>
    <p>Số điện thoại người nhận hàng: {{$customer['phone']}} </p>
    <p>Anh/Chị kiểm tra lại thông tin, có gì vấn đề gì cần thắc mặc có thể liên hệ trực tiếp với cửa hàng</p>
</body>
</html>