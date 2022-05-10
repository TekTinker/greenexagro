@extends('templates.adminaccount')

@section('adminpage')

    <div class="col-md-10" style="padding: 35px">

        <div class="panel panel-primary">

            <div class="panel-heading" style="text-align: center">Edit Product</div>
            <div class="panel-body">


                <div class="zigzag-bottom"></div>
                <div class="row" style="font-family: 'Raleway', sans-serif">
                    <form class="form-horizontal" enctype="multipart/form-data" role="form" method="post"
                          action="{{ route('admin.product.edit.single', ['id' => $product->id]) }}">

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}} form">
                            <label class="control-label col-sm-3">Name</label>
                            <div class="col-sm-7">
                                <input type="text" name="name" class="form-control" id="name"
                                       value="{{Request::old('name') ?: $product->name}}" placeholder="Product Name"/>
                                @if ($errors->has('name'))
                                    <span class="help-block">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('category') ? ' has-error' : ''}}">
                            <label class="control-label col-sm-3">Category</label>
                            <div class="col-sm-7">
                                <select class="form-control" id="category" name="category">
                                    @foreach( $categories as $cat)
                                        @if($cat->type != 'Crop' && $cat->available == 1)
                                        <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('category'))
                                <span class="help-block">{{ $errors->first('category') }}</span>
                            @endif
                        </div>


                        <div class="form-group{{ $errors->has('contents') ? ' has-error' : ''}}">
                            <label class="control-label col-sm-3">Contents</label>
                            <div class="col-sm-7">
                                <input type="text" name="contents" class="form-control" id="contents"
                                       value="{{Request::old('contents') ?: $product->contents}}" placeholder="Contents"/>
                            </div>
                            @if ($errors->has('contents'))
                                <span class="help-block">{{ $errors->first('contents') }}</span>
                            @endif
                        </div>


                        <div class="form-group{{ $errors->has('description') ? ' has-error' : ''}}">
                            <label class="control-label col-sm-3" for="description">Description :</label>
                            <div class="col-sm-7">
                                <textarea rows="15" name="description" class="form-control tinymce" id="description"
                                          placeholder="Description">
                                    {{Request::old('description') ?: $product->description}}
                                </textarea>
                            </div>

                            @if ($errors->has('description'))
                                <span class="help-block">{{ $errors->first('description') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('usage') ? ' has-error' : ''}}">
                            <label class="control-label col-sm-3" for="usage">Use :</label>
                            <div class="col-sm-7">
                                <textarea rows="15" name="usage" class="form-control tinymce" id="usage"
                                          placeholder="Use">
                                    {{Request::old('usage') ?: $product->usage}}
                                </textarea>
                            </div>

                            @if ($errors->has('usage'))
                                <span class="help-block">{{ $errors->first('usage') }}</span>
                            @endif
                        </div>


                        <div class="form-group" style="padding-top: 20px;">
                            <label class="control-label col-sm-3">Available</label>
                            <div class="col-sm-2 alignleft" style="vertical-align: middle">
                                <input type="hidden" value="0" name="available">
                                <input type="checkbox" value="1" id="available" name="available">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('img') ? ' has-error' : ''}}"
                             style="padding-bottom: 20px;">
                            <label class="control-label col-sm-3">Image</label>
                            <div class="col-sm-7">
                                <input type="file" name="img" class="btn" id="img" />
                            </div>
                            @if ($errors->has('img'))
                                <span class="help-block">{{ $errors->first('img') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="col-sm-3 col-sm-offset-1">
                                <button name="action" value="save" type="submit" class="btn btn-default aligncenter">Save</button>
                            </div>
                            <div class="col-sm-3 col-sm-offset-0">
                                <button name="action" value="cancel" type="submit" class="btn btn-default aligncenter">Cancel</button>
                            </div>

                            <div class="col-sm-3">
                                <button name="action" value="delete" type="submit" class="btn aligncenter" style="background-color: #ff2929">Delete</button>
                            </div>
                        </div>

                        <input type="hidden" name="type" value="{{ $product->type }}">

                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                    </form>
                </div>
            </div>
        </div>
    </div>


@stop