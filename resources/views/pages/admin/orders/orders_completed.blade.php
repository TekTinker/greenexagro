@extends('templates.adminaccount')

@section('adminpage')

    <div class="col-md-10" style="padding: 35px;font-family: 'Raleway', sans-serif">

        <div class="panel-group">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Search Panel
                </div>
                <div class="panel-body" style="font-family: 'Raleway', sans-serif">
                    <form class="form-horizontal" role="form" method="get" action="{{ route('admin.issued_orders.search') }}">
                        <div class="form-group">
                            <label class="control-label col-lg-3">Name</label>
                            <div class="col-md-5">
                                <input type="text" name="name" class="form-control" id="name"
                                       value="{{Request::old('name') ?: ''}}"
                                       placeholder="Customer Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3">Date From</label>
                            <div class="col-md-5">
                                <input size="40" type="date" name="dateFrom" class="form-control" id="dateFrom"
                                       value="{{Request::old('dateFrom') ?: ''}}" placeholder="YYYY-MM-DD"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3">To</label>
                            <div class="col-md-5">
                                <input size="40" type="date" name="dateTo" class="form-control" id="dateTo"
                                       value="{{Request::old('dateTo') ?: ''}}" placeholder="YYYY-MM-DD"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3">Type</label>
                            <div class="col-md-5">
                                <select class="form-control col-lg-5" id="type" name="type">
                                    <option value="any">Any</option>
                                    <option value="customer">Customer</option>
                                    <option value="consultant">Consultant</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-3">Taluka</label>
                            <div class="col-md-5">
                                <input type="text" name="taluka" class="form-control" id="taluka"
                                       value="{{Request::old('taluka') ?: ''}}"
                                       placeholder="Taluka">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-3">District</label>
                            <div class="col-md-5">
                                <input type="text" name="district" class="form-control" id="district"
                                       value="{{Request::old('district') ?: ''}}"
                                       placeholder="District">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-3">Mobile</label>
                            <div class="col-md-5">
                                <input type="text" name="mobile" class="form-control" id="mobile"
                                       value="{{Request::old('mobile') ?: ''}}"
                                       placeholder="Mobile">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-3">Product Name</label>
                            <div class="col-md-5">
                                <input type="text" name="product_name" class="form-control" id="product_name"
                                       value="{{Request::old('product_name') ?: ''}}"
                                       placeholder="Product Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3 col-sm-offset-2">
                                <button name="action" value="search" class="btn btn-default"
                                        style="width: 100%">
                                    Search
                                </button>
                            </div>

                            <div class="col-md-3 col-sm-offset-1">
                                <button name="action" value="print" class="btn btn-info"
                                        style="width: 100%">
                                    Print
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="panel panel-primary">
                <div class="panel-heading">
                    Orders
                </div>
                <div class="panel-body">

                    @if( count($orders) > 0)
                        <table class="table">
                            <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Mobile</th>
                            <th>Taluka</th>
                            <th>District</th>
                            <th>Product</th>
                            <th>Action</th>
                            </thead>
                            @foreach($orders as $order)
                                @include('pages.admin.orders.single_order_issued')
                            @endforeach
                        </table>
                    @else
                        <strong>No Orders.</strong>
                    @endif

                </div>
                <div style="text-align: center">{!! $orders->links() !!}</div>
            </div>

        </div>

    </div>
@stop