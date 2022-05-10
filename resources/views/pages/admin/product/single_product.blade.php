<tr>

    <td rowspan="4">
        <img src="{{  URL::asset('images/products/' . $product->img) }}" class="img-thumbnail" width="150px"
             height="150px">
    </td>

    <td style="font-size: medium; font-weight: 800">Name : {{ $product->name }}</td>

    <td rowspan="4" style="text-align: center; vertical-align: middle;">
        @if( $product->available == 0)
            Disabled
        @else
            Enabled
        @endif
    </td>

    <td rowspan="2" style="text-align: center; vertical-align: middle">
        @if( $product->available == 0)
            <form method="post" action="{{ route('admin.product.edit.status.toggle', ['id' => $product->id]) }}">
                <button class="btn-primary btn-sm" type="submit">Enable</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        @else
            <form method="post" action="{{ route('admin.product.edit.status.toggle', ['id' => $product->id]) }}">
                <button class="btn-primary btn-sm" type="submit">Disable</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        @endif

    </td>

</tr>

<tr style="border: hidden">
    <td>
        Category : {{ $product->category }}
    </td>
</tr>

<tr>
    <td style="border: hidden">
        Type : {{ $product->type }}
    </td>
    <td rowspan="2" style="text-align: center; vertical-align: middle">
        <form method="get" action="{{ route('admin.product.edit.single', ['id' => $product->id]) }}">
            <button class="btn-primary btn-sm" type="submit">Edit</button>
        </form>
    </td>
</tr>

<tr>
    <td>
        @if($product->type != 'Crop')
            <form method="get" action="{{ route('admin.product.packages', ['id' => $product->id]) }}">
                <button class="btn btn-sm" type="submit">Packages</button>
            </form>
        @endif

    </td>

</tr>