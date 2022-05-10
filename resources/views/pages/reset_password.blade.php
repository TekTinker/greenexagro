@extends('templates.default')
@section('content')
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Reset Password</h2>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Page title area -->

    <div class="container" style="padding-top: 50px; font-family: 'Raleway', sans-serif">
        <form class="form-horizontal" role="form" method="post" action="{{ route('auth.reset') }}">

            <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
                <label class="control-label col-sm-4" for="name">Name :</label>
                <div class="col-md-5">
                    <input type="text" name="name" class="form-control" id="name"
                           value="{{ $user->name }}"
                           placeholder="Full Name" readonly>
                    @if ($errors->has('name'))
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>


            <div class="form-group{{ $errors->has('pin') ? ' has-error' : ''}}">
                <label class="control-label col-sm-4" for="pin">Reset Pin :</label>
                <div class="col-md-5">
                    <input type="text" name="pin" class="form-control" id="pin"
                           value="{{Request::old('pin') ?: ''}}"
                           placeholder="Reset Pin">
                    @if ($errors->has('pin'))
                        <span class="help-block">{{ $errors->first('pin') }}</span>
                    @endif
                </div>
            </div>


            <div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
                <label class="control-label col-sm-4" for="password">Password :</label>
                <div class="col-md-5">
                    <input type="password" name="password" class="form-control"
                           placeholder="Password" id="password" title="Password">
                    @if ($errors->has('password'))
                        <span class="help-block">{{ $errors->first('password') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('confirm') ? ' has-error' : ''}}">
                <label class="control-label col-sm-4" for="confirm">Confirm Password :</label>
                <div class="col-md-5">
                    <input type="password" name="confirm" class="form-control"
                           placeholder="Reenter password" id="confirm" title="Confirm Password">
                    @if ($errors->has('confirm'))
                        <span class="help-block">{{ $errors->first('confirm') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-2 col-sm-offset-4">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>

            <input type="hidden" name="_token" value="{{ Session::token() }}">
            <input type="hidden" name="id" value="{{ $user->id }}">
        </form>
    </div>

@stop
