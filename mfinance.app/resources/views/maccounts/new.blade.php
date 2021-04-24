{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="col-12 row">

        <div class="card card-custom col-8">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">New MAccount
                        <div class="text-muted pt-2 font-size-sm">Register your own account.</div>
                    </h3>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('maccounts.store')}}" method="post">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Broker</label>
                        <div class="col-10">
                            <select class="form-control" name="broker">
                                <option selected disabled>Please select your broker.</option>
                                <option value="{{\App\Enums\UAccount\Broker::OANDA}}">Oanda</option>
                                <option value="{{\App\Enums\UAccount\Broker::ALPARI}}">Alpari<small>(LLC)</small></option>
                                <option value="{{\App\Enums\UAccount\Broker::FXTM}}">ForexTime</option>
                                <option value="{{\App\Enums\UAccount\Broker::ROBOFOREX}}">RoboForex</option>
                                <option value="{{\App\Enums\UAccount\Broker::HOTFOREX}}">HotForex</option>
                                <option value="{{\App\Enums\UAccount\Broker::FXCM}}">FXCM</option>
                                <option value="{{\App\Enums\UAccount\Broker::ALPARI_INTL}}">Alpari <small>(International)</small></option>
                                <option value="{{\App\Enums\UAccount\Broker::ICMARKETS}}">ICMarkets</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-2 col-form-label">Username</label>
                        <div class="col-10">
                            <input class="form-control" type="text" name="username" placeholder="Please enter username of your MetaTrader" id="username"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-2 col-form-label">Password</label>
                        <div class="col-10">
                            <input class="form-control" type="text" name="password" placeholder="Please enter password of your MetaTrader" id="password"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="investor-password" class="col-2 col-form-label">Investor Password</label>
                        <div class="col-10">
                            <input class="form-control" type="text" name="investor-password" placeholder="Please enter investor password of your MetaTrader" id="investor-password"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="server" class="col-2 col-form-label">Server</label>
                        <div class="col-10">
                            <input class="form-control" type="text" name="server" placeholder="Please enter server of your MetaTrader" id="server"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="report" class="col-2 col-form-label">Report</label>
                        <div class="col-10">
                            <select class="form-control" name="report">
                                <option value="{{\App\Enums\UAccount\Report::DISABLE}}">Disable</option>
                                <option value="{{\App\Enums\UAccount\Report::DAILY}}">Daily</option>
                                <option value="{{\App\Enums\UAccount\Report::WEEKLY}}">Weekly</option>
                                <option selected value="{{\App\Enums\UAccount\Report::MONTHLY}}">Monthly</option>
                                <option value="{{\App\Enums\UAccount\Report::THREE_MONTHS}}">Every 3 months</option>
                                <option value="{{\App\Enums\UAccount\Report::SIX_MONTHS}}">Every 6 months</option>
                                <option value="{{\App\Enums\UAccount\Report::YEARLY}}">Yearly</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dashboard" class="col-2 col-form-label">Show on Dashboard?</label>
                        <div class="col-10">
                            <select class="form-control" name="dashboard">
                                <option value="0">No</option>
                                <option selected value="1">Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <button type="submit" class="btn btn-primary btn-success font-weight-bolder mr-2">Register</button>
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
                        <div class="text-muted pt-2 font-size-sm">All your preferred UAccounts with our website's available brokers can be added here.</div>
                    </h3>
                </div>
            </div>

            <div class="card-body">
                <ul>
                    <li>Trading account should be owner`s name equal account name.</li>
                    <li>Minimum deposit is <strong>100,000 USDT</strong></li>
                    <li>We just support MetaTrader 4 version.</li>
                    <li>Capital, liquidity and risk management determined by Uinvest.</li>
                    <li>Do not interfere with trade.</li>
                    <li>Do not include expert advisors or other trading algorithms on your side.</li>
                    <li>Do not open or close orders.</li>
                    <li>Do not withdraw from the account and do not replenish without prior approval.</li>
                    <li>Do not change the trading password or investor password during operation.</li>
                    <li>Do not change leverage without prior approval.</li>
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
