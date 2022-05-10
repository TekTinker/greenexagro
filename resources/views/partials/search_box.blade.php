<div class="container-fluid" style="padding: 0px; text-align: center">
    <h2 class="sidebar-title text-center" style="margin: 20px">Search</h2>
    <div class="form">
        <form role="form" class="form-horizontal" action="{{ route('product.search', ['type' => 'product']) }}">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
                <input class="form-control" name="name" value="" placeholder="Name"
                       style="margin-top: 10px"/>
                @if ($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <select class="form-control" name="category" style="margin-top: 10px">
                <option value="all">All</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </select>
            <button class="btn-default btn" type="submit" style="margin-top: 10px">Search</button>
        </form>
    </div>
</div>
<hr>