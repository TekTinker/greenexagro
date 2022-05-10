@extends('templates.default')
@section('content')

    <div class="container" style="margin-top: 15px; padding-top: 15px; font-family: 'Raleway', sans-serif">
        <div class="row" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <div class="col-md-12">
                <h2 style="margin: 20px">{{ $product->name }}</h2>
            </div>

            <div class="row">
                <div class="col-md-4" style="margin: 20px; padding: 20px">
                    <img src="{{ URL::asset('images/products/' . $product->img) }}"
                         style="width: 100%; height: 100%" class="thumbnail"/>
                </div>

                <div class="col-md-7" style="margin: 20px; padding: 20px">
                    <div class="table">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th width="20%">Category</th>
                                <td width="80%">{{ $product->category }}</td>
                            </tr>
                            <tr>
                                <th>Contents</th>
                                <td>
                                    @foreach( $contents as $content)
                                        {{$content}} <br>
                                    @endforeach
                                </td>
                            </tr>

                            <tr style="height: auto">
                                <th>Packages</th>
                                <td>
                                    @foreach($packages as $package)
                                        {{$package->package}}  : - <span class="fa fa-inr"> {{$package->price}}</span><br>
                                    @endforeach
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
            <div class="row">
                <div class="col-md-10" style="margin: 20px; padding: 20px">
                    <div class="table table-responsive">
                        <table class="table">
                            <tr style="height: auto">
                                <th>Usage</th>
                                <td  style="text-wrap: normal;width: 80%">{!! htmlspecialchars_decode($product->usage) !!}</td>
                            </tr>
                            <tr style="height: auto">
                                <th>Description</th>
                                <td  style="text-wrap: normal;width: 80%">{!! htmlspecialchars_decode($product->description) !!}</td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>

@stop
