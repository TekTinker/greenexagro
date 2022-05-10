<div class="site-branding-area">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="logo" style="margin-top: 40px;margin-bottom: 40px;text-align: center">
                    <a>
                        <img style="height: 50px" src="{{ URL::asset('images/logo/main_logo.jpg') }}"/>
                    </a>
                </div>
            </div>

            @if(Auth::check())
                @if(Auth::user()->role == 'customer' || Auth::user()->role == 'consultant')
                    @if(isset($cart))
                        <div class="col-md-offset-2 col-md-4" style="height: 100px;">
                            <div class="shopping-item">
                                <a href="{{ route('user.cart') }}">
                                    Cart - <i class="fa fa-inr"></i>
                                    <span class="cart-amunt" id="main-cart-amount">
                                        {{ $cart->total_price }}
                                    </span>
                                    <i class="fa fa-shopping-cart"></i>
                                    <span class="product-count" id="main-cart-count">
                                        {{ $cart->total_items }}
                                    </span>
                                </a>
                            </div>
                        </div>
                    @endif
                @endif
            @endif
        </div>
    </div>
</div> <!-- End site branding area -->