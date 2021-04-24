{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="col-12 row">

        <div class="card card-custom col-8">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Register Wallet
                        <div class="text-muted pt-2 font-size-sm">Register your cryptocurrency wallet.</div>
                    </h3>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('wallets.store')}}" method="post">
                    @csrf
                    @include('partials.errors')

                    <div class="form-group row">
                        <label class="col-2 col-form-label">Currency</label>
                        <div class="col-10">
                            <select class="form-control" name="currency">
                                <option selected value="{{\App\Enums\Wallet\Currency::USDT}}">Tether (USDT)</option>
                                <option value="{{\App\Enums\Wallet\Currency::BNB}}">Binance (BNB)</option>
                                <option value="{{\App\Enums\Wallet\Currency::TUSD}}">True USD (TUSD)</option>
                                <option value="{{\App\Enums\Wallet\Currency::PAX}}">PAX)</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-2 col-form-label">Address</label>
                        <div class="col-10">
                            <input class="form-control" type="text" name="address"
                                   placeholder="Please enter address of your wallet" id="address"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="default" class="col-2 col-form-label">Default</label>
                        <div class="col-10">
                            <select class="form-control" name="default">
                                <option selected value="0">Yes</option>
                                <option value="1">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dashboard" class="col-2 col-form-label">Dashboard</label>
                        <div class="col-10">
                            <select class="form-control" name="dashboard">
                                <option selected value="0">Yes</option>
                                <option value="1">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <button type="submit" class="btn btn-primary btn-success font-weight-bolder mr-2">
                                    Register
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card col-4 pull-right">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Help Desk
                        <div class="text-muted pt-2 font-size-sm">All your preferred wallets with our website's
                            available services can be added here.
                        </div>
                    </h3>
                </div>
            </div>

            <div class="card-body">
                <ul>
                    <li>Select your cryptocurrency.</li>
                    <li>You can whether add your own wallet.</li>
                    <li>Insert the wallet information</li>
                    <li>Indicate your wallets priority.</li>
                    <li>Deactivate or destroy your wallet if you don't need it.</li>
                </ul>
            </div>
        </div>
    </div>

@endsection

@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('scripts')
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
@endsection
