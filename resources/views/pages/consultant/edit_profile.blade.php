@extends('templates.consultantaccount')

@section('consultantpage')

    <div class="col-md-8 " style="font-family: 'Raleway', sans-serif; padding: 30px">

        <div class="container" style="padding-top: 50px; font-family: 'Raleway', sans-serif">
            <form class="form-horizontal" role="form" method="post"
                  action="">

                <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
                    <label class="control-label col-md-2" for="name">Name :</label>
                    <div class="col-md-5">
                        <input type="text" name="name" class="form-control" id="name"
                               value="{{Request::old('name') ?: $user->name}}"
                               placeholder="Full Name">
                        @if ($errors->has('first_name'))
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('address') ? ' has-error' : ''}}">
                    <label class="control-label col-md-2" for="address">Address :</label>
                    <div class="col-md-5">
                    <textarea rows="3" name="address" class="form-control" id="address"
                              placeholder="Address">{{Request::old('address') ?: $customer->address}}</textarea>
                        @if ($errors->has('address'))
                            <span class="help-block">{{ $errors->first('address') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('taluka') ? ' has-error' : ''}}">
                    <label class="control-label col-md-2" for="taluka">Taluka :</label>
                    <div class="col-md-5">
                        <input type="text" name="taluka" class="form-control" id="taluka"
                               value="{{Request::old('taluka') ?: $customer->taluka}}" placeholder="Taluka">
                        @if ($errors->has('taluka'))
                            <span class="help-block">{{ $errors->first('taluka') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('district') ? ' has-error' : ''}}">
                    <label class="control-label col-md-2" for="district">District :</label>
                    <div class="col-md-5">
                        <input type="text" name="district" class="form-control" id="district"
                               value="{{Request::old('district') ?: $customer->district}}"
                               placeholder="District">
                        @if ($errors->has('district'))
                            <span class="help-block">{{ $errors->first('district') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('pin') ? ' has-error' : ''}}">
                    <label class="control-label col-md-2" for="pin">Pin :</label>
                    <div class="col-md-5">
                        <input type="text" name="pin" class="form-control" id="pin"
                               value="{{Request::old('pin') ?: $customer->pin}}" placeholder="Pincode">
                        @if ($errors->has('pin'))
                            <span class="help-block">{{ $errors->first('pin') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('mobile') ? ' has-error' : ''}}">
                    <label class="control-label col-md-2" for="mobile">Mobile :</label>
                    <div class="col-md-5">
                        <input type="text" name="mobile" class="form-control" id="mobile"
                               value="{{Request::old('mobile') ?: $user->mobile}}" placeholder="Mobile">
                        @if ($errors->has('mobile'))
                            <span class="help-block">{{ $errors->first('mobile') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-2 col-md-offset-1">
                        <button type="submit" class="btn btn-default btn-block">Save</button>
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-default btn-block" href="{{ route('user.account') }}">Cancel</a>
                    </div>

                </div>

                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>

    </div>

@stop