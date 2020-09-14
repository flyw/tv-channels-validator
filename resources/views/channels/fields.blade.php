<!-- Playlist Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('playlist_id', 'Playlist Id:') !!}
    {!! Form::number('playlist_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Scheme Field -->
<div class="form-group col-sm-6">
    {!! Form::label('scheme', 'Scheme:') !!}
    {!! Form::text('scheme', null, ['class' => 'form-control']) !!}
</div>

<!-- Domain Field -->
<div class="form-group col-sm-6">
    {!! Form::label('domain', 'Domain:') !!}
    {!! Form::text('domain', null, ['class' => 'form-control']) !!}
</div>

<!-- Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('url', 'Url:') !!}
    {!! Form::text('url', null, ['class' => 'form-control']) !!}
</div>

<!-- Valid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('valid', 'Valid:') !!}
    {!! Form::number('valid', null, ['class' => 'form-control']) !!}
</div>

<!-- Check Count Field -->
<div class="form-group col-sm-6">
    {!! Form::label('check_count', 'Check Count:') !!}
    {!! Form::number('check_count', null, ['class' => 'form-control']) !!}
</div>

<!-- Valid Count Field -->
<div class="form-group col-sm-6">
    {!! Form::label('valid_count', 'Valid Count:') !!}
    {!! Form::number('valid_count', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('channels.index') !!}" class="btn btn-default text-default">Cancel</a>
</div>
