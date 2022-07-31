@extends('layouts.clientLayout2')

{{-- CSS start --}}
@section('css')
@endsection
{{-- CSS end --}}

{{-- Main-wrap Start --}}
@section('main-wrap')
    <!-- Popular Products -->
    <section class="shop-page padding-top-100 padding-bottom-100">
        <div class="container">
            <div class="item-display">
                <div class="row">
                    <div class="col-xs-6"> <span class="product-num">Showing 1 - 10 of 30 products</span> </div>

                    <!-- Products Select -->
                    <div class="col-xs-6">
                        <div class="pull-right">

                            <!-- Short By -->
                            <select class="selectpicker">
                                <option>Short By</option>
                                <option>Short By</option>
                                <option>Short By</option>
                            </select>
                            <!-- Filter By -->
                            <select class="selectpicker">
                                <option>Filter By</option>
                                <option>Short By</option>
                                <option>Short By</option>
                            </select>

                            <!-- GRID & LIST -->
                            <a href="#." class="grid-style"><i class="icon-grid"></i></a> <a href="#."
                                class="list-style"><i class="icon-list"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Popular Item Slide -->
            <div class="papular-block row">
                @if ($getAllProduct->count() > 0)
                    @foreach ($getAllProduct as $item)
                        <!-- Item -->
                        <div class="col-md-3">
                            <div class="item">
                                <!-- Item img -->
                                <div class="item-img"> 
                                    <img class="img-1" src="{{$item->feature_image_path}}" alt=""> 
                                    <img class="img-2" src="{{$item->feature_image_path}}" alt="">
                                    <!-- Overlay -->
                                    <div class="overlay">
                                        <div class="position-center-center">
                                            <div class="inn">
                                                <a href="{{$item->feature_image_path}}" data-lighter>
                                                    <i class="icon-magnifier"></i>
                                                </a> 
                                                <a href="{{route('cart.add-cart', ['id' => $item->id])}}"
                                                    class="add-to-cart-js">
                                                    <i class="icon-basket"></i>
                                                </a> 
                                                <a href="#.">
                                                    <i class="icon-heart"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Item Name -->
                                <div class="item-name"> 
                                    <a href="{{route('san-pham.detail', ['id' => $item->id])}}">{{$item->name}}</a>
                                </div>
                                <!-- Price -->
                                <span class="price"><small>VNĐ</small>{{number_format($item->price)}}</span>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        {{-- Start pagination --}}
        <ul class="pagination ">
            <li class="page-item">
                @if ($pagination['prev'] >= 1)
                    <a class="page-link" href="{{ handleUrlPaging($queryArr, $pagination['prev']) }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                @endif
            </li>
            @if (!empty($pagination))
                @for ($i = $pagination['start']; $i <= $pagination['end']; $i++)
                    <li class="page-item {{ $i == $pagination['currentPage'] ? 'active' : false }}">
                        <a class="page-link" href="{{ handleUrlPaging($queryArr, $i) }}">{{ $i }}</a>
                    </li>
                @endfor
            @endif
            <li class="page-item">
                @if ($pagination['next'] <= $pagination['pageNumber'])
                    <a class="page-link" href="{{ handleUrlPaging($queryArr, $pagination['next']) }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                @endif
            </li>
        </ul>
        {{-- End pagination --}}
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
