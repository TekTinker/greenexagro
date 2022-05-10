@extends('templates.default')
@section('content')

    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Checkout</h2>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Page title area -->

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1" style="font-family: 'Raleway', sans-serif">
                <div style="margin-top: 50px"><h2 class="sidebar-title">Customer Details</h2></div>

                <div>
                    <div class="table-responsive">
                        <table class="table" style="border: hidden">
                            <tbody>
                            <tr>
                                <td width="20%" style="text-align: left; font-size: large; vertical-align: middle">
                                    Unique ID
                                    :
                                </td>
                                <td width="80%"
                                    style="text-align: left; font-size: larger; vertical-align: middle">{{ $user->uid }}</td>
                            </tr>
                            <tr>
                                <td width="20%" style="text-align: left; font-size: large; vertical-align: middle">Name
                                    :
                                </td>
                                <td width="80%"
                                    style="text-align: left; font-size: larger; vertical-align: middle">{{ $user->name }}</td>
                            </tr>

                            <tr>
                                <td style="text-align: left; font-size: large; vertical-align: middle">Mobile :</td>
                                <td style="text-align: left; font-size: larger; vertical-align: middle">{{ $user->mobile }}</td>
                            </tr>

                            <tr>
                                <td style="text-align: left; font-size: large; vertical-align: middle">Email :</td>
                                <td style="text-align: left; font-size: larger; vertical-align: middle">{{ $user->email }}</td>
                            </tr>

                            <tr>
                                <td style="text-align: left; font-size: large; vertical-align: middle">Address :</td>
                                <td style="text-align: left; font-size: larger; vertical-align: middle">{{ $details->address }}</td>
                            </tr>

                            <tr>
                                <td style="text-align: left; font-size: large; vertical-align: middle">Taluka :</td>
                                <td style="text-align: left; font-size: larger; vertical-align: middle">{{ $details->taluka }}</td>
                            </tr>

                            <tr>
                                <td style="text-align: left; font-size: large; vertical-align: middle">District :</td>
                                <td style="text-align: left; font-size: larger; vertical-align: middle">{{ $details->district }}</td>
                            </tr>

                            <tr>
                                <td style="text-align: left; font-size: large; vertical-align: middle">Pin :</td>
                                <td style="text-align: left; font-size: larger; vertical-align: middle">{{ $details->pin }}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <hr class="style13">

                <div style="margin-top: 30px"><h2 class="sidebar-title">Order Details</h2></div>

                <div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 36%">Product name</th>
                                <th style="width: 16%">Package</th>
                                <th style="width: 16%">Quantity</th>
                                <th style="width: 16%">Price per unit</th>
                                <th style="width: 16%">Total <i class="fa fa-inr"></i></th>
                            </tr>
                            <input type="hidden" value="{{ $grand_total = 0 }}"/>
                            @foreach( $cart_items as $item)
                                <tr>
                                    <td class="product-name">{{ $item->product_name }}</td>
                                    <td class="product-package">{{ $item->package }}</td>
                                    <td class="product-quantity">{{$item->quantity}}</td>
                                    <td class="unit-price">{{ $item->price }}</td>
                                    <td class="total-price">{{ $item->price * $item->quantity}}</td>
                                </tr>
                                <input type="hidden" value="{{$grand_total += ($item->price * $item->quantity) }}"/>
                            @endforeach
                            <tr>
                                <td colspan="5">
                                    <div style="font-size: large; font-weight: 800;text-align: right">
                                        <div class="grand-total">Grand Total : <i
                                                    class="fa fa-inr"> </i> {{ $grand_total }}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <hr class="style13">

                <div style="margin-top: 30px"><h2 class="sidebar-title">Payment</h2></div>

                <form action="{{ route('user.checkoutpage') }}" class="form-horizontal" method="post">
                    <div style="margin: 30px; ">

                    <div class="form-group">
                            <input type="radio" value="cod" name="payment" checked/>
                            <label class="control-label">Cash on delivery </label>
                        </div>

                        <div class="form-group">
                            <input type="radio" value="online" name="payment"/>
                            <label class="control-label">Online payment </label>
                        </div>

                        

                    </div>
                    <hr class="style13">

                    <input type="hidden" name="_token" value="{{ Session::token() }}">

                    <button type="submit" class="btn btn-info aligncenter" style="width: 30%; text-align: center">Place Order</button>
                </form>
            </div>
        </div>
    </div>

@stop
