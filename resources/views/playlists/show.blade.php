@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {!! $playlist->name !!}
            <small>数量： {!! $playlist->channels->where("valid", 1)->count() !!}</small>
        </h1>
    </section>
    <div class="content">
        <div class="card card-accent-primary shadow-lg">
            <div class="card-body">
{{--                <div class="row" style="padding: 20px">--}}
{{--                    @include('playlists.show_fields')--}}
{{--                    <div class="col-12">--}}
                    <textarea rows="25" class="w-100 text-black-50" style="white-space: pre" readonly>
@foreach($channels as $channel)
{!! $channel->name !!},{!! $channel->url !!}
@endforeach
                    </textarea>
{{--                    </div>--}}
                    <a href="{!! route('playlists.index') !!}" class="btn btn-default"><i class="fas fa-reply"></i> Back</a>
{{--                </div>--}}
            </div>
        </div>
    </div>
@endsection
