@extends('templates.adminaccount')

@section('adminpage')

    <div class="col-md-10" style="padding: 35px">

        <div class="panel panel-primary">

            <div class="panel-heading">Search</div>
            <div class="panel-body">
                <form class="form-inline" role="form" method="get" action="{{ route('admin.product.edit.search') }}">

                    <div class="form-group">
                        <input type="text" name="name" class="form-control" id="name"
                               value="{{Request::old('name') ?: ''}}" placeholder="Name" />
                    </div>
                    Category
                    <div class="form-group">

                        <select class="form-control" id="category" name="category">
                            <option value="any">Any</option>
                            @foreach( $categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-sm floatright">Search</button>
                    </div>
                </form>
            </div>
        </div>
        @if( count($products) > 0 )
            <div class="table-responsive">
                <table class="table" style="border: hidden; font-family: 'Raleway',sans-serif">
                    <thead>
                    <tr style="font-size: larger">
                        <th style="width: 20%">Picture</th>
                        <th style="width: 60%">Details</th>
                        <th style="width: 10%; text-align: center">Status</th>
                        <th style="width: 10%; text-align: center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $products as $product )
                        @include('pages.admin.product.single_product')
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            No result
        @endif
    </div>


@stop