<table class="table" style="height: 260px">
    <tbody>
    <tr style="height: 200px">
        <td colspan="2" style="text-align: center; vertical-align: middle">
            <a href="{{ route('crop.details', ['id' => $product->id ]) }}"><img
                        src="{{ URL::asset('images/products/' . $product->img) }}" class="thumbnail"
                        style="width: 100%;"/></a>
        </td>
    </tr>
    <tr style="height: 40px">
        <th colspan="2" style="text-align: center;font-size: medium; vertical-align: middle">{{ $product->name }}</th>
    </tr>
    </tbody>
</table>