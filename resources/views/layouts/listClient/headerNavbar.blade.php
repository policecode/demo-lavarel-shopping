  <header>
      <div class="sticky">
          <div class="container">

              <!-- Logo -->
              <div class="logo"> <a href="index.html"><img class="img-responsive" src="images/logo.png" alt=""></a>
              </div>
              <nav class="navbar ownmenu">
                  <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                          data-target="#nav-open-btn" aria-expanded="false"> <span class="sr-only">Toggle
                              navigation</span> <span class="icon-bar"><i class="fa fa-navicon"></i></span> </button>
                  </div>

                  <!-- NAV -->
                  <div class="collapse navbar-collapse" id="nav-open-btn">
                      <ul class="nav">
                          <li class="dropdown {{ $active == 'home' ? 'active' : false }}"> <a href="{{ route('home') }}" class="dropdown-toggle">Trang
                                  chủ</a>
                          </li>
                          <li class="{{ $active == 'shop' ? 'active' : false }}"> <a href="{{ route('shopping') }}" class="dropdown-toggle">Cửa hàng
                              </a> </li>
                          <li class="{{ $active == 'cart' ? 'active' : false }}">
                              <a href="{{ route('cart.home') }}" class="dropdown-toggle view-count-cart-js">
                                  Giỏ hàng
                                  @if (getCountCart() > 0)
                                      <span class="badge badge-danger">
                                          +{{ getCountCart() }}
                                      </span>
                                  @endif
                              </a>
                          </li>


                      </ul>
                  </div>

                  <!-- Nav Right -->
                  <div class="nav-right">
                      <ul class="navbar-right">

                          <!-- USER INFO -->
                          <li class="dropdown user-acc" title="Trang quản trị"> <a href="{{ route('admin.home') }}"
                                  class="dropdown-toggle"><i class="icon-user"></i> </a>

                          </li>

                          <!-- USER BASKET -->
                          {{-- <li class="dropdown user-basket"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="icon-basket-loaded"></i> </a>
                <ul class="dropdown-menu">
                  <li>
                    <div class="media-left">
                      <div class="cart-img"> <a href="#"> <img class="media-object img-responsive" src="images/cart-img-1.jpg" alt="..."> </a> </div>
                    </div>
                    <div class="media-body">
                      <h6 class="media-heading">WOOD CHAIR</h6>
                      <span class="price">129.00 USD</span> <span class="qty">QTY: 01</span> </div>
                  </li>
                  <li>
                    <div class="media-left">
                      <div class="cart-img"> <a href="#"> <img class="media-object img-responsive" src="images/cart-img-2.jpg" alt="..."> </a> </div>
                    </div>
                    <div class="media-body">
                      <h6 class="media-heading">WOOD STOOL</h6>
                      <span class="price">129.00 USD</span> <span class="qty">QTY: 01</span> </div>
                  </li>
                  <li>
                    <h5 class="text-center">SUBTOTAL: 258.00 USD</h5>
                  </li>
                  <li class="margin-0">
                    <div class="row">
                      <div class="col-xs-6"> <a href="shopping-cart.html" class="btn">VIEW CART</a></div>
                      <div class="col-xs-6 "> <a href="checkout.html" class="btn">CHECK OUT</a></div>
                    </div>
                  </li>
                </ul>
              </li> --}}

                          <!-- SEARCH BAR -->
                          {{-- <li class="dropdown"> <a href="javascript:void(0);" class="search-open"><i class=" icon-magnifier"></i></a>
                <div class="search-inside animated bounceInUp"> <i class="icon-close search-close"></i>
                  <div class="search-overlay"></div>
                  <div class="position-center-center">
                    <div class="search">
                      <form>
                        <input type="search" placeholder="Search Shop">
                        <button type="submit"><i class="icon-check"></i></button>
                      </form>
                    </div>
                  </div>
                </div>
              </li> --}}
                      </ul>
                  </div>
              </nav>
          </div>
      </div>
  </header>
