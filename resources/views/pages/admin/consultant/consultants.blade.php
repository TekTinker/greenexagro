@extends('templates.adminaccount')

@section('adminpage')

    <div class="col-md-10" style="padding: 35px;font-family: 'Raleway', sans-serif">

        <div class="panel-group">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Search Panel
                </div>
                <div class="panel-body" style="font-family: 'Raleway', sans-serif">
                    <form class="form-horizontal" role="form" method="get"
                          action="{{ route('admin.consultants.search') }}">

                        <div class="form-group">
                            <label class="control-label col-lg-2">Unique ID</label>
                            <div class="col-md-5">
                                <input type="text" name="uid" class="form-control" id="uid"
                                       value="{{Request::old('uid') ?: ''}}"
                                       placeholder="Unique ID">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-lg-2">Name</label>
                            <div class="col-md-5">
                                <input type="text" name="name" class="form-control" id="name"
                                       value="{{Request::old('name') ?: ''}}"
                                       placeholder="Customer Name">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-lg-2">Taluka</label>
                            <div class="col-md-5">
                                <input type="text" name="taluka" class="form-control" id="taluka"
                                       value="{{Request::old('taluka') ?: ''}}"
                                       placeholder="Taluka">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">District</label>
                            <div class="col-md-5">
                                <input type="text" name="district" class="form-control" id="district"
                                       value="{{Request::old('district') ?: ''}}"
                                       placeholder="District">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Mobile</label>
                            <div class="col-md-5">
                                <input type="text" name="mobile" class="form-control" id="mobile"
                                       value="{{Request::old('mobile') ?: ''}}"
                                       placeholder="Mobile">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-2 col-sm-offset-4">
                                <button type="submit" class="btn btn-default">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    Consultant list
                </div>
                <div class="panel-body">

                    @if( count($customers) > 0)
                        <table class="table">
                            <thead>
                            <th>UID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Taluka</th>
                            <th>District</th>
                            <th>Action</th>
                            </thead>
                            @foreach($customers as $customer)
                                @include('pages.admin.consultant.single_consultant')
                            @endforeach
                        </table>
                    @else
                        <strong>No Consultant.</strong>
                    @endif

                </div>

                <div style="text-align: center">{!! $customers->links() !!}</div>
            </div>

        </div>

    </div>
@stop