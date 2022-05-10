@extends('templates.adminaccount')

@section('adminpage')

    <div class="col-md-10" style="padding: 35px">

        <div class="panel panel-primary">

            <div class="panel-heading" style="text-align: center">Add Product</div>
            <div class="panel-body">


                <div class="zigzag-bottom"></div>
                <div class="row">

                    <div class="col-md-10 col-md-offset-1">
                        <form class="form-vertical" enctype="multipart/form-data" role="form" method="post"
                              action="{{ route('admin.product.add', ['type' => 'Product']) }}">

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
                                <input type="text" name="name" class="form-control" id="name"
                                       value="{{Request::old('name') ?: ''}}" placeholder="Product Name"/>
                                @if ($errors->has('name'))
                                    <span class="help-block">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('category') ? ' has-error' : ''}}">
                                <select class="form-control" id="category" name="category">

                                    @foreach( $categories as $cat)
                                        @if( $cat->type == 'Product')
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endif
                                    @endforeach

                                </select>
                                @if ($errors->has('category'))
                                    <span class="help-block">{{ $errors->first('category') }}</span>
                                @endif
                            </div>


                            <div class="form-group{{ $errors->has('contents') ? ' has-error' : ''}}">
                                <input type="text" name="contents" class="form-control" id="contents"
                                       value="{{Request::old('contents') ?: ''}}" placeholder="Contents"/>
                                @if ($errors->has('contents'))
                                    <span class="help-block">{{ $errors->first('contents') }}</span>
                                @endif
                            </div>


                            <div class="form-group{{ $errors->has('description') ? ' has-error' : ''}}">
                                <label class="control-label" for="description">Description :</label>
                                <textarea rows="15" name="description" class="form-control tinymce" id="description"
                                          placeholder="Description">
                                    {{Request::old('description') ?: ''}}
                                </textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">{{ $errors->first('description') }}</span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('usage') ? ' has-error' : ''}}">
                                <label class="control-label" for="usage">Use :</label>
                                <textarea rows="15" name="usage" class="form-control tinymce" id="usage"
                                           placeholder="Use">
                                    {{Request::old('usage') ?: ''}}
                                </textarea>
                                @if ($errors->has('usage'))
                                    <span class="help-block">{{ $errors->first('usage') }}</span>
                                @endif
                            </div>


                            <div class="form-group" style="padding-top: 20px;">
                                <input type="hidden" value="0" name="available">
                                <input type="checkbox" value="1" id="available" name="available">
                                <label>
                                    Available
                                </label>
                            </div>

                            <div class="btn-block{{ $errors->has('img') ? ' has-error' : ''}}"
                                 style="padding-bottom: 20px;">
                                <input type="file" name="img" class="btn" id="img""/>
                                @if ($errors->has('img'))
                                    <span class="help-block">{{ $errors->first('img') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-default aligncenter">Add</button>
                            </div>
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop