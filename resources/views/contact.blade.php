@extends('templates.base')
@section('base')


    <div class="maincontent-area">
        <div class="container">
            <div class="row">
                @include('partials.alert')
                <span style="font-size: large; margin-left: 5%">For any information and queries please contact us</span>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6" style="margin-right: 30px;">
                            <div style="margin: 15px; font-family: Raleway, sans-serif;">
                                <div>
                                    <div class="row" style="padding-top: 50px; font-family: 'Raleway', sans-serif;">
                                        <h3 style="text-align: center">Contact form</h3>
                                        <form class="form-horizontal" role="form" method="post"
                                              action="{{ route('user.contact') }}">

                                            <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
                                                <label class="control-label col-sm-4" for="name">Name :</label>
                                                <div class="col-md-8">
                                                    <input type="text" name="name" class="form-control" id="name"
                                                           value="{{Request::old('name') ?: ''}}"
                                                           placeholder="Full Name">
                                                    @if ($errors->has('name'))
                                                        <span class="help-block">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('mobile') ? ' has-error' : ''}}">
                                                <label class="control-label col-sm-4" for="mobile">Mobile :</label>
                                                <div class="col-md-8">
                                                    <input type="text" name="mobile" class="form-control" id="mobile"
                                                           value="{{Request::old('mobile') ?: ''}}"
                                                           placeholder="Mobile">
                                                    @if ($errors->has('mobile'))
                                                        <span class="help-block">{{ $errors->first('mobile') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
                                                <label class="control-label col-sm-4" for="email">Email :</label>
                                                <div class="col-md-8">
                                                    <input type="email" name="email" class="form-control" id="email"
                                                           value="{{Request::old('email') ?: ''}}" placeholder="Email"/>
                                                    @if ($errors->has('email'))
                                                        <span class="help-block">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('message') ? ' has-error' : ''}}">
                                                <label class="control-label col-sm-4" for="message">Message :</label>
                                                <div class="col-md-8">
                    <textarea rows="3" name="message" class="form-control" id="message"
                              placeholder="Message">{{Request::old('message') ?: ''}}</textarea>
                                                    @if ($errors->has('message'))
                                                        <span class="help-block">{{ $errors->first('message') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-4 col-sm-offset-4">
                                                    <button type="submit" class="btn btn-default">Submit</button>
                                                </div>
                                            </div>

                                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div style="margin: 30px; font-family: Raleway, sans-serif;">
                                <br>
                                <br>
                                <h3>Registered & Corporate Office</h3>
                                <p>
                                    Greenex Agro Chemicals<br>
                                    Gut 45 At Shahajatpur Post Lasurgaon,<br>
                                    Taluka Vaijapur,<br>
                                    District Aurangabad,<br>
                                    Pin : 423701<br>
                                    Mobile : 9665101095<br>
                                    E-mail : support@greenexagro.com<br>
                                    Website : www.greenexagro.com<br><br>
                                </p>
                                <h3>Office Address</h3>
                                <p>
                                    Sandeep Krushi Seva Kendra,<br>
                                    Lasur station,<br>
                                    Taluka Gangapur,<br>
                                    District Aurangabad,
                                    Pin : 431133<br>
                                    Telephone : 02433241595
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop