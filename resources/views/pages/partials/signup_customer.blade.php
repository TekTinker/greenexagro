<form class="form-horizontal" role="form" method="post" action="{{ route('auth.signup') }}">


    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : ''}}">
        <label class="control-label col-sm-4" for="first_name">Name :</label>
        <div class="col-md-2">
            <input type="text" name="first_name" class="form-control" id="first_name"
                   value="{{Request::old('first_name') ?: ''}}"
                   placeholder="First Name">
            @if ($errors->has('first_name'))
                <span class="help-block">{{ $errors->first('first_name') }}</span>
            @endif
        </div>
        <div class="col-md-3">
            <input type="text" name="last_name" class="form-control" id="last_name"
                   value="{{Request::old('last_name') ?: ''}}"
                   placeholder="Last Name">
            @if ($errors->has('last_name'))
                <span class="help-block">{{ $errors->first('last_name') }}</span>
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
                   value="{{Request::old('address') ?: ''}}"
                   placeholder="Address" ></textarea>
            @if ($errors->has('address'))
                <span class="help-block">{{ $errors->first('address') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('tq') ? ' has-error' : ''}}">
        <label class="control-label col-sm-4" for="taluka">Taluka :</label>
        <div class="col-md-5">
            <input type="text" name="taluka" class="form-control" id="taluka"
                   value="{{Request::old('tq') ?: ''}}" placeholder="Taluka">
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
    <div class="form-group">
        <div class="col-sm-2 col-sm-offset-4">
            <button type="submit" class="btn btn-default">Sign up</button>
        </div>
    </div>
    <input type="hidden" name="role" value="customer">
    <input type="hidden" name="_token" value="{{ Session::token() }}">
</form>