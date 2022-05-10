@extends('templates.default')
@section('content')
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Login</h2>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Page title area -->

    <div class="container" style="margin: 40px; padding-top: 50px">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form class="form-vertical" role="form" method="post" action="{{ route('auth.login') }}">

                    <div class="form-group{{ $errors->has('login') ? ' has-error' : ''}}">
                        <input type="text" name="login" class="form-control" id="login"
                               value="{{Request::old('login') ?: ''}}" placeholder="Email/Mobile"/>
                        @if ($errors->has('login'))
                            <span class="help-block">{{ $errors->first('login') }}</span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
                        <input type="password" name="password" class="form-control"
                               id="password" title="Password" placeholder="Password">
                        @if ($errors->has('password'))
                            <span class="help-block">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <div class="checkbox" style="padding: 10px">
                        <label>
                            <input type="checkbox" name="remember"> Remember me
                        </label>
                    </div>

                    <div class="form-group" style="text-align: center">
                        <button class="btn btn-success" style="width: 20%;">Login</button>


                        <span style="padding-right: 30px"></span>
                        <a class="btn btn-warning" href="{{ route('auth.forgot') }}">Forgot Password</a>

                    </div>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
            </div>
        </div>
    </div>

@stop
