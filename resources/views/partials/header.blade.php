<div class="header-area">
    <div class="container">
        <div class="row">
            <div class="alignright">
                <div class="user-menu">
                    <ul>
                        @if (Auth::check())
                            <li><a>Hello, {{Auth::user()->name}}</a></li>
                            @if ( Auth::user()->role == 'admin')
                                <li><a href="{{ route('admin.account') }}"><i class="fa fa-cogs"></i> Admin Panel</a>
                                </li>
                            @else
                                <li><a href="{{ route('user.account') }}"><i class="fa fa-user"></i> My Account</a></li>
                                <li><a href="{{ route('user.cart') }}"><i class="fa fa-shopping-cart"></i> My Cart</a></li>
                                <li><a href="{{ route('user.checkoutpage') }}"><i class="fa fa-check-square-o"></i> Checkout</a></li>
                            @endif
                            <li><a href="{{ route('auth.logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
                        @else
                            <li><a href="{{ route('auth.signup') }}"><i class="fa fa-user"></i> SignUp</a></li>
                            <li><a href="{{ route('auth.login') }}"><i class="fa fa-sign-in"></i> Login</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End header area -->