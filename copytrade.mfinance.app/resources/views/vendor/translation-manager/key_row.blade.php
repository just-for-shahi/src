@php
    $isCatalog = true;
    foreach($locales as $locale) {
        if(isset($translation[$locale])) {
            $isCatalog = false;
            break;
        }
    }
@endphp
@if(is_array($translation) && $isCatalog)
<tr class="empty" data-base="{{ $parent_key . $key }}">
    <td colspan="{{ 1 + sizeof($locales) + $deleteEnabled }}">{{ str_repeat("&nbsp;", $indent * 4) . $key }}</td>
</tr>
    @foreach($translation as $key2 => $value2)
        @include('translation-manager::key_row', [
            'key' => $key2, 
            'translation' => $value2, 
            'indent' => $indent + 1, 
            'parent_key' => $parent_key . $key .'.'
        ])
    @endforeach
@else
<tr data-parent="{{ rtrim($parent_key, '.') }}" id="{{ $parent_key . $key }}">
    <td>{{ str_repeat("&nbsp;", $indent * 4) . $key }}</td>
    @foreach($locales as $locale)
        @php $t = isset($translation[$locale]) ? $translation[$locale] : null; @endphp
        <td>
            <a href="#edit" class="editable status-{{ $t ? $t->status : 0 }} 
                locale-{{ $locale }}
                {{ $t && substr($t->value, -2) == strtoupper($currentLocale) && config('translation-manager.highlight_locale_marked') ? ' editable-locale-empty' : '' }}" 
                data-locale="{{ $locale }}" 
                data-name="{{ $locale . "|" . $parent_key . $key }}" 
                id="username" 
                data-type="textarea" 
                data-pk="{{ $t ? $t->id : 0 }}" 
                data-url="{{ route('translation-manager.edit', $group) }}" 
                data-title="{{ trans('translation-manager::panel.rows.edit') }}">{{ $t ? htmlentities($t->value, ENT_QUOTES, 'UTF-8', false) : '' }}</a>
        </td>
    @endforeach
    @if($deleteEnabled)
        <td>
            <a class="delete-key btn btn-danger btn-sm" 
            data-confirm="{{ trans('translation-manager::panel.rows.confirm-delete', ['key' => $key]) }}" 
            nohref 
            data-url="{{ route('translation-manager.delete', [$parent_key . $key, $group]) }}" 
            style="cursor: pointer" 
            title="{{ trans('translation-manager::panel.actions.delete') }}"><i class="glyphicon glyphicon-trash"></i></a>
        </td>
    @endif
</tr>
@endif