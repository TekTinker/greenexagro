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
    <input type="hidden" name="role" value="employee">
    <input type="hidden" name="_token" value="{{ Session::token() }}">
</form>