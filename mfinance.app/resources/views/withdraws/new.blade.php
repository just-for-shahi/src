{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="col-12 row">

        <div class="card card-custom col-8">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">New Withdraw
                        <div class="text-muted pt-2 font-size-sm">Get your profits & money easily!</div>
                    </h3>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('withdraws.store')}}" method="post">
                    @csrf
                    @include('partials.errors')
                    {{--                    <div class="form-group row">--}}
                    {{--                        <label class="col-2 col-form-label">Bank Account</label>--}}
                    {{--                        <div class="col-10">--}}
                    {{--                            <select class="form-control" name="bank_account">--}}
                    {{--                                <option selected value="no">Not Selected</option>--}}
                    {{--                                @foreach($bank_accounts as $bank_account)--}}
                    {{--                                    <option value="{{$bank_account->id}}">{{$bank_account->no}} - {{$bank_account->card}}</option>--}}
                    {{--                                @endforeach--}}
                    {{--                            </select>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Wallet</label>
                        <div class="col-10">
                            <select class="form-control" name="wallet_id" required>
                                <option selected value="" disabled>Not Selected</option>
                                @foreach($service_accounts as $service_account)
                                    <option
                                        value="{{$service_account->id}}">{{$service_account->description}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="iban" class="col-2 col-form-label">Investment</label>
                        <div class="col-10">
                            <select class="form-control" name="investment_id">
                                <option selected disabled>Please select</option>
                                @foreach($investments as $investment)
                                    <option
                                        value="{{$investment->id}}">Invested: {!! \App\Helpers\Investment\Investment::summary($investment)!!} - Remaining:
                                        {{$investment->withdrawable_amount}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="amount" class="col-2 col-form-label">Amount</label>
                        <div class="col-10">
                            <input class="form-control" type="number" name="amount"
                                   placeholder="Please enter how much money you want to withdraw" id="amount"/>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <button type="submit" class="btn btn-primary btn-success font-weight-bolder mr-2">Get
                                    Money
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
                        <div class="text-muted pt-2 font-size-sm">For get your profits & money from Uinvest to your bank
                            accounts and service accounts, Please register withdraw request. .
                        </div>
                    </h3>
                </div>
            </div>

            <div class="card-body">
                <ul>
                    <li>Uinvest account should be owner`s name equal withdraw account name.</li>
                    <li>Select your bank or service account for withdraw.</li>
                    <li>Select investment you want to get money from that.</li>
                    <li>Enter how much you want to withdraw.</li>
                    <li>Submit "Get Money" button to register withdraw request.</li>
                    <li>Please wait for minutes to get your money in your selected withdraw account.</li>
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
