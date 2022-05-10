<tr>
    <td>
        {{ $customer->uid }}
    </td>
    <td>
        <strong>{{ $customer->name}}</strong>
    </td>

    <td>
        {{ $customer->email }}
    </td>

    <td>
        {{ $customer->mobile }}
    </td>

    <td>
        {{ $customer->taluka }}
    </td>
    <td>
        {{ $customer->district }}
    </td>
    <td>
        <a href="{{ route('admin.consultant.view', ['id' => $customer->id]) }}" class="btn btn-default" style="margin: 3px">View Profile</a><br>
        <a href="" class="btn btn-default" style="margin: 3px">View Orders</a>
    </td>

</tr>
