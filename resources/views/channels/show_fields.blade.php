<!-- Playlist Id Field -->
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title">{!! Form::label('playlist_id', 'Playlist Id:') !!}</h6>
            <p class="card-text">
                {!! $channel->playlist_id !!}
            </p>
        </div>
    </div>
</div>

<!-- Name Field -->
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title">{!! Form::label('name', 'Name:') !!}</h6>
            <p class="card-text">
                {!! $channel->name !!}
            </p>
        </div>
    </div>
</div>

<!-- Scheme Field -->
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title">{!! Form::label('scheme', 'Scheme:') !!}</h6>
            <p class="card-text">
                {!! $channel->scheme !!}
            </p>
        </div>
    </div>
</div>

<!-- Domain Field -->
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title">{!! Form::label('domain', 'Domain:') !!}</h6>
            <p class="card-text">
                {!! $channel->domain !!}
            </p>
        </div>
    </div>
</div>

<!-- Url Field -->
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title">{!! Form::label('url', 'Url:') !!}</h6>
            <p class="card-text">
                {!! $channel->url !!}
            </p>
        </div>
    </div>
</div>

<!-- Valid Field -->
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title">{!! Form::label('valid', 'Valid:') !!}</h6>
            <p class="card-text">
                {!! $channel->valid !!}
            </p>
        </div>
    </div>
</div>

<!-- Check Count Field -->
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title">{!! Form::label('check_count', 'Check Count:') !!}</h6>
            <p class="card-text">
                {!! $channel->check_count !!}
            </p>
        </div>
    </div>
</div>

<!-- Valid Count Field -->
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title">{!! Form::label('valid_count', 'Valid Count:') !!}</h6>
            <p class="card-text">
                {!! $channel->valid_count !!}
            </p>
        </div>
    </div>
</div>

