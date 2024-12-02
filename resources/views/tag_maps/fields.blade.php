<!-- Tag Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tag_id', 'Tag Id:') !!}
    {!! Form::select('tag_id', ['s' => 's'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Item Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('item_id', 'Item Id:') !!}
    {!! Form::text('item_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Item Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('item_type', 'Item Type:') !!}
    {!! Form::text('item_type', null, ['class' => 'form-control']) !!}
</div>