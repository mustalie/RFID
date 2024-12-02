<div class="table-responsive">
    <table class="table" id="deviceRooms-table">
        <thead>
        <tr>
            <th>Antenna</th>
        <th>Room Id</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($deviceRooms as $deviceRoom)
            <tr>
                <td>{{ $deviceRoom->antenna }}</td>
            <td>{{ $deviceRoom->room_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['deviceRooms.destroy', $deviceRoom->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('deviceRooms.show', [$deviceRoom->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('deviceRooms.edit', [$deviceRoom->id]) }}"
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
