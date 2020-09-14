<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Keywords Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('keywords', 'Keywords:') !!}
    {!! Form::textarea('keywords', null, ['class' => 'form-control']) !!}
</div>

<!-- Priority Field -->
<div class="form-group col-sm-6">
    {!! Form::label('priority', 'Priority:') !!}
    {!! Form::number('priority', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('playlists.index') !!}" class="btn btn-default text-default">Cancel</a>
</div>
