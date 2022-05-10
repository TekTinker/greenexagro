@extends('templates.default')
@section('content')

    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Account</h2>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Page title area -->

    <div class="row">

        <div class="hidden-lg col-md-2">
            <div class="container-fluid" style="display: inline; margin: 20px" id="cssmenu">
                <ul>
                    <li><a href='{{ route('user.account') }}'><span>Profile</span></a></li>
                    <li><a href='{{ route('customer.account.farms') }}'><span>Farms</span></a></li>
                    <li><a href='{{ route('customer.account.orders') }}'><span>Orders</span></a></li>
                </ul>
            </div>

        </div>

        <div class="col-lg-2 hidden-md hidden-xs hidden-sm">
            <div class="container-fluid" id="cssmenu">
                <ul>
                    <li><a href='{{ route('user.account') }}'><span>Profile</span></a></li>
                    <li><a href='{{ route('customer.account.farms') }}'><span>Farms</span></a></li>
                    <li><a href='{{ route('customer.account.orders') }}'><span>Orders</span></a></li>
                </ul>
            </div>

        </div>

        @yield('customerpage')

    </div>

@stop
