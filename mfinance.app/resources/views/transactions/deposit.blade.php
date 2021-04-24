{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="col-12 row">

        <div class="card card-custom col-8">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Deposit to Uinvest
                        <div class="text-muted pt-2 font-size-sm">Deposit to Uinvest platform.</div>
                    </h3>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('transactions.deposited')}}" method="post">
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
                        <label for="amount" class="col-4 col-form-label">Amount</label>
                        <div class="col-8">
                            <input class="form-control" type="number" name="amount" placeholder="Please enter amount in your cryptocurrency" id="amount"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gateway" class="col-4 col-form-label">CryptoCurrency</label>
                        <div class="col-8">
                            <select class="form-control" name="cryptocurrency">
                                <option selected value="0">Tether (USDT)</option>
                                <option value="1">Binance (BNB)</option>
                                <option value="2">True USD (TUSD)</option>
                                <option value="3">PAX (PAX)</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-4 col-form-label">Description</label>
                        <div class="col-8">
                            <input class="form-control" type="text" name="description" placeholder="Please enter description of your deposit" id="description"/>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <button type="submit" class="btn btn-primary btn-success font-weight-bolder mr-2">Deposit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card col-4 pull-right">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Help Desk
                        <div class="text-muted pt-2 font-size-sm">In this page you can deposit your money to your Uinvest accounts and services.</div>
                    </h3>
                </div>
            </div>

            <div class="card-body">
                <ul>
                    <li>Enter amount of your deposit.</li>
                    <li>Select cryptocurrency of your deposit method.</li>
                    <li>Enter your description or comment for deposit.</li>
                    <li>Click on deposit to payment on your selected cryptocurrency.</li>
                    <li>Just a moment, Your money is ready to use in Uinvest platform.</li>
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
