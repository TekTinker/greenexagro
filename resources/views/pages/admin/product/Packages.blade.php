@extends('templates.adminaccount')

@section('adminpage')

    <div class=" col-md-10" style="font-family: 'Raleway',sans-serif; padding: 30px">
        <div class="panel-group">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Product
                </div>
                <div class="panel-body">
                    <table class="table" style="border: hidden;">
                        <tbody>
                        <tr>
                            <td rowspan="3" style="width: 30%">
                                <img src="{{  URL::asset('images/products/' . $product->img) }}"
                                     class="img-thumbnail" width="200px" height="300px"/>
                            </td>
                            <td style="font-size: large; font-weight: 800; width: 70%">Name : {{ $product->name }}</td>
                        </tr>
                        <tr>
                            <td>Type : {{ $product->type }}</td>
                        </tr>
                        <tr>
                            <td>Category : {{ $product->category }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    Packages
                </div>
                <div class="panel-body">
                    @if ( count($packages) > 0 )
                        <table class="table" style="border: hidden;">
                            <thead>
                            <tr style="font-size: larger">
                                <th style="width: 30%;">Package</th>
                                <th style="width: 30%;">Price</th>
                                <th style="width: 20%;">Status</th>
                                <th style="width: 20%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($packages as $package)
                                <tr>
                                    <td style="font-size: medium;">
                                        {{ $package->package }}
                                    </td>
                                    <td style="font-size: large;">
                                        {{ $package->price }}
                                    </td>
                                    <td style="font-size: large;">
                                        <form method="post"
                                              action="{{ route('admin.product.packages.toggle', ['id' => $package->id]) }}">
                                            <button class="btn btn-primary" type="submit">
                                                @if( $package->available )
                                                    Disable
                                                @else
                                                    Enable
                                                @endif
                                            </button>
                                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                                        </form>
                                    </td>
                                    <td style="font-size: large;">
                                        <form method="post" action="{{ route('admin.product.packages.delete', ['id' => $package->id]) }}">
                                            <button class="btn btn-danger" type="submit">
                                                Delete
                                            </button>
                                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        Packages not added.
                    @endif
                </div>
            </div>

            <div class="panel panel-primary">

                <div class="panel-heading">Add Package</div>
                <div class="panel-body">

                    <form class="row" role="form" method="post" action="{{ route('admin.product.packages.add', ['id' => $product->id]) }}">

                        <div class="form-group{{ $errors->has('package') ? ' has-error' : ''}} col-md-4">
                            <input type="text" name="package" class="form-control" id="package"
                                   value="{{Request::old('package') ?: ''}}" placeholder="Package"/>
                            @if ($errors->has('package'))
                                <span class="help-block">{{ $errors->first('package') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('price') ? ' has-error' : ''}} col-md-4">
                            <input type="text" name="price" class="form-control" id="price"
                                   value="{{Request::old('price') ?: ''}}" placeholder="Price"/>
                            @if ($errors->has('price'))
                                <span class="help-block">{{ $errors->first('price') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-md-2 col-md-offset-1">
                            <button type="submit" class="btn btn-sm">Add</button>
                        </div>
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                    </form>

                </div>
            </div>
        </div>

    </div>

@stop