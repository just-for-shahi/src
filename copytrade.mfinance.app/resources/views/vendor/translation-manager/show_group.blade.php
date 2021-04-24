@if($canManage)
<form class="form-add" action="{{ route('translation-manager.add', $group) }}" method="POST"  role="form">
    {{ csrf_field() }}
    <textarea class="form-control pull-left" style="width: calc(100% - 50px)" rows="2" name="keys" placeholder="{{ trans('translation-manager::panel.group.add-lines') }}"></textarea>
    <button type="submit" class="btn btn-primary pull-right" title="{{ trans('translation-manager::panel.actions.add') }}"><i class="glyphicon glyphicon-plus"></i></button>
    <div class="clearfix"></div>
</form>
<hr>
@endif
<div class="table-responsive">
    <table class="table table-sm table-striped table-bordered">
        <thead>
        <tr>
            <th width="15%">{{ trans('translation-manager::panel.rows.key') }}</th>
            @foreach($locales as $locale)
                <th>{{ $locale }}</th>
            @endforeach
            @if($deleteEnabled)
                <th style="width: 30px !important;">&nbsp;</th>
            @endif
        </tr>
        </thead>
        <tbody>
            @foreach($translations as $key => $translation)
                @include('translation-manager::key_row', [
                    'key' => $key, 
                    'translation' => $translation, 
                    'indent' => 0, 
                    'parent_key' => ''
                ])
            @endforeach
        </tbody>
    </table>
</div>

<div class="text-center margin-bottom-30">
    <form class="form-publish" method="POST" action="{{ route('translation-manager.publish', $group) }}" role="form">
        {{ csrf_field() }}
        <a href="{{ route('translation-manager.index') }}" class="c-translation-module__back btn btn-default margin-right-10" title="{{ trans('translation-manager::panel.actions.back') }}">
            <i class="glyphicon glyphicon-arrow-left"></i>
        </a>
        <button type="submit" class="btn btn-primary" title="{{ trans('translation-manager::panel.actions.publish') }}"><i class="glyphicon glyphicon-floppy-disk"></i></button>
    </form>
</div>