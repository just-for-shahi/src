@extends('translation-manager::layout')

@section('translate_section')
    @if($canManage)
        @include('translation-manager::index_manage')
    @endif  
@endsection