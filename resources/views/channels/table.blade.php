<div class="table-responsive">
    <table class="table w-100" id="channels-table">
        <thead>
            <tr>
                <th class="text-center">列表</th>
                <th >名称</th>
                <th class="text-center">协议</th>
                <th >域名</th>
{{--                <th>地址</th>--}}
                <th class="text-center">可用</th>
{{--                <th>Check Count</th>--}}
{{--                <th>Valid Count</th>--}}
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($channels as $channel)
            <tr>
                <td class="text-center"><span class="badge badge-light">{!! optional($channel->playlist)->name !!}</span></td>
                <td><span class="badge badge-light">{!! $channel->name !!}</span></td>
                <td class="text-center"><span class="badge badge-light">{!! $channel->scheme !!}</span></td>
                <td>
                    <a href="{{request()->fullUrlWithQuery(['domain'=> $channel->domain,'page' => null])}}"
                       class="badge badge-light">
                        {!! $channel->domain !!}
                    </a>
                </td>
                <td class="text-center">
                    @if ($channel->check_count == 0)
                        <span class="badge badge-success">未测试</span>
                    @elseif($channel->valid)
                        <span class="badge badge-success">有效</span>
                    @else
                        <span class="badge badge-danger">失效</span>
                    @endif
                </td>
                <td class="text-center">
                    {!! Form::open(['route' => ['channels.destroy', $channel->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('channels.edit', [$channel->id]) !!}" ><i class="fas fa-pencil-alt"></i></a>
                        {!! Form::button('<i class="fas fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'border-0 text-danger ml-2', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            <tr class="bg-secondary">
                <td class="p-0 pl-2" colspan="4" data-toggle="tooltip" title="{!! $channel->url !!}" data-trigger="click">
                    <span class="badge badge-secondary text-black-50">{!! $channel->url !!}</span>
                </td>
                <td class="p-0 text-center">
                     <span class="badge badge-light text-black-50">
                        尝试：{!! $channel->check_count !!}
                    </span>
                </td>
                <td class="p-0 text-center">
                     <span class="badge badge-light text-black-50">
                        有效：{!! $channel->valid_count !!}
                    </span>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
