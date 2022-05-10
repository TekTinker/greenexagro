@extends('templates.customeraccount')

@section('customerpage')

    <div class="col-md-10" style="font-family: 'Raleway',sans-serif; padding: 30px">
        <div class="panel-group">


            <div class="panel panel-primary">
                <div class="panel-heading">
                    Crops
                </div>
                <div class="panel-body">
                    @if ( count($crops) > 0 )
                        <table class="table" style="border: hidden;">
                            <thead>
                            <tr style="font-size: larger">
                                <th style="width: 30%;">Crop</th>
                                <th style="width: 30%;">Area</th>
                                <th style="width: 20%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($crops as $crop)
                                <tr>
                                    <td style="font-size: medium;">
                                        {{ $crop->crop_name }}
                                    </td>

                                    <td style="font-size: large;">
                                        {{ $crop->area }} Acre
                                    </td>

                                    <td style="font-size: large;">
                                        <form method="post"
                                              action="{{ route('customer.account.farms.delete', ['id' => $crop->id, 'signup' => 0]) }}">
                                            <button class="btn btn-danger" type="submit">
                                                Delete
                                            </button>
                                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        Crops not added.
                    @endif
                </div>
            </div>

            <div class="panel panel-primary">

                <div class="panel-heading">Add Crop</div>
                <div class="panel-body">

                    <form class="row" role="form" method="post"
                          action="{{ route('customer.account.farms.add', ['id' => $user->id, 'signUp' => 0]) }}">

                        <div class="form-group{{ $errors->has('crop') ? ' has-error' : ''}} col-md-4">
                            <input type="text" name="crop" class="form-control" id="crop"
                                   value="{{Request::old('crop') ?: ''}}" placeholder="Crop Name"/>
                            @if ($errors->has('crop'))
                                <span class="help-block">{{ $errors->first('crop') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('area') ? ' has-error' : ''}} col-md-4">
                            <input type="text" name="area" class="form-control" id="area"
                                   value="{{Request::old('area') ?: ''}}" placeholder="Area in acre"/>
                            @if ($errors->has('area'))
                                <span class="help-block">{{ $errors->first('area') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-md-2 col-md-offset-1">
                            <button type="submit" class="btn btn-sm">Add</button>
                        </div>
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                    </form>

                </div>
            </div>
        </div>

    </div>

@stop