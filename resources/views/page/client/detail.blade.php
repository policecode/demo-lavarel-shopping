@extends('layouts.clientLayout2')

{{-- CSS start --}}
@section('css')
@endsection
{{-- CSS end --}}

{{-- Main-wrap Start --}}
@section('main-wrap')
    <!-- Popular Products -->
    <section class="padding-top-100 padding-bottom-100">
        <div class="container">

            <!-- SHOP DETAIL -->
            <div class="shop-detail">
                <div class="row">

                    <!-- Popular Images Slider -->
                    <div class="col-md-7">

                        <!-- Images Slider -->
                        <div class="images-slider">
                            <ul class="slides">
                                @if ($imageProduct->count() > 0)
                                    @foreach ($imageProduct as $key => $item)
                                        @if ($key < 3)
                                            <li data-thumb="{{ $item->image_path }}"> <img class="img-responsive"
                                                    src="{{ $item->image_path }}" alt=""> </li>
                                        @endif
                                    @endforeach
                                @endif

                            </ul>
                        </div>
                    </div>

                    @if ($product)
                        <!-- COntent -->
                        <div class="col-md-5">
                            <h4>{{ $product->name }}</h4>
                            <span class="price"><small>VNĐ</small>{{ number_format($product->price) }}</span>

                            <!-- Sale Tags -->
                            <ul class="item-owner">
                                <li>Designer :<span> ABC Art</span></li>
                                <li>Tag:
                                    @if ($tagProduct)
                                        @foreach ($tagProduct as $value)
                                            <a href="#">
                                                <span>{{ $value->name }}</span>
                                            </a>
                                        @endforeach
                                    @endif
                                </li>
                            </ul>
                            <!-- Item Detail -->
                            <p>{{ $product->content }}</p>

                            <!-- Short By -->
                            <div class="some-info">
                                <ul class="row margin-top-30">
                                    <li class="col-xs-4">
                                        <div class="quinty">
                                            <!-- QTY -->
                                            <select class="selectpicker">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select>
                                        </div>
                                    </li>

                                    <!-- COLORS -->
                                    <li class="col-xs-8">
                                        <ul class="colors-shop">
                                            <li><span class="margin-right-20">Colors</span></li>
                                            <li><a href="#." style="background:#958170;"></a></li>
                                            <li><a href="#." style="background:#c9a688;"></a></li>
                                            <li><a href="#." style="background:#c9c288;"></a></li>
                                            <li><a href="#." style="background:#a7c988;"></a></li>
                                            <li><a href="#." style="background:#9ed66b;"></a></li>
                                            <li><a href="#." style="background:#6bd6b1;"></a></li>
                                            <li><a href="#." style="background:#82c2dc;"></a></li>
                                            <li><a href="#." style="background:#8295dc;"></a></li>
                                        </ul>
                                    </li>

                                    <!-- ADD TO CART -->
                                    <li class="col-xs-6"> <a href="#." class="btn">ADD TO CART</a> </li>

                                    <!-- LIKE -->
                                    <li class="col-xs-6"> <a href="#." class="like-us"><i class="icon-heart"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    @endif
                </div>
            </div>

            <!--======= PRODUCT DESCRIPTION =========-->
            <div class="item-decribe">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs animate fadeInUp" data-wow-delay="0.4s" role="tablist">
                    <li role="presentation" class="active"><a href="#" role="tab" data-toggle="tab">Bình luận</a>
                    </li>
                </ul>
                <!-- REVIEW -->

                {{ renderCommentProduct($listComment) }}

                <!-- ADD REVIEW -->
                <h6 class="margin-t-40" id="form-comment">Đăng bình luận</h6>
                <form method="post" action="{{ route('san-pham.comment') }}" id="form-comment-js">
                    <div class="reply-to-comment">

                    </div>
                    <ul class="row">
                        @if (!$authCheck)
                            <li class="col-sm-6">
                                <label> *HỌ TÊN
                                    <input type="text" name="fullname" value="{{ old('fullname') }}"
                                        placeholder="Nhập họ và tên của bạn">
                                    @if ($errors->has('fullname'))
                                        <span style="color:red;" class="errors">
                                            {{ $errors->first('fullname') }}
                                        </span>
                                    @endif
                                </label>
                            </li>
                            <li class="col-sm-6">
                                <label> *EMAIL
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        placeholder="Nhập email của Bạn">
                                    @if ($errors->has('email'))
                                        <span style="color:red;" class="errors">
                                            {{ $errors->first('email') }}
                                        </span>
                                    @endif
                                </label>
                            </li>
                        @else
                            <li class="col-sm-6 ">
                                <h6 style="margin-top: 5px; color: red;"> {{ $authAdmin }}</h6>
                            </li>
                            <input type="hidden" name="fullname" value="{{ $authAdmin }}">
                            <input type="hidden" name="email" value="admin@gmail.com">
                        @endif
                        <li class="col-sm-12">
                            <label> *Bình luận của bạn
                                <textarea name="comment"></textarea>
                                @if ($errors->has('comment'))
                                    <span style="color:red;" class="errors">
                                        {{ $errors->first('comment') }}
                                    </span>
                                @endif
                            </label>
                        </li>
                        <li class="col-sm-6">
                            <!-- Rating Stars -->
                            <div class="stars"> <span>YOUR RATING</span>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </li>
                        <li class="col-sm-6">
                            <button type="submit" class="btn btn-dark btn-small pull-right no-margin">GỬI</button>
                        </li>
                    </ul>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="parent_id" value="0">
                    @csrf
                </form>
            </div>

        </div>
        </div>
    </section>

    <!-- Popular Products -->
    <section class="light-gray-bg padding-top-150 padding-bottom-150">
        <div class="container">

            <!-- Main Heading -->
            <div class="heading text-center">
                <h4>Sản phẩm bạn có thể quan tâm</h4>
                <span>Những sản phẩm dưới đây có thể sẽ cần thiết cho bạn</span>
            </div>

            <!-- Popular Item Slide -->
            <div class="papular-block block-slide">
                @if ($listProduct->count() > 0)
                    @foreach ($listProduct as $item)
                        <!-- Item -->
                        <div class="item">
                            <!-- Item img -->
                            <div class="item-img"> <img class="img-1" src="{{$item->feature_image_path}}" alt=""> <img
                                    class="img-2" src="{{$item->feature_image_path}}" alt="">
                                <!-- Overlay -->
                                <div class="overlay">
                                    <div class="position-center-center">
                                        <div class="inn"><a href="images/product-1.jpg" data-lighter><i
                                                    class="icon-magnifier"></i></a> <a href="#."><i
                                                    class="icon-basket"></i></a> <a href="#."><i
                                                    class="icon-heart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Item Name -->
                            <div class="item-name"> 
                                <a href="{{route('san-pham.detail', ['id' => $item->id])}}">
                                {{$item->name}}</a>
                                <p>Lorem ipsum dolor sit amet</p>
                            </div>
                            <!-- Price -->
                            <span class="price"><small>VNĐ</small>{{number_format($item->price)}}</span>
                        </div>
                    @endforeach
                @endif
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
@endsection
{{-- Js End --}}
