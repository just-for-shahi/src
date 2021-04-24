<div class="btn-group">
    <a class="btn btn-sm btn-default">  {{ trans('admin.add2copier') }}</a>
    <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu" role="menu">
        @foreach($copiers as $copier)
            <li><a href="#" class="grid-add2copier-{{ $copier->id }}">{{ $copier->title }}</a></li>
        @endforeach
    </ul>
</div>