@extends('templates.adminaccount')

@section('adminpage')

    <div class="col-md-10" style="padding: 35px;font-family: 'Raleway', sans-serif">

        <div class="panel-group">

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

                            {{dd($orders)}}
                            @foreach($orders as $order)
                                @include('pages.admin.orders.single_order_issued')
                            @endforeach
                        </table>
                    @else
                        <strong>No Orders.</strong>
                    @endif

                </div>

            </div>

        </div>

    </div>
@stop