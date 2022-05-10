@extends('templates.default')
@section('content')

    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Sign Up</h2>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Page title area -->

    <div class="container" style="padding-top: 50px; font-family: 'Raleway', sans-serif">
        <form class="form-horizontal" role="form" method="post" action="{{ route('auth.signup') }}">

            <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
                <label class="control-label col-sm-4" for="name">Name :</label>
                <div class="col-md-5">
                    <input type="text" name="name" class="form-control" id="name"
                           value="{{Request::old('name') ?: ''}}"
                           placeholder="Full Name">
                    @if ($errors->has('name'))
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-4" for="role">Signup As :</label>
                <div class="col-md-5">
                    <select name="role" class="form-control" id="role">
                        <option value="customer" {{Request::old('role') == 'customer' ? 'selected' : ''}}>Customer
                        </option>
                        <option value="consultant" {{Request::old('role') == 'consultant' ? 'selected' : ''}}>
                            Consultant
                        </option>
                        <option value="employee" {{Request::old('role') == 'employee' ? 'selected' : ''}}>Employee
                        </option>
                    </select>
                    @if ($errors->has('role'))
                        <span class="help-block">{{ $errors->first('role') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
                <label class="control-label col-sm-4" for="email">Email :</label>
                <div class="col-md-5">
                    <input type="email" name="email" class="form-control" id="email"
                           value="{{Request::old('email') ?: ''}}" placeholder="Email"/>
                    @if ($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('address') ? ' has-error' : ''}}">
                <label class="control-label col-sm-4" for="address">Address :</label>
                <div class="col-md-5">
                    <textarea rows="3" name="address" class="form-control" id="address"
                              placeholder="Address">{{Request::old('address') ?: ''}}</textarea>
                    @if ($errors->has('address'))
                        <span class="help-block">{{ $errors->first('address') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('taluka') ? ' has-error' : ''}}">
                <label class="control-label col-sm-4" for="taluka">Taluka :</label>
                <div class="col-md-5">
                    <input type="text" name="taluka" class="form-control" id="taluka"
                           value="{{Request::old('taluka') ?: ''}}" placeholder="Taluka">
                    @if ($errors->has('taluka'))
                        <span class="help-block">{{ $errors->first('taluka') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('district') ? ' has-error' : ''}}">
                <label class="control-label col-sm-4" for="district">District :</label>
                <div class="col-md-5">
                    <input type="text" name="district" class="form-control" id="district"
                           value="{{Request::old('district') ?: ''}}"
                           placeholder="District">
                    @if ($errors->has('district'))
                        <span class="help-block">{{ $errors->first('district') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('pin') ? ' has-error' : ''}}">
                <label class="control-label col-sm-4" for="pin">Pin :</label>
                <div class="col-md-5">
                    <input type="text" name="pin" class="form-control" id="pin"
                           value="{{Request::old('pin') ?: ''}}" placeholder="Pincode">
                    @if ($errors->has('pin'))
                        <span class="help-block">{{ $errors->first('pin') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('mobile') ? ' has-error' : ''}}">
                <label class="control-label col-sm-4" for="mobile">Mobile :</label>
                <div class="col-md-5">
                    <input type="text" name="mobile" class="form-control" id="mobile"
                           value="{{Request::old('mobile') ?: ''}}" placeholder="Mobile">
                    @if ($errors->has('mobile'))
                        <span class="help-block">{{ $errors->first('mobile') }}</span>
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
                           placeholder="Reenter Password" id="confirm" title="Confirm Password">
                    @if ($errors->has('confirm'))
                        <span class="help-block">{{ $errors->first('confirm') }}</span>
                    @endif
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-2 col-sm-offset-4">
                    <button type="submit" class="btn btn-default">Sign up</button>
                </div>
            </div>

            <input type="hidden" name="_token" value="{{ Session::token() }}">
        </form>
    </div>
@stop
