<!--======= FOOTER =========-->
<footer>
    <div class="container"> 
      
      <!-- ABOUT Location -->
      <div class="col-md-3">
        <div class="about-footer"> <img class="margin-bottom-30" src="images/logo-foot.png" alt="" >
          <p><i class="icon-pointer"></i> {{getOptionSetting('address', 'opt_value')}}</p>
          <p><i class="icon-call-end"></i> {{getOptionSetting('phone', 'opt_value')}}</p>
          <p><i class="icon-envelope"></i> {{getOptionSetting('email', 'opt_value')}}</p>
        </div>
      </div>
      
      <!-- HELPFUL LINKS -->
      <div class="col-md-3">
        <h6>HELPFUL LINKS</h6>
        {{-- <ul class="link">
          <li><a href="#."> Products</a></li>
          <li><a href="#."> Find a Store</a></li>
          <li><a href="#."> Features</a></li>
          <li><a href="#."> Privacy Policy</a></li>
          <li><a href="#."> Blog</a></li>
          <li><a href="#."> Press Kit </a></li>
        </ul> --}}
      </div>
      
      <!-- SHOP -->
      <div class="col-md-3">
        <h6>SHOP</h6>
        {{-- <ul class="link">
          <li><a href="#."> About Us</a></li>
          <li><a href="#."> Career</a></li>
          <li><a href="#."> Shipping Methods</a></li>
          <li><a href="#."> Contact</a></li>
          <li><a href="#."> Support</a></li>
          <li><a href="#."> Retailer</a></li>
        </ul> --}}
      </div>
      
      <!-- MY ACCOUNT -->
      <div class="col-md-3">
        <h6>MY ACCOUNT</h6>
        {{-- <ul class="link">
          <li><a href="#."> Login</a></li>
          <li><a href="#."> My Account</a></li>
          <li><a href="#."> My Cart</a></li>
          <li><a href="#."> Wishlist</a></li>
          <li><a href="#."> Checkout</a></li>
        </ul> --}}
      </div>
      
      <!-- Rights -->
      
      <div class="rights">
        <p>©  2022 Shop vớ vẩn. </p>
        <div class="scroll"> <a href="#wrap" class="go-up"><i class="lnr lnr-arrow-up"></i></a> </div>
      </div>
    </div>
  </footer>
  
  <!--======= RIGHTS =========--> 
  
</div>
<script src="{{asset('assetClient/js/jquery-1.11.3.min.js') }}"></script> 
<script src="{{asset('assetClient/js/bootstrap.min.js') }}"></script> 
<script src="{{asset('assetClient/js/own-menu.js') }}"></script> 
<script src="{{asset('assetClient/js/jquery.lighter.js') }}"></script> 
<script src="{{asset('assetClient/js/owl.carousel.min.js') }}"></script> 

<!-- SLIDER REVOLUTION 4.x SCRIPTS  --> 
<script type="text/javascript" src="{{asset('assetClient/rs-plugin/js/jquery.tp.t.min.js') }}"></script> 
<script type="text/javascript" src="{{asset('assetClient/rs-plugin/js/jquery.tp.min.js') }}"></script> 
<script src="{{asset('assetClient/js/main.js') }}"></script> 
<script src="{{asset('assetClient/js/custom.js') }}"></script> 

@yield('js')
</body>
</html>