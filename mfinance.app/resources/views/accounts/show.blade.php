@php
    use App\Enums\Account\Country;
@endphp

{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
<div class="col-12 row">

    <div class="card card-custom col">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">My profile
                    <div class="text-muted pt-2 font-size-sm">To get back your smile into Uinvest family.</div>
                </h3>
            </div>
        </div>

        <div class="card-body">
            <form action="/account" method="post">
                @method('PATCH')
                @csrf

                <div class="row">
                    <div class="col-sm-6 col-md-4 mb-4">
                        <label for="first_name_tx">First name</label>
                        <input id="first_name_tx" name="first_name" value="{{$account['first_name']}}" type="text" class="form-control">
                    </div>
                    <div class="col-sm-6 col-md-4 mb-4">
                        <label for="last_name_tx">Last name</label>
                        <input id="last_name_tx" name="last_name" value="{{$account['last_name']}}" type="text" class="form-control">
                    </div>
                    <div class="col-sm-6 col-md-4 mb-4">
                        <label for="country">Country</label>
                        <select id="country" class="form-control" name="country">
                        @foreach($country_list as $name => $code)
                            <option value="{{ $code }}" {{ $code == $account['country'] ? 'selected="selected"' : '' }}>{{ $name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-4">
                        <label for="mobile_tx">Mobile</label>
                        <input id="mobile_tx" value="{{$account['mobile']}}" type="text" class="form-control" readonly>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-4">
                        <label for="email_tx">Email</label>
                        <input id="email_tx" value="{{$account['email']}}" type="text" class="form-control" readonly>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-4">
                        <label for="created_at_tx">Created at</label>
                        <input id="created_at_tx" value="{{$account['created_at']}}" type="text" class="form-control" readonly>
                    </div>
                </div>
                <br>
                <div class="row mb-4">
                    <div class="col text-center">
                        <input type="submit" class="btn btn-primary" value="Update">
                    </div>
                </div>
            </form>
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                        <br>
                    @endforeach
                </div>
            @elseif (!empty($msg))
                <div class="alert alert-success">
                    {{ $msg }}
                </div>
            @endif

        </div>
    </div>
</div>
@endsection

@section('styles')
@endsection

@section('scripts')
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
@endsection
