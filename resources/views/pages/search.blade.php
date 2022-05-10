@extends('templates.default')
@section('content')

    <div class="container">

        @foreach( $products as $product)
            @include('partials.single_product_modal')
        @endforeach

        <div class="row">

            <div class="col-lg-10 col-md-9 hidden-xs" style="padding: 20px">

                @if (Session::has('search'))
                    <div style="font-family: 'Raleway', sans-serif; text-align: center;font-size: medium">
                        Search results, found {{ Session::get('search') }} products
                        {{ Session::forget('search') }}
                    </div>
                @endif

                <div class="container">
                    <div class="row" style="margin: 10px;">
                        @foreach( $products as $product)
                            <div class="col-lg-3 col-md-4 col-sm-5 product-page-item">
                                @include('partials.single_product')
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="hidden-lg hidden-md hidden-sm col-xs-10">

                @if (Session::has('search'))
                    <div class="product-name" style="font-family: 'Raleway', sans-serif; text-align: center;">
                        Found {{ Session::get('search') }} products
                        {{ Session::forget('search') }}
                    </div>
                @endif

                <div class="container-fluid">
                    <div class="row">
                        @foreach( $products as $product)
                            <div class="col-xs-12 product-page-item-xs">
                                @include('partials.single_product')
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div style="text-align: center">{!! $products->links() !!}</div>

        </div>
    </div>

@stop
