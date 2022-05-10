@extends('templates.adminaccount')

@section('adminpage')


    <div class="col-md-10" style="padding: 35px;font-family: 'Raleway', sans-serif">

        <div class="panel-group">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    Requests
                </div>
                <div class="panel-body">

                    @if( count($employee_requests) > 0)
                        <table class="table">
                            @foreach($employee_requests as $employee)
                                <tr>
                                    <td style="font-size: large;width: 70%">
                                        <strong>{{ $employee->name}}</strong>
                                    </td>
                                    <td style="width:30%;text-align: right">
                                        <form method="post" action="{{ route('admin.employee.approve', ['id' => $employee->id]) }}">
                                            <button class="btn btn-primary" type="submit">
                                                Approve
                                            </button>
                                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                                        </form>
                                    </td>
                                </tr>

                                <tr>
                                    <td  style="border-top: hidden;width: 70%;">
                                        {{ $employee->email }}
                                    </td>
                                    <td  style="border-top: hidden;width: 30%;text-align: right">
                                        <form method="post" action="{{ route('admin.employee.delete', ['id' => $employee->id]) }}">
                                            <button class="btn" style="background: #ff262b" type="submit">
                                                Delete
                                            </button>
                                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <strong>No requests.</strong>
                    @endif

                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    Employee list
                </div>
                <div class="panel-body">

                    @if( count($employees) > 0)
                        <table class="table">
                            @foreach($employees as $employee)
                                <tr>
                                    <td style="font-size: large;width: 70%">
                                        <strong>{{ $employee->name}}</strong>
                                    </td>
                                    <td style="width:30%;text-align: right">
                                        <form method="get" action="{{ route('admin.employee.view', ['id' => $employee->id]) }}">
                                            <button class="btn btn-primary" type="submit">
                                                View
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <tr>
                                    <td  style="border-top: hidden;width: 70%;">
                                        {{ $employee->email }}
                                    </td>
                                    <td  style="border-top: hidden;width: 30%;text-align: right">
                                        <form method="post" action="{{ route('admin.employee.disable', ['id' => $employee->id]) }}">
                                            <button class="btn" style="background: #ff8a29" type="submit">
                                                Disable
                                            </button>
                                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <strong>No employees.</strong>
                    @endif



                </div>
            </div>

        </div>

    </div>


@stop