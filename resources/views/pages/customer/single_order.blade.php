<tr>

    <td>
        {{ date_format($order->created_at, 'd/m/Y') }}
    </td>

    <td>
        {{ $order->address }}<br/>
        {{ $order->taluka }}<br/>
        {{ $order->district }}<br/>
    </td>

    <td>
        {{ $order->total_price }}
    </td>

    <td>
        {{ $order->status }}
    </td>

    <td>
        <a class="btn btn-default" style="margin: 3px" href="{{ route('order.details', ['order_id' => $order->id]) }}">View</a>
    </td>
</tr>
