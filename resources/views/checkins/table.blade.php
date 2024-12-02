<div class="table-responsive">
    <table class="table" id="checkins-table">
        <thead>
        <tr>
            <th>Tag Id</th>
        <th>Location</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($checkins as $checkin)
            <tr>
                <td>{{ $checkin->tag_id }}</td>
            <td>{{ $checkin->location }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['checkins.destroy', $checkin->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('checkins.show', [$checkin->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('checkins.edit', [$checkin->id]) }}"
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
