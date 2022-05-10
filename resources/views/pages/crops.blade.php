@extends('templates.default')
@section('content')

    <div class="container">

        <div class="row">

            <div class="col-lg-10 col-md-9 hidden-xs" style="padding: 20px">

                <div class="container">
                    <div class="row" style="margin: 10px;">
                        @foreach( $products as $product)
                            <div class="col-lg-3 col-md-4 col-sm-5 product-page-item">
                                @include('partials.single_crop')
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="hidden-lg hidden-md hidden-sm col-xs-10">

                <div class="container-fluid">
                    <div class="row">
                        @foreach( $products as $product)
                            <div class="col-xs-12 product-page-item-xs">
                                @include('partials.single_crop')
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div style="text-align: center">{!! $products->links() !!}</div>

        </div>
    </div>

@stop
