@extends('layouts.clientLayout')

{{-- CSS start --}}
@section('css')
@endsection
{{-- CSS end --}}

{{-- Main-wrap Start --}}
@section('main-wrap')
    <div id="content">

        <!-- New Arrival -->
        <section class="padding-top-100 padding-bottom-100">
            <div class="container">

                <!-- Main Heading -->
                <div class="heading text-center">
                    <h4>{{ getOptionSetting('newarrival', 'name') }}</h4>
                    <span>{{ getOptionSetting('newarrival', 'opt_value') }}</span>
                </div>
            </div>

            <!-- New Arrival -->
            <div class="arrival-block">
                @if ($listCategory->count() > 0)
                    @foreach ($listCategory as $item)
                        <!-- Item -->
                        <div class="item">
                            <!-- Images -->
                            <img class="img-1" src="{{ $item->feature_image_path }}" alt="">
                            <img class="img-2" src="{{ $item->feature_image_path }}" alt="">
                            <!-- Overlay  -->
                            <div class="overlay">
                                <!-- Price -->
                                <span class="price"><small>VNĐ</small>{{ number_format($item->price) }}</span>
                                <div class="position-center-center"> <a href="images/item-img-1-1.jpg" data-lighter><i
                                            class="icon-magnifier"></i></a> </div>
                            </div>
                            <!-- Item Name -->
                            <div class="item-name"> <a href="#.">{{ $item->name }}</a>
                                <p>Lorem ipsum dolor sit amet</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </section>

        <!-- Popular Products -->
        <section class="padding-top-50 padding-bottom-150">
            <div class="container">

                <!-- Main Heading -->
                <div class="heading text-center">
                    <h4>{{ getOptionSetting('popuralproduct', 'name') }}</h4>
                    <span>{{ getOptionSetting('popuralproduct', 'opt_value') }}</span>
                </div>

                <!-- Popular Item Slide -->
                <div class="papular-block block-slide">

                    @if ($popuralproduct->count() > 0)
                        @foreach ($popuralproduct as $item)
                            <!-- Item -->
                            <div class="item">
                                <!-- Item img -->
                                <div class="item-img"> 
                                    <img class="img-1" src="{{ $item->feature_image_path }}" alt=""> 
                                    <img class="img-2" src="{{ $item->feature_image_path }}" alt="">
                                    <!-- Overlay -->
                                    <div class="overlay">
                                        <div class="position-center-center">
                                            <div class="inn"><a href="images/product-1.jpg" data-lighter><i
                                                        class="icon-magnifier"></i></a> <a href="#."
                                                    data-toggle="tooltip" data-placement="top" title="Add To Cart"><i
                                                        class="icon-basket"></i></a> <a href="#." data-toggle="tooltip"
                                                    data-placement="top" title="Add To WishList"><i
                                                        class="icon-heart"></i></a></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Item Name -->
                                <div class="item-name"> 
                                    <a href="#.">{{ $item->name }}</a>
                                    <p>Lorem ipsum dolor sit amet</p>
                                </div>
                                <!-- Price -->
                                <span class="price"><small>VNĐ</small>{{ number_format($item->price) }}</span>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </section>

        <!-- Knowledge Share -->
        <section class="light-gray-bg padding-top-150 padding-bottom-150">
            <div class="container">

                <!-- Main Heading -->
                <div class="heading text-center">
                    <h4>{{ getOptionSetting('knowledgeshare', 'name') }}</h4>
                    <span>{{ getOptionSetting('knowledgeshare', 'opt_value') }}</span>
                </div>
                <div class="knowledge-share">
                    <ul class="row">

                        <!-- Post 1 -->
                        <li class="col-md-6">
                            <div class="date"> <span>December</span> <span class="huge">27</span> </div>
                            <a href="#.">Donec commo is vulputate</a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec faucibus maximus vehicula. Sed
                                feugiat, tellus vel tristique posuere, diam</p>
                            <span>By <strong>Admin</strong></span>
                        </li>

                        <!-- Post 2 -->
                        <li class="col-md-6">
                            <div class="date"> <span>December</span> <span class="huge">09</span> </div>
                            <a href="#.">Donec commo is vulputate</a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec faucibus maximus vehicula. Sed
                                feugiat, tellus vel tristique posuere, diam</p>
                            <span>By <strong>Admin</strong></span>
                        </li>
                    </ul>
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
                    <li><a href="{{ getOptionSetting('facebook', 'opt_value') }}" target="_blank"><i class="icon-social-facebook" ></i></a></li>
                    <li><a href="{{ getOptionSetting('twitter', 'opt_value') }}" target="_blank"><i class="icon-social-twitter" ></i></a></li>
                    <li><a href="{{ getOptionSetting('youtube', 'opt_value') }}" target="_blank"><i class="icon-social-youtube" ></i></a></li>
                </ul>
            </div>
        </section>
        <section class="news-letter padding-top-150 padding-bottom-150">
            <div class="container">
                <div class="heading light-head text-center margin-bottom-30">
                    <h4>{{ getOptionSetting('newsletter', 'name') }}</h4>
                    <span>{{ getOptionSetting('newsletter', 'opt_value') }}</span>
                </div>
                <form>
                    <input type="email" placeholder="nhập địa chỉ email của bạn" required>
                    <button type="submit">Gửi đi</button>
                </form>
            </div>
        </section>
    </div>
@endsection
{{-- Main-wrap End --}}

{{-- Js Start --}}
@section('js')
@endsection
{{-- Js End --}}
