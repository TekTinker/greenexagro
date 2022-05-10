@extends('templates.adminaccount')

@section('adminpage')
    <div class="col-md-10">
        <div class="panel-group" style="padding: 20px;">

            <div class="panel panel-primary">

                <div class="panel-heading">Categories</div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th style="text-align: center">Name</th>
                            <th style="text-align: center">Type</th>
                            <th style="text-align: center">Status</th>
                            <th style="text-align: center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ( $categories as $category )
                            <tr style="text-align: center">
                                <td> {{ $category->name }} </td>
                                <td> {{ $category->type }} </td>
                                <td>
                                    @if( $category->available )
                                        Enabled
                                    @else
                                        Disabled
                                    @endif
                                </td>
                                <td>
                                    <form method="post" action="{{ route('admin.product.categories.toggle', ['id' => $category->id]) }}">
                                        <button class="btn btn-primary btn-xs" type="submit">
                                            @if( $category->available )
                                                Disable
                                            @else
                                                Enable
                                            @endif
                                        </button>
                                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                                    </form>
                                    <br>
                                    <form method="post" action="{{ route('admin.product.categories.delete', ['id' => $category->id]) }}">
                                        <button class="btn btn-primary btn-xs" type="submit">
                                            Delete
                                        </button>
                                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="panel panel-primary">

                <div class="panel-heading">Add Category</div>
                <div class="panel-body">

                    <form class="row" role="form" method="post" action="{{ route('admin.product.categories.add') }}">

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}} col-md-5">
                            <input type="text" name="name" class="form-control" id="name"
                                   value="{{Request::old('name') ?: ''}}" placeholder="Name"/>
                            @if ($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : ''}} col-md-4">
                            <select class="form-control" id="type" name="type">
                                <option value="Product">Product</option>
                                <option value="Raw">Raw</option>
                                <option value="Crop">Crop</option>
                            </select>
                            @if ($errors->has('type'))
                                <span class="help-block">{{ $errors->first('type') }}</span>
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