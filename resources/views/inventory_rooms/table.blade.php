<div class="table-responsive">
    <table class="table" id="inventoryRooms-table">
        <thead>
        <tr>
            <th>Acc</th>
        <th>Room Id</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($inventoryRooms as $inventoryRoom)
            <tr>
                <td>{{ $inventoryRoom->ACC }}</td>
            <td>{{ $inventoryRoom->room_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['inventoryRooms.destroy', $inventoryRoom->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('inventoryRooms.show', [$inventoryRoom->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('inventoryRooms.edit', [$inventoryRoom->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
