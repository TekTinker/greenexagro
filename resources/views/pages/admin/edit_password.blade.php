@extends('templates.adminaccount')

@section('adminpage')

    <div class="col-md-8 " style="font-family: 'Raleway', sans-serif; padding: 30px">

        <div class="container" style="padding-top: 50px; font-family: 'Raleway', sans-serif">
            <form class="form-horizontal" role="form" method="post"
                  action="{{ route('user.account.edit_password') }}">

                <div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
                    <label class="control-label col-md-3" for="password">Current Password :</label>
                    <div class="col-md-5">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Current Password">
                        @if ($errors->has('password'))
                            <span class="help-block">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('new_password') ? ' has-error' : ''}}">
                    <label class="control-label col-md-3" for="new_password">New Password :</label>
                    <div class="col-md-5">
                        <input type="password" name="new_password" class="form-control" id="new_password" placeholder="New Password">
                        @if ($errors->has('new_password'))
                            <span class="help-block">{{ $errors->first('new_password') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('retype') ? ' has-error' : ''}}">
                    <label class="control-label col-md-3" for="retype">Re-enter New Password :</label>
                    <div class="col-md-5">
                        <input type="password" name="retype" class="form-control" id="retype" placeholder="Re-enter New Password">
                        @if ($errors->has('retype'))
                            <span class="help-block">{{ $errors->first('retype') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-2 col-md-offset-1">
                        <button type="submit" class="btn btn-default btn-block">Save</button>
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-default btn-block" href="{{ route('admin.account') }}">Cancel</a>
                    </div>
                </div>

                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>

    </div>

@stop