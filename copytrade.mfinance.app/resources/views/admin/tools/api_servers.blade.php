<div class="btn-group">
    <a class="btn btn-sm btn-default">  {{ trans('admin.api_server') }} @if(!empty($api_server_ip_active)) : {{$api_server_ip_active}} @endif</a>
    <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu" role="menu">
        @foreach($api_server_ips as $key => $label)
            <li><a href="" data-ip="{{$key}}" class="grid-api-server-ip">{{ $label }}</a></li>
        @endforeach
    </ul>
</div>