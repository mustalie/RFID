<!-- Acc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ACC', 'Acc:') !!}
    {!! Form::select('ACC', ['s' => 's'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Group Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('group_id', 'Group Id:') !!}
    {!! Form::select('group_id', ['s' => 's'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Room Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('room_id', 'Room Id:') !!}
    {!! Form::select('room_id', ['s' => 's'], null, ['class' => 'form-control custom-select']) !!}
</div>
