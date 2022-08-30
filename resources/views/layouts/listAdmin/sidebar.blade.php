<div class="sidebar" data-color="purple" data-image="{{ asset('assets/images/sidebar-5.jpg') }}">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{route('admin.home')}}" class="simple-text">
                    Trang quản trị
                </a>
            </div>

            <ul class="nav">
                <li class="{{!empty($active)&&$active=='home'?'active':false}} ">
                    <a href="{{route('admin.home')}}">
                        <i class="pe-7s-graph"></i>
                        <p>Trang Admin</p>
                    </a>
                </li>
                <li class="{{!empty($active)&&$active=='categories'?'active':false}} ">
                    <a href="{{route('admin.categories')}}">
                        <i class="pe-7s-photo-gallery"></i>
                        <p>Danh mục sản phẩm</p>
                    </a>
                </li>
                <li class="{{!empty($active)&&$active=='menu'?'active':false}} ">
                    <a href="{{route('admin.menu')}}">
                        <i class="pe-7s-note2"></i>
                        <p>Menu</p>
                    </a>
                </li>
                <li class="{{!empty($active)&&$active=='product'?'active':false}}">
                    <a href="{{route('admin.product.list')}}">
                        <i class="pe-7s-news-paper"></i>
                        <p>Sản phẩm</p>
                    </a>
                </li>
                <li class="{{!empty($active)&&$active=='slider'?'active':false}}">
                    <a href="{{route('admin.slider.list')}}">
                        <i class="fa-brands fa-slack"></i>
                        <p>Slider</p>
                    </a>
                </li>
                <li class="{{!empty($active)&&$active=='user'?'active':false}}">
                    <a href="{{route('admin.users.index')}}">
                        <i class="pe-7s-user"></i>
                        <p>Quản lý tài khoản</p>
                    </a>
                </li>
                <li class="{{!empty($active)&&$active=='groups'?'active':false}}">
                    <a href="{{route('admin.groups.index')}}">
                        <i class="pe-7s-users"></i>
                        <p>Quản lý nhóm</p>
                    </a>
                </li>
                <li class="{{!empty($active)&&$active=='settings'?'active':false}}">
                    <a href="{{route('admin.settings.home')}}">
                        <i class="pe-7s-settings"></i>
                        <p>Settings</p>
                    </a>
                </li>
                
				{{-- <li class="active-pro">
                    <a href="upgrade.html">
                        <i class="pe-7s-rocket"></i>
                        <p>Upgrade to PRO</p>
                    </a>
                </li> --}}
            </ul>
    	</div>
    </div>