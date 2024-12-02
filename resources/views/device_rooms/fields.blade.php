<!-- Antenna Field -->
<div class="form-group col-sm-6">
    {!! Form::label('antenna', 'Antenna:') !!}
    {!! Form::text('antenna', null, ['class' => 'form-control']) !!}
</div>

<!-- Room Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('room_id', 'Room Id:') !!}
    {!! Form::select('room_id', ['s' => 's'], null, ['class' => 'form-control custom-select']) !!}
</div>
