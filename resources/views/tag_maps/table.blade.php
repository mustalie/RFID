<div class="table-responsive">
    <table class="table" id="tagMaps-table">
        <thead>
        <tr>
            <th>Tag Id</th>
        <th>Item Id</th>
        <th>Item Type</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tagMaps as $tagMap)
            <tr>
                <td>{{ $tagMap->tag_id }}</td>
            <td>{{ $tagMap->item_id }}</td>
            <td>{{ $tagMap->item_type }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['tagMaps.destroy', $tagMap->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('tagMaps.show', [$tagMap->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('tagMaps.edit', [$tagMap->id]) }}"
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
