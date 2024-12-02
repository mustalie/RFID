<div class="table-responsive">
    <table class="table" id="inventoryGroups-table">
        <thead>
        <tr>
            <th>Name</th>
        <th>Required Permission</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($inventoryGroups as $inventoryGroup)
            <tr>
                <td>{{ $inventoryGroup->name }}</td>
            <td>{{ $inventoryGroup->required_permission }}</td>
            <td>{{ $inventoryGroup->status }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['inventoryGroups.destroy', $inventoryGroup->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('inventoryGroups.show', [$inventoryGroup->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('inventoryGroups.edit', [$inventoryGroup->id]) }}"
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
