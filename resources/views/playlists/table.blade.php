<div class="table-responsive">
    <table class="table w-100" id="playlists-table">
        <thead>
            <tr>
                <th class="text-center">Name</th>
{{--                <th>Keywords</th>--}}
                <th class="text-center">Priority</th>
                <th class="text-center">Count</th>
                <th class="text-center">Update</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($playlists as $playlist)
            <tr>
                <td class="text-center" data-toggle="tooltip" title="{!! $playlist->keywords !!}" data-trigger="click">{!! $playlist->name !!}</td>
{{--                <td>{!! $playlist->keywords !!}</td>--}}
                <td class="text-center">{!! $playlist->priority !!}</td>
                <td class="text-center" data-toggle="tooltip" title="总数/存活/有效" data-trigger="click">
                    <span class="badge badge-secondary text-black-50">{!! $playlist->channels()->withTrashed()->count() !!}</span>
                    <span class="badge badge-light">{!! $playlist->channels()->count() !!}</span>
                    <span class="badge badge-success">{!! $playlist->channels()->where("valid", 1)->count() !!}</span>
                </td>
                <td class="text-center">
                    <span class="badge badge-white">
                        {!! \Carbon\Carbon::parse($playlist->updated_at)->format("m/d H:i") !!}
                    </span>
                </td>
                <td>
                    {!! Form::open(['route' => ['playlists.destroy', $playlist->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('playlists.edit-list', [$playlist->id]) !!}" class='btn btn-primary btn-sm' data-toggle="tooltip" title="Edit List"><i class="fas fa-list"></i></a>
                        <a href="{!! route('playlists.sync', [$playlist->id]) !!}" class='btn btn-warning btn-sm' data-toggle="tooltip" title="Sync"><i class="fas fa-sync-alt"></i></a>
{{--                        <a href="{!! route('playlists.show', [$playlist->id]) !!}" class='btn btn-secondary btn-sm' data-toggle="tooltip" title="List"><i class="fas fa-list"></i></a>--}}
                        <a href="{!! route('playlists.edit', [$playlist->id]) !!}" class='btn btn-primary btn-sm' data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                        {!! Form::button('<i class="fas fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
