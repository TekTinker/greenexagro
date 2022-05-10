@extends('templates.consultantaccount')

@section('consultantpage')

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
                            <th>Date</th>
                            <th>Address</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Details</th>
                            </thead>
                            @foreach($orders as $order)
                                @include('pages.consultant.single_order')
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