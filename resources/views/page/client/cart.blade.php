@extends('layouts.clientLayout2')

{{-- CSS start --}}
@section('css')
@endsection
{{-- CSS end --}}

{{-- Main-wrap Start --}}
@section('main-wrap')
    <!--======= PAGES INNER =========-->
    <section class="padding-top-100 padding-bottom-100 pages-in chart-page">
        <div class="container">

            <!-- Payments Steps -->
            <div class="shopping-cart text-center" id="shopping-cart-js">
                <div class="cart-head">
                    <ul class="row">
                        <!-- PRODUCTS -->
                        <li class="col-sm-3 text-center">
                            <h6>Tên sản phẩm</h6>
                        </li>
                        <!-- NAME -->
                        <li class="col-sm-3 text-center">
                            <h6>Hình ảnh</h6>
                        </li>
                        <!-- PRICE -->
                        <li class="col-sm-2">
                            <h6>Giá</h6>
                        </li>
                        <!-- QTY -->
                        <li class="col-sm-1">
                            <h6>Số lượng</h6>
                        </li>

                        <!-- TOTAL PRICE -->
                        <li class="col-sm-2">
                            <h6>Thành tiền</h6>
                        </li>
                        <li class="col-sm-1"> </li>
                    </ul>
                </div>

                @if (!empty($cartList))
                    @foreach ($cartList as $index => $item)
                        <!-- Cart Details -->
                        <ul class="row cart-details parent-shopping-cart">
                            <li class="col-sm-3">
                                <div class="position-center-center">
                                    <h5>{{$item['name']}}</h5>
                                </div>
                            </li>
                            <!-- Image -->
                            <li class="col-sm-3">
                                <div class="media-left media-middle"><img class="media-object"
                                        src="{{$item['options']['image']}}" alt=""></div>
                            </li>

                            <!-- PRICE -->
                            <li class="col-sm-2">
                                <div class="position-center-center">
                                    <span class="price many-js" data-price="{{$item['price']}}"><small>VNĐ</small>{{number_format($item['price'])}}</span> 
                                </div>
                            </li>

                            <!-- QTY -->
                            <li class="col-sm-1">
                                <div class="position-center-center">
                                    <div class="quinty">
                                        <!-- QTY -->
                                        <select class="selectpicker qty-shopping-cart"
                                        data-link="{{route('cart.update-product', ['index' => $index])}}"
                                        data-token="{{csrf_token() }}">
                                            <option {{$item['qty']==1?'selected':false}}>1</option>
                                            <option {{$item['qty']==2?'selected':false}}>2</option>
                                            <option {{$item['qty']==3?'selected':false}}>3</option>
                                        </select>
                                    </div>
                                </div>
                            </li>

                            <!-- TOTAL PRICE -->
                            <li class="col-sm-2">
                                <div class="position-center-center">
                                    <span class="price total-many-js"><small>VNĐ</small>{{number_format($item['price'] * $item['qty'])}}</span>
                                 </div>
                            </li>

                            <!-- REMOVE -->
                            <li class="col-sm-1">
                                <div class="position-center-center"> 
                                    <a href="{{route('cart.delete', ['index' => $index])}}" class="close-shopping-cart">
                                        <i class="icon-close"></i>
                                    </a> 
                                </div>
                            </li>
                        </ul>
                    @endforeach
                @endif

            </div>
        </div>
    </section>

    <!--======= PAGES INNER =========-->
    <section class="padding-top-100 padding-bottom-100 light-gray-bg shopping-cart small-cart">
    <div class="container"> 
      
      <!-- SHOPPING INFORMATION -->
      <div class="cart-ship-info margin-top-0">
        <div class="row"> 
          
          <!-- DISCOUNT CODE -->
          <div class="col-sm-7">
            <h6>MÃ GIẢM GIÁ</h6>
            <form>
              <input type="text" value="" placeholder="NHẬP MÃ GIẢM GIÁ CỦA BẠN">
              <button type="submit" class="btn btn-small btn-dark">NHẬP CODE</button>
            </form>
            <div class="coupn-btn">
                <a href="{{route('shopping')}}" class="btn">Cửa hàng</a>
            </div>
          </div>
          
          <!-- SUB TOTAL -->
          <div class="col-sm-5">
            <h6>Hóa đơn</h6>
            <div class="grand-total">
              <div class="order-detail order-detail-js" data-link="{{route('cart.apiOrderCart')}}">
                {{-- <p>WOOD CHAIR  x2<span>$598 </span></p>
                <p>STOOL <span>$199 </span></p>
                <p>WOOD SPOON <span> $139</span></p>
                
                <!-- SUB TOTAL -->
                <p class="all-total">TOTAL COST <span> $998</span></p> --}}
              </div>
            </div>
            <div class="coupn-btn">
                <a href="{{route('pay.form-customer')}}" class="btn">Thanh toán</a>
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
<script>
    
</script>
@endsection
{{-- Js End --}}
