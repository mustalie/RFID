<div class="table-responsive">
    <table class="table" id="studentPresences-table">
        <thead>
        <tr>
            <th>Nim</th>
        <th>Room Id</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($studentPresences as $studentPresence)
            <tr>
                <td>{{ $studentPresence->nim }}</td>
            <td>{{ $studentPresence->room_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['studentPresences.destroy', $studentPresence->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('studentPresences.show', [$studentPresence->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('studentPresences.edit', [$studentPresence->id]) }}"
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
