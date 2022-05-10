@extends('templates.adminaccount')

@section('adminpage')

    <div class="col-md-10" style="padding: 35px;font-family: 'Raleway', sans-serif">

        <div class="panel-group">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    Post a Notification
                </div>
                <div class="panel-body">

                    <div class="zigzag-bottom"></div>
                    <div class="row">

                        <div class="col-md-10 col-md-offset-1">
                            <form class="form-vertical" enctype="multipart/form-data" role="form" method="post"
                                  action="{{ route('admin.notifications.add') }}">

                                <div class="form-group{{ $errors->has('title') ? ' has-error' : ''}}">
                                    <input type="text" name="title" class="form-control" id="title"
                                           value="{{Request::old('title') ?: ''}}" placeholder="Title"/>
                                    @if ($errors->has('title'))
                                        <span class="help-block">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('type') ? ' has-error' : ''}}">
                                    <select class="form-control" id="type" name="type">
                                        <option value="news">News</option>
                                        <option value="career">Career</option>
                                    </select>
                                    @if ($errors->has('type'))
                                        <span class="help-block">{{ $errors->first('type') }}</span>
                                    @endif
                                </div>


                                <div class="form-group{{ $errors->has('notification') ? ' has-error' : ''}}">
                                    <label class="control-label" for="notification">Notification :</label>
                                <textarea rows="20" name="notification" class="form-control tinymce" id="notification"
                                          placeholder="Notification">
                                    {{Request::old('notification') ?: ''}}
                                </textarea>
                                    @if ($errors->has('notification'))
                                        <span class="help-block">{{ $errors->first('notification') }}</span>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <button type="submit" class="btn btn-default aligncenter">Post</button>
                                </div>
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@stop