@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Playlist
        </h1>
   </section>
   <div class="content">
       {{-- @include('adminlte-templates::common.errors') --}}
       <div class="card card-accent-primary shadow-lg">
           <div class="card-body">
                   {!! Form::model($playlist, ['route' => ['playlists.update', $playlist->id], 'method' => 'patch']) !!}
                   <div class="row">
                        @include('playlists.fields')
                    </div>
                   {!! Form::close() !!}
           </div>
       </div>
   </div>
@endsection
