<table class="table" style="height: 360px">
    <thead>
    <tr style="height: 80px">
        <th colspan="2" style="text-align: center;font-size: medium; vertical-align: middle">{{ $product->name }}</th>
    </tr>
    </thead>
    <tbody>
    <tr style="height: 260px">
        <td colspan="2" style="text-align: center; vertical-align: middle">
            <a href="{{ route('product.details', ['id' => $product->id ]) }}"><img
                        src="{{ URL::asset('images/products/' . $product->img) }}" class="thumbnail"
                        style="width: 100%;"/></a>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center; width: 80%; vertical-align: bottom">
            <button class="btn btn-primary" style="width: 100%"
                    id="{{ $product->id }}_addToCart"
                    data-toggle="modal" data-target="#{{ $product->id }}Modal">Add to cart
            </button>
        </td>
    </tr>
    </tbody>
</table>
