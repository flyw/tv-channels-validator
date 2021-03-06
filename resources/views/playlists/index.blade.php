@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="float-left">Playlists</h1>
        <h1 class="float-right">
            <a class="btn btn-secondary" href="{!! route('bc.index') !!}"><i class="fas fa-list"></i> 百川 /av /test</a>

            <a class="btn btn-secondary" href="{!! route('fxz.index') !!}"><i class="fas fa-list"></i> 分享者 /av /test</a>

            <a class="btn btn-primary" href="{!! route('playlists.create') !!}"><i class="fas fa-plus-circle"></i> Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="card card-accent-primary shadow-lg">
            <div class="card-body">
                    @include('playlists.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

