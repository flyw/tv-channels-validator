@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Edit List
        </h1>
   </section>
   <div class="content">
       {{-- @include('adminlte-templates::common.errors') --}}
       <div class="card card-accent-primary shadow-lg">
           <div class="card-body">
                   {!! Form::model($playlist, ['route' => ['playlists.update-list', $playlist->id], 'method' => 'patch']) !!}
                   <div class="row">
                       <div class="form-group col-sm-12">
                           {!! Form::textarea('list', null, ['class' => 'form-control', 'rows'=> '20']) !!}
                       </div>

                       <!-- Submit Field -->
                       <div class="form-group col-12">
                           {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                           <a href="{!! route('playlists.index') !!}" class="btn btn-default text-default">Cancel</a>
                       </div>
                    </div>
                   {!! Form::close() !!}
           </div>
       </div>
   </div>
@endsection
