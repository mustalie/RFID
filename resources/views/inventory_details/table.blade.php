<div class="table-responsive">
    <table class="table" id="inventoryDetails-table">
        <thead>
        <tr>
            <th>Acc</th>
        <th>Group Id</th>
        <th>Room Id</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($inventoryDetails as $inventoryDetail)
            <tr>
                <td>{{ $inventoryDetail->ACC }}</td>
            <td>{{ $inventoryDetail->group_id }}</td>
            <td>{{ $inventoryDetail->room_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['inventoryDetails.destroy', $inventoryDetail->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('inventoryDetails.show', [$inventoryDetail->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('inventoryDetails.edit', [$inventoryDetail->id]) }}"
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
