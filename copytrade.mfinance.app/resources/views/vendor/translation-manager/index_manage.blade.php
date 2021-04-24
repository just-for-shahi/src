@if(!isset($group))
    <div class="panel panel-primary">
        <div class="panel-heading">{{ trans('translation-manager::panel.welcome.title') }}</div>
        <div class="panel-body">
            @if(sizeof($groups) == 0)
                <p>{{ trans('translation-manager::panel.welcome.doImport') }}</p>
            @else
                <p>{{ trans('translation-manager::panel.welcome.chooseGroup') }}</p>
            @endif
        </div>
    </div>
@else
    <div class="panel panel-primary">
        <div class="panel-heading">{{ $group }}</div>
        <div class="panel-body">
            @yield('translate_section') 
        </div>
    </div>
@endif