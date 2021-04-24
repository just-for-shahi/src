<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">

        @foreach($experts as $expert)
            <li {{ $expert['active'] ? 'class=active' : '' }}>
                <a href="{{ $expert['link'] }}">
                    {{ $expert['title'] }} <i class="fa fa-exclamation-circle text-red hide"></i>
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