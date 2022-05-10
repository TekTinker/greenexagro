<tr>
    <td>
        {{ $notification->id }}
    </td>
    <td>
        <strong>{{ $notification->title}}</strong>
    </td>

    <td>
        {{ $notification->type }}
    </td>

    <td>
        <form method="post" action="{{ route('admin.notifications.delete', ['id' => $notification->id]) }}">
            <input type="hidden" name="_token" value="{{ Session::token() }}">
            <input type="submit" class="btn" style="margin: 3px; background-color: #ff2929" value="Delete"/>
        </form>
        <br>
        <a href="{{ route('admin.notifications.edit', ['id' => $notification->id] ) }}" class="btn btn-default">
            Edit
        </a>
    </td>
</tr>
