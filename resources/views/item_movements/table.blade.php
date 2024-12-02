<div class="table-responsive">
    <table class="table" id="itemMovements-table">
        <thead>
        <tr>
            <th>Tag Id</th>
        <th>Location</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($itemMovements as $itemMovement)
            <tr>
                <td>{{ $itemMovement->tag_id }}</td>
            <td>{{ $itemMovement->location }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['itemMovements.destroy', $itemMovement->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('itemMovements.show', [$itemMovement->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('itemMovements.edit', [$itemMovement->id]) }}"
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
