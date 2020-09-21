@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="float-left">Channels</h1>
        <h1 class="float-right">
{{--            <a class="btn btn-secondary" href="{!! route('channels.update-playlist-id') !!}"><i class="fas fa-sync"></i> Sync Playlist</a>--}}
            <a class="btn btn-primary" href="{!! route('channels.create') !!}"><i class="fas fa-plus-circle"></i> 添加[未分类]频道</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="card card-accent-primary shadow-lg">
            <div class="card-header">
                <table class="bg-secondary w-100">
                    <tr>
                        <td class="p-2" style="width:80px; text-align: center">
                            <span class="lead">协议</span>
                        </td>
                        <td class="p-2">
                            <div class="btn-group" role="group">
                                @foreach($schemes as $scheme)
                                    <a href="{{request()->fullUrlWithQuery(['scheme'=> $scheme->scheme,'page' => null])}}"
                                       class="btn btn-light btn-sm @if($currentScheme == $scheme->scheme) active @endif">
                                        {{$scheme->scheme}}
                                    </a>
                                @endforeach
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="p-2" style="width:80px; text-align: center">
                            <span class="lead">列表</span>
                        </td>
                        <td class="p-2">
                            <div class="btn-group" role="group">
                                @foreach($playlists as $playlist)
                                    <a href="{{request()->fullUrlWithQuery(['playlist'=> $playlist->id,'page' => null])}}"
                                       class="btn btn-light btn-sm @if($currentPlaylist == $playlist->name) active @endif">
                                        {{$playlist->name}}
                                    </a>
                                @endforeach
                            </div>
                        </td>
                    </tr>

                    @if($currentDomain)
                    <tr>
                        <td class="p-2" style="width:80px; text-align: center">
                            <span class="lead">域</span>
                        </td>
                        <td class="p-2">
                            <div class="btn-group" role="group">
                                <a href="{{request()->fullUrlWithQuery(['domain'=> null,'page' => null])}}"
                                   class="btn btn-light btn-sm">{{$currentDomain}}
                                </a>
                                <a  href="{{request()->fullUrlWithQuery(['domain'=> null,'page' => null])}}"
                                    class="btn btn-danger btn-sm"><i class="fas fa-times"></i> </a>
                            </div>
                        </td>
                    </tr>
                    @endif
                </table>
                <div>
                    <style>
                        ul { margin-bottom: 0 !important;}
                    </style>
                    <div class="float-right pt-2">
                        {{$channels->links()}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('channels.table')
            </div>
            <div class="card-footer d-flex justify-content-center">
                {{$channels->links()}}
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

