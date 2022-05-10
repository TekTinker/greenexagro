@extends('templates.adminaccount')

@section('adminpage')

    <div class="col-md-10" style="padding: 35px;font-family: 'Raleway', sans-serif">

        <div class="panel-group">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    Notifications
                </div>
                <div class="panel-body">

                    @if( count($notifications) > 0)
                        <table class="table">
                            <thead>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Action</th>
                            </thead>
                            @foreach($notifications as $notification)
                                @include('pages.admin.notifications.notification_single')
                            @endforeach
                        </table>
                    @else
                        <strong>No notifications.</strong>
                    @endif

                </div>
                <div style="text-align: center">{!! $notifications->links() !!}</div>
            </div>

        </div>

    </div>
@stop