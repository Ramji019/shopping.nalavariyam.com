
<div class="footer-nav-area" id="footerNav">
    <div class="container px-0">
        <!-- Footer Content -->
        <div class="footer-nav position-relative shadow-sm footer-style-two">
            <ul class="h-100 d-flex align-items-center justify-content-between ps-0">
                <li>
                    <a href="{{ route('home') }}">
                        <i class="bi bi-house"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                  <a href="#">
                    <i class="bi bi-collection"></i>
                    <span>Category</span>
                </a>
                </li>

                <li class="active">
                    @if (Auth::user() && Auth::user()->usertype_id == 4)
                        <a href="{{ url('/user/wishlist') }}">
                            <span id="boot-icon" class="bi bi-heart"
                                style="font-size: 3rem; color: rgb(255, 255, 255);"></span>
                        </a>
                    @else
                        <a id="current_locationtop" data-bs-toggle="offcanvas" data-bs-target="#login"
                            aria-controls="offcanvasBottom">
                            <span id="boot-icon" class="bi bi-heart"
                                style="font-size: 3rem; color: rgb(255, 255, 255);"></span>

                        </a>
                    @endif
                    <div class="text-center">Favourites</div>
                </li>

                <li>
                    <a href="{{ url('/cart') }}">
                        <i class="bi bi-cart"></i>
                        <span class='badge badge-warning' id='lblCartCount'>Cart</span>
                    </a>
                </li>

                {{-- 
                @if (Auth::user())
                @if (isset($currentRouteName) && $currentRouteName == 'product')
                <li>
                    <a href="{{ url('/chat') }}/{{ $prod->seller_id }}">
                        <i class="bi bi-chat-dots"></i>
                        <span>Chat</span>
                    </a>
                </li>
                @else
                <li>
                    <a href="{{ url('/users') }}">
                        <i class="bi bi-chat-dots"></i>
                        <span>Chat</span>
                    </a>
                </li>
                @endif
                @else
                <li>
                    <a data-bs-toggle="offcanvas" data-bs-target="#login" aria-controls="offcanvasBottom">
                        <i class="bi bi-chat-dots"></i>
                        <span>Chat</span>
                    </a>
                </li>
                @endif --}}

                <li>
                    <a id="affanNavbarToggler" data-bs-toggle="offcanvas" data-bs-target="#test"
                    aria-controls="affanOffcanvas">
                        <i class="bi bi-three-dots-vertical"></i>
                        <span>More</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>


    <div class="offcanvas offcanvas-start" id="test" data-bs-scroll="true" tabindex="-1"
    aria-labelledby="affanOffcanvsLabel">

    <button class="btn-close btn-close-white text-reset" type="button" data-bs-dismiss="offcanvas"
      aria-label="Close"></button>

    <div class="offcanvas-body p-0">
      <div class="sidenav-wrapper">
        <!-- Sidenav Profile -->
        <div class="sidenav-profile bg-gradient">
          <div class="sidenav-style1"></div>

          <!-- User Thumbnail -->
          <div class="user-profile">
            <img src="img/bg-img/2.jpg" alt="">
          </div>

          <!-- User Info -->
          <div class="user-info">
            <h6 class="user-name mb-0">Shopping</h6>
          </div>
        </div>

        <!-- Sidenav Nav -->
        <ul class="sidenav-nav ps-0">
          <li>
            <a href="{{ url('/') }}"><i class="bi bi-house-door"></i> Home</a>
          </li>
          <li>
            <a href="{{ url('/sellerregister') }}"><i class="bi bi-folder2-open"></i> Seller Registration
            </a>
          </li>
          <li>
            <a href="{{ url('/admin') }}"><i class="bi bi-collection"></i> Seller Login
            </a>
          </li>
          <li>
            <div class="night-mode-nav">
              <i class="bi bi-moon"></i> Dark Mode
              <div class="form-check form-switch">
                <input class="form-check-input form-check-success" id="darkSwitch" type="checkbox">
              </div>
            </div>
          </li>
          @if(Auth::user())
          <li>
            <a href="{{ url('/userlogout') }}"><i class="bi bi-box-arrow-right"></i> Logout</a>
          </li>
          @endif
        </ul>

        <!-- Social Info -->
        <div class="social-info-wrap">
          <a href="#">
            <i class="bi bi-facebook"></i>
          </a>
          <a href="#">
            <i class="bi bi-twitter"></i>
          </a>
          <a href="#">
            <i class="bi bi-linkedin"></i>
          </a>
        </div>

        <!-- Copyright Info -->
        <div class="copyright-info">
          <p>
            <span id="copyrightYear"></span>
            &copy; Made by <a href="#">Designing World</a>
          </p>
        </div>
      </div>
    </div>
  </div>

