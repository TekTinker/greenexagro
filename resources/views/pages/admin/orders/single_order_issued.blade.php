<tr>
    <td>
        {{ $order->order_id }}
    </td>
    <td>
        <strong>{{ $order->name}}</strong>
    </td>

    <td>
        {{ $order->role }}
    </td>
    <td>
        {{ $order->order_date }}
    </td>

    <td>
        {{ $order->mobile }}
    </td>

    <td>
        {{ $order->taluka }}
    </td>

    <td>
        {{ $order->district }}
    </td>
    <td>
        {{ $order->product_name }}
    </td>
    <td>
        <form method="post" action="{{ route('admin.issued_orders.activate', ['order_id' => $order->order_id]) }}">
            <input type="hidden" name="_token" value="{{ Session::token() }}">
            <input type="submit" class="btn btn-default" style="margin: 3px" value="Activate"/>
        </form>
    </td>
</tr>
