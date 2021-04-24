<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">

        @foreach($copiers as $copier)
            <li {{ $copier['active'] ? 'class=active' : '' }}>
                <a href="{{ $copier['link'] }}">
                    {{ $copier['title'] }} <i class="fa fa-exclamation-circle text-red hide"></i>
                </a>
            </li>
        @endforeach

    </ul>
    <div class="tab-content">
        <div class="tab-pane active" >
                {!! $panel->render() !!}
        </div>
    </div>
</div>